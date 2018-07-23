@extends('layouts.app')

@section('head')
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Payroll | Perhitungan Gaji</title>
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
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $title }}</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                @if(!$proses->id)
                    {{ Form::model( $proses,['url'=> '#']) }}
                @else
                    {{ Form::model( $proses, ['method' => 'PATCH','url'=> ['#', $proses->id ]]) }}
                @endif
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-3 col-xs-4">
                                <div class="form-group">
                                    {{ Form::label('calculate_start','Dari Tanggal',['class'=>'control-label']) }}
                                    {{ Form::date('calculate_start', null, ['id'=>'calculate_start', 'class'=>'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-4">
                                <div class="form-group">
                                    {{ Form::label('calculate_end','Sampai Tanggal',['class'=>'control-label']) }}
                                    {{ Form::date('calculate_end', null, ['id'=>'calculate_end', 'class'=>'form-control']) }}
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-4">
                                <div class="form-group">
                                    {{ Form::label('calculate_period','Periode Gaji',['class'=>'control-label']) }}
                                    @if(!$proses->id)
                                    {{ Form::select('calculate_period', $bulans , null , ['id'=>'calculate_period','class'=>'select','placeholder' => 'Pilih Periode','style'=>'width: 100%;']) }}
                                    @else
                                    {{ Form::select('calculate_period', $bulans , $proses->calculate_period , ['id'=>'calculate_period','class'=>'select','placeholder' => 'Pilih Periode','style'=>'width: 100%;']) }}
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row" id="gajian">
                            <div class="col-md-12">
                                <table class="table table-bordered table-striped datatable-show-all">
                                    <thead>
                                        <tr>
                                            <td>ID</td>
                                            <td>Nama Pegawai</td>
                                            <td>Tot Masuk</td>
                                            <td>Tot Lembur</td>
                                            <td>Gaji Harian</td>
                                            <td>Total Gaji</td>
                                            <td>Lembur</td>
                                            <td>Total Lembur</td>
                                            <td>Pinjaman</td>
                                            <td>Total Diterima</td>
                                        </tr>
                                    </thead>
                                    <tbody id="detail_gaji">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="box-footer">
                            <div class="text-left">
                                <button type="button" class="btn btn-primary proses">Proses</button>
                            </div>
                            <div class="text-right" id="save_data">
                                <button type="submit" class="btn btn-primary simpan">Save</button>
                            </div>
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
    <script src="{{ asset('bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>

	@push('scripts')
    
	<script type="text/javascript">
        var uri_proses = "{{ url('tarik_data') }}";

        $('#gajian').hide();
        $('#save_data').hide();

        $('#calculate_period').select2();

        $('.proses').click(function(e){
            if (!e.isDefaultPrevented()){      
                //$('input[name=_method]').val('PATCH');
                var dari_tgl = $('#calculate_start').val();
                var end_tgl = $('#calculate_end').val();

                $.ajax({
                    url : uri_proses + '/' + dari_tgl + '/sampai/'+ end_tgl, 
                    type : 'get',
                    dataType: 'json',
                    success:function(data){
                        console.log(data);
                        $('#gajian').show();
                        $('#save_data').show();
                    }
                });
                return false;
			}
        });

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
	</script>
	@endpush
@stop
