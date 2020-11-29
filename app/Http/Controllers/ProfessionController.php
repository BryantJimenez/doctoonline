<?php

namespace App\Http\Controllers;

use App\Profession;
use App\Http\Requests\ProfessionStoreRequest;
use App\Http\Requests\ProfessionUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $professions=Profession::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.professions.index', compact('professions', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.professions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfessionStoreRequest $request) {
        $count=Profession::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Profession::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $data=array('name' => request('name'), 'slug' => $slug);
                break;
            }
        }

        $profession=Profession::create($data);

        if ($profession) {
            return redirect()->route('profesiones.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La profesión ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('profesiones.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $profession=Profession::where('slug', $slug)->firstOrFail();
        return view('admin.professions.edit', compact("profession"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfessionUpdateRequest $request, $slug) {

        $profession = Profession::where('slug', $slug)->firstOrFail();
        $data=array('name' => request('name'));

        $profession->fill($data)->save();

        if ($profession) {
            return redirect()->route('profesiones.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La profesión ha sido editada exitosamente.']);
        } else {
            return redirect()->route('profesiones.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
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
        $profession=Profession::where('slug', $slug)->firstOrFail();
        $profession->delete();

        if ($profession) {
            return redirect()->route('profesiones.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La profesión ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('profesiones.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
