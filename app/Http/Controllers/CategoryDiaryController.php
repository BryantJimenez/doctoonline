<?php

namespace App\Http\Controllers;

use App\CategoryDiary;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryDiaryStoreRequest;
use App\Http\Requests\CategoryDiaryUpdateRequest;
use Illuminate\Support\Str;

class CategoryDiaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $categories=CategoryDiary::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.categories_diaries.index', compact('categories', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories_diaries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryDiaryStoreRequest $request)
    {
        $count=CategoryDiary::where('name', request('name'))->count();
        $slug=Str::slug(request('name'), '-');
        if ($count>0) {
            $slug=$slug."-".$count;
        }

        // Validación para que no se repita el slug
        $num=0;
        while (true) {
            $count2=CategoryDiary::where('slug', $slug)->count();
            if ($count2>0) {
                $slug=Str::slug(request('name'), '-')."-".$num;
                $num++;
            } else {
                $data=array('name' => request('name'), 'slug' => $slug);
                break;
            }
        }

        $category=CategoryDiary::create($data);

        if ($category) {
            return redirect()->route('categorias.agenda.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'La categoría ha sido registrada exitosamente.']);
        } else {
            return redirect()->route('categorias.agenda.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $category=CategoryDiary::where('slug', $slug)->firstOrFail();
        return view('admin.categories_diaries.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryDiaryUpdateRequest $request, $slug) {

        $category=CategoryDiary::where('slug', $slug)->firstOrFail();
        $category->fill($request->all())->save();

        if ($category) {
            return redirect()->route('categorias.agenda.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'La categoría ha sido editada exitosamente.']);
        } else {
            return redirect()->route('categorias.agenda.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
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
        $category=CategoryDiary::where('slug', $slug)->firstOrFail();
        $category->delete();

        if ($category) {
            return redirect()->route('categorias.agenda.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La categoría ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('categorias.agenda.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
