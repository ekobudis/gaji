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
                <div class="col-xs-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title text-center"><strong>{{ $title }}</strong></h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6 text-left">
                                    <strong>Department : </strong> {{ $calculate->pegawai->departemen->department_name }}
                                </div>
                                <div class="col-xs-6 text-left">
                                    <strong>Tanggal : </strong> {{ \Carbon\Carbon::now()->format('d-M-Y') }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-6 text-left">
                                    <strong>Nama : </strong> {{ $calculate->pegawai->user->name }}
                                </div>
                                <div class="col-xs-6 text-left">
                                    <strong> : </strong> {{ $calculate->pegawai->jabatan->position_name }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    Gaji Pokok
                                </div>
                                <div class="col-xs-2">
                                        
                                </div>
                                <div class="col-xs-1 text-right">Rp. </div>
                                <div class="col-xs-3 text-right">
                                    {{ number_format($calculate->calculate_gapok,0) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    Tunjangan Jabatan
                                </div>
                                <div class="col-xs-2">
                                        
                                </div>
                                <div class="col-xs-1 text-right">Rp. </div>
                                <div class="col-xs-3 text-right">
                                    {{ number_format($calculate->calculate_allowance,0) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-2">
                                    Lembur
                                </div>
                                <div class="col-xs-4">
                                    {{ number_format($calculate->calculate_overtime,0) }} Jam x Rp . {{ number_format($calculate->pegawai->employee_allowance,0) }}
                                </div>
                                <div class="col-xs-1 text-right">Rp. </div>
                                <div class="col-xs-3 text-right">
                                    {{ number_format($calculate->calculate_overtime_amount,0) }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    Transport
                                </div>
                                <div class="col-xs-2">
                                    
                                </div>
                                <div class="col-xs-1 text-right">Rp. </div>
                                <div class="col-xs-3 text-right">
                                    0
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    Uang Makan
                                </div>
                                <div class="col-xs-2">
                                    
                                </div>
                                <div class="col-xs-1 text-right">Rp. </div>
                                <div class="col-xs-3 text-right">
                                    0
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    Bonus
                                </div>
                                <div class="col-xs-2">
                                    
                                </div>
                                <div class="col-xs-1 text-right">Rp. </div>
                                <div class="col-xs-3 text-right">
                                    0
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-5">
                                    <strong>Jumlah Penghasilan</strong>
                                </div>
                                <div class="col-xs-1 text-right">Rp. </div>
                                <div class="col-xs-4 text-right">
                                    {{ number_format($calculate->calculate_gapok+$calculate->calculate_allowance+$calculate->calculate_overtime_amount,0) }}
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-xs-6">
                                    <strong>Personalia</strong>
                                    <p></p><br><br><br><br>
                                </div>
                                <div class="col-xs-6">Penerima
                                    <p></p><br><br><br><br>
                                    {{ ucfirst($calculate->pegawai->user->name) }}
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>