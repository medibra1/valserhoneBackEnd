<?php

namespace App\Http\Controllers;

use App\Mail\SendContact;
use App\Mail\SendQuote;
use App\Models\Company;
use App\Models\Devis;
use App\Models\Partner;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Team;
use App\Models\Temoignage;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ClientController extends Controller
{

    public function index()
    {
        $information = Company::get()->first();
        $sliders = Slider::where('status', '=', 1)->get();
        $services = Service::all();
        $partners= Partner::all();
        $equipes = Team::all();
        $temoignages = Temoignage::all();
        $travails = Work::all();
        $services2 = Service::with('works')->has('works')->get();
        return view('client.index', compact('information','sliders', 'services', 'partners', 'equipes', 'temoignages', 'travails', 'services2'));

    }
  
    /*public function index()
    {
        $information = Company::all();
        $sliders = Slider::where('status', '=', 1)->get();
        $services = Service::all();
        $partners= Partner::all();
        $equipes = Team::all();
        $temoignages = Temoignage::all();
        $travails = Work::all();
        return view('client.index', compact('information','sliders', 'services', 'partners', 'equipes', 'temoignages', 'travails'));
    }

    public function devis()
    {
        $services = Service::all();
        return view('client.devis')->with('services', $services);
    }

    public function storeDevis(Request $request) {
        $this->validate($request, [
            'nom' => 'required',
            'email' => 'required',
            'heure1' => 'lt:heure2'
        ], [
                'nom.required' => 'le champ nom est requis.',
                'email.required' => 'Veuiller renseigner votre adresse mail.',
                'heure1.lt' => 'L\'heure de depart doit être inférieure à l\'heure de fin.',

            ]
        );


        $devis = new Devis();

        $devis->nom = $request->input('nom');
        $devis->email = $request->input('email');
        $devis->telephone = $request->input('telephone');
        $devis->adresse = $request->input('adresse');
        $devis->chambre = $request->input('chambre');
        $devis->sallebain = $request->input('sallebain');
        $devis->service = $request->input('service');
        $devis->frequence = $request->input('frequence');
        $devis->date = $request->input('date');
        $devis->heure1 = $request->input('heure1');
        $devis->heure2 = $request->input('heure2');
        $devis->description = $request->input('description');

        $information = Company::all();
        Mail::to($devis->email)->send(new SendQuote($devis, $information));
        return redirect()->back()->with('status', 'Votre dévis a été envoyé avec succès !');
    }

    public function sendContact(Request $request) {
        $this->validate($request, [
            'nom' => 'required',
            'email' => 'required',
            'message' => 'required'
        ], [
                'nom.required' => 'le champ nom est requis.',
                'email.required' => 'Veuiller renseigner votre adresse mail.',
                'message.required' => 'Rentrez votre message .'
            ]
        );

        $touch = new Devis();
        $touch->nom = $request->input('nom');
        $touch->email = $request->input('email');
        $touch->description = $request->input('message');

        $information = Company::all();
        Mail::to($touch->email)->send(new SendContact($touch));
        return redirect()->back()->with('status', 'Votre message a été envoyé avec succès !');

    }*/

}
