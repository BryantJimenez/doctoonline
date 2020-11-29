<?php

namespace App\Http\Controllers;

use App\Disease;
use Illuminate\Http\Request;
use App\Http\Requests\DiseaseStoreRequest;
use App\Http\Requests\DiseaseUpdateRequest;
use Illuminate\Support\Str;

class DiseaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $diseases=Disease::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.diseases.index', compact('diseases', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.diseases.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DiseaseStoreRequest $request)
    {
        $count=Disease::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Disease::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $data=array('name' => request('name'), 'slug' => $slug);
                break;
            }
        }

        $disease=Disease::create($data);

        if ($disease) {
            return redirect()->route('enfermedades.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La enfermedad ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('enfermedades.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $disease
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $disease=Disease::where('slug', $slug)->firstOrFail();
        return view('admin.diseases.edit', compact('disease'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $disease
     * @return \Illuminate\Http\Response
     */
    public function update(DiseaseUpdateRequest $request, $slug) {

        $disease=Disease::where('slug', $slug)->firstOrFail();
        $disease->fill($request->all())->save();

        if ($disease) {
            return redirect()->route('enfermedades.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La enfermedad ha sido editada exitosamente.']);
        } else {
            return redirect()->route('enfermedades.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $disease
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $disease=Disease::where('slug', $slug)->firstOrFail();
        $disease->delete();

        if ($disease) {
            return redirect()->route('enfermedades.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La enfermedad ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('enfermedades.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
