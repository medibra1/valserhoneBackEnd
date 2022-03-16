@extends('layouts.admin_template')

@section('title') Nouveau membre @endsection

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
                        <strong>Formulaire d'ajout d'un nouveau membre</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{route('teams.store')}}" method="POST" enctype="multipart/form-data" autocomplete="off" role="form">
                            {{csrf_field()}}

                            <div class="form-group">
                                <label class=" form-control-label">Prénom *</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                    <input type="text" name="prenom" value="{{old('prenom')}}" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" form-control-label">Nom </label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-male"></i></div>
                                    <input type="text" name="nom" value="{{old('nom')}}" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" form-control-label">Poste *</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-desktop"></i></div>
                                    <input type="text" name="poste"  value="{{old('poste')}}" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" form-control-label">Téléphone </label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                    <input type="tel" name="tel"  value="{{old('tel')}}" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" form-control-label">Email </label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                    <input type="email" name="email"  value="{{old('email')}}" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" form-control-label">Facebook </label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-facebook"></i></div>
                                    <input type="text" name="social1"  value="{{old('social1')}}" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" form-control-label">Twitter </label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-twitter"></i></div>
                                    <input type="text" name="social2"  value="{{old('social2')}}" class="form-control" >
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" form-control-label">Instagram </label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-instagram"></i></div>
                                    <input type="text" name="social3"  value="{{old('social3')}}" class="form-control" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class=" form-control-label">Observations</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-file-text"></i></div>
                                    <textarea name="observations" rows="5" class="form-control">{{old('observations')}}</textarea>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class=" form-control-label">Photo</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa  fa-picture-o"></i></div>
                                    <input type="file" class="form-control" name="photo">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Enregistrer
                                </button>
                                <a class="btn btn-danger btn-sm" href="{{route('teams.index')}}">
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