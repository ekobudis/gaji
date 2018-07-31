<!doctype html>
<html>
<head>
    <title>{{ config('app.name', 'Laravel') }} - {{$title}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
    <body>
        <style>
            .invoice-title h2, .invoice-title h3 {
                display: inline-block;
            }
            .table > tbody > tr > .no-line {
                border-top: none;
            }
            .table > thead > tr > .no-line {
                border-bottom: none;
            }
            .btmth {
                border-bottom: 2px solid #ddd;
            }
            .btm {
                border-bottom: 1px solid #ddd;
            }
            .container {
                background: white;
            }
            .page {
                overflow: hidden;
                page-break-after: always;
            }
        </style>

        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="row">
                        <div class="col-xs-4">
                           
                        </div>
                        <div class="col-xs-2"></div>
                        <div class="col-xs-6">
                            <h3 class="pull-right" style="display: inline-block;">  </h3><br>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <h3 class="panel-title"><strong>{{ $title }}</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row btmth">
                                <div class="col-xs-4">
                                    <strong>Nama</strong>
                                </div>
                                <div class="col-xs-2">
                                    <strong>Tanggal</strong>
                                </div>
                                <div class="col-xs-1 text-center">
                                    <strong>Jam Masuk</strong>
                                </div>
                                <div class="col-xs-1 text-center">
                                    <strong>Jam Keluar</strong>
                                </div>
                                <div class="col-xs-1 text-center">
                                    <strong>Durasi</strong>
                                </div>
                                <div class="col-xs-1 text-center">
                                    <strong>Jam Lembur</strong>
                                </div>
                                <div class="col-xs-1 text-center">
                                    <strong>Akhir Lembur</strong>
                                </div>
                                <div class="col-xs-1 text-center">
                                    <strong>Durasi</strong>
                                </div>
                            </div>

                            @foreach($absens as $key => $value )
                                @php 
                                    $masuk = \Carbon\Carbon::parse($value->attend_time_in);
                                    $keluar = \Carbon\Carbon::parse($value->attend_time_out);
                                    $total = $keluar->diffInHours($masuk);
                                    $menit = $keluar->diffInMinutes($masuk);
                                    if($total>8){
                                        $jam = $total-1;
                                    }else{
                                        $jam = $total;
                                    }
                                    $lembur_masuk = \Carbon\Carbon::parse($value->attend_overtime_start);
                                    $lembur_keluar = \Carbon\Carbon::parse($value->attend_overtime_end);
                                    $lembur_total = $lembur_keluar->diffInHours($lembur_masuk);
                                    $lembur_menit = $lembur_keluar->diffInMinutes($lembur_masuk);
                                @endphp
                                <div class="row btm">
                                    <div class="col-xs-2">
                                        {{ $value->pegawai->user->name }}
                                    </div>
                                    <div class="col-xs-2">
                                        {{ \Carbon\Carbon::parse($value->attend_date)->format('d-M-y') }}
                                    </div>
                                    <div class="col-xs-1 text-center">
                                        {{ \Carbon\Carbon::parse($value->attend_time_in)->format('H:i') }}
                                    </div>
                                    <div class="col-xs-1 text-center">
                                        {{ \Carbon\Carbon::parse($value->attend_time_out)->format('H:i') }}
                                    </div>
                                    <div class="col-xs-1 text-center">
                                        @if($value->attend_time_out != null)
                                        {{ $jam }}
                                        @else
                                        @endif
                                    </div>
                                    <div class="col-xs-1 text-center">
                                        {{ \Carbon\Carbon::parse($value->attend_overtime_start)->format('H:i') }}
                                    </div>
                                    <div class="col-xs-1 text-center">
                                        {{ \Carbon\Carbon::parse($value->attend_overtime_end)->format('H:i') }}
                                    </div>
                                    <div class="col-xs-1 text-center">
                                        @if($value->attend_overtime_end != null)
                                        {{ $lembur_total }}
                                        @else
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <br>
                            <div class="row btmth">
                                <div class="col-xs-4">
                                    Dibuat Oleh : <br><br><br><br><br>
                                </div>
                                <div class="col-xs-4">
                                    Disetujui Oleh : <br><br><br><br><br>
                                </div>
                                <div class="col-xs-4">
                                    Diketahui Oleh : <br><br><br><br><br>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>