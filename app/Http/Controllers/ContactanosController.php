<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactanosMailable;

use Illuminate\Support\ViewErrorBag;

class ContactanosController extends Controller
{
   public function index(){
    return View('contactanos.index');
   }

   public function store(Request $request){

      $request->validate([
         'name' => 'required',
         'correo' => 'required|email',
         'mensaje' => 'required',
      ]);

    Mail::to('chihuahua69scort@gmail.com')
    ->send(new ContactanosMailable($request->all()));

    session()->flash('info','Mensaje enviado');
    return redirect()->route('contactanos.index');

   }
}
