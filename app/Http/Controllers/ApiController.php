<?php

namespace App\Http\Controllers;

use App\Mail\SendContact;
use App\Mail\SendQuote;
use App\Models\Temoignage;
use App\Models\Company;
use App\Models\Devis;
use App\Models\Service;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ApiController extends Controller
{

    public function companyInfoApi()
    {
        $information = Company::first();
        return response()->json($information);
    }

     /* API SERVICE */
     public function indexServiceApi()
     {
         $services = Service::all();
         return response()->json($services);
     }
     /* API */


     /* API SLIDER */
   public function indexSliderApi() {
       $sliders = Slider::all();
       return response()->json($sliders);
   }

    /* DOWNLOAD SLIDER IMAGE */
   public function downloadFile($file)
   {
       $filename = $file;
       $path = public_path('storage/slider_images/' . $filename);

       if (!File::exists($path)) {
           abort(404);
       }

       $file = File::get($path);
       $type = File::mimeType($path);

       $response = Response::make($file, 200);
       $response->header("Content-Type", $type);
       return $response;

   }

   // TESTIMO
   public function indexTemoignageApi()
   {
       $temoignages = Temoignage::all();
       return response()->json($temoignages);
   }
   // DOWNLOAD TESTI IMAGE
   public function downloadTestimoFile($file)
   {
       $filename = $file;
       $path = public_path('storage/pictures/' . $filename);

       if (!File::exists($path)) {
           abort(404);
       }

       $file = File::get($path);
       $type = File::mimeType($path);

       $response = Response::make($file, 200);
       $response->header("Content-Type", $type);
       return $response;

   }

   // PORTOFOLIO
   public function indexPortofolio()
    {
        /*$works = Work::all()->groupBy('service_id');
        return view('works.index')->with('works', $works);*/

        $services = Service::with('works')->has('works')->get();
        return response()->json($services);
    }

    //POTTOFOLIO IMAGES
    public function downloadPortofoFile($file) {
        $filename = $file;
        $path = public_path('storage/work_images/'.$filename);
 
        if (!File::exists($path)) {
            abort(404);
        }
 
        $file = File::get($path);
        $type = File::mimeType($path);
 
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

   // SEND CONTACT MAIL
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

    // SEND DEVIS MAIL
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

}
