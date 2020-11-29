<?php

namespace App\Http\Controllers;

use App\Specialty;
use App\Http\Requests\SpecialtyStoreRequest;
use App\Http\Requests\SpecialtyUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SpecialtyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $specialties=Specialty::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.specialties.index', compact('specialties', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.specialties.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpecialtyStoreRequest $request) {
        $count=Specialty::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Specialty::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $data=array('name' => request('name'), 'slug' => $slug);
                break;
            }
        }

        $specialty=Specialty::create($data);

        if ($specialty) {
            return redirect()->route('especialidades.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La especialidad ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('especialidades.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $specialty=Specialty::where('slug', $slug)->firstOrFail();
        return view('admin.specialties.edit', compact("specialty"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SpecialtyUpdateRequest $request, $slug) {

        $specialty = Specialty::where('slug', $slug)->firstOrFail();
        $data=array('name' => request('name'));

        $specialty->fill($data)->save();

        if ($specialty) {
            return redirect()->route('especialidades.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La especialidad ha sido editada exitosamente.']);
        } else {
            return redirect()->route('especialidades.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
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
        $specialty=Specialty::where('slug', $slug)->firstOrFail();
        $specialty->delete();

        if ($specialty) {
            return redirect()->route('especialidades.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La especialidad ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('especialidades.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
