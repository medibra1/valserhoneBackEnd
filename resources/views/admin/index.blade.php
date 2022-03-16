@extends('layouts.admin_template')

@section('title')
    Infosite
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('backend/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('backend/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css') }}">
@endsection

@section('position')
    <li><a href="#">Dashboard</a></li>
    <li><a href="#">Info société</a></li>
    <li class="active">Info</li>
@endsection


@section('content')
    <div class="animated fadeIn">

        <div class="col-sm-12">
            @if (Session::has('failed'))
                <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-danger">Echec</span>
                    {{ Session::get('failed') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
        </div>

        <div class="col-sm-12">
            @if (Session::has('status'))
                <div class="alert  alert-success alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-success">Success</span>
                    {{ Session::get('status') }}
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
                        <strong class="card-title">Les informations de la société</strong>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('admin.create') }}" class="btn btn-primary btn-sm mb-2"><span
                                class="fa fa-plus"></span>Ajouter des infos</a>
                        <div class="table-responsive-md">
                            <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">Logo</th>
                                        <th scope="col">Tel</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Adresse 1</th>
                                        <th scope="col">Adresse 2</th>
                                        <th scope="col">Nom de domaine</th>
                                        <th scope="col">Url Map</th>
                                        <th scope="col">Slogan</th>
                                        <th scope="col">Apropos</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        @forelse($information as $info)
                                            <td><img src="/storage/pictures/{{ $info->logo }}" alt=""></td>
                                            <td nowrap>{{ $info->tel }}</td>
                                            <td>{{ $info->email }}</td>
                                            <td>{{ $info->adresse1 }}</td>
                                            <td>{{ $info->adresse2 }}</td>
                                            <td>{{ $info->nomdomaine }}</td>
                                            <td style="max-width: 200px">
                                                {{ $info->mapurl }}
                                            </td>
                                            <td>{{ $info->slogan }}</td>
                                            <td style="max-width: 200px">{{ $info->apropos }}</td>

                                            <td>
                                                <a href="{{ route('admin.edit', $info->id) }}"
                                                    class="btn btn-outline-warning btn-sm"><span
                                                        class="fa fa-edit"></span>Editer</a>
                                            </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="table-danger">Aucun enregistrement trouvé !!!</td>
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
@endsection

@section('scripts')
    <script src="{{ asset('backend/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/jszip/dist/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/pdfmake/build/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/pdfmake/build/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/vendors/datatables.net-buttons/js/buttons.colVis.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/init-scripts/data-table/datatables-init.js') }}"></script>
@endsection
