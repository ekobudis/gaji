@extends('layouts.app')

@section('head')
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>AdminLTE 2 | Pegawai Baru</title>
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
        <div class="col-md-6">
        <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $title }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @if(!$emp->id)
                    {{ Form::model( $emp,['url'=> 'employees']) }}
                @else
                    {{ Form::model( $emp, ['method' => 'PATCH','url'=> ['employees', $emp->id ]]) }}
                @endif
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-4">
                                <input type="hidden" name="dept_code" id="dept_code">
                                <div class="form-group">
                                    {{ Form::label('emp_id','Kode Pegawai',['class'=>'control-label']) }}
                                    {{ Form::text('emp_id', null, ['id'=>'emp_id', 'class'=>'form-control','placeholder'=>'Kode Otomatis']) }}
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    {{ Form::label('emp_name','Nama Pegawai',['class'=>'control-label']) }}
                                    {{ Form::text('emp_name', null, ['id'=>'emp_name', 'class'=>'form-control','placeholder'=>'Nama Pegawai']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('emp_join_date','Tanggal Gabung',['class'=>'control-label']) }}
                                    {{ Form::date('emp_join_date', null, ['id'=>'emp_join_date', 'class'=>'form-control','placeholder'=>'Tgl Masuk']) }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    {{ Form::label('emp_birthdate','Tanggal Lahir',['class'=>'control-label']) }}
                                    {{ Form::date('emp_birthdate', null, ['id'=>'emp_birthdate', 'class'=>'form-control','placeholder'=>'Tgl Lahir']) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('dept_id','Departemen') }}
                                    @if(!$emp->id)
                                    {{ Form::select('dept_id', $dept , null , ['id'=>'dept_id','class'=>'select','placeholder' => 'Pilih Departemen','style'=>'width: 100%;']) }}
                                    @else
                                    {{ Form::select('dept_id', $dept , $emp->dept_id , ['id'=>'dept_id','class'=>'select','placeholder' => 'Pilih Departemen','style'=>'width: 100%;']) }}
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('position_id','Jabatan') }}
                                    @if(!$emp->id)
                                    {{ Form::select('position_id', $post , null , ['id'=>'position_id','class'=>'select','placeholder' => 'Pilih Jabatan','style'=>'width: 100%;']) }}
                                    @else
                                    {{ Form::select('position_id', $post , $emp->position_id , ['id'=>'position_id','class'=>'select','placeholder' => 'Pilih Jabatan','style'=>'width: 100%;']) }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('emp_basic','Gaji Pokok',['class'=>'control-label']) }}
                                    {{ Form::number('emp_basic', null, ['id'=>'emp_basic', 'class'=>'form-control','placeholder'=>'Gaji Pokok']) }}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('emp_allowance','Tunjangan',['class'=>'control-label']) }}
                                    {{ Form::number('emp_allowance', null, ['id'=>'emp_bemp_allowanceasic', 'class'=>'form-control','placeholder'=>'Tunjangan Jabatan']) }}
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
        var uri_nomer = "{{ url('nomer_karyawan') }}";
        var uri_dept = "{{ url('dept_code') }}";

        $('#dept_id').select2();
        $('#position_id').select2();

        $('#emp_join_date').change(function(){
            var tgl =$('#emp_join_date').val();
            
            if($('#dept_id').val()!=null){
                var dept = $('#dept_code').val();
                var dept_id = $('#dept_id').val();
            }else{
                var dept = '';
                var dept_id = 0;
            }

            $.ajax({
                dataType : 'json',
                url : uri_nomer + '/' +  dept_id + '/' + tgl ,
                success:function(data){
                    console.log(data);
                    //$('#nomer_pembelian').text(data);
                    $('#emp_id').val(data.emp_id);
                }
            });
        });

        $('#dept_id').change(function(){
            
            if($('#dept_id').val()!=null){
                var dept = $('#dept_id').val();
            }else{
                var dept = '';
            }

            $.ajax({
                dataType : 'json',
                url : uri_dept + '/' +  dept ,
                success:function(data){
                    console.log(data.dept_code);
                    //$('#nomer_pembelian').text(data);
                    $('#dept_code').val(data.dept_code);
                }
            });
        });

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
	</script>
	@endpush
@stop
