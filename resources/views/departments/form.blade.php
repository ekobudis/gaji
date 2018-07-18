@extends('layouts.app')

@section('head')
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>AdminLTE 2 | Departemen Baru</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
        <!-- Theme style -->
        <link rel="stylesheet" href="{{ asset('dist/css/AdminLTE.min.css') }}">
        <!-- AdminLTE Skins. Choose a skin from the css/skins
            folder instead of downloading all of them to reduce the load. -->
        <link rel="stylesheet" href="{{ asset('dist/css/skins/_all-skins.min.css') }}">
    
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    
        <!-- Google Font -->
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    </head>
@stop

@section('content')
    <div class="row">
          <!-- left column -->
        <div class="col-md-6">
        <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $title }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @if(!$depts->id)
                    {{ Form::model( $depts,['url'=> 'departments']) }}
                @else
                    {{ Form::model( $depts, ['method' => 'PATCH','url'=> ['departments', $depts->id ]]) }}
                @endif
                    <div class="box-body">
                        <div class="row">
                            <div class="form-group col-md-4">
                                {{ Form::label('dept_code','Kode Departemen',['class'=>'control-label']) }}
                                {{ Form::text('dept_code', null, ['id'=>'dept_code', 'class'=>'form-control','placeholder'=>'Kode Departemen']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                {{ Form::label('dept_name','Nama Departement',['class'=>'control-label']) }}
                                {{ Form::text('dept_name', null, ['id'=>'dept_name', 'class'=>'form-control','placeholder'=>'Nama Departemen']) }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                {{ Form::label('dept_desc','Keterangan',['class'=>'control-label']) }}
                                {{ Form::textarea('dept_desc', null, ['id'=>'dept_desc', 'rows'=> '3', 'class'=>'form-control','placeholder'=>'Keterangan']) }}
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="box-footer">
                        <div class="text-left">
                            <a href="{{ url('departments') }}" class="btn btn-info btn-rounded"><i class="fa fa-back">Batal</i></a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div> 
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>

	@push('scripts')
    
	<script type="text/javascript">
		
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
	</script>
	@endpush
@stop
