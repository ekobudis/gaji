@extends('layouts.app')

@section('head')
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Payroll | Daftar Perhitungan Gaji</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
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
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $title }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="box-body">
                    <a href="{{ url('preview_listgaji') }}" target="_blank" class="btn bg-default btn-xs btn-icon"><i class="fa fa-print"></i></a>
                    <table class="table table-bordered table-striped datatable-show-all" id="gaji_data">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Periode</th>
                                <th>Tot Hadir</th>
                                <th>Tot Lembur</th>
                                <th>Gaji</th>
                                <th>Lembur</th>
                                <th>Tunjangan Lain</th>
                                <th>Total Gaji</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
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
    <!-- DataTables -->
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script><!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    
    <!-- SlimScroll -->
    <script src="{{ asset('bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
	@push('scripts')
    
	<script type="text/javascript">
        var uri_gaji = "{{ url('list_payroll') }}";
        
        //$('#emp_id').select2();
        var table = $('#gaji_data').DataTable({
                processing:true,
                serverSide:true,
                ajax: uri_gaji,
                columns:[
                    {data:'nama', name:'nama'},
                    {data:'periode', name:'periode'},
                    {data:'total_masuk', name:'total_masuk'},
                    {data:'total_lembur', name:'total_lembur'},
                    {data:'gaji_pokok', name:'gaji_pokok'},
                    {data:'tunjangan', name:'tunjangan'},
                    {data:'lemburan', name:'lemburan'},
                    {data:'total_gaji',name:'total_gaji'},
                    {data:'action', orderable: false, searchable: false}
                ],
                'columnDefs': [
                    { 'visible': false }
                ],
                'displayLength': 100,
            });

        function showDelete(id){
			$('#del-title').text('Hapus Data Absen');
			$('#id').val(id);
			$('#del_formspan').text('Yakin ingin menghapus absensi pegawai ini?');
			$('#del-form').modal('show');
		}

		$(document).on("click",'#delConfirm',(function(){
			var csrf_token = $('meta[name="csrf-token"]').attr('content');
			var id = $('#id').val();
            console.log(id);
			$.ajax({
				url : "{{ url('attends') }}" + '/' + id,
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