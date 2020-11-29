<?php

namespace App\Http\Controllers;

use App\Operation;
use Illuminate\Http\Request;
use App\Http\Requests\OperationStoreRequest;
use App\Http\Requests\OperationUpdateRequest;
use Illuminate\Support\Str;

class OperationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $operations=Operation::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.operations.index', compact('operations', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.operations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OperationStoreRequest $request)
    {
        $count=Operation::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=Operation::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $data=array('name' => request('name'), 'slug' => $slug);
                break;
            }
        }

        $operation=Operation::create($data);

        if ($operation) {
            return redirect()->route('operaciones.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La operación quirurgica ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('operaciones.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $operation=Operation::where('slug', $slug)->firstOrFail();
        return view('admin.operations.edit', compact('operation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function update(OperationUpdateRequest $request, $slug) {

        $operation=Operation::where('slug', $slug)->firstOrFail();
        $operation->fill($request->all())->save();

        if ($operation) {
            return redirect()->route('operaciones.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La operación quirurgica ha sido editada exitosamente.']);
        } else {
            return redirect()->route('operaciones.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Operation  $operation
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $operation=Operation::where('slug', $slug)->firstOrFail();
        $operation->delete();

        if ($operation) {
            return redirect()->route('operaciones.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La operación quirurgica ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('operaciones.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
