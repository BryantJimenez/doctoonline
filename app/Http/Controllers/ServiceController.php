<?php

namespace App\Http\Controllers;

use App\Service;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceStoreRequest;
use App\Http\Requests\ServiceUpdateRequest;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $services=Service::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.services.index', compact('services', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceStoreRequest $request)
    {
        $count=Service::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Service::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $data=array('name' => request('name'), 'slug' => $slug, 'title' => request('title'), 'description' => request('description'), 'diary_title' => request('diary_title'), 'diary_description' => request('diary_description'), 'app_title' => request('app_title'), 'app_description' => request('app_description'), 'line' => request('line'), 'type' => request('type'), 'featured' => request('featured'));
                break;
            }
        }

        // Mover imagen a carpeta services y extraer nombre
        if ($request->hasFile('image')) {
            $file=$request->file('image');
            $data['image']=store_files($file, $slug, '/admins/img/services/');
        }

        if ($request->hasFile('banner')) {
            $file=$request->file('banner');
            $data['banner']=store_files($file, "banner-".$slug, '/admins/img/services/');
        }

        if ($request->hasFile('icon')) {
            $file=$request->file('icon');
            $data['icon']=store_files($file, "icono-".$slug, '/admins/img/services/');
        }

        $service=Service::create($data);

        if ($service) {
            return redirect()->route('servicios.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El servicio ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('servicios.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\News  $services
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $service=Service::where('slug', $slug)->firstOrFail();
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\News  $services
     * @return \Illuminate\Http\Response
     */
    public function update(ServiceUpdateRequest $request, $slug)
    {
        $service=Service::where('slug', $slug)->firstOrFail();
        $data=array('name' => request('name'), 'title' => request('title'), 'description' => request('description'), 'diary_title' => request('diary_title'), 'diary_description' => request('diary_description'), 'app_title' => request('app_title'), 'app_description' => request('app_description'), 'line' => request('line'), 'type' => request('type'), 'featured' => request('featured'), 'state' => request('state'));

        // Mover imagen a carpeta services y extraer nombre
        if ($request->hasFile('image')) {
            $file=$request->file('image');
            $data['image']=store_files($file, $slug, '/admins/img/services/');
        }

        if ($request->hasFile('banner')) {
            $file=$request->file('banner');
            $data['banner']=store_files($file, "banner-".$slug, '/admins/img/services/');
        }

        if ($request->hasFile('icon')) {
            $file=$request->file('icon');
            $data['icon']=store_files($file, "icono-".$slug, '/admins/img/services/');
        }

        $service->fill($data)->save();

        if ($service) {
            return redirect()->route('servicios.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El servicio ha sido editado exitosamente.']);
        } else {
            return redirect()->route('servicios.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\News  $services
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $service=Service::where('slug', $slug)->firstOrFail();
        $service->delete();

        if ($service) {
            return redirect()->route('servicios.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El servicio ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('servicios.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, $slug) {
        $service=Service::where('slug', $slug)->firstOrFail();
        $service->fill(['state' => "0"])->save();

        if ($service) {
            return redirect()->route('servicios.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El servicio ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('servicios.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {
        $service=Service::where('slug', $slug)->firstOrFail();
        $service->fill(['state' => "1"])->save();

        if ($service) {
            return redirect()->route('servicios.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El servicio ha sido activado exitosamente.']);
        } else {
            return redirect()->route('servicios.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
