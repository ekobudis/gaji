@extends('layouts.app')

@section('head')
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>AdminLTE 2 | Pegawai</title>
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
                    <a href="{{ url('employees/create') }}" class="btn bg-blue btn-xs btn-icon"><i class="fa fa-plus"></i></a>
                    <a href="{{ url('preview-employees') }}" target="_blank" class="btn bg-default btn-xs btn-icon"><i class="fa fa-print"></i></a>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Pegawai</th>
                                <th>Tgl Gabung</th>
                                <th>Departemen</th>
                                <th>Jabatan</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                            @foreach($employees as $emp)
                                <tr>
                                    <td>{{ $emp->employee_code }}</td>
                                    <td>{{ $emp->user->name }}</td>
                                    <td>{{ $emp->employee_join_date }}</td>
                                    <td>{{ $emp->departemen->department_name }}</td>
                                    <td>{{ $emp->jabatan->position_name }}</td>
                                    @if($emp->employee_status !=0 )
                                    <td class="text-center"><span class="label label-warning">Suspended</span></td>
                                    @else
                                    <td class="text-center"><span class="label label-success">Active</span></td>
                                    @endif
                                    <td class="text-center">
                                        <a href="{{ url('employees/'.$emp->id.'/edit') }}"><i class="fa fa-edit"></i></a>
                                        <a href="#" onclick="showDelete('{{ $emp->id }}')"><i class="fa fa-trash"></i></a> 
                                    </td>
                                </tr>
                            @endforeach
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
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
			$('#del-title').text('Hapus Data Pegawai');
			$('#id').val(id);
			$('#del_formspan').text('Yakin ingin menghapus pegawai ini?');
			$('#del-form').modal('show');
		}

		$(document).on("click",'#delConfirm',(function(){
			var csrf_token = $('meta[name="csrf-token"]').attr('content');
			var id = $('#id').val();
            console.log(id);
			$.ajax({
				url : "{{ url('employees') }}" + '/' + id,
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