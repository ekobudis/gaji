@extends('layouts.app')

@section('head')
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Payroll | Kasbon Baru</title>
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
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $title }}</h3>
                </div>
                    <!-- /.card-header -->
                <!-- form start -->
                @if(!$advances->id)
                    {{ Form::model( $advances,['url'=> 'advanceds']) }}
                @else
                    {{ Form::model( $advances, ['method' => 'PATCH','url'=> ['advanceds', $advances->id ]]) }}
                @endif
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    {{ Form::label('employee_id','Pegawai') }}
                                    @if(!$advances->id)
                                    {{ Form::select('employee_id', $emp , null , ['id'=>'employee_id','class'=>'select2','placeholder' => 'Pilih Pegawai','style'=>'width: 100%;']) }}
                                    @else
                                    {{ Form::select('employee_id', $emp , $advances->employee_id , ['id'=>'employee_id','class'=>'select2','placeholder' => 'Pilih Pegawai','style'=>'width: 100%;']) }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('advance_date','Tgl Pengajuan',['class'=>'control-label']) }}
                                    {{ Form::date('advance_date', null, ['id'=>'advance_date', 'class'=>'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('advance_refund','Tgl Pengembalian',['class'=>'control-label']) }}
                                    {{ Form::date('advance_refund', null, ['id'=>'advance_refund', 'class'=>'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('advance_desc','Alasan',['class'=>'control-label']) }}
                                    {{ Form::text('advance_desc', null, ['id'=>'advance_desc', 'class'=>'form-control','placeholder'=>'Masukkan Alasan Pinjaman']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('advance_amount','Jumlah',['class'=>'control-label']) }}
                                    {{ Form::number('advance_amount', null, ['id'=>'advance_amount', 'class'=>'form-control','placeholder'=>'Masukkan Nominal Pinjaman']) }}
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
