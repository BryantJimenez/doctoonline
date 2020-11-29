<?php

namespace App\Http\Controllers;

use App\Region;
use App\Province;
use Illuminate\Http\Request;
use App\Http\Requests\ProvinceStoreRequest;
use App\Http\Requests\ProvinceUpdateRequest;

class ProvinceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $provinces=Province::orderBy('id', 'DESC')->get();
        $num = 1;
        return view('admin.provinces.index', compact('provinces', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions=Region::all();
        return view('admin.provinces.create', compact('regions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProvinceStoreRequest $request)
    {
        $province=Province::create($request->all());

        if($province){
            return redirect()->route('provincias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La provincia ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('provincias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
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
        $province=Province::where('id', $id)->firstOrFail();
        return view('admin.provinces.edit', compact("province"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProvinceUpdateRequest $request, $id)
    {
        $province=Province::where('id', $id)->firstOrFail();
        $province->fill($request->all())->save();

        if ($province) {
            return redirect()->route('provincias.edit', ['id' => $id])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La provincia ha sido editada exitosamente.']);
        } else {
            return redirect()->route('provincias.edit', ['id' => $id])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
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
        $province=Province::where('id', $id)->firstOrFail();
        $province->delete();

        if ($province) {
            return redirect()->route('provincias.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La provincia ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('provincias.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function addProvinces(Request $request) {
        $num=0;
        $provincesSelect=[];
        $provinces=Province::where('region_id', request('id'))->orderBy('name', 'DESC')->get();   
        foreach ($provinces as $province) {
            $provincesSelect[$num]=['id' => $province->id, 'name' => $province->name];
            $num++;
        }

        return response()->json($provincesSelect);
    }
}
