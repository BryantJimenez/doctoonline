<?php

namespace App\Http\Controllers;

use App\Covenant;
use Illuminate\Http\Request;
use App\Http\Requests\CovenantStoreRequest;
use App\Http\Requests\CovenantUpdateRequest;
use Illuminate\Support\Str;

class CovenantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $covenants=Covenant::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.covenants.index', compact('covenants', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.covenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CovenantStoreRequest $request)
    {
        $count=Covenant::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Covenant::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $data=array('name' => request('name'), 'slug' => $slug, 'email' => request('email'), 'address' => request('address'));
                break;
            }
        }

        $covenant=Covenant::create($data);

        if ($covenant) {
            return redirect()->route('convenios.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El convenio ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('convenios.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Email  $covenant
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $covenant=Covenant::where('slug', $slug)->firstOrFail();
        return view('admin.covenants.edit', compact('covenant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Email  $covenant
     * @return \Illuminate\Http\Response
     */
    public function update(CovenantUpdateRequest $request, $slug) {

        $covenant=Covenant::where('slug', $slug)->firstOrFail();
        $covenant->fill($request->all())->save();

        if ($covenant) {
            return redirect()->route('convenios.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El convenio ha sido editado exitosamente.']);
        } else {
            return redirect()->route('convenios.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Email  $covenant
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $covenant=Covenant::where('slug', $slug)->firstOrFail();
        $covenant->delete();

        if ($covenant) {
            return redirect()->route('convenios.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El convenio ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('convenios.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
