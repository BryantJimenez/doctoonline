<?php

namespace App\Http\Controllers;

use App\Region;
use App\Province;
use App\Commune;
use Illuminate\Http\Request;
use App\Http\Requests\CommuneStoreRequest;
use App\Http\Requests\CommuneUpdateRequest;

class CommuneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $communes=Commune::orderBy('id', 'DESC')->get();
        $num = 1;
        return view('admin.communes.index', compact('communes', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions=Region::all();
        $provinces=Province::all();

        return view('admin.communes.create', compact('regions', 'provinces'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommuneStoreRequest $request)
    {
        $commune=Commune::create($request->all());

        if($commune){
            return redirect()->route('comunas.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La comuna ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('comunas.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
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
        $commune=Commune::where('id', $id)->firstOrFail();
        return view('admin.communes.edit', compact("commune"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CommuneUpdateRequest $request, $id)
    {
        $commune=Commune::where('id', $id)->firstOrFail();
        $commune->fill($request->all())->save();

        if ($commune) {
            return redirect()->route('comunas.edit', ['id' => $id])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La comuna ha sido editada exitosamente.']);
        } else {
            return redirect()->route('comunas.edit', ['id' => $id])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
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
        $commune=Commune::where('id', $id)->firstOrFail();
        $commune->delete();

        if ($commune) {
            return redirect()->route('comunas.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La comuna ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('comunas.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function addCommunes(Request $request) {
        $num=0;
        $communesSelect=[];
        $communes=Commune::where('province_id', request('id'))->orderBy('name', 'DESC')->get();   
        foreach ($communes as $commune) {
            $communesSelect[$num]=['id' => $commune->id, 'name' => $commune->name];
            $num++;
        }

        return response()->json($communesSelect);
    }
}
