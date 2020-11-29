<?php

namespace App\Http\Controllers;

use App\Pharmacy;
use Illuminate\Http\Request;
use App\Http\Requests\PharmacyStoreRequest;
use App\Http\Requests\PharmacyUpdateRequest;
use Illuminate\Support\Str;

class PharmacyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pharmacies=Pharmacy::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.pharmacies.index', compact('pharmacies', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pharmacies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PharmacyStoreRequest $request)
    {
        $count=Pharmacy::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Pharmacy::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $data=array('name' => request('name'), 'slug' => $slug, 'email' => request('email'), 'address' => request('address'));
                break;
            }
        }

        $pharmacy=Pharmacy::create($data);

        if ($pharmacy) {
            return redirect()->route('farmacias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La farmacia ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('farmacias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Email  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $pharmacy=Pharmacy::where('slug', $slug)->firstOrFail();
        return view('admin.pharmacies.edit', compact('pharmacy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Email  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function update(PharmacyUpdateRequest $request, $slug) {

        $pharmacy=Pharmacy::where('slug', $slug)->firstOrFail();
        $pharmacy->fill($request->all())->save();

        if ($pharmacy) {
            return redirect()->route('farmacias.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La farmacia ha sido editada exitosamente.']);
        } else {
            return redirect()->route('farmacias.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Email  $pharmacy
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $pharmacy=Pharmacy::where('slug', $slug)->firstOrFail();
        $pharmacy->delete();

        if ($pharmacy) {
            return redirect()->route('farmacias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La farmacia ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('farmacias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
