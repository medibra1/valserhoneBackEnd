<?php

namespace App\Http\Controllers;

use App\Models\Temoignage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class TemoignageController extends Controller
{

    public function index()
    {
        $temoignages = Temoignage::all();
        return view('temoignages.index')->with('temoignages', $temoignages);
    }


    public function create()
    {
        return view('temoignages.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'nom' => 'required',
            'texte' => 'required',
            'photo' => 'image|nullable|mimes:jpg,jpeg,png,svg,gif|min:1|max:2048'
        ]);

        if ($request->hasFile('photo'))
        {
            // 1: get file name with ext
            $fileNameWithExt = $request->file('photo')->getClientOriginalName();
            // 2: get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // 3: get just file extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            // 4: file name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            // 5: uploader image
            $path = $request->file('photo')->storeAs('public/pictures', $fileNameToStore);
        }else{
            $fileNameToStore = 'no_testimo_image.jpg';
        }


        $temoignage = new Temoignage();

        $temoignage->texte = $request->input('texte');
        $temoignage->nom = $request->input('nom');
        $temoignage->local = $request->input('local');
        $temoignage->status = 0;

        $temoignage->photo = $fileNameToStore;
        $temoignage->save();

        return redirect('/temoignages')->with('status', 'Le temoignage a été modifié avec succes !');
    }


    public function edit($id)
    {
        $temoignage = Temoignage::find($id);
        return view('temoignages.edit')->with('temoignage', $temoignage);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nom' => 'required',
            'texte' => 'required',
            'photo' => 'image|mimes:jpg,jpeg,png,svg,gif|min:1|max:2048'
        ]);

        $temoignage = Temoignage::find($id);

        $temoignage->texte = $request->input('texte');
        $temoignage->nom = $request->input('nom');
        $temoignage->local = $request->input('local');

        if ($request->hasFile('photo'))
        {
            // 1: get file name with ext
            $fileNameWithExt = $request->file('photo')->getClientOriginalName();
            // 2: get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // 3: get just file extension
            $extension = $request->file('photo')->getClientOriginalExtension();
            // 4: file name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            // 5: uploader image
            $path = $request->file('photo')->storeAs('public/pictures', $fileNameToStore);

            if($temoignage->photo != 'no_testimo_image.jpg') {
                Storage::delete('public/pictures/'.$temoignage->photo);
            }

            $temoignage->photo = $fileNameToStore;
        }

        $temoignage->update();

        return redirect('/temoignages')->with('status', 'Le temoignage a été mis à jour avec succes !');
    }


    public  function change_tem_status($id)
    {
        $temoignage = Temoignage::find($id);
        if ($temoignage->status == 1){
            $temoignage->status = 0;
            $temoignage->update();
            return back()->with('status', 'Le temoignage a été desactivé avec succes !');
        }else{
            $temoignage->status = 1;
            $temoignage->update();
            return back()->with('status', 'Le temoignage a été activé avec succes !');
        }
    }

    public function destroy($id)
    {
        $temoignage = Temoignage::find($id);
        if($temoignage->photo != 'no_testimo_image.jpg') {
            Storage::delete('public/pictures/'.$temoignage->photo);
        }
        $temoignage->delete();
        return back()->with('status', 'Le temoignage a été supprimé avec succes !');
    }

}
