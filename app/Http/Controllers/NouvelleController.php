<?php

namespace App\Http\Controllers;

use App\Models\Nouvelle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NouvelleController extends Controller
{

    public function index()
    {
        $nouvelles = Nouvelle::all();
        return view('nouvelles.index')->with('nouvelles', $nouvelles);
    }


    public function create()
    {
        return view('nouvelles.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'contenu' => 'required',
            'image' => 'image|required|mimes:jpg,jpeg,png,svg,gif|min:1|max:2048'
        ]);

            // 1: get file name with ext
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            // 2: get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // 3: get just file extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // 4: file name to store
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            // 5: uploader image
            $path = $request->file('image')->storeAs('public/nouvelle_images', $fileNameToStore);

        $nouvelle = new Nouvelle();

        $nouvelle->contenu = $request->input('contenu');
        $nouvelle->poste_par = $request->input('poste_par');
        $nouvelle->status = 0;

        $nouvelle->image = $fileNameToStore;
        $nouvelle->save();

        return redirect('/nouvelles')->with('status', 'Le Nouvelle a été ajouté avec succès !');
    }

    public function edit($id)
    {
        $nouvelle = Nouvelle::find($id);
        return view('nouvelles.edit')->with('nouvelle', $nouvelle);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'contenu' => 'required',
            'image' => 'image|nullable|mimes:jpg,jpeg,png,svg,gif|min:1|max:2048'
        ]);

        $nouvelle = Nouvelle::find($id);
        $nouvelle->contenu = $request->input('contenu');
        $nouvelle->poste_par = $request->input('poste_par');

        if ($request->hasFile('image')) {
            // 1: get file name with ext
            $fileNameWithExt = $request->file('image')->getClientOriginalName();
            // 2: get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // 3: get just file extension
            $extension = $request->file('image')->getClientOriginalExtension();
            // 4: file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // 5: uploader image
            $path = $request->file('image')->storeAs('public/nouvelle_images', $fileNameToStore);
            Storage::delete('public/pictures/'.$nouvelle->image);
            $nouvelle->image = $fileNameToStore;
        }

        $nouvelle->update();

        return redirect('/nouvelles')->with('status', 'Le Nouvelle a été mis à jour avec succès !');
    }

    public function change_new_status($id){
        $nouvelle = Nouvelle::find($id);
        if ($nouvelle->status == 1){
            $nouvelle->status = 0;
            $nouvelle->update();
            return back()->with('status', 'La nouvelle a été desactivé avec succes !');
        }else{
            $nouvelle->status = 1;
            $nouvelle->update();
            return back()->with('status', 'La nouvelle a été activé avec succes !');
        }
    }

    public function destroy($id)
    {
        $nouvelle = Nouvelle::find($id);
        Storage::delete('public/pictures/'.$nouvelle->image);
        $nouvelle->delete();
        return back()->with('status', 'La nouvelle a été supprimé avec succes !');
    }
}
