<?php

namespace App\Http\Controllers;

use App\Setting;
use App\Country;
use App\Region;
use App\People;
use App\Patient;
use App\Reset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\LoginCustomRequest;
use App\Http\Requests\RegisterCustomRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Notifications\ResetPasswordCustomNotification;

class AuthController extends Controller
{
	public function loginForm() {
		$setting=Setting::where('id', 1)->firstOrFail();
		return view('web.auth.login', compact('setting'));
	}

	public function login(LoginCustomRequest $request) {
		$user=People::where('email', request('email'))->first();
		if (!is_null($user)) {
			if ((!is_null($user->patient) && $user->patient->state==0) && (!is_null($user->doctor) && $user->doctor->state==0)) {
				return redirect()->back()->with(['error.login' => 'Este usuario no tiene permitido ingresar.'])->withInput();
			} elseif(Hash::check(request('password'), $user->password)) {
				if ($request->session()->has('user')) {
					$request->session()->forget('user');
				}
				
				if ((!is_null($user->patient) && $user->patient->state==1) && (!is_null($user->doctor) && $user->doctor->state==1)) {

					$user->type=NULL;
					$request->session()->push('user', $user);
					return redirect()->route('web.selected');

				} elseif ((is_null($user->patient) || $user->patient->state==0) && (!is_null($user->doctor) && $user->doctor->state==1)) {

					$user->type=1;
					$request->session()->push('user', $user);
					return redirect()->route('web.profile');

				} else {

					$user->type=2;
					$request->session()->push('user', $user);
					return redirect()->route('web.profile');
				}
				
			}
		}
		
		return redirect()->back()->with(['error.login' => 'Las credenciales no coinciden.'])->withInput();
	}

	public function registerForm() {
		$setting=Setting::where('id', 1)->firstOrFail();
		$countries=Country::orderBy('name', 'ASC')->get();
		$regions=Region::orderBy('name', 'ASC')->get();
		return view('web.auth.register', compact('setting', 'countries', 'regions'));
	}

	public function register(RegisterCustomRequest $request) {
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
					$data=array('dni' => request('dni'), 'verify_digit' => request('verify_digit'), 'name' => request('name'), 'first_lastname' => request('first_lastname'), 'second_lastname' => request('second_lastname'), 'slug' => $slug, 'birthday' => date('Y-m-d', strtotime(request('birthday'))), 'commune_id' => request('commune_id'), 'country_id' => request('country_id'), 'gender' => request('gender'), 'email' => request('email'), 'password' => Hash::make(request('password')));
					break;
				}
			}

			$people=People::create($data);

			$data=array('people_id' => $people->id);
			$patient=Patient::create($data);

			if ($people && $patient) {
				$user=People::where('email', request('email'))->first();
				$user->type=2;
				$request->session()->push('user', $user);
				return redirect()->route('web.profile');
			} else {
				return redirect()->back()->with(['error.register' => 'Ha ocurrido un problema, intentelo nuevamente.'])->withInputs();
			}
		}

		if (!is_null($people->patient)) {
			return redirect()->back()->with(['error.register' => 'El paciente ya se encuentra registrado.']);
		}

		$data=array('people_id' => $people->id);
		$patient=Patient::create($data);

		if ($patient) {
			$user=People::where('id', $people->id)->firstOrFail();

			if ((!is_null($user->patient) && $user->patient->state==1) && (!is_null($user->doctor) && $user->doctor->state==1)) {

				$user->type=NULL;
				$request->session()->push('user', $user);
				return redirect()->route('web.selected');

			} else {
				$user->type=2;
				$request->session()->push('user', $user);
				return redirect()->route('web.profile');
			}

		} else {
			return redirect()->back()->with(['error.register' => 'Ha ocurrido un problema, intentelo nuevamente.'])->withInputs();
		}
	}

	public function recoveryForm() {
		$setting=Setting::where('id', 1)->firstOrFail();
		return view('web.auth.recovery', compact('setting'));
	}

	public function recovery(Request $request) {
		$user=People::where('email', request('email'))->first();
		if (!is_null($user)) {
			
			if (!is_null($user->patient)) {
				$token=str_replace("=", "", encrypt(rand(1000000, 9999999)));
				$data=array('email' => $user->email, 'token' => $token);
				$reset=Reset::create($data);

				$user->notify(new ResetPasswordCustomNotification($token));
				return redirect()->back()->with(['success.recovery' => 'El correo ha sido enviado exitosamente']);
			}

			return redirect()->back()->with(['error.recovery' => 'Este usuario no es un paciente.'])->withInput();
		}
		
		return redirect()->back()->with(['error.recovery' => 'Este usuario no existe.'])->withInput();
	}

	public function resetForm(Request $request, $slug, $token) {
		$setting=Setting::where('id', 1)->firstOrFail();
		$people=People::where('slug', $slug)->firstOrFail();
		$reset=Reset::where('email', $people->email)->orderBy('created_at', 'DESC')->first();

		if (!is_null($reset) && $token==$reset->token) {
			$date=date('d-m-Y H:i:s', strtotime($reset->created_at->format('d-m-Y H:i:s')."+30 minutes"));

			if ($date>date('d-m-Y H:i:s')) {
				return view('web.auth.reset', compact('setting', 'slug', 'token'));
			}
		}
		
		abort(403);
	}

	public function reset(Request $request, $slug, $token) {
		$people=People::where('slug', $slug)->firstOrFail();

		if (!is_null($people->patient)) {

			$people->fill(['password' => Hash::make(request('password'))])->save();
			if ($people) {
				return redirect()->route('ingresar')->with(['success.reset' => 'La contraseña ha sido actualizada exitosamente.']);
			} else {
				return redirect()->back()->with(['error.reset' => 'Ha ocurrido un problema durante el proceso, intentelo nuevamente.'])->withInput();
			}
		}
		
		return redirect()->back()->with(['error.reset' => 'Este usuario no es un paciente.'])->withInput();
	}

	public function logout(Request $request) {
		if ($request->session()->has('user')) {
			$request->session()->forget('user');
		}

		return redirect()->back();
	}
}