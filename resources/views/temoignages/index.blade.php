@extends('layouts.admin_template')

@section('title') Temoignages @endsection

@section('css')
    <link rel="stylesheet" href="{{asset('backend/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">
@endsection

@section('position')
    <li><a href="#">Dashboard</a></li>
    <li><a href="#">Temoignages</a></li>
    <li class="active">Temoignages</li>
@endsection

@section('content')

    <input type="hidden" name="" value="{{$increment=1}}">

    <div class="animated fadeIn">

        <div class="col-sm-12">
            @if (Session::has('status'))
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Success</span>
                    {{Session::get('status')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <strong class="card-title">Liste des temoignages</strong>
                    </div>
                    <div class="card-body">
                        <a href="{{route('temoignages.create')}}" class="btn btn-primary btn-sm mb-2"><span class="fa fa-plus"></span>Nouveau temoignage</a>
                        <div class="table-responsive">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Texte</th>
                                    <th>Auteur</th>
                                    <th>Local</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    @forelse($temoignages as $temoignage)
                                        <td>{{$increment}}</td>
                                        <td><img src="/storage/pictures/{{$temoignage->photo}}" alt=""></td>
                                        <td>{{$temoignage->texte}}</td>
                                        <td>{{$temoignage->nom}}</td>
                                        <td>{{$temoignage->local}}</td>
                                        <td>
                                            @if ($temoignage->status == 1)
                                                <label class="badge badge-success">Activé</label>
                                            @else
                                                <label class="badge badge-danger">Desactivé</label>
                                            @endif
                                        </td>
                                        <td>

                                            <div class="btn-group">
                                                <a href="{{route('temoignages.edit', $temoignage->id)}}" class="btn btn-outline-info btn-sm" style="margin-right: 5px"><span class="fa fa-edit"></span>Editer</a>
                                                <button class="btn btn-outline-danger btn-sm delmodal" data-toggle="modal" data-target="#delmodal" data-url="{{route('temoignages.destroy', $temoignage->id)}}" style="margin-right: 5px"><span class="fa fa-trash-o" ></span>Supprimer</button>
                                                @if ($temoignage->status == 1)
                                                    <a class="btn btn-outline-warning btn-sm"  href="{{url('/change_tem_status/'.$temoignage->id)}}"><span class="fa fa-ban"></span>Desactiver</a>
                                                @else
                                                    <a class="btn btn-outline-success btn-sm" onclick="window.location = '{{url('/change_tem_status/'.$temoignage->id)}}'"><span class="fa fa-check-circle-o"></span>Activer</a>
                                                @endif
                                            </div>

                                        </td>

                                </tr>
                                <input type="hidden" name="" value="{{$increment=$increment+1}}">
                                @empty
                                    <tr>
                                        <td colspan="7" class="table-danger">Aucun enregistrement trouvé !!!</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->
    @include('include.delete_modal')
@endsection

@section('scripts')
    <script src="{{asset('backend/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('backend/vendors/jszip/dist/jszip.min.js')}}"></script>
    <script src="{{asset('backend/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
    <script src="{{asset('backend/vendors/pdfmake/build/vfs_fonts.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
    <script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('backend/assets/js/init-scripts/data-table/datatables-init.js')}}"></script>
@endsection