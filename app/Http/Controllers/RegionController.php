<?php

namespace App\Http\Controllers;

use App\Region;
use Illuminate\Http\Request;
use App\Http\Requests\RegionStoreRequest;
use App\Http\Requests\RegionUpdateRequest;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions=Region::orderBy('id', 'DESC')->get();
        $num = 1;
        return view('admin.regions.index', compact('regions', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.regions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegionStoreRequest $request)
    {
        $region=Region::create($request->all());

        if($region){
            return redirect()->route('regiones.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La región ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('regiones.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $region=Region::where('id', $id)->firstOrFail();
        return view('admin.regions.edit', compact("region"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RegionUpdateRequest $request, $id)
    {
        $region=Region::where('id', $id)->firstOrFail();
        $region->fill($request->all())->save();

        if ($region) {
            return redirect()->route('regiones.edit', ['id' => $id])->with(['alert' => 'sweet', 'alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La región ha sido editado exitosamente.']);
        } else {
            return redirect()->route('regiones.edit', ['id' => $id])->with(['alert' => 'lobibox', 'alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $region=Region::where('id', $id)->firstOrFail();
        $region->delete();

        if ($region) {
            return redirect()->route('regiones.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La región ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('regiones.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
