@extends('layouts.admin_template')

@section('title') Ajout traveaux @endsection

@section('css')
    <link rel="stylesheet" href="{{asset('backend/vendors/chosen/chosen.min.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.4/css/fileinput.min.css" media="all" integrity="sha512-iPac4HfczXMa0qW1F34D91WysfdyjgbvopGdZcW0IlTwxgfLrFmxnQFThIASKs72aAHm5WVODsZZMrx+tgE+iw==" crossorigin="anonymous" />

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
                        <strong>Formulaire d'ajout d'image de traveaux realisé</strong>
                    </div>
                    <div class="card-body card-block">
                        <form action="{{route('works.store')}}" method="POST" enctype="multipart/form-data" autocomplete="off" role="form">
                            {{csrf_field()}}

                           <div class="form-group" style="margin-top: 20px; margin-bottom: 20px">
                               <label class="form-control-label">Selectionner un service * </label>
                               <select id="service" name="service" data-placeholder="Choisir un service..." class="standardSelect"
                                       tabindex="1">
                                   <option value=""></option>
                                   @foreach($services as $service)
                                       <option value="{{$service->id}}">{{$service->service_nom}}</option>
                                   @endforeach
                               </select>
                           </div>



                            <div class="form-group">
                                <label class="form-control-label">Télécharger une ou plusieurs photos *</label>
                                    <input type="file" class="file" id="file-1" data-overwrite-initial="false"  name="travail_image[]" multiple
                                           >
                            </div>



                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    <i class="fa fa-dot-circle-o"></i> Enregistrer
                                </button>
                                <a class="btn btn-danger btn-sm" href="{{route('works.index')}}">
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

@section('scripts')

    {{-- script pour image view  --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.4/js/fileinput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.4/themes/fa/theme.min.js"></script>

    <script type="text/javascript">
        $("#file-1").fileinput({
            theme: 'fa',
            //uploadUrl:"",
            uploadExtraData: function () {
                return {
                    _token: $("input[name='_token']").val()
                };
            },
            allowedFileExtensions: ['jpg','png', 'gif', 'svg','gif'],
            overwriteInitial: false,
            maxFileSize: 2048,
            maxFileCount: 4,
            uploadUrl: false,
            showUpload: false,
            showRemove: true,
            dropZoneTitle: 'Télécharger des images ici...'
            // required: true,
            // validateInitialCount: true,
           /* slugcallback: function (filename) {
                return filename.replace('(','_').replace(']','_');
            } */
        })
    </script>
{{-- script pour image view  --}}


{{-- script pour select control  --}}
    <script src="{{asset('backend/vendors/chosen/chosen.jquery.min.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            jQuery(".standardSelect").chosen({
                disable_search_threshold: 10,
                no_results_text: "Oops, nothing found!",
                width: "100%"
            });
        });
    </script>
{{-- script pour select control  --}}
@endsection



   {{--     <!doctype html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" media="all" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.4/css/fileinput.min.css" media="all" integrity="sha512-iPac4HfczXMa0qW1F34D91WysfdyjgbvopGdZcW0IlTwxgfLrFmxnQFThIASKs72aAHm5WVODsZZMrx+tgE+iw==" crossorigin="anonymous" />
    <title>Image</title>

    <style type="text/css">
        .main-section{
            margin: 0 auto;
            padding: 20px;
            margin-top: 100px;
            background: #fff;
            box-shadow: 0px 0px 20px #C1C1C1;
        }
    </style>
</head>
<body>

<div class="bg-info">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-11 main-section">
                <h1 class="text-center text-danger">Mutiple Upload Images By Momo</h1>
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <div class="form-group">
                    <input type="file" id="file-1" name="file" multiple class="file" data-overwrite-initial="false"
                           data-min-file-count="2">
                </div>
            </div>
        </div>
    </div>
</div>




<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.4/js/fileinput.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/5.1.4/themes/fa/theme.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>


<script type="text/javascript">
    $("#file-1").fileinput({
        theme: 'fa',
        uploadUrl:"/image-submit",
        uploadExtraData: function () {
            return {
                _token: $("input[name='_token']").val()
            };
        },
        allowedFileExtensions: ['jpg','png', 'gif'],
        overwriteInitial: false,
        maxFileSize: 2000,
        maxFileNum: 8,
        slugcallback: function (filename) {
            return filename.replace('(','_').replace(']','_');
        }
    })
</script>


</body>
</html>--}}