<?php

namespace App\Http\Controllers;

use App\User;
use App\Setting;
use App\Http\Requests\AboutUpdateRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\TermUpdateRequest;
use Illuminate\Http\Request;
use App\Notifications\MessageContactNotification;

class SettingController extends Controller
{
    public function aboutEdit() {
        $setting=Setting::where('id', 1)->firstOrFail();
        return view('admin.settings.about', compact("setting"));
    }

    public function aboutUpdate(AboutUpdateRequest $request) {

        $setting=Setting::where('id', 1)->firstOrFail();
        $data=array('about' => request('about'), 'mission' => request('mission'), 'vision' => request('vision'));

        // Mover imagen a carpeta aboutus y extraer nombre
        if ($request->hasFile('banner')) {
            $file=$request->file('banner');
            $data['banner']=store_files($file, 'banner-about', '/admins/img/aboutus/');
        }

        $setting->fill($data)->save();

        if ($setting) {
            return redirect()->route('nosotros.edit')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'Los ajustes de quienes somos han sido editados exitosamente.']);
        } else {
            return redirect()->route('nosotros.edit')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function contactEdit() {
        $setting=Setting::where('id', 1)->firstOrFail();
        return view('admin.settings.contact', compact("setting"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function contactUpdate(ContactUpdateRequest $request) {

        $setting=Setting::where('id', 1)->firstOrFail();
        $setting->fill($request->all())->save();

        if ($setting) {
            return redirect()->route('contactos.edit')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'Los ajustes de contacto han sido editados exitosamente.']);
        } else {
            return redirect()->route('contactos.edit')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    public function editTerms() {
        $setting=Setting::where('id', 1)->firstOrFail();
        return view('admin.settings.terms', compact("setting"));
    }

    public function updateTerms(TermUpdateRequest $request) {
        $setting=Setting::where('id', 1)->firstOrFail();
        $setting->fill($request->all())->save();

        if ($setting) {
            return redirect()->route('terminos.edit')->with(['alert' => 'sweet', 'type' => 'success', 'title' => 'Edición exitosa', 'msg' => 'Los términos y condiciones han sido editados exitosamente.']);
        } else {
            return redirect()->route('terminos.edit')->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Edición fallida', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }

    public function send(ContactStoreRequest $request) {
        $setting=Setting::where('id', 1)->firstOrFail();

        $contact=new User;
        $contact->email=$setting->email;
        $contact->name=request('name');
        $contact->email_contact=request('email');
        $contact->message=request('message');
        $contact->notify(new MessageContactNotification());

        if ($contact) {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'success', 'title' => 'Envio exitoso', 'msg' => 'El mensaje ha sido enviado exitosamente.']);
        } else {
            return redirect()->back()->with(['alert' => 'lobibox', 'type' => 'error', 'title' => 'Envio fallido', 'msg' => 'Ha ocurrido un error durante el proceso, intentelo nuevamente.'])->withInputs();
        }
    }
}
