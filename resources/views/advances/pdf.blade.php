<!doctype html>
<html>
<head>
    <title>{{ config('app.name', 'Laravel') }} - {{$title}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta id="token" name="token" value="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
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
                            <h3 class="pull-right" style="display: inline-block;"> Daftar Pinjaman </h3><br>
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
                                    <strong>Nama Pegawai</strong>
                                </div>
                                <div class="col-xs-3">
                                    <strong>Departemen</strong>
                                </div>
                                <div class="col-xs-2">
                                    <strong>Tgl Pinjam</strong>
                                </div>
                                <div class="col-xs-3 text-right">
                                    <strong>Jml Pinjam</strong>
                                </div>
                            </div>

                            @foreach($advanced as $key => $value )
                                <div class="row btm">
                                    <div class="col-xs-4">
                                        {{$value->pegawai->user->name }}
                                    </div>
                                    <div class="col-xs-3">
                                        {{$value->pegawai->departemen->department_name }}
                                    </div>
                                    <div class="col-xs-2">
                                        {{ \Carbon\Carbon::parse($value->advance_date)->format('d-M-Y') }}
                                    </div>
                                    <div class="col-xs-3 text-right">
                                        {{ number_format($value->advance_amount,0) }}
                                    </div>
                                </div>
                            @endforeach
                            <div class="row btmth">
                                <div class="col-xs-9">
                                    Total Kasbon :
                                </div>
                                <div class="col-xs-3 text-right">
                                    <strong>{{ number_format($advanced->sum('advance_amount'),0 ) }}</strong>
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