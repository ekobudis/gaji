@extends('layouts.app')

@section('head')
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Payroll | Absen Pegawai</title>
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
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    @if(!$attend->id)
                        {{ Form::model( $attend,['url'=> 'attends']) }}
                    @else
                        {{ Form::model( $attend, ['method' => 'PATCH','url'=> ['attends', $attend->id ]]) }}
                    @endif
                    <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('/images/default-avatar.png') }}" alt="User profile picture">
                        <input type="hidden" name="emp_id" id="emp_id" value="{{ $emp->id }}">
                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
                        <p class="text-muted text-center">{{ $emp->jabatan->position_name }}</p>
                        @if(!$attend->id)
                        <a href="#" id="masuk" class="btn btn-primary btn-block btn-rounded"><b>Absen Masuk</b></a>
                        @else
                        <button type="submit" class="btn btn-primary btn-block btn-rounded">Absen Pulang</button>
                        @endif
                    </div>
                    {{ Form::close() }}
                <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Slip Gaji</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        
                    </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li>
                            <a href="#settings" data-toggle="tab">Absensi Bulan Ini :  {{ \Carbon\Carbon::parse($tgl_awal)->format('d-M-Y') }} sampai {{ \Carbon\Carbon::parse($tgl_sekarang)->format('d-M-Y') }} </a>
                        </li>
                        <div class="text-right">
                            <a href="{{ url('lap_absensipegawai/'.$emp->id) }}" target="_blank"><i class="fa fa-print"></i></a>
                        </div>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="settings">
                            <div class="post">
                                <table class="table table-bordered table-striped datatable-show-all" id="absensi_emp">
                                    <thead>
                                        <tr>
                                            <th>Tgl Absen</th>
                                            <th>Jam Masuk</th>
                                            <th>Jam Keluar</th>
                                            <th>Durasi</th>
                                            <th>Lembur Jam</th>
                                            <th>Lembur Selesai</th>
                                            <th>Durasi Lembur</th>
                                        </tr>
                                    </thead>
                                    <tbody id="load_data">
                                        @include('attends.detail')
                                        {{--@foreach($absens as $absen)
                                            @php 
                                                $masuk = \Carbon\Carbon::parse($absen->attend_time_in);
                                                $keluar = \Carbon\Carbon::parse($absen->attend_time_out);
                                                $total = $keluar->diffInHours($masuk);
                                                $menit = $keluar->diffInMinutes($masuk);
                                                if($total>8){
                                                    $jam = $total-1;
                                                }else{
                                                    $jam = $total;
                                                }
                                                $lembur_masuk = \Carbon\Carbon::parse($absen->attend_overtime_start);
                                                $lembur_keluar = \Carbon\Carbon::parse($absen->attend_overtime_end);
                                                $lembur_total = $lembur_keluar->diffInHours($lembur_masuk);
                                                $lembur_menit = $lembur_keluar->diffInMinutes($lembur_masuk);
                                            @endphp
                                            <tr>
                                                <td><div class="text-center">{{ \Carbon\Carbon::parse($absen->attend_date)->format('d-M-y') }} </div></td>
                                                <td><div class="text-center"> {{ \Carbon\Carbon::parse($absen->attend_time_in)->format('H:i') }} </div></td>
                                                <td>
                                                    @if($absen->attend_time_out != null)
                                                    <div class="text-center">{{ \Carbon\Carbon::parse($absen->attend_time_out)->format('H:i') }} </div>
                                                    @else
                                                    <div class="text-center"></div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($absen->attend_time_out != null)
                                                    <div class="text-center">{{ $jam }} </div>
                                                    @else
                                                    <div class="text-center"></div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($absen->attend_time_out != null)
                                                    <div class="text-center">{{ \Carbon\Carbon::parse($absen->attend_overtime_start)->format('H:i') }} </div>
                                                    @else
                                                    <div class="text-center"></div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($absen->attend_time_out != null)
                                                    <div class="text-center">{{ \Carbon\Carbon::parse($absen->attend_overtime_end)->format('H:i') }} </div>
                                                    @else
                                                    <div class="text-center"></div>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if($absen->attend_overtime_end != null)
                                                        <div class="text-center">{{ $lembur_total }} </div>
                                                    @else
                                                        <div class="text-center"> </div>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach--}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
        <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
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
        $(document).ready(function(){
            var uri_masuk = "{{ url('attends') }}";
            var uri_keluar = "{{ url('updateAbsenKeluar') }}";
            var uri_absen = "{{ url('populate_absensi') }}";

            $('#masuk').click(function(){
                $.ajax({
                    dataType: 'json',
                    url:uri_masuk,
                    type:'post',
                    success:function(result){
                        
                    }
                });
            });

            /*$('#keluar').click(function(e){
                //e.preventDefault();
                var emp_id = $('#emp_id').val();
                console.log(emp_id);
                $.ajax({
                    dataType: 'json',
                    url: uri_masuk + '/' + emp_id,
                    type:'post',
                    data:{employee_id:emp_id},
                    cache: false,
                    success:function(data){
                        console.log(data);
                        //return data;
                    }
                });
                //return false;
            });*/

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            arrbulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
            date = new Date();
            millisecond = date.getMilliseconds();
            detik = date.getSeconds();
            menit = date.getMinutes();
            jam = date.getHours();
            hari = date.getDay();
            tanggal = date.getDate();
            bulan = date.getMonth();
            tahun = date.getFullYear();
            //document.write(tanggal+"-"+arrbulan[bulan]+"-"+tahun+"<br/>"+jam+" : "+menit+" : "+detik+"."+millisecond);
        });
	</script>
	@endpush
@stop
