@extends('layouts.app')

@section('head')
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>AdminLTE 2 | Proyek Baru</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/select2/dist/css/select2.min.css') }}">
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
          <div class="box-header">
          <h3 class="box-title">{{ $title }}</h3>
          </div>
          <div class="col-md-6">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#activity" data-toggle="tab">Proyek</a></li>
                        <li><a href="#pekerja" data-toggle="tab">Pekerja</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="activity">
                            <div class="post">
                <!-- form start -->
                            @if(!$project->id)
                                {{ Form::model( $project,['url'=> 'projects']) }}
                            @else
                                {{ Form::model( $project, ['method' => 'PATCH','url'=> ['projects', $project->id ]]) }}
                            @endif
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('project_code','Kode Proyek',['class'=>'control-label']) }}
                                                {{ Form::text('project_code', null, ['id'=>'project_code', 'class'=>'form-control','placeholder'=>'Masukkan Jabatan']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                {{ Form::label('project_name','Nama Proyek',['class'=>'control-label']) }}
                                                {{ Form::text('project_name', null, ['id'=>'project_name', 'class'=>'form-control','placeholder'=>'Masukkan Jabatan']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ Form::label('project_desc','Keterangan Proyek',['class'=>'control-label']) }}
                                                {{ Form::text('project_desc', null, ['id'=>'project_desc', 'class'=>'form-control','placeholder'=>'Masukkan Jabatan']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('project_start','Mulai Proyek',['class'=>'control-label']) }}
                                                {{ Form::date('project_start', null, ['id'=>'project_start', 'class'=>'form-control','placeholder'=>'Masukkan Jabatan']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('project_end','Akhir Proyek',['class'=>'control-label']) }}
                                                {{ Form::date('project_end', null, ['id'=>'project_end', 'class'=>'form-control','placeholder'=>'Masukkan Jabatan']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('project_amounts','Nilai Proyek',['class'=>'control-label']) }}
                                                {{ Form::number('project_amounts', null, ['id'=>'project_amounts', 'class'=>'form-control','placeholder'=>'Masukkan Jabatan']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                {{ Form::label('employee_id','Penanggung Jawab Proyek',['class'=>'control-label']) }}
                                                @if(!$project->id)
                                                {{ Form::select('employee_id', $emp , null , ['id'=>'employee_id','class'=>'select','placeholder' => 'Pilih PIC','style'=>'width: 100%;']) }}
                                                @else
                                                {{ Form::select('employee_id', $emp , $project->employee_id , ['id'=>'employee_id','class'=>'select','placeholder' => 'Pilih PIC','style'=>'width: 100%;']) }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            {{ Form::close() }}
                            </div>
                        </div>
                        <div class="tab-pane" id="pekerja">
                            <div class="post">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('footer')
        
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
	@push('scripts')
    
    <script type="text/javascript">
    
        $('#employee_id').select2();
		
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
	</script>
	@endpush
@stop
