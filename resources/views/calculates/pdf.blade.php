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
                                <div class="col-xs-3">
                                    <strong>Nama Pegawai</strong>
                                </div>
                                <div class="col-xs-1">
                                    <strong>Bulan</strong>
                                </div>
                                <div class="col-xs-2 text-right">
                                    <strong>Gaji Pokok</strong>
                                </div>
                                <div class="col-xs-2 text-right">
                                    <strong>Tunjangan</strong>
                                </div>
                                <div class="col-xs-2 text-right">
                                    <strong>Lembur</strong>
                                </div>
                                <div class="col-xs-2 text-right">
                                    <strong>Total Gaji</strong>
                                </div>
                            </div>

                            @foreach($calculate as $key => $value )
                                <div class="row btm">
                                    <div class="col-xs-3">
                                        {{$value->pegawai->user->name }}
                                    </div>
                                    <div class="col-xs-1">
                                        @php 
                                            $dt_object = \Carbon\Carbon::createFromFormat('!m', $value->calculate_period);
                                            $bulan = $dt_object->format('F');
                                        @endphp
                                        {{ $bulan }}
                                    </div>
                                    <div class="col-xs-2 text-right">
                                        {{ number_format($value->calculate_gapok,0 ) }}
                                    </div>
                                    <div class="col-xs-2 text-right">
                                        {{ number_format($value->calculate_allowance,0 ) }}
                                    </div>
                                    <div class="col-xs-2 text-right">
                                        {{ number_format($value->calculate_overtime_amount,0 ) }}
                                    </div>
                                    <div class="col-xs-2 text-right">
                                        {{ number_format($value->calculate_gapok+$value->calculate_overtime_amount+$value->calculate_allowance,0 ) }}
                                    </div>
                                </div>
                            @endforeach
                            <div class="row btmth">
                                <div class="col-xs-10">
                                    Total Gaji :
                                </div>
                                <div class="col-xs-2 text-right">
                                    <strong>{{ number_format($calculate->sum('calculate_gapok')+$calculate->sum('calculate_overtime_amount')+$calculate->sum('calculate_allowance'),0 ) }}</strong>
                                </div>
                            </div>
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