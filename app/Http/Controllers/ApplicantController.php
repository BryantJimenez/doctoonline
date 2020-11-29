<?php

namespace App\Http\Controllers;

use App\Applicant;
use Illuminate\Http\Request;
use App\Http\Requests\ApplicantStoreRequest;
use Illuminate\Support\Str;

class ApplicantController extends Controller
{
    public function index(){
        $applicants=Applicant::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.applicants.index', compact('applicants', 'num'));
    }

    public function store(ApplicantStoreRequest $request)
    {
        // Validación para que no se repita el slug
        $slug="solicitud";
        $num=0;
        while (true) {
            $count2=Applicant::where('slug', $slug)->count();
            if ($count2>0) {
                $slug="solicitud-".$num;
                $num++;
            } else {
                $data=array('name' => request('name'), 'slug' => $slug, 'email' => request('email'), 'message' => request('message'));
                break;
            }
        }

        // Mover imagen a carpeta applicants y extraer nombre
        if ($request->hasFile('file')) {
            $file=$request->file('file');
            $data['file']=store_files($file, $slug, '/admins/img/applicants/');
        }

        $applicant=Applicant::create($data);

        if ($applicant) {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Envio exitoso', 'msg' => 'El mensaje ha sido enviado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Envio fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function show($slug) {
        $applicant=Applicant::where('slug', $slug)->firstOrFail();
        return view('admin.applicants.show', compact('applicant'));
    }

    public function destroy($slug)
    {
        $applicant=Applicant::where('slug', $slug)->firstOrFail();
        $applicant->delete();

        if ($applicant) {
            return redirect()->route('solicitudes.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'La solicitud ha sido eliminada exitosamente.']);
        } else {
            return redirect()->route('solicitudes.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }
}
