<?php

namespace App\Http\Controllers;

use App\Setting;
use App\User;
use App\People;
use App\Patient;
use App\Doctor;
use App\Banner;
use App\Category;
use App\News;
use App\Country;
use App\Region;
use App\Province;
use App\Commune;
use App\Study;
use App\Insurer;
use App\Profession;
use App\Specialty;
use App\DoctorSpecialty;
use App\Disease;
use App\Operation;
use App\CategoryExam;
use App\Subcategory;
use App\Type;
use App\Exam;
use App\Report;
use App\DiseaseReport;
use App\OperationReport;
use App\FamiliarReport;
use App\ExamReport;
use App\ImageReport;
use App\Pharmacy;
use App\Service;
use App\CategoryDiary;
use App\SubcategoryDiary;
use App\Payment;
use App\Flow;
use App\Diary;
use App\DiaryService;
use App\ExamService;
use App\DoctorService;
use App\Visit;
use App\ServiceVisit;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateCustomRequest;
use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\ReportOneStoreRequest;
use App\Http\Requests\ReportTwoStoreRequest;
use App\Http\Requests\ReportThreeStoreRequest;
use App\Http\Requests\ReportFourStoreRequest;
use App\Http\Requests\ReportFiveStoreRequest;
use App\Http\Requests\ReportSixStoreRequest;
use App\Http\Requests\ReportOneUpdateRequest;
use App\Http\Requests\ReportFiveUpdateRequest;
use App\Http\Requests\DiaryOneStoreRequest;
use App\Http\Requests\DiaryTwoStoreRequest;
use App\Http\Requests\DiaryThreeStoreRequest;
use App\Http\Requests\DiaryFourStoreRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Notifications\DiaryNotification;
use Illuminate\Validation\Rule;
use Barryvdh\DomPDF\Facade as PDF;
use Jenssegers\Agent\Agent;
use Mail;
use File;
use Exception;

class WebController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $this->visitor();
        $num=0;
        $setting=Setting::where('id', "1")->first();
        $services=Service::where('state', "1")->orderBy('id', 'DESC')->get();
        $carousels=Banner::where('type', "1")->where('state', "1")->orderBy('id', 'DESC')->get();
        $banner=Banner::where('type', "2")->where('state', "1")->orderBy('id', 'DESC')->first();
        $news=News::where('featured', "1")->where('state', "1")->limit(3)->orderBy('id', 'DESC')->get();
        return view('web.home', compact('num', 'services', 'carousels', 'banner', 'news', 'setting'));
    }

    public function about() {
        $this->visitor();
        $setting=Setting::where('id', "1")->first();
        $services=Service::where('state', "1")->orderBy('id', 'DESC')->get();
        return view('web.about', compact('setting', 'services'));
    }

    public function services($slug) {
        $setting=Setting::where('id', "1")->first();
        $services=Service::where('state', "1")->orderBy('id', 'DESC')->get();
        $service=Service::where('slug', $slug)->where('state', "1")->firstOrFail();
        $this->visitor($service->id);
        return view('web.services', compact('setting', 'services', 'service'));
    }

    public function diary(Request $request, $phase=NULL) {
        $setting=Setting::where('id', "1")->first();
        $services=Service::where('state', "1")->orderBy('id', 'DESC')->get();

        if (is_null($phase) || ($phase!='area-y-profesional' && $phase!='fecha-y-hora' && $phase!='pago-y-confirmacion')) {
            if ($request->session()->has('diary')) {
                $request->session()->forget('diary');
            }

            if (!is_null($phase)) {
                return redirect()->route('diary');
            }
        }

        if ($phase!="area-y-profesional" && session()->has('diary') && session('diary')[0]['phase']==1) {
            return redirect()->route('diary', ['phase' => 'area-y-profesional']);
        }

        if ($phase!="fecha-y-hora" && session()->has('diary') && session('diary')[0]['phase']==2) {
            return redirect()->route('diary', ['phase' => 'fecha-y-hora']);
        }

        if ($phase!="pago-y-confirmacion" && session()->has('diary') && session('diary')[0]['phase']==3) {
            return redirect()->route('diary', ['phase' => 'pago-y-confirmacion']);
        }

        if (session()->has('diary') && session('diary')[0]['phase']==1) {
            $this->visitor();
            $specialties=Specialty::all();
            $categories=CategoryDiary::all();
            return view('web.diary', compact('setting', 'services', 'phase', 'categories', 'specialties'));
        }

        if (session()->has('diary') && session('diary')[0]['phase']==2) {
            $this->visitor();
            $service=session('diary')[0]['service'];
            if ($service->type==1) {
                $doctor=People::where('slug', session('diary')[0]['doctor']->slug)->firstOrFail();
                $schedules=$doctor->doctor->diary_doctor->schedules->where('service_id', $service->id)->where('day', date('w'));
                $selected=session('diary')[0]['doctor']->slug;
                $compare=session('diary')[0]['doctor'];
            } elseif ($service->type==2) {
                $subcategory=SubcategoryDiary::where('slug', session('diary')[0]['subcategory']->slug)->firstOrFail();
                $schedules=$subcategory->schedules->where('service_id', $service->id)->where('day', date('w'));
                $selected=session('diary')[0]['subcategory']->slug;
                $compare=session('diary')[0]['subcategory'];
            }

            $num=0;
            $times=[];
            foreach ($schedules->sortBy('start') as $schedule) {

                $start=$schedule->start;
                $end=date("H:i", strtotime($start."+".($setting->interval-1)." minutes"));

                $count=Diary::where('date', date("Y-m-d"))->whereBetween('time', [date('H:i', strtotime($start)), date('H:i', strtotime($end))])->count();
                if ($count>0) {
                    $datesDiaries=Diary::where('date', date("Y-m-d"))->whereBetween('time', [date('H:i', strtotime($start)), date('H:i', strtotime($end))])->get();
                    $datesDiaries=$datesDiaries->map(function($item, $key) use ($service, $compare) {
                        if ($service->type==1) {
                            if ($service->id==$item->diary_service->service_id && $compare->id==$item->diary_service->doctor_service->people_id) {
                                return "2";
                            } else {
                                return "1";
                            }
                        } elseif ($service->type==2) {
                            if ($service->id==$item->diary_service->service_id && $compare->id==$item->diary_service->exam_service->subcategory_id) {
                                return "2";
                            } else {
                                return "1";
                            }
                        }
                    });

                    if ($datesDiaries->search("2")!==false) {
                        $type="2";
                    } else {
                        $type="1";
                    }
                } else {
                    $type="1";
                }

                $times[$num]=array('time' => date('H:i A', strtotime($schedule->start)), 'type' => $type);
                $num++;

                $actual=$schedule->start;
                while (true) {
                    if ($actual<$schedule->end) {
                        $actual=date("H:i", strtotime($actual."+".$setting->interval." minutes"));

                        $start=$actual;
                        $end=date("H:i", strtotime($actual."+".($setting->interval-1)." minutes"));

                        $count=Diary::where('date', date("Y-m-d"))->whereBetween('time', [date('H:i', strtotime($start)), date('H:i', strtotime($end))])->count();
                        if ($count>0) {
                            $datesDiaries=Diary::where('date', date("Y-m-d"))->whereBetween('time', [date('H:i', strtotime($start)), date('H:i', strtotime($end))])->get();
                            $datesDiaries=$datesDiaries->map(function($item, $key) use ($service, $compare) {
                                if ($service->type==1) {
                                    if ($service->id==$item->diary_service->service_id && $compare->id==$item->diary_service->doctor_service->people_id) {
                                        return "2";
                                    } else {
                                        return "1";
                                    }
                                } elseif ($service->type==2) {
                                    if ($service->id==$item->diary_service->service_id && $compare->id==$item->diary_service->exam_service->subcategory_id) {
                                        return "2";
                                    } else {
                                        return "1";
                                    }
                                }
                            });

                            if ($datesDiaries->search("2")!==false) {
                                $type="2";
                            } else {
                                $type="1";
                            }
                        } else {
                            $type="1";
                        }

                        $times[$num]=array('time' => date('H:i A', strtotime($actual)), 'type' => $type);
                        $num++;
                    } else {
                        break;
                    }
                }

            }

            return view('web.diary', compact('setting', 'services', 'phase', 'times', 'service', 'selected'));
        }

        if (session()->has('diary') && session('diary')[0]['phase']==3) {
            $this->visitor();
            $service=session('diary')[0]['service'];
            if ($service->type==1) {
                $schedule=session('diary')[0]['doctor']->doctor->diary_doctor->schedules->where('service_id', $service->id);
            } elseif ($service->type==2) {
                $schedule=session('diary')[0]['subcategory']->schedules->where('service_id', $service->id);
            }

            return view('web.diary', compact('setting', 'services', 'phase', 'schedule'));
        }

        $this->visitor();
        return view('web.diary', compact('setting', 'services', 'phase'));
    }

    public function storeDiary(DiaryOneStoreRequest $request) {
        $data=array('dni' => request('dni'), 'verify_digit' => request('verify_digit'), 'name' => request('name'), 'lastname' => request('lastname'), 'email' => request('email'), 'phone' => request('phone'), 'birthday' => date('Y-m-d', strtotime(request('birthday'))), 'gender' => request('gender'), 'phase' => 1);
        $request->session()->push('diary', $data);

        if ($request->session()->has('diary')) {
            return redirect()->route('diary', ['phase' => 'area-y-profesional']);
        } else {
            return redirect()->route('diary')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    public function storeDiaryTwo(DiaryTwoStoreRequest $request) {
        $service=Service::where('slug', request('service_id'))->firstOrFail();
        if ($service->type==1) {
            $specialty=Specialty::where('slug', request('specialty_id'))->firstOrFail();
            $doctor=People::where('slug', request('doctor_id'))->firstOrFail();
            $data=array('type' => 1, 'service' => $service, 'specialty' => $specialty, 'doctor' => $doctor);
        } elseif ($service->type==2) {
            $category=CategoryDiary::where('slug', request('category_id'))->firstOrFail();
            $subcategory=SubcategoryDiary::where('slug', request('subcategory_id'))->firstOrFail();
            $data=array('type' => 2, 'service' => $service, 'category' => $category, 'subcategory' => $subcategory);
        }

        $data=Arr::collapse([$data, session('diary')[0]]);
        $data['phase']=2;
        $request->session()->forget('diary');
        $request->session()->push('diary', $data);

        if ($request->session()->has('diary') && session('diary')[0]['phase']==2) {
            return redirect()->route('diary', ['phase' => 'fecha-y-hora']);
        } else {
            return redirect()->route('diary')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    public function storeDiaryThree(DiaryThreeStoreRequest $request) {
        $data=array('date' => request('date'), 'time' => request('time'));
        $data=Arr::collapse([$data, session('diary')[0]]);
        $data['phase']=3;
        $request->session()->forget('diary');
        $request->session()->push('diary', $data);

        if ($request->session()->has('diary') && session('diary')[0]['phase']==3) {
            return redirect()->route('diary', ['phase' => 'pago-y-confirmacion']);
        } else {
            return redirect()->route('diary')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    public function storeDiaryFour(Request $request) {
        if (session('diary')[0]['type']==1) {
            $schedule=session('diary')[0]['doctor']->doctor->diary_doctor->schedules->where('service_id', session('diary')[0]['service']->id);

            $optional=json_encode(array("rut" => session('diary')[0]['dni']."-".session('diary')[0]['verify_digit'], "dni" => session('diary')[0]['dni'], "verify_digit" => session('diary')[0]['verify_digit'], "name" => session('diary')[0]['name'], "lastname" => session('diary')[0]['lastname'], 'phone' => session('diary')[0]['phone'], 'birthday' => session('diary')[0]['birthday'], 'gender' => session('diary')[0]['gender'], 'date' => date('Y-m-d', strtotime(session('diary')[0]['date'])), 'time' => substr(session('diary')[0]['time'], 0, -3), 'type' => session('diary')[0]['type'], 'service_id' => session('diary')[0]['service']->id, 'specialty_id' => session('diary')[0]['specialty']->id, 'people_id' => session('diary')[0]['doctor']->id));

        } elseif (session('diary')[0]['type']==2) {
            $schedule=session('diary')[0]['subcategory']->schedules->where('service_id', session('diary')[0]['service']->id);

            $optional=json_encode(array("rut" => session('diary')[0]['dni']."-".session('diary')[0]['verify_digit'], "dni" => session('diary')[0]['dni'], "verify_digit" => session('diary')[0]['verify_digit'], "name" => session('diary')[0]['name'], "lastname" => session('diary')[0]['lastname'], 'phone' => session('diary')[0]['phone'], 'birthday' => session('diary')[0]['birthday'], 'gender' => session('diary')[0]['gender'], 'date' => date('Y-m-d', strtotime(session('diary')[0]['date'])), 'time' => substr(session('diary')[0]['time'], 0, -3), 'type' => session('diary')[0]['type'], 'service_id' => session('diary')[0]['service']->id, 'subcategory_id' => session('diary')[0]['subcategory']->id));
        }

        $params=array("commerceOrder" => rand(1100, 2000), "subject" => "Pago del servicio: ".session('diary')[0]['service']->name, "currency" => "CLP", "amount" => number_format($schedule->first()->price, 0, ".", ""), "email" => session('diary')[0]['email'], "paymentMethod" => 1, "urlConfirmation" => env("APP_URL")."/agendar/confirmacion", "urlReturn" => env("APP_URL")."/agendar/respuesta", "optional" => $optional);

        try {
            $response=$this->sendFlow("payment/create", $params, "POST");
            $redirect=$response["url"]."?token=".$response["token"];
            return redirect($redirect);
        } catch (Exception $e) {
            return redirect()->route('diary', ['phase' => 'pago-y-confirmacion'])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Pago fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function diaryResponse(Request $request) {
        $response=$this->sendFlow("payment/getStatus", request()->all());
        if ($response["status"]==2) {
            // Validación para que no se repita el slug
            $slug='pago';
            $num=0;
            while (true) {
                $count=Payment::where('slug', $slug)->count();
                if ($count>0) {
                    $slug='pago-'.$num;
                    $num++;
                } else {
                    $data=array('slug' => $slug, 'subject' => $response['subject'], 'method' => $response['paymentData']['media'], 'currency' => $response['currency'], 'amount' => $response['paymentData']['amount'], 'fee' => $response['paymentData']['fee'], 'taxes' => $response['paymentData']['taxes'], 'balance' => $response['paymentData']['balance']);
                    break;
                }
            }

            $payment=Payment::create($data);
            Flow::create(['method' => $response['paymentData']['media'], 'flow_order' => $response['flowOrder'], 'token' => request("token"), 'payment_id' => $payment->id]);

            // Validación para que no se repita el slug
            $slug='reserva';
            $num=0;
            while (true) {
                $count=Diary::where('slug', $slug)->count();
                if ($count>0) {
                    $slug='reserva-'.$num;
                    $num++;
                } else {
                    $data=array('slug' => $slug, 'dni' => $response['optional']['dni'], 'verify_digit' => $response['optional']['verify_digit'], 'name' => $response['optional']['name'], 'lastname' => $response['optional']['lastname'], 'email' => $response['payer'], 'phone' => $response['optional']['phone'], 'birthday' => $response['optional']['birthday'], 'gender' => $response['optional']['gender'], 'date' => $response['optional']['date'], 'time' => $response['optional']['time'], 'amount' => $response['paymentData']['amount'], 'payment_id' => $payment->id);
                    break;
                }
            }

            $diary=Diary::create($data);

            $data=array('price' => $response['paymentData']['amount'], 'diary_id' => $diary->id, 'service_id' => $response['optional']['service_id']);
            $diary_service=DiaryService::create($data);

            if ($response['optional']['type']==1) {
                $data=array('service_id' => $diary_service->id, 'specialty_id' => $response['optional']['specialty_id'], 'people_id' => $response['optional']['people_id']);
                $doctor_service=DoctorService::create($data);

                if ($doctor_service) {
                    $user=new User;
                    $user->email=$response['payer'];
                    $user->diary=$diary;
                    $user->doctor=$doctor_service->people;
                    $user->service=$diary_service->service->slug;
                    $user->notify(new DiaryNotification());

                    $user=new User;
                    $user->email=$doctor_service->people->email;
                    $user->diary=$diary;
                    $user->doctor=$doctor_service->people;
                    $user->service=$diary_service->service->slug;
                    $user->notify(new DiaryNotification());
                }

            } elseif ($response['optional']['type']==2) {
                $data=array('service_id' => $diary_service->id, 'subcategory_id' => $response['optional']['subcategory_id']);
                $exam_service=ExamService::create($data);
            }

            if ($diary) {
                return redirect()->route("diary.success", ["token" => request("token")]);
            } else {
                return redirect()->route("diary")->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Pago fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
            }
        }
        
        return redirect()->route("diary")->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Pago fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
    }

    public function diarySuccess(Request $request, $token) {
        $setting=Setting::where('id', "1")->first();
        $services=Service::where('state', "1")->orderBy('id', 'DESC')->get();

        if ($request->session()->has('diary')) {
            $request->session()->forget('diary');
        }

        $flow=Flow::where('token', $token)->first();
        if (!is_null($flow)) {
            $diary=$flow->payment->diary;
            return view('web.success', compact("setting", "services", "diary"));
        }
        
        return redirect()->route("diary");
    }

    public function news(Request $request, $category=null) {
        $this->visitor();
        $setting=Setting::where('id', "1")->first();
        $services=Service::where('state', "1")->orderBy('id', 'DESC')->get();
        $selected=$category;
        $categories=Category::all();

        if ($request->has('pagina')) {
            $offset=9*(request('pagina')-1);
        } else {
            $offset=0;
        }

        if (is_null($category)) {
            $news=News::where('state', "1")->orderBy('id', 'DESC')->offset($offset)->limit(9)->get();
            $total=News::where('state', "1")->get();
            $search=NULL;
        } else {
            $category=Category::where('slug', $category)->firstOrFail();
            $news=News::select('news.id', 'news.slug', 'news.title', 'news.image')->join('category_news', 'news.id', '=', 'category_news.news_id')->where('news.state', "1")->where('category_news.category_id', $category->id)->orderBy('news.id', 'DESC')->offset($offset)->limit(9)->get();
            $total=News::join('category_news', 'news.id', '=', 'category_news.news_id')->where('news.state', "1")->where('category_news.category_id', $category->id)->get();
            $search=array('name' => $category->name, 'slug' => $category->slug);
        }

        $varPage='pagina';
        $page=Paginator::resolveCurrentPage($varPage);
        $pagination=new LengthAwarePaginator($news, $total=count($total), $perPage = 9, $page, ['path' => Paginator::resolveCurrentPath(), 'pageName' => $varPage]);

        return view('web.news', compact('services', 'news', 'categories', 'selected', 'pagination', 'search', 'setting'));
    }

    public function new($category, $slug) {
        $this->visitor();
        $setting=Setting::where('id', "1")->first();
        $services=Service::where('state', "1")->orderBy('id', 'DESC')->get();
        $category=Category::where('slug', $category)->firstOrFail();
        $new=News::where('slug', $slug)->firstOrFail();
        $related_news=News::where('id', '!=', $new->id)->orderBy('id', 'DESC')->where('state', "1")->limit(4)->get();

        return view('web.new', compact('services', 'category', 'new', 'related_news', 'setting'));
    }

    public function contact() {
        $this->visitor();
        $setting=Setting::where('id', "1")->first();
        $services=Service::where('state', "1")->orderBy('id', 'DESC')->get();
        return view('web.contact', compact('setting', 'services'));
    }

    public function applicant() {
        $this->visitor();
        $setting=Setting::where('id', "1")->first();
        $services=Service::where('state', "1")->orderBy('id', 'DESC')->get();
        return view('web.applicant', compact('setting', 'services'));
    }

    public function selected(Request $request) {
        if (!isset(session('user')[0]->type) || is_null(session('user')[0]->type) || session('user')[0]->type=="" || (session('user')[0]->type!=1 && session('user')[0]->type!=2)) {
            return view('web.admin.selected');
        }

        return redirect()->route('web.profile');
    }

    public function selectedDoctor(Request $request) {
        if (!is_null(session('user')[0]->doctor) && session('user')[0]->doctor->state=="1") {
            session('user')[0]->type=1;
        } elseif (!is_null(session('user')[0]->patient) && session('user')[0]->patient->state=="1") {
            session('user')[0]->type=2;
        }

        return redirect()->route('web.profile');
    }

    public function selectedPatient(Request $request) {
        if (!is_null(session('user')[0]->patient) && session('user')[0]->patient->state=="1") {
            session('user')[0]->type=2;
        } elseif (!is_null(session('user')[0]->doctor) && session('user')[0]->doctor->state=="1") {
            session('user')[0]->type=1;
        }

        return redirect()->route('web.profile');
    }

    public function profile() {
        return view('web.admin.home');
    }

    public function profileEdit(Request $request) {
        $countries=Country::orderBy('name', 'ASC')->get();
        $regions=Region::orderBy('name', 'ASC')->get();
        $provinces=Province::where('region_id', session('user')[0]->commune->province->region->id)->orderBy('name', 'ASC')->get();
        $communes=Commune::where('province_id', session('user')[0]->commune->province->id)->orderBy('name', 'ASC')->get();
        $studies=Study::all();
        $insurers=Insurer::all();
        $professions=Profession::all();
        $specialties=Specialty::all();
        return view('web.admin.edit', compact('countries', 'regions', 'provinces', 'communes', 'studies', 'insurers', 'professions', 'specialties'));
    }

    public function profileUpdate(ProfileUpdateCustomRequest $request) {
        $user = People::where('slug', session('user')[0]->slug)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'dni' => Rule::unique('people')->ignore($user->id),
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $data=array('dni' => request('dni'), 'verify_digit' => request('verify_digit'), 'name' => request('name'), 'first_lastname' => request('first_lastname'), 'second_lastname' => request('second_lastname'), 'phone' => request('phone'), 'celular' => request('celular'), 'birthday' => date('Y-m-d', strtotime(request('birthday'))), 'commune_id' => request('commune_id'), 'country_id' => request('country_id'), 'address' => request('address'), 'postal' => request('postal'), 'gender' => request('gender'));

        if (!is_null(request('password'))) {
            $data['password']=Hash::make(request('password'));
        }

        // Mover imagen a carpeta users y extraer nombre
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $data['photo']=store_files($file, session('user')[0]->slug, '/admins/img/users/');
        }

        $user->fill($data)->save();

        if(session('user')[0]->type=="1") {
            $people=Doctor::where('people_id', $user->id)->firstOrFail();
            $profession=Profession::where('slug', request('profession_id'))->firstOrFail();

            $data=array('inscription' => request('inscription'), 'number_doctor' => request('number_doctor'), 'profession_id' => $profession->id);

            // Mover imagen a carpeta doctors y extraer nombre
            if ($request->hasFile('signature')) {
                $file=$request->file('signature');
                $data['signature']=store_files($file, $user->slug, '/admins/img/doctors/');
            }
            $people->fill($data)->save();

            foreach ($people->specialties as $specialty) {
                $special=DoctorSpecialty::where('doctor_id', $people->id)->where('specialty_id', $specialty->id)->firstOrFail();
                $special->delete();
            }

            $num=0;
            $specialties=request('specialty_id');
            foreach ($specialties as $specialty) {
                $special=Specialty::where('slug', $specialty)->firstOrFail();
                $data=array('specialty_id' => $special->id, 'doctor_id' => $people->id);
                DoctorSpecialty::create($data);
                $num++;
            }

        } else {
            $people=Patient::where('people_id', $user->id)->firstOrFail();
            $study=Study::where('slug', request('study_id'))->firstOrFail();
            $insurer=Insurer::where('slug', request('insurer_id'))->firstOrFail();
            if (request('question_children')=="No") {
                $children=0;
            } else {
                $children=request('children');
            }
            $data=array('civil_state' => request('civil_state'), 'children' => $children, 'laboral' => request('laboral'), 'study_id' => $study->id, 'insurer_id' => $insurer->id);
            $people->fill($data)->save();
        }


        if ($user && $people) {
            $type=session('user')[0]->type;
            if ($request->session()->has('user')) {
                $request->session()->forget('user');
            }
            $request->session()->push('user', $user);
            session('user')[0]->type=$type;

            return redirect()->back()->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El perfil ha sido editado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    public function reports(Request $request) {
        $num=1;
        $reports=Report::where('patient_id', session('user')[0]->patient->id)->where('state', '1')->orderBy('id', 'DESC')->get();
        return view('web.admin.reports.reports', compact('reports', 'num'));
    }

    public function search() {
        return view('web.admin.reports.search');
    }

    public function exist(Request $request) {

        $count = People::where('dni', request('dni'))->where('verify_digit', request('dv'))->count();
        if ($count>0) {
            $num=0;
            $data=[];
            $user = People::where('dni', request('dni'))->where('verify_digit', request('dv'))->first();
            if (!is_null($user->patient)) {
                foreach ($user->patient->reports as $report) {
                    $data[$num]=array('date' => $report->created_at->format('d-m-Y'), 'reason' => $report->reason, 'doctor' => $report->doctor->people->name." ".$report->doctor->people->first_lastname." ".$report->doctor->people->second_lastname, 'slug' => $report->slug, 'state' => $report->state, 'recipe' => $report->recipe, 'order' => $report->order);
                    $num++;
                }
                $user=array('name' => $user->name, 'first_lastname' => $user->first_lastname, 'second_lastname' => $user->second_lastname, 'dni' => number_format($user->dni, 0, ".", ".")."-".$user->verify_digit, 'photo' => $user->photo, 'movil' => $user->celular, 'slug' => $user->slug);
                return response()->json(['status' => true, 'user' => $user, 'reports' => $data]);
            } else {
                return response()->json(['status' => false, 'type' => 'warning', 'title' => 'Paciente no encontrado', 'msg' => 'El paciente buscado no esta registrado en el sistema.']);
            }

        } else {
            return response()->json(['status' => false, 'type' => 'warning', 'title' => 'Paciente no encontrado', 'msg' => 'El paciente buscado no esta registrado en el sistema.']);
        }
    }

    public function createPatient(Request $request) {
        $countries=Country::orderBy('name', 'ASC')->get();
        $regions=Region::orderBy('name', 'ASC')->get();
        $studies=Study::all();
        $insurers=Insurer::all();
        return view('web.admin.patients.create', compact('countries', 'regions', 'studies', 'insurers'));
    }

    public function storePatient(PatientStoreRequest $request) {
        $people=People::where('dni', request('dni'))->where('verify_digit', request('verify_digit'))->first();
        if (is_null($people) || is_null($people->patient)) {
            if (is_null($people)) {
                $count=People::where('name', request('name'))->where('first_lastname', request('first_lastname'))->where('second_lastname', request('second_lastname'))->count();
                $slug=Str::slug(request('name')." ".request('first_lastname')." ".request('second_lastname'), '-');
                if ($count>0) {
                    $slug=$slug."-".$count;
                }

                // Validación para que no se repita el slug
                $num=0;
                while (true) {
                    $count2=People::where('slug', $slug)->count();
                    if ($count2>0) {
                        $slug=Str::slug(request('name')." ".request('first_lastname')." ".request('second_lastname'), '-')."-".$num;
                        $num++;
                    } else {
                        $data=array('dni' => request('dni'), 'verify_digit' => request('verify_digit'), 'name' => request('name'), 'first_lastname' => request('first_lastname'), 'second_lastname' => request('second_lastname'), 'slug' => $slug, 'phone' => request('phone'), 'celular' => request('celular'), 'birthday' => date('Y-m-d', strtotime(request('birthday'))), 'commune_id' => request('commune_id'), 'country_id' => request('country_id'), 'address' => request('address'), 'postal' => request('postal'), 'gender' => request('gender'), 'email' => request('email'), 'password' => Hash::make(request('password')));
                        break;
                    }
                }

                // Mover imagen a carpeta users y extraer nombre
                if ($request->hasFile('photo')) {
                    $file=$request->file('photo');
                    $data['photo']=store_files($file, $slug, '/admins/img/users/');
                }

                $people=People::create($data);
            }

            if (!is_null($people->patient)) {
                return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => 'Paciente ya existe', 'msg' => 'El paciente ya se encuentra registrado.']);
            }

            $study=Study::where('slug', request('study_id'))->firstOrFail();
            $insurer=Insurer::where('slug', request('insurer_id'))->firstOrFail();
            if (request('question_children')=="No") {
                $children=0;
            } else {
                $children=request('children');
            }
            $data=array('civil_state' => request('civil_state'), 'children' => $children, 'laboral' => request('laboral'), 'study_id' => $study->id, 'insurer_id' => $insurer->id, 'people_id' => $people->id);
            $patient=Patient::create($data);


            if ($patient) {
                return redirect()->route('search')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El paciente ha sido registrado exitosamente.', 'patient' => $patient->people]);
            } else {
                return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
            }
        }

        return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => 'Paciente Existente', 'msg' => 'Este paciente ya esta registrado en el sistema.']);
    }

    public function createReport($slug, $report=NULL) {
        $patient=People::where('slug', $slug)->firstOrFail();
        $diseases=Disease::all();
        $operations=Operation::all();
        if (is_null($report)) {
            $last=Report::where('patient_id', $patient->id)->orderBy('id', 'DESC')->first();
            return view('web.admin.reports.create', compact('patient', 'report', 'diseases', 'operations', 'last'));
        }

        $report=Report::where('slug', $report)->firstOrFail();

        if ($report->phase==2) {
            $exams=Exam::all();
            $categories=CategoryExam::all();
            $types=Type::all();
            return view('web.admin.reports.create', compact('patient', 'report', 'exams', 'categories', 'types'));
        }

        $num=1;

        return view('web.admin.reports.create', compact('patient', 'report', 'diseases', 'operations', 'num'));
    }

    public function nextStep($slug, $phase) {
        $report=Report::where('slug', $slug)->firstOrFail();

        if ($phase<6) {
            $report->fill(['phase' => $phase])->save();
        }

        return redirect()->route('reports.create', ['slug' => $report->patient->people->slug, 'report' => $report->slug]);
    }

    public function storeReport(ReportOneStoreRequest $request) {
        // Validación para que no se repita el slug
        $slug='reporte';
        $num=0;
        while (true) {
            $count=Report::where('slug', $slug)->count();
            if ($count>0) {
                $slug='reporte-'.$num;
                $num++;
            } else {
                $patient=People::where('slug', request('people_id'))->firstOrFail();
                $data=array('slug' => $slug, 'reason' => request('reason'), 'select_personal_history' => request('select_personal_history'), 'personal_history' => request('personal_history'), 'select_surgical_history' => request('select_surgical_history'), 'surgical_history' => request('surgical_history'), 'select_family_history' => request('select_family_history'), 'family_history' => request('family_history'), 'medicines' => request('medicines'), 'foods' => request('foods'), 'others_allergies' => request('others_allergies'), 'tobacco' => request('tobacco'), 'number_cigarettes' => request('number_cigarettes'), 'years_smoker' => request('years_smoker'), 'alcohol' => request('alcohol'), 'number_liters' => request('number_liters'), 'years_taker' => request('years_taker'), 'drugs' => request('drugs'), 'years_consumption' => request('years_consumption'), 'indicate_drugs' => request('indicate_drugs'), 'disease_current' => request('disease_current'), 'phase' => "1", 'doctor_id' => session('user')[0]->doctor->id, 'patient_id' => $patient->patient->id);
                break;
            }
        }

        $report=Report::create($data);

        $personals=request('disease_personal');
        if (!is_null($personals)) {
            foreach ($personals as $personal) {
                $disease=Disease::where('slug', $personal)->firstOrFail();
                $data=array('report_id' => $report->id, 'disease_id' => $disease->id);
                DiseaseReport::create($data);
            }
        }

        $surgicals=request('surgicals');
        if (!is_null($surgicals)) {
            foreach ($surgicals as $surgical) {
                $operation=Operation::where('slug', $surgical)->firstOrFail();
                $data=array('report_id' => $report->id, 'operation_id' => $operation->id);
                OperationReport::create($data);
            }
        }

        $familiars=request('disease_family');
        if (!is_null($familiars)) {
            foreach ($familiars as $familiar) {
                $disease=Disease::where('slug', $familiar)->firstOrFail();
                $data=array('report_id' => $report->id, 'disease_id' => $disease->id);
                FamiliarReport::create($data);
            }
        }

        if ($report) {
            return redirect()->route('reports.create', ['slug' => $patient->slug, 'report' => $slug])->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El informe ha sido registrado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    public function storeReportOne(ReportOneUpdateRequest $request, $slug) {
        $report=Report::where('slug', $slug)->firstOrFail();
        $data=array('reason' => request('reason'), 'select_personal_history' => request('select_personal_history'), 'personal_history' => request('personal_history'), 'select_surgical_history' => request('select_surgical_history'), 'surgical_history' => request('surgical_history'), 'select_family_history' => request('select_family_history'), 'family_history' => request('family_history'), 'medicines' => request('medicines'), 'foods' => request('foods'), 'others_allergies' => request('others_allergies'), 'tobacco' => request('tobacco'), 'number_cigarettes' => request('number_cigarettes'), 'years_smoker' => request('years_smoker'), 'alcohol' => request('alcohol'), 'number_liters' => request('number_liters'), 'years_taker' => request('years_taker'), 'drugs' => request('drugs'), 'years_consumption' => request('years_consumption'), 'indicate_drugs' => request('indicate_drugs'), 'disease_current' => request('disease_current'), 'phase' => "1");
        $report->fill($data)->save();

        if (!is_null($report->diseases)) {
            foreach ($report->diseases as $personal) {
                $disease=DiseaseReport::where('id', $personal->id)->firstOrFail();
                $disease->delete();
            }
        }

        $personals=request('disease_personal');
        if (!is_null($personals)) {
            foreach ($personals as $personal) {
                $disease=Disease::where('slug', $personal)->firstOrFail();
                $data=array('report_id' => $report->id, 'disease_id' => $disease->id);
                DiseaseReport::create($data);
            }
        }

        if (!is_null($report->operations)) {
            foreach ($report->operations as $operation) {
                $operation=OperationReport::where('report_id', $operation->pivot->report_id)->where('operation_id', $operation->pivot->operation_id)->firstOrFail();
                $operation->delete();
            }
        }

        $surgicals=request('surgicals');
        if (!is_null($surgicals)) {
            foreach ($surgicals as $surgical) {
                $operation=Operation::where('slug', $surgical)->firstOrFail();
                $data=array('report_id' => $report->id, 'operation_id' => $operation->id);
                OperationReport::create($data);
            }
        }

        if (!is_null($report->familiars)) {
            foreach ($report->familiars as $familiar) {
                $disease=FamiliarReport::where('id', $familiar->id)->firstOrFail();
                $disease->delete();
            }
        }

        $familiars=request('disease_family');
        if (!is_null($familiars)) {
            foreach ($familiars as $familiar) {
                $disease=Disease::where('slug', $familiar)->firstOrFail();
                $data=array('report_id' => $report->id, 'disease_id' => $disease->id);
                FamiliarReport::create($data);
            }
        }

        if ($report) {
            return redirect()->route('reports.create', ['slug' => $report->patient->people->slug, 'report' => $slug])->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El informe ha sido registrado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function storeReportTwo(ReportTwoStoreRequest $request, $slug) {
        $report=Report::where('slug', $slug)->firstOrFail();
        $data=array('weight' => request('weight'), 'height' => request('height'), 'temperature' => request('temperature'), 'pulse' => request('pulse'), 'systolic_pressure' => request('systolic_pressure'), 'dystolic_pressure' => request('dystolic_pressure'), 'frequency' => request('frequency'), 'mucous' => request('mucous'), 'head_neck' => request('head_neck'), 'respiratory' => request('respiratory'), 'cardiovascular' => request('cardiovascular'), 'abdomen' => request('abdomen'), 'others_exams' => request('others_exams'), 'phase' => "2");
        $report->fill($data)->save();

        if ($report) {
            return redirect()->route('reports.create', ['slug' => $report->patient->people->slug, 'report' => $slug])->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El informe ha sido registrado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function storeReportThree(ReportThreeStoreRequest $request, $slug) {
        $report=Report::where('slug', $slug)->firstOrFail();
        $data=array('order' => request('order'), 'phase' => '3');
        $report->fill($data)->save();

        $exams=request('exam_id');
        if (!is_null($exams)) {
            $report_exams=ExamReport::where('report_id', $report->id)->get();
            foreach($exams as $exam) {
                $exa=Exam::where('slug', $exam)->firstOrFail();
                if (!is_null($report_exams) && count($report_exams)>0) {
                    $register=false;
                    foreach($report_exams as $report_exam) {
                        if ($exa->id==$report_exam->exam_id) {
                            $register=false;
                            break;
                        } else {
                            $register=true;
                        }
                    }

                    if ($register) {
                        $data=array('exam_id' => $exa->id, 'report_id' => $report->id);
                        ExamReport::create($data);
                    }
                } else {
                    $data=array('exam_id' => $exa->id, 'report_id' => $report->id);
                    ExamReport::create($data);
                }

            }

            foreach($report_exams as $report_exam) {
                $delete=false;
                foreach($exams as $exam) {
                    $exa=Exam::where('slug', $exam)->firstOrFail();
                    if ($exa->id==$report_exam->exam_id) {
                        $delete=false;
                        break;
                    } else {
                        $delete=true;
                    }
                }

                if ($delete) {
                    $report_exa=ExamReport::where('id', $report_exam->id)->firstOrFail();
                    $report_exa->delete();

                    $report_images=ImageReport::where('report_id', $report->id)->where('exam_id', $report_exam->exam_id)->get();
                    foreach($report_images as $report_image) {
                        $report_imag=ImageReport::where('id', $report_image->id)->firstOrFail();
                        $report_imag->delete();
                    }
                }
            }

        } else {
            $report_exams=ExamReport::where('report_id', $report->id)->get();
            foreach($report_exams as $report_exam) {
                $report_exa=ExamReport::where('id', $report_exam->id)->firstOrFail();
                $report_exa->delete();
            }

            $report_images=ImageReport::where('report_id', $report->id)->get();
            foreach($report_images as $report_image) {
                $report_imag=ImageReport::where('id', $report_image->id)->firstOrFail();
                $report_imag->delete();
            }
        }

        if ($report) {
            return redirect()->route('reports.create', ['slug' => $report->patient->people->slug, 'report' => $slug])->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El informe ha sido registrado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    public function storeReportFour(ReportFourStoreRequest $request, $slug) {
        $normalTimeLimit=ini_get("max_execution_time");
        ini_set("max_execution_time", 300000);

        $report=Report::where('slug', $slug)->firstOrFail();
        $data=array('recipe' => request('recipe'), 'phase' => '4');
        $report->fill($data)->save();

        if ($report) {
            define('RECIPES_DIR', public_path('/admins/uploads/recipes'));

            if (!is_dir(RECIPES_DIR)){
                mkdir(RECIPES_DIR, 0755, true);
            }

            try {
                $pdfPath=RECIPES_DIR.'/recetamedica.pdf';
                File::put($pdfPath, PDF::loadView('admin.pdfs.recipe', compact('report'))->output());

                $count=Pharmacy::count();
                if ($count>1) {
                    $to=[];
                    $num=0;
                    $emails=Pharmacy::all();
                    foreach ($emails as $email) {
                        $to[$num]=$email->email;
                        $num++;
                    }
                } elseif ($count==1) {
                    $emails=Pharmacy::first();
                    $to=$emails->email;
                }

                if ($count>0) {
                    Mail::send('admin.emails.recipe', ['name' => $report->patient->people->name." ".$report->patient->people->first_lastname." ".$report->patient->people->second_lastname], function($msj) use ($pdfPath, $to, $report) {
                        $msj->subject('Receta Médica de Paciente: '.$report->patient->people->name." ".$report->patient->people->first_lastname." ".$report->patient->people->second_lastname);
                        $msj->from('no-reply@doctoonline.cl', 'Doctoonline');
                        $msj->to($to);
                        $msj->attach($pdfPath);
                    });
                }
                ini_set("max_execution_time", $normalTimeLimit);

            } catch (Exception $e) {
                return redirect()->back()->with(['alert' => 'lobibox','type' => 'error', 'title' => 'Envio fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
            }

            return redirect()->route('reports.create', ['slug' => $report->patient->people->slug, 'report' => $slug])->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El informe ha sido registrado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    public function storeReportFive(ReportFiveStoreRequest $request, $slug) {
        $report=Report::where('slug', $slug)->firstOrFail();
        $data=array('phase' => '5');
        $report->fill($data)->save();

        if (!is_null($report->exams) && $request->has('files')) {
            $num=0;
            foreach ($report->exams as $exam) {
                $exa=ExamReport::where('id', $exam->id)->firstOrFail();
                $data=array('results' => request('results')[$num]);
                $exa->fill($data)->save();
                $num++;
            }
        }

        // Mover imagen a carpeta reports y extraer nombre
        if ($request->has('files') && $request->has('exams')) {
            $num=0;
            $files=request('files');
            foreach ($files as $file) {
                $exam=Exam::where('slug', request('exams')[$num])->firstOrFail();
                ImageReport::create(['image' => $file, 'report_id' => $report->id, 'exam_id' => $exam->id])->save();
                $num++;
            }
        }

        if ($report) {
            return redirect()->route('reports.create', ['slug' => $report->patient->people->slug, 'report' => $slug])->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El informe ha sido registrado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    public function storeReportSix(ReportSixStoreRequest $request, $slug) {
        $report=Report::where('slug', $slug)->firstOrFail();
        $data=array('report' => request('report'), 'state' => "1", 'phase' => '6');
        $report->fill($data)->save();

        if ($report) {
            return redirect()->route('search')->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El informe ha sido completado exitosamente.', 'patient' => $report->patient->people]);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    public function showReport($slug) {
        $report=Report::where('slug', $slug)->firstOrFail();
        if ($report->state==1) {
            return view('web.admin.reports.show', compact('report'));
        }

        return redirect()->route('reports.create', ['slug' => $report->patient->people->slug, 'report' => $slug]);
    }

    public function editReport($slug, $phase=NULL) {
        $report=Report::where('slug', $slug)->firstOrFail();
        $diseases=Disease::all();
        $operations=Operation::all();
        if (is_null($phase) || $phase=="segundo" || $phase=="cuarto" || $phase=="quinto" || $phase=='sexto') {
            $num=1;
            return view('web.admin.reports.edit', compact('report', 'phase', 'diseases', 'operations', 'num'));
        } elseif ($phase=="tercero") {
            $exams=Exam::all();
            $categories=CategoryExam::all();
            $types=Type::all();
            return view('web.admin.reports.edit', compact('report', 'phase', 'exams', 'categories', 'types'));
        }

        abort(404);
    }

    public function updateReportOne(ReportOneUpdateRequest $request, $slug) {
        $report=Report::where('slug', $slug)->firstOrFail();
        $data=array('reason' => request('reason'), 'select_personal_history' => request('select_personal_history'), 'personal_history' => request('personal_history'), 'select_surgical_history' => request('select_surgical_history'), 'surgical_history' => request('surgical_history'), 'select_family_history' => request('select_family_history'), 'family_history' => request('family_history'), 'medicines' => request('medicines'), 'foods' => request('foods'), 'others_allergies' => request('others_allergies'), 'tobacco' => request('tobacco'), 'number_cigarettes' => request('number_cigarettes'), 'years_smoker' => request('years_smoker'), 'alcohol' => request('alcohol'), 'number_liters' => request('number_liters'), 'years_taker' => request('years_taker'), 'drugs' => request('drugs'), 'years_consumption' => request('years_consumption'), 'indicate_drugs' => request('indicate_drugs'), 'disease_current' => request('disease_current'));
        $report->fill($data)->save();

        if (!is_null($report->diseases)) {
            foreach ($report->diseases as $personal) {
                $disease=DiseaseReport::where('id', $personal->id)->firstOrFail();
                $disease->delete();
            }
        }

        $personals=request('disease_personal');
        if (!is_null($personals)) {
            foreach ($personals as $personal) {
                $disease=Disease::where('slug', $personal)->firstOrFail();
                $data=array('report_id' => $report->id, 'disease_id' => $disease->id);
                DiseaseReport::create($data);
            }
        }

        if (!is_null($report->operations)) {
            foreach ($report->operations as $operation) {
                $operation=OperationReport::where('report_id', $operation->pivot->report_id)->where('operation_id', $operation->pivot->operation_id)->firstOrFail();
                $operation->delete();
            }
        }

        $surgicals=request('surgicals');
        if (!is_null($surgicals)) {
            foreach ($surgicals as $surgical) {
                $operation=Operation::where('slug', $surgical)->firstOrFail();
                $data=array('report_id' => $report->id, 'operation_id' => $operation->id);
                OperationReport::create($data);
            }
        }

        if (!is_null($report->familiars)) {
            foreach ($report->familiars as $familiar) {
                $disease=FamiliarReport::where('id', $familiar->id)->firstOrFail();
                $disease->delete();
            }
        }

        $familiars=request('disease_family');
        if (!is_null($familiars)) {
            foreach ($familiars as $familiar) {
                $disease=Disease::where('slug', $familiar)->firstOrFail();
                $data=array('report_id' => $report->id, 'disease_id' => $disease->id);
                FamiliarReport::create($data);
            }
        }

        if ($report) {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El informe ha sido editado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function updateReportTwo(ReportTwoStoreRequest $request, $slug) {
        $report=Report::where('slug', $slug)->firstOrFail();
        $data=array('weight' => request('weight'), 'height' => request('height'), 'temperature' => request('temperature'), 'pulse' => request('pulse'), 'systolic_pressure' => request('systolic_pressure'), 'dystolic_pressure' => request('dystolic_pressure'), 'frequency' => request('frequency'), 'mucous' => request('mucous'), 'head_neck' => request('head_neck'), 'respiratory' => request('respiratory'), 'cardiovascular' => request('cardiovascular'), 'abdomen' => request('abdomen'), 'others_exams' => request('others_exams'));
        $report->fill($data)->save();

        if ($report) {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El informe ha sido editado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function updateReportThree(ReportThreeStoreRequest $request, $slug) {
        $report=Report::where('slug', $slug)->firstOrFail();
        $data=array('order' => request('order'));
        $report->fill($data)->save();

        $exams=request('exam_id');
        if (!is_null($exams)) {
            $report_exams=ExamReport::where('report_id', $report->id)->get();
            foreach($exams as $exam) {
                $exa=Exam::where('slug', $exam)->firstOrFail();
                if (!is_null($report_exams) && count($report_exams)>0) {
                    $register=false;
                    foreach($report_exams as $report_exam) {
                        if ($exa->id==$report_exam->exam_id) {
                            $register=false;
                            break;
                        } else {
                            $register=true;
                        }
                    }

                    if ($register) {
                        $data=array('exam_id' => $exa->id, 'report_id' => $report->id);
                        ExamReport::create($data);
                    }
                } else {
                    $data=array('exam_id' => $exa->id, 'report_id' => $report->id);
                    ExamReport::create($data);
                }

            }

            foreach($report_exams as $report_exam) {
                $delete=false;
                foreach($exams as $exam) {
                    $exa=Exam::where('slug', $exam)->firstOrFail();
                    if ($exa->id==$report_exam->exam_id) {
                        $delete=false;
                        break;
                    } else {
                        $delete=true;
                    }
                }

                if ($delete) {
                    $report_exa=ExamReport::where('id', $report_exam->id)->firstOrFail();
                    $report_exa->delete();

                    $report_images=ImageReport::where('report_id', $report->id)->where('exam_id', $report_exam->exam_id)->get();
                    foreach($report_images as $report_image) {
                        $report_imag=ImageReport::where('id', $report_image->id)->firstOrFail();
                        $report_imag->delete();
                    }
                }
            }

        } else {
            $report_exams=ExamReport::where('report_id', $report->id)->get();
            foreach($report_exams as $report_exam) {
                $report_exa=ExamReport::where('id', $report_exam->id)->firstOrFail();
                $report_exa->delete();
            }

            $report_images=ImageReport::where('report_id', $report->id)->get();
            foreach($report_images as $report_image) {
                $report_imag=ImageReport::where('id', $report_image->id)->firstOrFail();
                $report_imag->delete();
            }
        }

        if ($report) {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El informe ha sido editado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function updateReportFour(ReportFourStoreRequest $request, $slug) {
        $normalTimeLimit=ini_get("max_execution_time");
        ini_set("max_execution_time", 300000);

        $report=Report::where('slug', $slug)->firstOrFail();
        $data=array('recipe' => request('recipe'));
        $report->fill($data)->save();

        if ($report) {
            define('RECIPES_DIR', public_path('/admins/uploads/recipes'));

            if (!is_dir(RECIPES_DIR)){
                mkdir(RECIPES_DIR, 0755, true);
            }

            try {
                $pdfPath=RECIPES_DIR.'/recetamedica.pdf';
                File::put($pdfPath, PDF::loadView('admin.pdfs.recipe', compact('report'))->output());

                $count=Pharmacy::count();
                if ($count>1) {
                    $to=[];
                    $num=0;
                    $emails=Pharmacy::all();
                    foreach ($emails as $email) {
                        $to[$num]=$email->email;
                        $num++;
                    }
                } elseif ($count==1) {
                    $emails=Pharmacy::first();
                    $to=$emails->email;
                }

                if ($count>0) {
                    Mail::send('admin.emails.recipe', ['name' => $report->patient->people->name." ".$report->patient->people->first_lastname." ".$report->patient->people->second_lastname], function($msj) use ($pdfPath, $to, $report) {
                        $msj->subject('Receta Médica de Paciente: '.$report->patient->people->name." ".$report->patient->people->first_lastname." ".$report->patient->people->second_lastname);
                        $msj->from('no-reply@doctoonline.cl', 'Doctoonline');
                        $msj->to($to);
                        $msj->attach($pdfPath);
                    });
                }
                ini_set("max_execution_time", $normalTimeLimit);

            } catch (Exception $e) {
                return redirect()->back()->with(['alert' => 'lobibox','type' => 'error', 'title' => 'Envio fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
            }

            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El informe ha sido editado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function updateReportFive(ReportFiveUpdateRequest $request, $slug) {
        $report=Report::where('slug', $slug)->firstOrFail();
        $data=array('state' => "1");
        $report->fill($data)->save();

        if (!is_null($report->exams)) {
            $num=0;
            foreach ($report->exams as $exam) {
                $exa=ExamReport::where('id', $exam->id)->firstOrFail();
                $data=array('results' => request('results')[$num]);
                $exa->fill($data)->save();
                $num++;
            }
        }

        if ($report) {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El informe ha sido editado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function updateReportSix(ReportSixStoreRequest $request, $slug) {
        $report=Report::where('slug', $slug)->firstOrFail();
        $data=array('report' => request('report'));
        $report->fill($data)->save();

        if ($report) {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El informe ha sido editado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function diaries(Request $request){
        $user=People::where('id', session('user')[0]->id)->firstOrFail();
        $diaries=$user->doctor_service->map(function($item, $key) {
            return $item->diary_service->diary;
        });
        $num=1;
        return view('web.admin.diaries.index', compact('diaries', 'num'));
    }

    public function showDiary($slug){
        $diary=Diary::where('slug', $slug)->firstOrFail();
        return view('web.admin.diaries.show', compact('diary'));
    }

    public function visitor($service=null) {
        $agent=new Agent();
        if ($agent->isDesktop()) {
            $device="Escritorio";
        } elseif ($agent->isMobile()) {
            if ($agent->isPhone()) {
                $device="Teléfono";
            } elseif ($agent->isTablet()) {
                $device="Tablet";
            }
        }

        if (filter_var(request()->server('HTTP_CLIENT_IP'), FILTER_VALIDATE_IP)) {
            $ip=request()->server('HTTP_CLIENTE_IP');
        }
        elseif (filter_var(request()->server('HTTP_X_FORWARDED_FOR'), FILTER_VALIDATE_IP)) {
            $ip=request()->server('HTTP_X_FORWARDED_FOR');
        }
        elseif (filter_var( request()->server('HTTP_VIA'), FILTER_VALIDATE_IP)) {
            $ip=request()->server('HTTP_VIA');
        }
        else {
            $ip=request()->server('REMOTE_ADDR');
        }

        $visit=Visit::create(['visitor' => $ip, 'device' => $device]);

        if (!is_null($service)) {
            ServiceVisit::create(['service_id' => $service, 'visit_id' => $visit->id]);
        }
    }
}