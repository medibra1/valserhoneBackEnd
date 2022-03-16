@extends('layouts.admin_template')

@section('title') Photos traveaux @endsection

@section('css')
   {{-- <link rel="stylesheet" href="{{asset('backend/vendors/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('backend/vendors/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css')}}">--}}
   <style type="text/css">
       .floating-del-button {
           position: fixed;
           top: 150px;
          margin-left: 70px;
       }
   </style>
@endsection

@section('position')
    <li><a href="#">Dashboard</a></li>
    <li><a href="#">Traveaux</a></li>
    <li class="active">Traveaux</li>
@endsection

@section('content')
    @include('include.delete_modal')

  {{--  <input type="hidden" name="" value="{{$increment=1}}">

    <div class="animated fadeIn">

        <div class="col-sm-12">
            @if (Session::has('failed'))
                <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                    <span class="badge badge-pill badge-danger">Echec</span>
                    {{Session::get('failed')}}
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
                        <strong class="card-title">Les traveaux réalisés</strong>
                    </div>
                    <div class="card-body">
                        <a href="{{route('works.create')}}" class="btn btn-primary btn-sm"><span class="fa fa-plus"></span></a>
                        <div class="table-responsive">
                            <div class="table-responsive">
                                <table id="bootstrap-data-table-export" class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Image</th>
                                        <th>Service</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        @forelse($works as $work)
                                            <td>{{$increment}}</td>
                                            <td><img src="/storage/work_images/{{$work->travail_image}}" alt="" width="100" height="100"></td>
                                            <td>{{$work->service->service_nom}}</td>
                                            <td>
                                                <form action="{{route('works.destroy', $work->id)}}" method="post" >
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger btn-sm"><span class="fa fa-trash-o" ></span>Delete</button>
                                                </form>                                            </td>
                                    </tr>

                                    <input type="hidden" name="" value="{{$increment=$increment+1}}">

                                    @empty
                                        <tr>
                                            <td colspan="10">Aucun enregistrement trouvé !!!</td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div><!-- .animated -->--}}

 {{-- @foreach($works as $service_id => $serviceItem)
        Service ID: {{$service_id}} <br> <br>
        @foreach($serviceItem as $item)
            {{$item->travail_image}} <br>
            @endforeach

    @endforeach--}}
  <input type="hidden" name="" value="{{$increment=1}}">

      <div class="animated fadeIn">

          <div class="col-sm-12">
              @if (Session::has('failed'))
                  <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                      <span class="badge badge-pill badge-danger">Echec</span>
                      {{Session::get('failed')}}
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
                      {{Session::get('status')}}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              @endif
          </div>

          <form action="{{url('del-checked-work')}}" method="POST">
              {{csrf_field()}}
              <a href="{{route('works.create')}}" class="btn btn-primary btn-sm" style="margin-bottom: 5px; margin-left: 15px"><span class="fa fa-plus"></span>Ajouter des traveaux</a>

              @forelse($services as $service)

                  <div class="col-sm-12">



                      <div class="card">
                          <div class="card-header">
                              <strong class="card-title">Images de traveaux réalisés: {{$service->service_nom}}</strong>
                          </div>
                          <div class="card-body">

                              <table class="table table-bordered">
                                  <thead>
                                  <tr>
                                      <th>#</th>
                                      <th>Images</th>
                                      <th>Actions</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  @forelse($service->works as $work)

                                      <tr>
                                          <td>
                                              <div class="form-check">
                                                  <input class="form-check-input" type="checkbox" name="delete_check_box[]" value="{{$work->id}}" >
                                                  {{$increment}}
                                              </div>
                                          </td>
                                          <td><img src="/storage/work_images/{{$work->travail_image}}" alt="" width="100" height="100"></td>
                                          <td>
                                              <a class="btn btn-outline-danger btn-sm delmodal" id="delOneButton" data-toggle="modal" data-target="#delmodal" data-url="{{url('/delete_one_work/'.$work->id)}}" ><span class="fa fa-trash-o" ></span>Supprimer</a>
                                          </td>
                                      </tr>


                                      <input type="hidden" name="" value="{{$increment=$increment+1}}">
                                  @empty
                                      <tr>
                                          <td colspan="3" class="table-danger">Aucune image assiciée !!!</td>
                                      </tr>
                                  @endforelse


                                  </tbody>

                              </table>

                          </div>
                      </div>
                  </div>

              @empty
                  <div class="card">
                      <div class="card-header">
                      </div>
                      <div class="card-body">
                          <table class="table table-bordered">
                              <tr>
                                  <th class="table-danger"> Veillez ajouté au moins un service avant d'ajouter une photo trouvée.</th>
                              </tr>
                          </table>
                      </div>
                  </div>
              @endforelse
              <div class="col-sm-7 floating-del-button" id="delCheckedButton" >
                  <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                      <span class="badge badge-pill badge-danger">Suppression</span>
                      Voulez-vous vraiment supprimés les élements selectionnés ?
                      <button type="submit" class="btn btn-danger btn-sm" >Oui</button>
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="closeAlert">
                          <span aria-hidden="true">&times;</span>
                      </button>
                  </div>
              </div>
          </form>
          @endsection

          @section('scripts')
              <script>
                  jQuery(document).ready(function($) {

                      // scripts pour cacher le boutton supprimé les photos selectionnées
                      //  let checkbox = $('#selectCheckbox'),
                      let	button = $('#delCheckedButton');
                      let	button2 = $('#delOneButton');
                      let cocher = 0;

                      button.hide();

                      $('input[type="checkbox"]').click(function() {
                          if($(this).is(':checked')) {
                              button.show();
                              button2.hide();
                              cocher++;
                              $( "#closeAlert" ).click(function () {
                                  location.reload();
                              });


                          }else {
                              button2.hide();

                              cocher--;
                          }
                          if (cocher === 0){
                              button.hide();
                             button2.show();

                          }
                      });




                  });
              </script>
@endsection
                    {{--<script
                    src="{{asset('backend/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
                    <script src="{{asset('backend/vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
                    <script src="{{asset('backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
                    <script src="{{asset('backend/vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js')}}"></script>
                    <script src="{{asset('backend/vendors/jszip/dist/jszip.min.js')}}"></script>
                    <script src="{{asset('backend/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
                    <script src="{{asset('backend/vendors/pdfmake/build/vfs_fonts.js')}}"></script>
                    <script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
                    <script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
                    <script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.colVis.min.js')}}"></script>
                    <script src="{{asset('backend/assets/js/init-scripts/data-table/datatables-init.js')}}">
                    </script>--}}
