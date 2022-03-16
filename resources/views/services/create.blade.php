@extends('layouts.admin_template')

@section('title') Ajout de service @endsection

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
                        <strong>Formulaire d'ajout de service</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{route('services.store')}}" method="POST" enctype="multipart/form-data" autocomplete="off" role="form">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label class=" form-control-label">Nom service *</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-file-text-o"></i></div>
                                    <input type="text" name="service_nom" value="{{old('service_nom')}}" class="form-control"  />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" form-control-label">Description service *</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-file-text"></i></div>
                                    <textarea name="service_description" rows="3" class="form-control">{{old('service_description')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Description 2 </label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-file-text"></i></div>
                                    <textarea name="description2" rows="2" class="form-control">{{old('description2')}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Description 3 </label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-file-text"></i></div>
                                    <textarea name="description3" rows="2" class="form-control">{{old('description3')}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" form-control-label">Nom icon</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-file-text-o"></i></div>
                                    <input type="text" name="icon_name" value="{{old('icon_name')}}" class="form-control"  />
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" form-control-label">Image </label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-picture-o"></i></div>
                                    <input type="file" class="form-control" name="service_image">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Enregistrer
                                </button>
                                <a class="btn btn-danger btn-sm" href="{{route('services.index')}}">
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