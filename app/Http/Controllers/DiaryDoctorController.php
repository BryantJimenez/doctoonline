<?php

namespace App\Http\Controllers;

use App\People;
use App\Doctor;
use App\Service;
use App\DiaryDoctor;
use App\DoctorSchedule;
use Illuminate\Http\Request;
use App\Http\Requests\DiaryDoctorStoreRequest;
use App\Http\Requests\DiaryDoctorUpdateRequest;
use Illuminate\Support\Str;

class DiaryDoctorController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
  	$doctors=DiaryDoctor::orderBy('id', 'DESC')->get();
  	$num=1;
  	return view('admin.diaries_doctors.index', compact('doctors', 'num'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
  	$doctors=Doctor::all();
    $services=Service::where('type', 1)->get();
    return view('admin.diaries_doctors.create', compact('doctors', 'services'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(DiaryDoctorStoreRequest $request)
  {
  	$doctor=People::where('slug', request('doctor_id'))->firstOrFail();
  	$data=array('description' => request('description'), 'rating' => request('rating'), 'url' => request('url'), 'doctor_id' => $doctor->doctor->id);
  	$diary_doctor=DiaryDoctor::create($data);

    $num=0;
    if (!is_null(request('service')) && is_array(request('service'))) {
      foreach (request('service') as $service) {
        if(!is_null(request('day')[$num]) && (request('day')[$num]>=0 && request('day')[$num]<=6) && !empty(request('start')[$num]) && !is_null(request('start')[$num]) && !empty(request('end')[$num]) && !is_null(request('end')[$num]) && request('start')[$num]<=request('end')[$num] && !empty(request('price')[$num]) && !is_null(request('price')[$num])) {

          $service=Service::where('slug', $service)->first();
          $exist=DoctorSchedule::where([
            ['service_id', $service->id],
            ['day', request('day')[$num]],
            ['start', '<=', date('H:i', strtotime(request('start')[$num]))],
            ['end', '>=', date('H:i', strtotime(request('end')[$num]))],
            ['doctor_id', $diary_doctor->id]
          ])->orWhere([
            ['service_id', $service->id],
            ['day', request('day')[$num]],
            ['start', '>', date('H:i', strtotime(request('start')[$num]))],
            ['start', '<=', date('H:i', strtotime(request('end')[$num]))],
            ['doctor_id', $diary_doctor->id]
          ])->orWhere([
            ['service_id', $service->id],
            ['day', request('day')[$num]],
            ['end', '>=', date('H:i', strtotime(request('start')[$num]))],
            ['end', '<', date('H:i', strtotime(request('end')[$num]))],
            ['doctor_id', $diary_doctor->id]
          ])->count();

          if (!is_null($service) && $exist==0) {
            $data=array('day' => request('day')[$num], 'start' => request('start')[$num], 'end' => request('end')[$num], 'service_id' => $service->id, 'price' => request('price')[$num], 'doctor_id' => $diary_doctor->id);
            DoctorSchedule::create($data);
          }
        }
        $num++;
      }
    }

    if($diary_doctor){
      return redirect()->route('medicos.agenda.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El médico ha sido registrado exitosamente.']);
    } else {
      return redirect()->route('medicos.agenda.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($slug)
  {
  	$doctor=People::where('slug', $slug)->firstOrFail();
    $services=Service::where('type', 1)->get();
    $num=0;
    return view('admin.diaries_doctors.edit', compact("doctor", "services", "num"));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(DiaryDoctorUpdateRequest $request, $slug)
  {
  	$doctor=People::where('slug', $slug)->firstOrFail();
  	$diary_doctor=DiaryDoctor::where('doctor_id', $doctor->doctor->id)->firstOrFail();
  	$data=array('description' => request('description'), 'rating' => request('rating'), 'url' => request('url'));
  	$diary_doctor->fill($data)->save();

    DoctorSchedule::where('doctor_id', $diary_doctor->id)->delete();

    $num=0;
    if (!is_null(request('service')) && is_array(request('service'))) {
      foreach (request('service') as $service) {
        if(!is_null(request('day')[$num]) && (request('day')[$num]>=0 && request('day')[$num]<=6) && !empty(request('start')[$num]) && !is_null(request('start')[$num]) && !empty(request('end')[$num]) && !is_null(request('end')[$num]) && request('start')[$num]<=request('end')[$num] && !empty(request('price')[$num]) && !is_null(request('price')[$num])) {

          $service=Service::where('slug', $service)->first();
          $exist=DoctorSchedule::orWhere([
            ['service_id', $service->id],
            ['day', request('day')[$num]],
            ['start', '<=', date('H:i', strtotime(request('start')[$num]))],
            ['end', '>=', date('H:i', strtotime(request('end')[$num]))],
            ['doctor_id', $diary_doctor->id]
          ])->orWhere([
            ['service_id', $service->id],
            ['day', request('day')[$num]],
            ['start', '>', date('H:i', strtotime(request('start')[$num]))],
            ['start', '<=', date('H:i', strtotime(request('end')[$num]))],
            ['doctor_id', $diary_doctor->id]
          ])->orWhere([
            ['service_id', $service->id],
            ['day', request('day')[$num]],
            ['end', '>=', date('H:i', strtotime(request('start')[$num]))],
            ['end', '<', date('H:i', strtotime(request('end')[$num]))],
            ['doctor_id', $diary_doctor->id]
          ])->count();

          if (!is_null($service) && $exist==0) {
            $data=array('day' => request('day')[$num], 'start' => request('start')[$num], 'end' => request('end')[$num], 'service_id' => $service->id, 'price' => request('price')[$num], 'doctor_id' => $diary_doctor->id);
            DoctorSchedule::create($data);
          }
        }
        $num++;
      }
    }

    if ($diary_doctor) {
      return redirect()->route('medicos.agenda.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El médico ha sido editado exitosamente.']);
    } else {
      return redirect()->route('medicos.agenda.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($slug)
  {
  	$doctor=People::where('slug', $slug)->firstOrFail();
  	$diary_doctor=DiaryDoctor::where('doctor_id', $doctor->doctor->id)->firstOrFail();
  	$diary_doctor->delete();

  	if ($diary_doctor) {
  		return redirect()->route('medicos.agenda.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El médico ha sido eliminado exitosamente.']);
  	} else {
  		return redirect()->route('medicos.agenda.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
  	}
  }

  public function deactivate(Request $request, $slug) {
  	$doctor=People::where('slug', $slug)->firstOrFail();
  	$diary_doctor=DiaryDoctor::where('doctor_id', $doctor->doctor->id)->firstOrFail();
  	$diary_doctor->fill(['state' => "0"])->save();

  	if ($diary_doctor) {
  		return redirect()->route('medicos.agenda.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El médico ha sido desactivado exitosamente.']);
  	} else {
  		return redirect()->route('medicos.agenda.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
  	}
  }

  public function activate(Request $request, $slug) {
  	$doctor=People::where('slug', $slug)->firstOrFail();
  	$diary_doctor=DiaryDoctor::where('doctor_id', $doctor->doctor->id)->firstOrFail();
  	$diary_doctor->fill(['state' => "1"])->save();

  	if ($diary_doctor) {
  		return redirect()->route('medicos.agenda.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El médico ha sido activado exitosamente.']);
  	} else {
  		return redirect()->route('medicos.agenda.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
  	}
  }
}
