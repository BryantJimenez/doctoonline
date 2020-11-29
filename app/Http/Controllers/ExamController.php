<?php

namespace App\Http\Controllers;

use App\CategoryExam;
use App\Subcategory;
use App\Type;
use App\Exam;
use Illuminate\Http\Request;
use App\Http\Requests\ExamStoreRequest;
use App\Http\Requests\ExamUpdateRequest;
use Illuminate\Support\Str;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $exams=Exam::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.exams.index', compact('exams', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=CategoryExam::all();
        $types=Type::all();
        return view('admin.exams.create', compact('categories', 'types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExamStoreRequest $request)
    {
        $subcategory=Subcategory::where('slug', request('subcategory_id'))->firstOrFail();
        $type=Type::where('slug', request('type_id'))->firstOrFail();
        $count=Exam::where('subcategory_id', $subcategory->id)->where('type_id', $type->id)->count();
        if ($count>0) {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => 'Examen Existente', 'msg' => 'Este examen ya ha sido registrado.']);
        }

        // Validación para que no se repita el slug
        $slug="examen";
        $num=0;
        while (true) {
            $count2=Exam::where('slug', $slug)->count();
            if ($count2>0) {
                $slug="examen-".$num;
                $num++;
            } else {  
                $data=array('slug' => $slug, 'subcategory_id' => $subcategory->id, 'type_id' => $type->id);
                break;
            }
        }

        $exam=Exam::create($data);

        if ($exam) {
            return redirect()->route('examenes.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El examen ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('examenes.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $exam=Exam::where('slug', $slug)->firstOrFail();
        $types=Type::all();
        return view('admin.exams.edit', compact('exam', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(ExamUpdateRequest $request, $slug) {
        $exam=Exam::where('slug', $slug)->firstOrFail();
        $type=Type::where('slug', request('type_id'))->firstOrFail();
        $count=Exam::where('subcategory_id', $exam->subcategory_id)->where('type_id', $type->id)->where('id', '!=', $exam->id)->count();
        if ($count>0) {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'warning', 'title' => 'Examen Existente', 'msg' => 'Este examen ya ha sido registrado.']);
        }

        $data=array('type_id' => $type->id);
        $exam->fill($data)->save();

        if ($exam) {
            return redirect()->route('examenes.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El examen ha sido editado exitosamente.']);
        } else {
            return redirect()->route('examenes.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
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
        $exam=Exam::where('slug', $slug)->firstOrFail();
        $exam->delete();

        if ($exam) {
            return redirect()->route('examenes.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El examen ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('examenes.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function new(Request $request)
    {
        $subcategory=Subcategory::where('slug', request('subcategory'))->firstOrFail();
        $type=Type::where('slug', request('type'))->firstOrFail();
        $count=Exam::where('subcategory_id', $subcategory->id)->where('type_id', $type->id)->count();
        if ($count>0) {
            return response()->json([
                'status' => false,
                'copy' => true
            ]);
        }

        // Validación para que no se repita el slug
        $slug="examen";
        $num=0;
        while (true) {
            $count2=Exam::where('slug', $slug)->count();
            if ($count2>0) {
                $slug="examen-".$num;
                $num++;
            } else {  
                $data=array('slug' => $slug, 'subcategory_id' => $subcategory->id, 'type_id' => $type->id);
                break;
            }
        }

        $exam=Exam::create($data);

        if ($exam) {
            return response()->json([
                'status' => true,
                'slug' => $exam->slug,
                'name' => $exam->subcategory->category->name." | ".$exam->subcategory->name." | ".$exam->type->name
            ]);
        } else {
            return response()->json([
                'status' => false,
                'copy' => false
            ]);
        }
    }
}
