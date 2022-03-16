@extends('layouts.admin_template')

@section('title') Ajout new @endsection

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
                        <strong>Formulaire d'ajout de new</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{route('nouvelles.store')}}" method="POST" enctype="multipart/form-data" autocomplete="off" role="form">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label class=" form-control-label">Contenu *</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-file-text"></i></div>
                                    <textarea name="contenu" rows="10" class="form-control">{{old('contenu')}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" form-control-label">Ecrit par</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-file-text-o"></i></div>
                                    <input type="text" name="poste_par" value="{{old('poste_par')}}" class="form-control"  />
                                </div>
                            </div>



                            <div class="form-group">
                                <label class=" form-control-label">Image *</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-picture-o"></i></div>
                                    <input type="file" class="form-control" name="image">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Enregistrer
                                </button>
                                <a class="btn btn-danger btn-sm" href="{{route('nouvelles.index')}}">
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