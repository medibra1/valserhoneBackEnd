<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Reference;

class TeamController extends Controller
{

    public function index()
    {
        $equipes = Team::all();
        return view('teams.index')->with('equipes', $equipes);
    }

    public function create()
    {
        return view('teams.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'prenom' => 'required',
            'poste' => 'required',
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
            $path = $request->file('photo')->storeAs('public/team_images', $fileNameToStore);
        }else{
            $fileNameToStore = 'no_image.jpg';
        }


        $equipe = new Team();

        $equipe->prenom = $request->input('prenom');
        $equipe->nom = $request->input('nom');
        $equipe->poste = $request->input('poste');
        $equipe->tel = $request->input('tel');
        $equipe->email = $request->input('email');
        $equipe->social1 = $request->input('social1');
        $equipe->social2 = $request->input('social2');
        $equipe->social3 = $request->input('social3');
        $equipe->observations = $request->input('observations');
        $equipe->status = 0;

        $equipe->photo = $fileNameToStore;
        $equipe->save();

        return redirect('/teams')->with('status', 'L\'equipier '.$equipe->prenom.' a été modifié avec succes !');
    }

    public function edit($id)
    {
        $equipe = Team::find($id);
        return view('teams.edit')->with('equipe', $equipe);

    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'prenom' => 'required',
            'poste' => 'required',
            'photo' => 'image|mimes:jpg,jpeg,png,svg,gif|min:1|max:2048'
        ]);

        $equipe = Team::find($id);

        $equipe->prenom = $request->input('prenom');
        $equipe->nom = $request->input('nom');
        $equipe->poste = $request->input('poste');
        $equipe->tel = $request->input('tel');
        $equipe->email = $request->input('email');
        $equipe->social1 = $request->input('social1');
        $equipe->social2 = $request->input('social2');
        $equipe->social3 = $request->input('social3');
        $equipe->observations = $request->input('observations');

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
            $path = $request->file('photo')->storeAs('public/team_images', $fileNameToStore);

            if($equipe->photo != 'no_image.jpg') {
                Storage::delete('public/team_images/'.$equipe->photo);
            }

            $equipe->photo = $fileNameToStore;

        }

        $equipe->update();

        return redirect('/teams')->with('status', 'L\'equipier '.$equipe->prenom.' a été modifié avec succes !');
    }

    public function change_team_status($id)
    {
        $equipe = Team::find($id);
        if ($equipe->status == 1){
            $equipe->status = 0;
            $equipe->update();
            return redirect('/teams')->with('status', $equipe->prenom.' a été desactivé avec succes !');
        }else{
            $equipe->status = 1;
            $equipe->update();
            return redirect('/teams')->with('status', $equipe->prenom.' a été activé avec succes !');
        }
    }

    public function sendTeamID($id) {
        $equipeId = Team::where('id', '=', $id)->value('id');
        return redirect()->route($this->delete($id)->with('equipeId', $equipeId));

    }

    public function destroy($id)
    {
        $equipe = Team::find($id);
        if($equipe->photo != 'no_image.jpg') {
            Storage::delete('public/team_images/'.$equipe->photo);
        }
        $equipe->delete();
        return redirect('/teams')->with('status', $equipe->prenom.' a été supprimé avec succes !');
    }
}
