<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class SliderController extends Controller
{

    public function index()
    {
        $sliders = Slider::all();
        return view('sliders.index')->with('sliders', $sliders);
    }


    public function create()
    {
        return view('sliders.create');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'description1' => 'required',
            'slider_image' => 'image|required|mimes:jpg,jpeg,png,svg,gif|min:1|max:2048'
        ]);

        // 1: get file name with ext
        $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();
        // 2: get just file name
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        // 3: get just file extension
        $extension = $request->file('slider_image')->getClientOriginalExtension();
        // 4: file name to store
        $fileNameToStore = $fileName.'_'.time().'.'.$extension;
        // 5: uploader image
        $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);

        $slider = new Slider();

        $slider->description1 = $request->input('description1');
        $slider->description2 = $request->input('description2');
        $slider->status = 1;

        $slider->slider_image = $fileNameToStore;
        $slider->save();

        return redirect('/sliders')->with('status', 'Le slider a été ajouté avec succes !');
    }


    public function change_slider_status($id) {
        $slider = Slider::find($id);
        if ($slider->status == 1){
            $slider->status = 0;
            $slider->update();
            return redirect('/sliders')->with('status', 'Le slider a été desactivé avec succes !');
        }else{
            $slider->status = 1;
            $slider->update();
            return redirect('/sliders')->with('status', 'Le slider a été activé avec succes !');
        }

    }

    public function edit($id)
    {
        $slider = Slider::find($id);
        return view('sliders.edit')->with('slider', $slider);
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'description1' => 'required',
            'slider_image' => 'image|mimes:jpg,jpeg,png,svg,gif|min:1|max:2048'
        ]);

        $slider = Slider::find($id);

        $slider->description1 = $request->input('description1');
        $slider->description2 = $request->input('description2');

        if($request->hasfile('slider_image')) {
            // 1: get file name with ext
            $fileNameWithExt = $request->file('slider_image')->getClientOriginalName();
            // 2: get just file name
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            // 3: get just file extension
            $extension = $request->file('slider_image')->getClientOriginalExtension();
            // 4: file name to store
            $fileNameToStore = $fileName . '_' . time() . '.' . $extension;
            // 5: uploader image
            $path = $request->file('slider_image')->storeAs('public/slider_images', $fileNameToStore);
            Storage::delete('public/slider_images/' . $slider->slider_image);
            $slider->slider_image = $fileNameToStore;

        }

        $slider->update();

        return redirect('/sliders')->with('status', 'Le slider a été modifié avec succes !');
    }


    public function destroy($id)
    {
        $slider = Slider::find($id);
        Storage::delete('public/slider_images/'.$slider->slider_image);
        $slider->delete();
        return redirect('/sliders')->with('status', 'Le slider a été supprimé avec succes !');
    }


    /* API FUNCTION */
    public function indexSliderApi() {
        $sliders = Slider::all();
        return response()->json($sliders);
    }

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

}
