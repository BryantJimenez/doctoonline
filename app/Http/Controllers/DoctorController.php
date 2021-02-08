<?php

namespace App\Http\Controllers;

use App\Country;
use App\Region;
use App\Province;
use App\Commune;
use App\People;
use App\Specialty;
use App\Profession;
use App\Doctor;
use App\DoctorSpecialty;
use App\Service;
use App\Http\Requests\DoctorStoreRequest;
use App\Http\Requests\DoctorUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $doctors=Doctor::orderBy('id', 'DESC')->get();
        $num=1;
        return view('admin.doctors.index', compact('doctors', 'num'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $countries=Country::orderBy('name', 'ASC')->get();
        $regions=Region::orderBy('name', 'ASC')->get();
        $specialties=Specialty::orderBy('id', 'DESC')->get();
        $professions=Profession::orderBy('id', 'DESC')->get();
        return view('admin.doctors.create', compact('countries', 'regions', 'specialties', 'professions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorStoreRequest $request) {
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

        } else {

            if (!is_null($people->doctor)) {
                return redirect()->back()->with(['alert' => 'sweet', 'type' => 'warning', 'title' => 'Doctor ya existe', 'msg' => 'El doctor ya se encuentra registrado.'])->withInputs();
            }
        }

        $profession=Profession::where('slug', request('profession_id'))->firstOrFail();
        $data=array('inscription' => request('inscription'), 'number_doctor' => request('number_doctor'), 'profession_id' => $profession->id, 'people_id' => $people->id);

        // Mover imagen a carpeta doctors y extraer nombre
        if ($request->hasFile('signature')) {
            $file=$request->file('signature');
            $data['signature']=store_files($file, $people->slug, '/admins/img/doctors/');
        }
        $doctor=Doctor::create($data);

        $num=0;
        $specialties=request('specialty_id');
        foreach ($specialties as $specialty) {
            $special=Specialty::where('slug', $specialty)->firstOrFail();
            $data=array('specialty_id' => $special->id, 'doctor_id' => $doctor->id);
            DoctorSpecialty::create($data);
            $num++;
        }

        if ($doctor) {
            return redirect()->route('medicos.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Registro exitoso', 'msg' => 'El médico ha sido registrado exitosamente.']);
        } else {
            return redirect()->route('medicos.create')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Registro fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug) {
        $doctor=People::where('slug', $slug)->firstOrFail();
        return view('admin.doctors.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug) {
        $doctor=People::where('slug', $slug)->firstOrFail();
        $countries=Country::orderBy('name', 'ASC')->get();
        $regions=Region::orderBy('name', 'ASC')->get();
        $provinces=Province::where('region_id', $doctor->commune->province->region_id)->orderBy('name', 'ASC')->get();
        $communes=Commune::where('province_id', $doctor->commune->province_id)->orderBy('name', 'ASC')->get();
        $specialties=Specialty::orderBy('id', 'DESC')->get();
        $professions=Profession::orderBy('id', 'DESC')->get();
        return view('admin.doctors.edit', compact("doctor", "countries", "regions", "provinces", "communes", "specialties", "professions"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorUpdateRequest $request, $slug) {
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

        $doctor=Doctor::where('people_id', $people->id)->firstOrFail();
        $profession=Profession::where('slug', request('profession_id'))->firstOrFail();
        $data=array('inscription' => request('inscription'), 'number_doctor' => request('number_doctor'), 'profession_id' => $profession->id);

        // Mover imagen a carpeta doctors y extraer nombre
        if ($request->hasFile('signature')) {
            $file=$request->file('signature');
            $data['signature']=store_files($file, $people->slug, '/admins/img/doctors/');
        }
        $doctor->fill($data)->save();

        foreach ($doctor->specialties as $specialty) {
            $special=DoctorSpecialty::where('doctor_id', $doctor->id)->where('specialty_id', $specialty->id)->firstOrFail();
            $special->delete();
        }

        $num=0;
        $specialties=request('specialty_id');
        foreach ($specialties as $specialty) {
            $special=Specialty::where('slug', $specialty)->firstOrFail();
            $data=array('specialty_id' => $special->id, 'doctor_id' => $doctor->id);
            DoctorSpecialty::create($data);
            $num++;
        }

        if ($doctor) {
            return redirect()->route('medicos.edit', ['slug' => $slug])->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El médico ha sido editado exitosamente.']);
        } else {
            return redirect()->route('medicos.edit', ['slug' => $slug])->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
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
        $doctor=People::where('slug', $slug)->firstOrFail();
        if (is_null($doctor->patient)) {
            $doctor->delete();
        } else {
            $doctor=Doctor::where('people_id', $doctor->id)->firstOrFail();
            $doctor->delete();
        }

        if ($doctor) {
            return redirect()->route('medicos.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Eliminación exitosa', 'msg' => 'El médico ha sido eliminado exitosamente.']);
        } else {
            return redirect()->route('medicos.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Eliminación fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function deactivate(Request $request, $slug) {

        $people = People::where('slug', $slug)->firstOrFail();
        $doctor = Doctor::where('people_id', $people->id)->firstOrFail();
        $doctor->fill(['state' => 0])->save();

        if ($doctor) {
            return redirect()->route('medicos.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El médico ha sido desactivado exitosamente.']);
        } else {
            return redirect()->route('medicos.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function activate(Request $request, $slug) {

        $people = People::where('slug', $slug)->firstOrFail();
        $doctor = Doctor::where('people_id', $people->id)->firstOrFail();
        $doctor->fill(['state' => "1"])->save();

        if ($doctor) {
            return redirect()->route('medicos.index')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'El médico ha sido activado exitosamente.']);
        } else {
            return redirect()->route('medicos.index')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.']);
        }
    }

    public function addDoctors(Request $request) {
        $num=0;
        $doctorsSelect=[];
        $specialty=Specialty::where('slug', request('slug'))->firstOrFail();
        $service=Service::where('slug', request('service'))->firstOrFail();
        foreach ($specialty->doctors as $doctor) {
            if (!is_null($doctor->diary_doctor) && $doctor->state=='1' && $doctor->diary_doctor->state=='1') {
                foreach ($doctor->diary_doctor->schedules as $schedule) {
                    if ($schedule->service_id==$service->id) {
                        $doctorsSelect[$num]=['slug' => $doctor->people->slug, 'name' => $doctor->people->name." ".$doctor->people->first_lastname." ".$doctor->people->second_lastname];
                        $num++;
                        break;
                    }
                }
            }            
        }

        return response()->json($doctorsSelect);
    }

    public function searchDoctor(Request $request) {
        $people=People::where('slug', request('slug'))->firstOrFail();
        $specialties="";
        foreach ($people->doctor->specialties as $specialty) {
            $specialties.=$specialty->name.", ";
        }
        $specialties=substr($specialties, 0, -2);
        $data=['photo' => $people->photo, 'name' => $people->name." ".$people->first_lastname." ".$people->second_lastname, 'rating' => $people->doctor->diary_doctor->rating, 'description' => $people->doctor->diary_doctor->description, 'specialties' => $specialties];

        return response()->json($data);
    }
}
