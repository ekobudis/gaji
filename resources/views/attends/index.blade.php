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
    @include('modals.form')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">{{ $title }}</h3>
                </div>
                <!-- /.card-header -->
                <div class="box-body">
                    <a href="{{ url('attends/create') }}" class="btn bg-blue btn-xs btn-icon"><i class="fa fa-plus"></i></a>
                    <a href="{{ url('preview-attends') }}" target="_blank" class="btn bg-default btn-xs btn-icon"><i class="fa fa-print"></i></a>
                    <table class="table table-bordered table-striped datatable-show-all" id="absen_data">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nama</th>
                                <th>Tgl Absen</th>
                                <th>Jam Masuk</th>
                                <th>Jam Keluar</th>
                                <th>Durasi</th>
                                <th>Lembur Jam</th>
                                <th>Lembur Selesai</th>
                                <th>Durasi Lembur</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /page length options -->
    <!-- Modal Absen Keluar Form -->
    <div class="modal" data-easein="flipYIn" id="out_attend" tabindex="-1" role="dialog" aria-hidden="true"  data-backdrop="static" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="title"></h4>
                </div>
                <div class="modal-body" id="data-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" id="emp_key" name="emp_key">
                                {{ Form::label('emp_id','Nama Pegawai',['class'=>'control-label']) }}
                                <select id="emp_id" name="emp_id" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {{ Form::label('attend_time_out','Jam Masuk',['class'=>'control-label']) }}
                                {{ Form::time('attend_time_out', null, ['id'=>'attend_time_out', 'class'=>'form-control']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary absenkeluar" id="delConfirm">
                        <span> <i class="fa fa-trash-o" aria-hidden="true"> </i> Ya</span>
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Modal Form -->
    <!-- Modal Absen Masuk Lembur Form -->
    <div class="modal" data-easein="flipYIn" id="in_overtime" tabindex="-1" role="dialog" aria-hidden="true"  data-backdrop="static" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="title-lembur"></h4>
                </div>
                <div class="modal-body" id="data-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <input type="hidden" id="emp_pk" name="emp_pk">
                                <input type="hidden" id="lembur_id" name="lembur_id">
                                {{ Form::label('emp_code','Nama Pegawai',['class'=>'control-label']) }}
                                <select id="emp_code" name="emp_code" class="form-control select2" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4" id="masuk">
                            <div class="form-group">
                                {{ Form::label('attend_overtime_start','Jam Lembur Masuk',['class'=>'control-label']) }}
                                {{ Form::time('attend_overtime_start', null, ['id'=>'attend_overtime_start', 'class'=>'form-control']) }}
                            </div>
                        </div>
                        <div class="col-md-4" id="keluar">
                            <div class="form-group">
                                {{ Form::label('attend_overtime_end','Jam Lembur Keluar',['class'=>'control-label']) }}
                                {{ Form::time('attend_overtime_end', null, ['id'=>'attend_overtime_end', 'class'=>'form-control']) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary lemburmasuk" id="delConfirm">
                        <span> <i class="fa fa-trash-o" aria-hidden="true"> </i> Ya</span>
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                </div>
            </div>
        </div>
    </div>
    <!-- END Modal Form -->
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
        var uri_emp = "{{ url('list_emp') }}";
        var uri = "{{ url('attends') }}";
        var uri_overtime = "{{ url('overtime') }}";
        var uri_absen = "{{ url('absensi') }}";

        //$('#emp_id').select2();
        var table = $('#absen_data').DataTable({
                processing:true,
                serverSide:true,
                ajax: uri_absen,
                columns:[
                    {data:'id', name:'id'},
                    {data:'nama', name:'nama'},
                    {data:'tgl_masuk', name:'tgl_masuk'},
                    {data:'jam_masuk', name:'jam_masuk'},
                    {data:'jam_keluar', name:'jam_keluar'},
                    {data:'total_masuk', name:'total_masuk'},
                    {data:'masuk_lembur', name:'masuk_lembur'},
                    {data:'keluar_lembur', name:'keluar_lembur'},
                    {data:'durasi_lembur',name:'durasi_lembur'},
                    {data:'action', orderable: false, searchable: false}
                ],
                'columnDefs': [
                    { 'visible': false, 'targets': [0] }
                ],
                'order': [[ 2 , 'asc' ]],
                'displayLength': 100,
            });

        function attendOut(id){
            $('#title').text('Absensi Keluar');
            $('#emp_key').val(id);
            var op="";

            $.ajax({
                url:uri_emp,
                dataType:'json',
                type:'get',
                success:function(data){
                    console.log(data);
                    op+='<option value="0" selected> Pilih Pegawai</option>';
                    for(var i=0;i<data.length;i++){
                        if(data[i].id== id){
                            op+='<option value="'+data[i].id+'" selected>'+data[i].emp_name+'</option>';
                        }else{
                            op+='<option value="'+data[i].id+'">'+data[i].emp_name+'</option>';
                        }
                    }
                    $('#emp_id').html("");
                    $('#emp_id').append(op);
                }
            });
            $('#out_attend').modal('show');
        }

        function JamMasukLembur(id){
            $('#title-lembur').text('Absensi Lembur Masuk');
            $('#emp_pk').val(id);
            console.log(id);
            $('#lembur_id').val(1); //Masuk
            var op="";
            $('#keluar').hide();
            $.ajax({
                url:uri_emp,
                dataType:'json',
                type:'get',
                success:function(data){
                    console.log(data);
                    op+='<option value="0" selected> Pilih Pegawai</option>';
                    for(var i=0;i<data.length;i++){
                        if(data[i].id== id){
                            op+='<option value="'+data[i].id+'" selected>'+data[i].emp_name+'</option>';
                        }else{
                            op+='<option value="'+data[i].id+'">'+data[i].emp_name+'</option>';
                        }
                    }
                    $('#emp_code').html("");
                    $('#emp_code').append(op);
                }
            });
            $('#in_overtime').modal('show');
        }

        function JamKeluarLembur(id){
            var uri_out = "{{ url('get_dataovertime') }}";

            $('#title-lembur').text('Absensi Lembur Keluar');
            $('#emp_pk').val(id);
            console.log(id);
            $('#lembur_id').val(0); //Keluar
            $('#keluar').show();
            var op="";
            // /$('#attend_overtime_start').readonly();
            $.ajax({
                url:uri_emp,
                dataType:'json',
                type:'get',
                success:function(data){
                    console.log(data);
                    op+='<option value="0" selected> Pilih Pegawai</option>';
                    for(var i=0;i<data.length;i++){
                        if(data[i].id== id){
                            op+='<option value="'+data[i].id+'" selected>'+data[i].emp_name+'</option>';
                        }else{
                            op+='<option value="'+data[i].id+'">'+data[i].emp_name+'</option>';
                        }
                    }
                    $('#emp_code').html("");
                    $('#emp_code').append(op);
                }
            });
            $.ajax({
                url:uri_out + '/' + id,
                type:'get',
                success:function(result){
                    $('#attend_overtime_start').val(result.attend_overtime_start);
                }
            })
            $('#in_overtime').modal('show');
        }

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

        $('.absenkeluar').click(function(e){
            var attend_time_out = $('#attend_time_out').val();
            if (!e.isDefaultPrevented()){      
                //$('input[name=_method]').val('PATCH');
                var id = $('#emp_key').val();
                console.log(id);
                $.ajax({
                    url : uri + '/' + id, 
                    type : 'patch',
                    data:{attend_time_out:attend_time_out},
                    success:function(result){
                        $('#out_attend').modal('hide');
                        table.ajax.reload();
                    }
                });
                //return false;
			}
        });

        // /lemburmasuk
        $('.lemburmasuk').click(function(e){
            if (!e.isDefaultPrevented()){      
                //$('input[name=_method]').val('PATCH');
                var id = $('#emp_pk').val();
                if($('#lembur_id').val()==1){
                    var attend_overtime_start = $('#attend_overtime_start').val();
                    var attend_overtime_end = '';
                }else{
                    var attend_overtime_start = $('#attend_overtime_start').val();
                    var attend_overtime_end = $('#attend_overtime_end').val();
                }
                $.ajax({
                    url : uri_overtime + '/' + id, 
                    type : 'patch',
                    data:{attend_overtime_start:attend_overtime_start,attend_overtime_end:attend_overtime_end},
                    success:function(result){
                        $('#in_overtime').modal('hide');
                        table.ajax.reload();
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