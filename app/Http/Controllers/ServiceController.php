<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isEmpty;

class ServiceController extends Controller
{

    public function index()
    {
        $services = Service::all();
        return view('services.index')->with('services', $services);
    }


    public function create()
    {
        return view('services.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'service_nom' => 'required',
            'service_description' => 'required',
            'service_image' => 'image|nullable|mimes:jpg,jpeg,png,svg,gif|min:1|max:2048'
        ]);

        if($request->hasfile('service_image')) {
            // 1: get file name with ext
            $fileNameWithExt = $request->file('service_image')->getClientOriginalName();
            // 2: get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // 3: get just file extension
            $extension = $request->file('service_image')->getClientOriginalExtension();
            // 4: file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // 5: uploader image
            $path = $request->file('service_image')->storeAs('public/pictures', $fileNameToStore);
        }else{
            $fileNameToStore = 'no_image.jpg';
        }
        $service = new Service();

        $service->service_nom = $request->input('service_nom');
        $service->service_description = $request->input('service_description');
        $service->description2 = $request->input('description2');
        $service->description3 = $request->input('description3');
        $service->icon_name = $request->input('icon_name');
        $service->service_status = 1;

        $service->service_image = $fileNameToStore;
        $service->save();

        return redirect('/services')->with('status', 'Le service '.$service->service_nom.'a été ajouté avec succes !');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $service = Service::find($id);
        return view('services.edit')->with('service', $service);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'service_nom' => 'required',
            'service_description' => 'required',
            'service_image' => 'image|nullable|mimes:jpg,jpeg,png,svg,gif|min:1|max:2048'
        ]);

        $service = Service::find($id);

        $service->service_nom = $request->input('service_nom');
        $service->service_description = $request->input('service_description');
        $service->description2 = $request->input('description2');
        $service->description3 = $request->input('description3');
        $service->icon_name = $request->input('icon_name');

        if($request->hasfile('service_image')) {
            // 1: get file name with ext
            $fileNameWithExt = $request->file('service_image')->getClientOriginalName();
            // 2: get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // 3: get just file extension
            $extension = $request->file('service_image')->getClientOriginalExtension();
            // 4: file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // 5: uploader image
            $path = $request->file('service_image')->storeAs('public/pictures', $fileNameToStore);
            Storage::delete('public/pictures/' . $service->service_image);
            $service->service_image = $fileNameToStore;

        }

        $service->update();

        return redirect('/services')->with('status', 'Le service '.$service->service_nom.'a été modifié avec succes !');
    }


    public function destroy($id)
    {
        $service = Service::find($id);
        $work = Work::where('service_id', '=', $service->id)->count();

       if($work > 0) {
            return redirect('/services')->with('failed', 'Vous ne pouvez pas supprimé un service lié avec les photos de traveaux réalisés !');
        }else{
            Storage::delete('public/pictures/'.$service->service_image);
            $service->delete();
           return redirect('/services')->with('status', 'Le service '.$service->service_nom.' a été supprimé avec succes !');

        }

    }

    /* API */
    public function indexServiceApi()
    {
        $services = Service::all();
        return response()->json($services);
    }
    /* API */
}
