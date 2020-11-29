<?php

namespace App\Http\Controllers;

use App\Insurer;
use App\Http\Requests\InsurerStoreRequest;
use App\Http\Requests\InsurerUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class InsurerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $insurers=Insurer::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.insurers.index', compact('insurers', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.insurers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InsurerStoreRequest $request) {
        $count=Insurer::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Insurer::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $data=array('name' => request('name'), 'slug' => $slug);
                break;
            }
        }

        $insurer=Insurer::create($data);

        if ($insurer) {
            return redirect()->route('aseguradoras.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La aseguradora de salud ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('aseguradoras.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $insurer=Insurer::where('slug', $slug)->firstOrFail();
        return view('admin.insurers.edit', compact("insurer"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(InsurerUpdateRequest $request, $slug) {

        $insurer = Insurer::where('slug', $slug)->firstOrFail();
        $data=array('name' => request('name'));

        $insurer->fill($data)->save();

        if ($insurer) {
            return redirect()->route('aseguradoras.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La aseguradora de salud ha sido editada exitosamente.']);
        } else {
            return redirect()->route('aseguradoras.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $insurer=Insurer::where('slug', $slug)->firstOrFail();
        $insurer->delete();

        if ($insurer) {
            return redirect()->route('aseguradoras.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La aseguradora de salud ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('aseguradoras.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
