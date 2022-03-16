<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use phpDocumentor\Reflection\Types\Parent_;

class WorkController extends Controller
{

    public function index()
    {
        /*$works = Work::all()->groupBy('service_id');
        return view('works.index')->with('works', $works);*/

        $services = Service::with('works')->get();
        return view('works.index')->with('services', $services);
    }


    public function create()
    {
        $services = Service::all();
        return view('works.create')->with('services', $services);

    }


    public function store(Request $request )
    {

       /* $messages = [
            "travail_image.max" => "Vous ne pouvez pas uploader plus de 3 images."
        ];*/

        $this->validate($request, [
            'service' => 'required',
            'travail_image.*' => 'mimes:jpg,jpeg,png,svg,gif|max:2048',
            'travail_image' => 'required|max:4',
        ], [
                'travail_image.required' => 'Upload une ou plusieurs images.',
                'travail_image.*.mimes' => 'Seulement les images jpg,jpeg,png,svg,gif,bmp sont autorisées .',
                'travail_image.*.max' => 'Desolé ! La taille maximale autorisée par image est de 2 MB.',
                'travail_image.max' => 'Vous ne pouvez pas uploader plus de 3 images.',
                'service.required' => 'Selectionner un service.',

            ]
        );


        foreach ($request->file('travail_image') as $file) {
            // 1: get file name with ext
            $fileNameWithExt = $file->getClientOriginalName();
            // 2: get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // 3: get just file extension
            $extension = $file->getClientOriginalExtension();
            // 4: file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // 5: uploader image
            $path = $file->storeAs('public/work_images', $fileNameToStore);

            $work = new Work();

            $work->service_id = $request->input('service');
            $work->travail_image = $fileNameToStore;
            $work->save();
        }
        return redirect('works')->with('status', 'Le(s) image(s) a(ont) été ajouté(s) avec succes !');

    }

    public function delete_one_work($id)
    {
        $work = Work::find($id);
        Storage::delete('public/work_images/' . $work->travail_image);
        $work->delete();

        return redirect('/works')->with('status', 'L\'image a été supprimé avec succes !');

    }

    public function delwork(Request $request)
    {
        foreach ($request->input('delete_check_box') as $work){
            $pic = Work::where('id', '=', $work)->first();
            //print($pic);
            //print($pic->travail_image);
            Storage::delete('public/work_images/' . $pic->travail_image);
            $pic->delete();
        }
        return redirect('/works')->with('status', 'Les images ont été supprimées avec succes !');

    }

}
