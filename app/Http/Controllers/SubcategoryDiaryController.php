<?php

namespace App\Http\Controllers;

use App\Service;
use App\CategoryDiary;
use App\SubcategoryDiary;
use App\ScheduleSubcategory;
use Illuminate\Http\Request;
use App\Http\Requests\SubcategoryDiaryStoreRequest;
use App\Http\Requests\SubcategoryDiaryUpdateRequest;
use Illuminate\Support\Str;

class SubcategoryDiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories=SubcategoryDiary::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.subcategories_diaries.index', compact('subcategories', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=CategoryDiary::all();
        $services=Service::where('type', 2)->get();
        return view('admin.subcategories_diaries.create', compact('categories', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubcategoryDiaryStoreRequest $request)
    {
        $count=SubcategoryDiary::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=SubcategoryDiary::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $category=CategoryDiary::where('slug', request('category_id'))->firstOrFail();
                $data=array('name' => request('name'), 'slug' => $slug, 'code' => request('code'), 'category_id' => $category->id);
                break;
            }
        }

        $subcategory=SubcategoryDiary::create($data);

        $num=0;
        if (!is_null(request('service')) && is_array(request('service'))) {
            foreach (request('service') as $service) {
                if(!is_null(request('day')[$num]) && (request('day')[$num]>=0 && request('day')[$num]<=6) && !empty(request('start')[$num]) && !is_null(request('start')[$num]) && !empty(request('end')[$num]) && !is_null(request('end')[$num]) && request('start')[$num]<=request('end')[$num] && !empty(request('price')[$num]) && !is_null(request('price')[$num])) {

                    $service=Service::where('slug', $service)->first();
                    $exist=ScheduleSubcategory::where([
                        ['service_id', $service->id],
                        ['day', request('day')[$num]],
                        ['start', '<=', date('H:i', strtotime(request('start')[$num]))],
                        ['end', '>=', date('H:i', strtotime(request('end')[$num]))],
                        ['subcategory_id', $subcategory->id]
                    ])->orWhere([
                        ['service_id', $service->id],
                        ['day', request('day')[$num]],
                        ['start', '>', date('H:i', strtotime(request('start')[$num]))],
                        ['start', '<=', date('H:i', strtotime(request('end')[$num]))],
                        ['subcategory_id', $subcategory->id]
                    ])->orWhere([
                        ['service_id', $service->id],
                        ['day', request('day')[$num]],
                        ['end', '>=', date('H:i', strtotime(request('start')[$num]))],
                        ['end', '<', date('H:i', strtotime(request('end')[$num]))],
                        ['subcategory_id', $subcategory->id]
                    ])->count();
                    
                    if (!is_null($service) && $exist==0) {
                        $data=array('day' => request('day')[$num], 'start' => request('start')[$num], 'end' => request('end')[$num], 'service_id' => $service->id, 'price' => request('price')[$num], 'subcategory_id' => $subcategory->id);
                        ScheduleSubcategory::create($data);
                    }
                }
                $num++;
            }
        }

        if($subcategory){
            return redirect()->route('subcategorias.agenda.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La subcategoría ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('subcategorias.agenda.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
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
        $subcategory=SubcategoryDiary::where('slug', $slug)->firstOrFail();
        $categories=CategoryDiary::all();
        $services=Service::where('type', 2)->get();
        $num=0;
        return view('admin.subcategories_diaries.edit', compact("subcategory", "categories", "services", "num"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubcategoryDiaryUpdateRequest $request, $slug)
    {
        $subcategory=SubcategoryDiary::where('slug', $slug)->firstOrFail();
        $category=CategoryDiary::where('slug', request('category_id'))->firstOrFail();
        $data=array('name' => request('name'), 'code' => request('code'), 'category_id' => $category->id);
        $subcategory->fill($data)->save();
        
        ScheduleSubcategory::where('subcategory_id', $subcategory->id)->delete();

        $num=0;
        if (!is_null(request('service')) && is_array(request('service'))) {
            foreach (request('service') as $service) {
                if(!is_null(request('day')[$num]) && (request('day')[$num]>=0 && request('day')[$num]<=6) && !empty(request('start')[$num]) && !is_null(request('start')[$num]) && !empty(request('end')[$num]) && !is_null(request('end')[$num]) && request('start')[$num]<=request('end')[$num] && !empty(request('price')[$num]) && !is_null(request('price')[$num])) {
                    
                    $service=Service::where('slug', $service)->first();
                    $exist=ScheduleSubcategory::where([
                        ['service_id', $service->id],
                        ['day', request('day')[$num]],
                        ['start', '<=', date('H:i', strtotime(request('start')[$num]))],
                        ['end', '>=', date('H:i', strtotime(request('end')[$num]))],
                        ['subcategory_id', $subcategory->id]
                    ])->orWhere([
                        ['service_id', $service->id],
                        ['day', request('day')[$num]],
                        ['start', '>', date('H:i', strtotime(request('start')[$num]))],
                        ['start', '<=', date('H:i', strtotime(request('end')[$num]))],
                        ['subcategory_id', $subcategory->id]
                    ])->orWhere([
                        ['service_id', $service->id],
                        ['day', request('day')[$num]],
                        ['end', '>=', date('H:i', strtotime(request('start')[$num]))],
                        ['end', '<', date('H:i', strtotime(request('end')[$num]))],
                        ['subcategory_id', $subcategory->id]
                    ])->count();
                    
                    if (!is_null($service) && $exist==0) {
                        $data=array('day' => request('day')[$num], 'start' => request('start')[$num], 'end' => request('end')[$num], 'service_id' => $service->id, 'price' => request('price')[$num], 'subcategory_id' => $subcategory->id);
                        ScheduleSubcategory::create($data);
                    }
                }
                $num++;
            }
        }

        if ($subcategory) {
            return redirect()->route('subcategorias.agenda.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La subcategoría ha sido editada exitosamente.']);
        } else {
            return redirect()->route('subcategorias.agenda.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
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
        $subcategory=SubcategoryDiary::where('slug', $slug)->firstOrFail();
        $subcategory->delete();

        if ($subcategory) {
            return redirect()->route('subcategorias.agenda.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La subcategoría ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('subcategorias.agenda.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $subcategory=SubcategoryDiary::where('slug', $slug)->firstOrFail();
        $subcategory->fill(['state' => "0"])->save();

        if ($subcategory) {
            return redirect()->route('subcategorias.agenda.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La subcategoría ha sido desactivada exitosamente.']);
        } else {
            return redirect()->route('subcategorias.agenda.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {
        $subcategory=SubcategoryDiary::where('slug', $slug)->firstOrFail();
        $subcategory->fill(['state' => "1"])->save();

        if ($subcategory) {
            return redirect()->route('subcategorias.agenda.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La subcategoría ha sido activada exitosamente.']);
        } else {
            return redirect()->route('subcategorias.agenda.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function addSubcategories(Request $request) {
        $num=0;
        $subcategoriesSelect=[];
        $category=CategoryDiary::where('slug', request('slug'))->firstOrFail();
        $service=Service::where('slug', request('service'))->firstOrFail();
        $subcategories=SubcategoryDiary::where('category_id', $category->id)->orderBy('name', 'DESC')->get();
        foreach ($subcategories as $subcategory) {
            foreach ($subcategory->schedules as $schedule) {
                if ($schedule->service_id==$service->id) {
                    $subcategoriesSelect[$num]=['slug' => $subcategory->slug, 'name' => $subcategory->name, 'code' => $subcategory->code];
                    $num++;
                    break;
                }
            }
        }

        return response()->json($subcategoriesSelect);
    }
}
