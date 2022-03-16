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

    public function sendContactApi(Request $request) {
        $rules=array(
            'nom' => 'required',
            'email' => 'required|email',
            'objet' => 'required',
            'message' => 'required'
        );
        $messages = [
            'nom.required' => 'le champ nom est requis.',
                'email.required' => 'Veuiller renseigner votre adresse mail.',
                'email.email' => 'Veuiller renseigner une adresse mail valide.',
                'objet.required' => 'Veuiller entrer un object.',
                'message.required' => 'Rentrez votre message .'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            return response()->json([
                'code' => 400,
                'message' => $validator->errors()
            ]);
        }

        $touch = new Devis();
        $touch->nom = $request->input('nom');
        $touch->email = $request->input('email');
        $touch->objet = $request->input('objet');
        $touch->description = $request->input('message');

        $information = Company::get()->first();
        Mail::to('modroq@gmail.com')->send(new SendContact($touch, $information));
        return response()->json([
            'code' => 200,
            'message' => 'Message envoyé avec succes !',
            'data' => $touch
        ]);
        //return redirect()->back()->with('status', 'Votre message a été envoyé avec succès !');

    }

    public function sendDevisApi(Request $request) {

        $rules=array(
            'nom' => 'required',
            'email' => 'required',
            'heure1' => 'nullable|lt:heure2'
        );
        $messages = [
            'nom.required' => 'le champ nom est requis.',
            'email.required' => 'Veuiller renseigner votre adresse mail.',
            'heure1.lt' => 'L\'heure de depart doit être inférieure à l\'heure de fin.',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()){
            return response()->json([
                'code' => 400,
                'message' => $validator->errors()
            ]);
        }

        $devis = new Devis();

        $devis->nom = $request->input('nom');
        $devis->email = $request->input('email');
        $devis->telephone = $request->input('telephone');
        $devis->adresse = $request->input('adresse');

        $devis->dim_interieur = $request->input('dim_interieur');
        $devis->dim_exterieur = $request->input('dim_exterieur');
        $devis->dim_plafond = $request->input('dim_plafond');
        $devis->dim_sol_interieur = $request->input('dim_sol_interieur');
        $devis->dim_sol_exterieur = $request->input('dim_sol_exterieur');

        $devis->service_interieur = $request->input('service_interieur');
        $devis->service_exterieur = $request->input('service_exterieur');
        $devis->service_plafond = $request->input('service_plafond');
        $devis->service_sol_interieur = $request->input('service_sol_interieur');
        $devis->service_sol_exterieur = $request->input('service_sol_exterieur');

        $devis->divers_libelle = $request->input('divers_libelle');
        $devis->divers_dim = $request->input('divers_dim');

        $devis->date = $request->input('date');
        $devis->heure1 = $request->input('heure1');
        $devis->heure2 = $request->input('heure2');
        $devis->description = $request->input('description');

        $information = Company::get()->first();
        Mail::to('modroq@gmail.com')->send(new SendQuote($devis, $information));
        return response()->json([
            'code' => 200,
            'message' => 'Dévis envoyé avec succes !',
            'data' => $devis
        ]);
        //return redirect()->back()->with('status', 'Votre dévis a été envoyé avec succès!');
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
