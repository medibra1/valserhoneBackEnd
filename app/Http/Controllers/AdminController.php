<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function index()
    {
        $information = Company::get();
        return view('admin.index')->with('information', $information);
    }


    public function create()
    {
        $compagnie = Company::get()->first();

        if (empty($compagnie)) {
            return view('admin.create');
        }else{
            return redirect('/admin')->with('failed', 'Vous n\'etes pas autorisé. Vous ne pouvez qu\'editer la ligne existente !!!');
        }

    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'tel' => 'required',
            'apropos' => 'required',
            'email' => 'required',
            'adresse1' => 'required',
            'logo' => 'image|required|mimes:jpg,jpeg,png,svg,gif,ico|nullable|max:2048'
        ]);

            // 1: get file name with ext
            $fileNameWithExt = $request->file('logo')->getClientOriginalName();
            // 2: get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // 3: get just file extension
            $extension = $request->file('logo')->getClientOriginalExtension();
            // 4: file name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            // 5: uploader image
            $path = $request->file('logo')->storeAs('public/pictures', $fileNameToStore);

        $compagnie = new Company();

        $compagnie->apropos = $request->input('apropos');
        $compagnie->tel = $request->input('tel');
        $compagnie->email = $request->input('email');
        $compagnie->adresse1 = $request->input('adresse1');
        $compagnie->adresse2 = $request->input('adresse2');
        $compagnie->slogan = $request->input('slogan');
        $compagnie->mapurl = $request->input('mapurl');
        $compagnie->nomdomaine = $request->input('nomdomaine');
        $compagnie->mapurl = $request->input('mapurl');


        $compagnie->logo = $fileNameToStore;

        $compagnie->save();

        return redirect('/admin')->with('status', 'Les informations de l\'entreprise ont été ajouté avec succes !');
    }


    public function show($id)
    {

    }


    public function edit($id)
    {
        $compagnie = Company::find($id);
        return view('admin.edit')->with('compagnie', $compagnie);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tel' => 'required',
            'apropos' => 'required',
            'email' => 'required',
            'adresse1' => 'required',
            'logo' => 'image|mimes:jpg,jpeg,png,svg,gif,ico|nullable|max:2048'
        ]);

        $compagnie = Company::find($id);

        $compagnie->apropos = $request->input('apropos');
        $compagnie->tel = $request->input('tel');
        $compagnie->email = $request->input('email');
        $compagnie->adresse1 = $request->input('adresse1');
        $compagnie->adresse2 = $request->input('adresse2');
        $compagnie->horaire = $request->input('horaire');
        $compagnie->slogan = $request->input('slogan');
        $compagnie->mapurl = $request->input('mapurl');
        $compagnie->nomdomaine = $request->input('nomdomaine');
        $compagnie->mapurl = $request->input('mapurl');

        if($request->hasfile('logo')) {
            // 1: get file name with ext
            $fileNameWithExt = $request->file('logo')->getClientOriginalName();
            // 2: get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // 3: get just file extension
            $extension = $request->file('logo')->getClientOriginalExtension();
            // 4: file name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            // 5: uploader image
            $path = $request->file('logo')->storeAs('public/pictures', $fileNameToStore);

            Storage::delete('public/pictures/'.$compagnie->logo);
            $compagnie->logo = $fileNameToStore;

        }

        $compagnie->update();

        return redirect('/admin')->with('status', 'Les informations de l\'entreprise ont été mis à jour avec succes !');
    }


    public function destroy($id)
    {
        //
    }

    public function companyInfoApi()
    {
        $information = Company::first();
        return response()->json($information);
    }

}
