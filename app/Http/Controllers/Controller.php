<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Visit;
use App\Service;

class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function sendFlow($service, $params, $method="GET") {
		$url="https://sandbox.flow.cl/api/".$service;
		// $url="https://www.flow.cl/api/".$service;
		$params=array('apiKey' => "7713E23F-3AC9-4826-8633-55F95L7EE640") + $params;
		// $params=array('apiKey' => "1F395146-00B7-49DD-A4D3-55F95L7EE640") + $params;
		$params["s"]=$this->sign($params);
		if ($method=="GET") {
			$response=$this->httpGetFlow($url, $params);
		} else {
			$response=$this->httpPostFlow($url, $params);
		}

		if (isset($response["info"])) {
			$code=$response["info"]["http_code"];
			if (!in_array($code, array("200", "400", "401"))) {
				return redirect()->route('diary')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Pago fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
			}
		}
		$body=json_decode($response["output"], true);
		return $body;
	}

	public function sign($params) {
		$keys=array_keys($params);
		sort($keys);
		$toSign="";
		foreach ($keys as $key) {
			$toSign.=$key.$params[$key];
		}
		if (!function_exists("hash_hmac")) {
			return redirect()->route('diary')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Pago fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
		}
		return hash_hmac('sha256', $toSign, "58c8205a004c56679ebf540e25ac4f763e340d8a");
		// return hash_hmac('sha256', $toSign, "1729ca40f31b74324c181a64b0baf919ca01acff");
	}

	public function httpGetFlow($url, $params) {
		$url=$url."?".http_build_query($params);
		$curl=curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		$response=curl_exec($curl);
		if($response===false) {
			$error=curl_error($curl);
			return $error;
		} 
		$info=curl_getinfo($curl);
		curl_close($curl);
		return array("output" => $response, "info" => $info);
	}

	public function httpPostFlow($url, $params) {
		$curl=curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($curl, CURLOPT_POST, TRUE);
		curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
		$response=curl_exec($curl);
		if($response===false) {
			$error=curl_error($curl);
			return redirect()->route('diary', ['phase' => 'pago-y-confirmacion'])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Pago fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
		} 
		$info=curl_getinfo($curl);
		curl_close($curl);
		return array("output" => $response, "info" => $info);
	}

	public function data()
	{
		$services=[];
		$services_labels=[];
		$services_values=[];

		$all_services=Service::get();
		foreach ($all_services as $service) {
			$services[$service->slug]=array('name' => $service->name, 'value' => count($service->visits));
		}

		$num=0;
		usort($services, function($a, $b) {
			return $a['value'] - $b['value'];
		});
		$services=array_reverse($services);

		$services_labels="";
		foreach ($services as $service) {
			if ($num<5) {
				$services_labels.='"'.$service['name'].'",';
				$services_values[$num]=$service['value'];
				$num++;
			}
		}
		$services_labels=substr($services_labels, 0, -1);

		$today=date('D');
		$week_days='"'.date("D",strtotime($today."- 6 days")).'", "'.date("D",strtotime($today."- 5 days")).'", "'.date("D",strtotime($today."- 4 days")).'", "'.date("D",strtotime($today."- 3 days")).'", "'.date("D",strtotime($today."- 2 days")).'", "'.date("D",strtotime($today."- 1 days")).'", "'.$today.'"';

		$month=date('d-m-Y');
		$month_year='"'.date("M",strtotime($month."- 11 month")).'", "'.date("M",strtotime($month."- 10 month")).'", "'.date("M",strtotime($month."- 9 month")).'", "'.date("M",strtotime($month."- 8 month")).'", "'.date("M",strtotime($month."- 7 month")).'", "'.date("M",strtotime($month."- 6 month")).'", "'.date("M",strtotime($month."- 5 month")).'", "'.date("M",strtotime($month."- 4 month")).'", "'.date("M",strtotime($month."- 3 month")).'", "'.date("M",strtotime($month."- 2 month")).'", "'.date("M",strtotime($month."- 1 month")).'", "'.date("M",strtotime($month)).'"';

		$day=date('Y-m-d');
		$day_one=Visit::whereBetween('created_at', [date('Y-m-d')." 00:00:00", date('Y-m-d')." 23:59:59"])->count();
		$day_two=Visit::whereBetween('created_at', [date('Y-m-d',strtotime($day."- 1 days"))." 00:00:00", date('Y-m-d',strtotime($day."- 1 days"))." 23:59:59"])->count();
		$day_three=Visit::whereBetween('created_at', [date('Y-m-d',strtotime($day."- 2 days"))." 00:00:00", date('Y-m-d',strtotime($day."- 2 days"))." 23:59:59"])->count();
		$day_four=Visit::whereBetween('created_at', [date('Y-m-d',strtotime($day."- 3 days"))." 00:00:00", date('Y-m-d',strtotime($day."- 3 days"))." 23:59:59"])->count();
		$day_five=Visit::whereBetween('created_at', [date('Y-m-d',strtotime($day."- 4 days"))." 00:00:00", date('Y-m-d',strtotime($day."- 4 days"))." 23:59:59"])->count();
		$day_six=Visit::whereBetween('created_at', [date('Y-m-d',strtotime($day."- 5 days"))." 00:00:00", date('Y-m-d',strtotime($day."- 5 days"))." 23:59:59"])->count();
		$day_seven=Visit::whereBetween('created_at', [date('Y-m-d',strtotime($day."- 6 days"))." 00:00:00", date('Y-m-d',strtotime($day."- 6 days"))." 23:59:59"])->count();

		$month=date('Y-m');
		$month_one=Visit::whereYear('created_at', date('Y'))->whereMonth('created_at', date('m'))->count();
		$month_two=Visit::whereYear('created_at', date('Y', strtotime($month."- 1 month")))->whereMonth('created_at', date('m', strtotime($month."- 1 month")))->count();
		$month_three=Visit::whereYear('created_at', date('Y', strtotime($month."- 2 month")))->whereMonth('created_at', date('m', strtotime($month."- 2 month")))->count();
		$month_four=Visit::whereYear('created_at', date('Y', strtotime($month."- 3 month")))->whereMonth('created_at', date('m', strtotime($month."- 3 month")))->count();
		$month_five=Visit::whereYear('created_at', date('Y', strtotime($month."- 4 month")))->whereMonth('created_at', date('m', strtotime($month."- 4 month")))->count();
		$month_six=Visit::whereYear('created_at', date('Y', strtotime($month."- 5 month")))->whereMonth('created_at', date('m', strtotime($month."- 5 month")))->count();
		$month_seven=Visit::whereYear('created_at', date('Y', strtotime($month."- 6 month")))->whereMonth('created_at', date('m', strtotime($month."- 6 month")))->count();
		$month_eight=Visit::whereYear('created_at', date('Y', strtotime($month."- 7 month")))->whereMonth('created_at', date('m', strtotime($month."- 7 month")))->count();
		$month_nine=Visit::whereYear('created_at', date('Y', strtotime($month."- 8 month")))->whereMonth('created_at', date('m', strtotime($month."- 8 month")))->count();
		$month_ten=Visit::whereYear('created_at', date('Y', strtotime($month."- 9 month")))->whereMonth('created_at', date('m', strtotime($month."- 9 month")))->count();
		$month_eleven=Visit::whereYear('created_at', date('Y', strtotime($month."- 10 month")))->whereMonth('created_at', date('m', strtotime($month."- 10 month")))->count();
		$month_twentytwo=Visit::whereYear('created_at', date('Y', strtotime($month."- 11 month")))->whereMonth('created_at', date('m', strtotime($month."- 11 month")))->count();

		$week_values=[$day_seven, $day_six, $day_five, $day_four, $day_three, $day_two, $day_one];
		$month_values=[$month_twentytwo, $month_eleven, $month_ten, $month_nine, $month_eight, $month_seven, $month_six, $month_five, $month_four, $month_three, $month_two, $month_one];

		return ['services_labels' => $services_labels, 'services_values' => $services_values, 'week_days' => $week_days, 'week_values' => $week_values, 'month_year' => $month_year, 'month_values' => $month_values];
	}
}
