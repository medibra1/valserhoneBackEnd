@extends('layouts.admin_template')

@section('title') Edit slider @endsection

@section('css')
@endsection

@section('content')

    <div class="animated fadeIn">

        <div class="col-sm-12">
            @if (count($errors) > 0)
                <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Error</span>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        <div class="row">

            <div class="col-xs-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Formulaire de modification du slider</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{route('sliders.update', $slider->id)}}" method="POST" enctype="multipart/form-data" autocomplete="off" role="form">
                            {{csrf_field()}}
                            {{method_field('PUT')}}
                            <div class="form-group">
                                <label class=" form-control-label">Description 1 *</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-file-text-o"></i></div>
                                    <textarea name="description1" class="form-control" >{{$slider->description1}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" form-control-label">Description 2</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-file-text"></i></div>
                                    <textarea name="description2" class="form-control">{{$slider->description2}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" form-control-label">Slider image *</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa  fa-picture-o"></i></div>
                                    <input type="file" class="form-control" name="slider_image">
                                    <img src="/storage/slider_images/{{$slider->slider_image}}" alt="Logo" width="80" height="50">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Modifier
                                </button>
                                <a class="btn btn-danger btn-sm" href="{{route('sliders.index')}}">
                                    <i class="fa fa-ban"></i> Annuler
                                </a>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection