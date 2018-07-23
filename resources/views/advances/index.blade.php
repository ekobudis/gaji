@extends('layouts.app')

@section('head')
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>AdminLTE 2 | Kasbon</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
        <!-- jvectormap -->
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
    <!-- Page length options -->
    @include('modals.form')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $title }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="box-body">
                    <a href="{{ url('advanceds/create') }}" class="btn bg-blue btn-xs btn-icon"><i class="fa fa-plus"></i></a>
                    <a href="{{ url('preview-advanced') }}" target="_blank" class="btn bg-default btn-xs btn-icon"><i class="fa fa-print"></i></a>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Tgl Pinjam</th>
                                <th>Tgl Bayar</th>
                                <th>Departemen</th>
                                <th>Alasan</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                            @foreach($advances as $dept)
                                <tr>
                                    <td>{{ $dept->pegawai->user->name }}</td>
                                    <td>{{ $dept->advance_date }}</td>
                                    <td>{{ $dept->advance_refund }}</td>
                                    <td>{{ $dept->pegawai->departemen->department_name }}</td>
                                    <td>{{ $dept->advance_desc }}</td>
                                    <td class="text-right">{{ number_format($dept->advance_amount,0) }}</td>
                                    <td></td>
                                    <td class="text-center">
                                        <a href="{{ url('advanceds/'.$dept->id.'/edit') }}"><i class="fa fa-edit"></i></a>
                                        <a href="#" onclick="showDelete('{{ $dept->id }}')"><i class="fa fa-trash"></i></a>    
                                        <a href="{{ url('preview-form/'.$dept->id) }}" target="_blank"><i class="fa fa-print"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /page length options -->
@stop

@section('footer')
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- SlimScroll -->
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
	@push('scripts')
    
	<script type="text/javascript">
		
        function showDelete(id){
			$('#del-title').text('Hapus Data Kasbon');
			$('#id').val(id);
			$('#del_formspan').text('Yakin ingin menghapus kasbon pegawai ini?');
			$('#del-form').modal('show');
		}

		$(document).on("click",'#delConfirm',(function(){
			var csrf_token = $('meta[name="csrf-token"]').attr('content');
			var id = $('#id').val();
            console.log(id);
			$.ajax({
				url : "{{ url('advanceds') }}" + '/' + id,
				type : "POST",
				data : {'_method' : 'DELETE', '_token' : csrf_token},
				success : function(data) {
					$('#del-form').modal('hide');
					table.ajax.reload();
				}
			});
        }));

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
	</script>
	@endpush
@stop