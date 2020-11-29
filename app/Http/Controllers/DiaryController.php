<?php

namespace App\Http\Controllers;

use App\People;
use App\Specialty;
use App\Service;
use App\CategoryDiary;
use App\SubcategoryDiary;
use App\Diary;
use App\DiaryService;
use App\DoctorService;
use App\ExamService;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\DiaryStoreRequest;
use App\Http\Requests\DiaryUpdateRequest;
use Illuminate\Support\Str;

class DiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $diaries=Diary::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.diaries.index', compact('diaries', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $services=Service::where('state', "1")->orderBy('id', 'DESC')->get();
        $specialties=Specialty::all();
        $categories=CategoryDiary::all();
        return view('admin.diaries.create', compact('services', 'specialties', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiaryStoreRequest $request)
    {
        // Validación para que no se repita el slug
        $slug='reserva';
        $num=0;
        while (true) {
            $count=Diary::where('slug', $slug)->count();
            if ($count>0) {
                $slug='reserva-'.$num;
                $num++;
            } else {
                $service=Service::where('slug', request('service_id'))->firstOrFail();
                if ($service->type==1) {
                    $specialty=Specialty::where('slug', request('specialty_id'))->firstOrFail();
                    $people=People::where('slug', request('doctor_id'))->firstOrFail();
                    $schedule=$people->doctor->diary_doctor->schedules->where('service_id', $service->id);
                } elseif ($service->type==2) {
                    $subcategory=SubcategoryDiary::where('slug', request('subcategory_id'))->firstOrFail();
                    $schedule=$subcategory->schedules->where('service_id', $service->id);
                }

                $data=array('slug' => $slug, 'dni' => request('dni'), 'verify_digit' => request('verify_digit'), 'name' => request('name'), 'lastname' => request('lastname'), 'email' => request('email'), 'phone' => request('phone'), 'birthday' => request('birthday'), 'gender' => request('gender'), 'date' => date('Y-m-d', strtotime(request('date'))), 'time' => substr(request('time'), 0, -3), 'amount' => $schedule->first()->price);
                break;
            }
        }

        $diary=Diary::create($data);

        $data=array('price' => $schedule->first()->price, 'diary_id' => $diary->id, 'service_id' => $service->id);
        $diary_service=DiaryService::create($data);

        if ($service->type==1) {
            $data=array('service_id' => $diary_service->id, 'specialty_id' => $specialty->id, 'people_id' => $people->id);
            $doctor_service=DoctorService::create($data);
        } elseif ($service->type==2) {
            $data=array('service_id' => $diary_service->id, 'subcategory_id' => $subcategory->id);
            $exam_service=ExamService::create($data);
        }

        if ($diary) {
            return redirect()->route('reservas.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La reserva ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('reservas.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {
        $diary=Diary::where('slug', $slug)->firstOrFail();
        return view('admin.diaries.show', compact('diary'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $diary=Diary::where('slug', $slug)->firstOrFail();
        $setting=Setting::where('id', "1")->first();
        $service=Service::where('slug', $diary->diary_service->service->slug)->firstOrFail();
        if ($service->type==1) {
            $doctor=People::where('slug', $diary->diary_service->doctor_service->people->slug)->firstOrFail();
            $schedules=$doctor->doctor->diary_doctor->schedules->where('service_id', $service->id);
            $compare=$doctor;
        } elseif ($service->type==2) {
            $subcategory=SubcategoryDiary::where('slug', $diary->diary_service->exam_service->subcategory_diary->slug)->firstOrFail();
            $schedules=$subcategory->schedules->where('service_id', $service->id);
            $compare=$subcategory;
        }

        $num=0;
        $times=[];
        foreach ($schedules->sortBy('start') as $schedule) {

            $start=$schedule->start;
            $end=date("H:i", strtotime($start."+".($setting->interval-1)." minutes"));

            $count=Diary::where('date', date("Y-m-d", strtotime($diary->date)))->whereBetween('time', [date('H:i', strtotime($start)), date('H:i', strtotime($end))])->count();
            if ($count>0) {
                $datesDiaries=Diary::where('date', date("Y-m-d", strtotime($diary->date)))->whereBetween('time', [date('H:i', strtotime($start)), date('H:i', strtotime($end))])->get();
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

                    $count=Diary::where('date', date("Y-m-d", strtotime($diary->date)))->whereBetween('time', [date('H:i', strtotime($start)), date('H:i', strtotime($end))])->count();
                    if ($count>0) {
                        $datesDiaries=Diary::where('date', date("Y-m-d", strtotime($diary->date)))->whereBetween('time', [date('H:i', strtotime($start)), date('H:i', strtotime($end))])->get();
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

        return view('admin.diaries.edit', compact('diary', 'times', 'service', 'compare'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(DiaryUpdateRequest $request, $slug) {

        $diary=Diary::where('slug', $slug)->firstOrFail();
        $diary->fill(['date' => date("Y-m-d", strtotime(request('date'))), 'time' => request('time')])->save();

        if ($diary) {
            return redirect()->route('reservas.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La reserva ha sido editada exitosamente.']);
        } else {
            return redirect()->route('reservas.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $diary=Diary::where('slug', $slug)->firstOrFail();
        $diary->fill(['state' => "0"])->save();

        if ($diary) {
            return redirect()->route('reservas.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La reserva ha sido cancelada exitosamente.']);
        } else {
            return redirect()->route('reservas.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {

        $diary=Diary::where('slug', $slug)->firstOrFail();
        $diary->fill(['state' => "1"])->save();

        if ($diary) {
            return redirect()->route('reservas.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La reserva ha sido activada exitosamente.']);
        } else {
            return redirect()->route('reservas.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
