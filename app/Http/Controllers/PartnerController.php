<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PartnerController extends Controller
{

    public function index()
    {
        $partenaires = Partner::all();
        return view('partners.index')->with('partenaires', $partenaires);
    }


    public function create()
    {
        return view('partners.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'denomination' => 'required',
            'logo' => 'image|required|mimes:jpg,jpeg,png,svg,gif|min:1|max:2048'
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
        $path = $request->file('logo')->storeAs('public/partner_logo', $fileNameToStore);

        $partenaire = new Partner();

        $partenaire->description = $request->input('description');
        $partenaire->denomination = $request->input('denomination');

        $partenaire->logo = $fileNameToStore;
        $partenaire->save();

        return redirect('/partners')->with('status', 'Le partenaire '.$partenaire->denomination.' a été ajouté avec succes !');
    }


    public function edit($id)
    {
        $partenaire = Partner::find($id);
        return view('partners.edit')->with('partenaire', $partenaire);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'denomination' => 'required',
            'logo' => 'image|mimes:jpg,jpeg,png,svg,gif|min:1|max:2048'
        ]);

        $partenaire =  Partner::find($id);

        $partenaire->description = $request->input('description');
        $partenaire->denomination = $request->input('denomination');

        if($request->hasfile('logo')) {
            // 1: get file name with ext
            $fileNameWithExt = $request->file('logo')->getClientOriginalName();
            // 2: get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // 3: get just file extension
            $extension = $request->file('logo')->getClientOriginalExtension();
            // 4: file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // 5: uploader image
            $path = $request->file('logo')->storeAs('public/partner_logo', $fileNameToStore);
            Storage::delete('public/partner_logo/' . $partenaire->logo);
            $partenaire->logo = $fileNameToStore;
        }

        $partenaire->update();

        return redirect('/partners')->with('status', 'Le partenaire '.$partenaire->denomination.' a été mis à jour !');
    }


    public function destroy($id)
    {
        $partenaire =  Partner::find($id);
        Storage::delete('public/partner_logo/' . $partenaire->logo);
        $partenaire->delete();
        return redirect('/partners')->with('status', 'Le partenaire '.$partenaire->denomination.' a été supprimé avec succès !');

    }
}
