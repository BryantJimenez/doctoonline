<?php

namespace App\Http\Controllers;

use App\User;
use App\People;
use App\Patient;
use App\Doctor;
use App\Pharmacy;
use App\Covenant;
use App\Service;
use App\SubcategoryDiary;
use App\Diary;
use App\Setting;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index() {
        $data=$this->data();
        $patient=Patient::count();
        $doctor=Doctor::count();
        return view('admin.home', compact('patient', 'doctor', 'data'));
    }

    public function profile() {
        return view('admin.profile');
    }

    public function profileEdit() {
        return view('admin.edit');
    }

    public function profileUpdate(ProfileUpdateRequest $request) {
        $user = User::where('slug', Auth::user()->slug)->firstOrFail();
        $data=array('name' => request('name'), 'lastname' => request('lastname'), 'phone' => request('phone'));

        if (!is_null(request('password'))) {
            $data['password']=Hash::make(request('password'));
        }

        // Mover imagen a carpeta admins y extraer nombre
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $data['photo']=store_files($file, $slug, '/admins/img/admins/');
        }

        $user->fill($data)->save();

        if ($user) {
            if ($request->hasFile('photo')) {
                Auth::user()->photo=$data['photo'];
            }
            Auth::user()->name=request('name');
            Auth::user()->lastname=request('lastname');
            Auth::user()->phone=request('phone');
            if (!is_null(request('password'))) {
                Auth::user()->password=Hash::make(request('password'));
            }
            return redirect()->back()->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El perfil ha sido editado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    public function emailVerifyAdmin(Request $request)
    {
        $count=User::where('email', request('email'))->count();
        if ($count>0) {
            return "false";
        } else {
            return "true";
        }
    }

    public function emailVerifyPeople(Request $request)
    {
        $count=People::where('email', request('email'))->count();
        if ($count>0) {
            return "false";
        } else {
            return "true";
        }
    }

    public function emailVerifyPharmacy(Request $request)
    {
        $count=Pharmacy::where('email', request('email'))->count();
        if ($count>0) {
            return "false";
        } else {
            return "true";
        }
    }

    public function emailVerifyCovenant(Request $request)
    {
        $count=Covenant::where('email', request('email'))->count();
        if ($count>0) {
            return "false";
        } else {
            return "true";
        }
    }

    public function searchRutPatient(Request $request)
    {
        $count=People::where('dni', request('dni'))->count();
        if ($count>0) {

            $user=People::where('dni', request('dni'))->first();
            if (!is_null($user)) {

                if (!is_null($user->patient)) {
                    return response()->json(['status' => true, 'type' => 'patient']);
                } else {
                    return response()->json(['status' => true, 'type' => 'people', 'dni' => number_format($user->dni, 0, ".", ".")."-".$user->verify_digit, 'name' => $user->name." ".$user->first_lastname." ".$user->second_lastname, 'gender' => $user->gender, 'phone' => $user->phone, 'celular' => $user->celular, 'birthday' => date('d-m-Y', strtotime($user->birthday)), 'age' => age(date('Y-m-d', strtotime($user->birthday))), 'address' => $user->address, 'postal' => $user->postal, 'email' => $user->email, 'address_place' => $user->country->name." / ".$user->commune->province->region->name." / ".$user->commune->province->name." / ".$user->commune->name, 'photo' => $user->photo, 'slug' => $user->slug]);
                }

            } else {
                return response()->json(['status' => false]);
            }

        } else {
            return response()->json(['status' => false]);
        }
    }

    public function searchRutDoctor(Request $request)
    {
        $count=People::where('dni', request('dni'))->count();
        if ($count>0) {

            $user=People::where('dni', request('dni'))->first();
            if (!is_null($user)) {

                if (!is_null($user->doctor)) {
                    return response()->json(['status' => true, 'type' => 'doctor']);
                } else {
                    return response()->json(['status' => true, 'type' => 'people', 'dni' => number_format($user->dni, 0, ".", ".")."-".$user->verify_digit, 'name' => $user->name." ".$user->first_lastname." ".$user->second_lastname, 'gender' => $user->gender, 'phone' => $user->phone, 'celular' => $user->celular, 'birthday' => date('d-m-Y', strtotime($user->birthday)), 'age' => age(date('Y-m-d', strtotime($user->birthday))), 'address' => $user->address, 'postal' => $user->postal, 'email' => $user->email, 'address_place' => $user->country->name." / ".$user->commune->province->region->name." / ".$user->commune->province->name." / ".$user->commune->name, 'photo' => $user->photo, 'slug' => $user->slug]);
                }
            }
        }
        return response()->json(['status' => false]);
    }

    public function searchRutPeople(Request $request)
    {
        $count=People::where('dni', request('dni'))->count();
        if ($count>0) {

            $user=People::where('dni', request('dni'))->first();
            if (!is_null($user)) {
                return response()->json(['status' => true, 'name' => $user->name, 'lastname' => $user->first_lastname." ".$user->second_lastname, 'gender' => $user->gender, 'phone' => $user->phone, 'birthday' => date('d-m-Y', strtotime($user->birthday)), 'email' => $user->email]);
            }
        }
        return response()->json(['status' => false]);
    }

    public function diaryTimes(Request $request)
    {
        $setting=Setting::where('id', "1")->first();
        $service=Service::where('slug', request('service'))->firstOrFail();
        if ($service->type==1) {
            $doctor=People::where('slug', request('selected'))->firstOrFail();
            $schedules=$doctor->doctor->diary_doctor->schedules->where('service_id', $service->id)->where('day', date('w', strtotime(request('date'))));
            $compare=$doctor;
        } elseif ($service->type==2) {
            $subcategory=SubcategoryDiary::where('slug', request('selected'))->firstOrFail();
            $schedules=$subcategory->schedules->where('service_id', $service->id)->where('day', date('w', strtotime(request('date'))));
            $compare=$subcategory;
        }

        $num=0;
        $times=[];
        foreach ($schedules->sortBy('start') as $schedule) {

            $start=$schedule->start;
            $end=date("H:i", strtotime($start."+".($setting->interval-1)." minutes"));

            $count=Diary::where('date', date("Y-m-d", strtotime(request('date'))))->whereBetween('time', [date('H:i', strtotime($start)), date('H:i', strtotime($end))])->count();
            if (date('Y-m-d H:i')>date('Y-m-d H:i', strtotime(date("Y-m-d", strtotime(request('date')))." ".$end))) {
                $type="2";
            } elseif ($count>0) {
                $datesDiaries=Diary::where('date', date("Y-m-d", strtotime(request('date'))))->whereBetween('time', [date('H:i', strtotime($start)), date('H:i', strtotime($end))])->get();
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

                    $count=Diary::where('date', date("Y-m-d", strtotime(request('date'))))->whereBetween('time', [date('H:i', strtotime($start)), date('H:i', strtotime($end))])->count();
                    if (date('Y-m-d H:i')>date('Y-m-d H:i', strtotime(date("Y-m-d", strtotime(request('date')))." ".$end))) {
                        $type="2";
                    } elseif ($count>0) {
                        $datesDiaries=Diary::where('date', date("Y-m-d", strtotime(request('date'))))->whereBetween('time', [date('H:i', strtotime($start)), date('H:i', strtotime($end))])->get();
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

        $times=array_reverse($times);

        return $times;
    }

    public function diariesDay(Request $request)
    {
        $user=People::where('slug', request('slug'))->firstOrFail();
        $diaries=$user->doctor_service->map(function($item, $key) {
            return $item->diary_service->diary;
        });

        $num=0;
        $data=[];
        foreach ($diaries->where('date', date('Y-m-d', strtotime(request('date')))) as $diary) {
            $data[$num]=array('date' => date('d-m-Y H:i A', strtotime($diary->date." ".$diary->time)), 'name' => $diary->name." ".$diary->lastname, 'service' => $diary->diary_service->service->name, 'state' => stateDiary($diary->state), 'slug' => $diary->slug);
        }

        return $data;
    }
}
