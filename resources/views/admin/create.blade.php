@extends('layouts.admin_template')

@section('title') Ajout d'information @endsection

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
                            <strong>Formulaire d'ajout d'informations de la société</strong>
                        </div>
                        <div class="card-body card-block">
                            <form action="{{route('admin.store')}}" method="POST" enctype="multipart/form-data" autocomplete="off" role="form">
                                {{csrf_field()}}
                                <div class="form-group">
                                    <label class=" form-control-label">Contact de l'entreprise *</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-phone"></i></div>
                                        <input type="tel" class="form-control" name="tel" value="{{old('tel')}}">
                                    </div>
                                    <small class="form-text text-muted">ex. (+33) 999-999-999</small>
                                </div>

                                <div class="form-group">
                                    <label class=" form-control-label">Email *</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                                        <input type="email" class="form-control" name="email" value="{{old('email')}}">
                                    </div>
                                    <small class="form-text text-muted">ex. moneamil@site.com</small>
                                </div>

                                <div class="form-group">
                                    <label class=" form-control-label">Adresse 1 *</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                        <input type="text" class="form-control" name="adresse1" value="{{old('adresse1')}}">
                                    </div>
                                    <small class="form-text text-muted">ex. 110 rue du Congo</small>
                                </div>

                                <div class="form-group">
                                    <label class=" form-control-label">Adresse 2</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                        <input type="text" class="form-control" name="adresse2" value="{{old('adresse2')}}">
                                    </div>
                                    <small class="form-text text-muted">ex. 845244 xxxx France</small>
                                </div>

                                <div class="form-group">
                                    <label class=" form-control-label">Heure - jour de travail</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                        <input type="text" class="form-control" name="horaire" value="{{old('horaire')}}">
                                    </div>
                                    <small class="form-text text-muted">ex. Lundi-Dimanche(8h-17h)</small>
                                </div>

                                <div class="form-group">
                                    <label class=" form-control-label">slogan</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-file-text-o"></i></div>
                                        <textarea name="slogan" class="form-control" >{{old('slogan')}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" form-control-label">A propos *</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-file-text"></i></div>
                                        <textarea name="apropos" class="form-control" rows="10">{{old('apropos')}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" form-control-label">Nom de domaine du site web</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-keyboard-o"></i></div>
                                        <input type="text" class="form-control" name="nomdomaine" value="{{old('nomdomaine')}}">
                                    </div>
                                    <small class="form-text text-muted">ex. www.monsite.com</small>
                                </div>

                                <div class="form-group">
                                    <label class=" form-control-label">URL de la position sur google map</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                                        <textarea name="mapurl" class="form-control" >{{old('mapurl')}}</textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class=" form-control-label">Logo du site *</label>
                                    <div class="input-group">
                                        <div class="input-group-addon"><i class="fa  fa-picture-o"></i></div>
                                        <input type="file" class="form-control" name="logo" value="{{old('logo')}}">
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary btn-sm">
                                        <i class="fa fa-dot-circle-o"></i> Enregistrer
                                    </button>
                                    <a class="btn btn-danger btn-sm" href="{{route('admin.index')}}">
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