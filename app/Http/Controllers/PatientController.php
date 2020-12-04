<?php

namespace App\Http\Controllers;

use App\Country;
use App\Region;
use App\Province;
use App\Commune;
use App\Study;
use App\Insurer;
use App\People;
use App\Patient;
use App\Report;
use App\Http\Requests\PatientStoreRequest;
use App\Http\Requests\PatientUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $patients=Patient::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.patients.index', compact('patients', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $countries=Country::orderBy('name', 'ASC')->get();
        $regions=Region::orderBy('name', 'ASC')->get();
        $studies=Study::all();
        $insurers=Insurer::all();
        return view('admin.patients.create', compact('countries', 'regions', 'studies', 'insurers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientStoreRequest $request) {
        $people=People::where('dni', request('dni'))->where('verify_digit', request('verify_digit'))->first();
        if (is_null($people)) {
            $count=People::where('name', request('name'))->where('first_lastname', request('first_lastname'))->where('second_lastname', request('second_lastname'))->count();
            $slug=Str::slug(request('name')." ".request('first_lastname')." ".request('second_lastname'), '-');
            if ($count>0) {
                $slug=$slug."-".$count;
            }

            // Validación para que no se repita el slug
            $num=0;
            while (true) {
                $count2=People::where('slug', $slug)->count();
                if ($count2>0) {
                    $slug=Str::slug(request('name')." ".request('first_lastname')." ".request('second_lastname'), '-')."-".$num;
                    $num++;
                } else {
                    $data=array('dni' => request('dni'), 'verify_digit' => request('verify_digit'), 'name' => request('name'), 'first_lastname' => request('first_lastname'), 'second_lastname' => request('second_lastname'), 'slug' => $slug, 'phone' => request('phone'), 'celular' => request('celular'), 'birthday' => date('Y-m-d', strtotime(request('birthday'))), 'commune_id' => request('commune_id'), 'country_id' => request('country_id'), 'address' => request('address'), 'postal' => request('postal'), 'gender' => request('gender'), 'email' => request('email'), 'password' => Hash::make(request('password')));
                    break;
                }
            }

            // Mover imagen a carpeta users y extraer nombre
            if ($request->hasFile('photo')) {
                $file=$request->file('photo');
                $data['photo']=store_files($file, $slug, '/admins/img/users/');
            }

            $people=People::create($data);

            $study=Study::where('slug', request('study_id'))->firstOrFail();
            $insurer=Insurer::where('slug', request('insurer_id'))->firstOrFail();
            if (request('question_children')=="No") {
                $children=0;
            } else {
                $children=request('children');
            }
            $data=array('civil_state' => request('civil_state'), 'children' => $children, 'laboral' => request('laboral'), 'study_id' => $study->id, 'insurer_id' => $insurer->id, 'people_id' => $people->id);
            $patient=Patient::create($data);

            if ($patient) {
                return redirect()->route('pacientes.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El paciente ha sido registrado exitosamente.']);
            } else {
                return redirect()->route('pacientes.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
            }
        } else {

            if (!is_null($people->patient)) {
                return redirect()->back()->with(['alert' => 'sweet', 'type' => 'warning', 'title' => 'Paciente ya existe', 'msg' => 'El paciente ya se encuentra registrado.']);
            }
            
            $study=Study::where('slug', request('study_id'))->firstOrFail();
            $insurer=Insurer::where('slug', request('insurer_id'))->firstOrFail();
            if (request('question_children')=="No") {
                $children=0;
            } else {
                $children=request('children');
            }
            $data=array('civil_state' => request('civil_state'), 'children' => $children, 'laboral' => request('laboral'), 'study_id' => $study->id, 'insurer_id' => $insurer->id, 'people_id' => $people->id);
            $patient=Patient::create($data);

            if ($patient) {
                return redirect()->route('pacientes.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El paciente ha sido registrado exitosamente.']);
            } else {
                return redirect()->route('pacientes.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {
        $patient=People::where('slug', $slug)->firstOrFail();
        return view('admin.patients.show', compact('patient'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $patient=People::where('slug', $slug)->firstOrFail();
        $countries=Country::orderBy('name', 'ASC')->get();
        $regions=Region::orderBy('name', 'ASC')->get();
        $provinces=Province::where('region_id', $patient->commune->province->region_id)->orderBy('name', 'ASC')->get();
        $communes=Commune::where('province_id', $patient->commune->province_id)->orderBy('name', 'ASC')->get();
        $studies=Study::all();
        $insurers=Insurer::all();
        return view('admin.patients.edit', compact("patient", "countries", "regions", "provinces", "communes", "studies", "insurers"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PatientUpdateRequest $request, $slug) {
        $people=People::where('slug', $slug)->firstOrFail();

        $validator = Validator::make($request->all(), [
            'dni' => Rule::unique('people')->ignore($people->id),
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $data=array('dni' => request('dni'), 'verify_digit' => request('verify_digit'), 'name' => request('name'), 'first_lastname' => request('first_lastname'), 'second_lastname' => request('second_lastname'), 'phone' => request('phone'), 'celular' => request('celular'), 'birthday' => date('Y-m-d', strtotime(request('birthday'))), 'commune_id' => request('commune_id'), 'country_id' => request('country_id'), 'address' => request('address'), 'postal' => request('postal'), 'gender' => request('gender'), 'email' => request('email'));

        if (!is_null(request('password'))) {
            $data['password']=Hash::make(request('password'));
        }

        // Mover imagen a carpeta users y extraer nombre
        if ($request->hasFile('photo')) {
            $file=$request->file('photo');
            $data['photo']=store_files($file, $slug, '/admins/img/users/');
        }

        $people->fill($data)->save();

        $patient=Patient::where('people_id', $people->id)->firstOrFail();
        $study=Study::where('slug', request('study_id'))->firstOrFail();
        $insurer=Insurer::where('slug', request('insurer_id'))->firstOrFail();
        if (request('question_children')=="No") {
            $children=0;
        } else {
            $children=request('children');
        }
        $data=array('civil_state' => request('civil_state'), 'children' => $children, 'laboral' => request('laboral'), 'study_id' => $study->id, 'insurer_id' => $insurer->id);
        $patient->fill($data)->save();

        if ($patient) {
            return redirect()->route('pacientes.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El paciente ha sido editado exitosamente.']);
        } else {
            return redirect()->route('pacientes.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
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
        $patient=People::where('slug', $slug)->firstOrFail();
        if (is_null($patient->patient)) {
            $patient->delete();
        } else {
            $patient=Patient::where('people_id', $patient->id)->firstOrFail();
            $patient->delete();
        }
        
        if ($patient) {
            return redirect()->route('pacientes.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El paciente ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('pacientes.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $people=People::where('slug', $slug)->firstOrFail();
        $patient=Patient::where('people_id', $people->id)->firstOrFail();
        $patient->fill(['state' => "0"])->save();

        if ($patient) {
            return redirect()->route('pacientes.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El paciente ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('pacientes.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {

        $people=People::where('slug', $slug)->firstOrFail();
        $patient=Patient::where('people_id', $people->id)->firstOrFail();
        $patient->fill(['state' => "1"])->save();

        if ($patient) {
            return redirect()->route('pacientes.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El paciente ha sido activado exitosamente.']);
        } else {
            return redirect()->route('pacientes.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function reports($slug) {
        $people=People::where('slug', $slug)->firstOrFail();
        $reports=Report::where('patient_id', $people->patient->id)->orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.patients.reports', compact('reports', 'num'));
    }

    public function report($slug, $report) {
        $report=Report::where('slug', $report)->firstOrFail();
        return view('admin.patients.report', compact('report', 'slug'));
    }
}
