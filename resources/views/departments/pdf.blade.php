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
                                    <strong>Kode Dept</strong>
                                </div>
                                <div class="col-xs-7">
                                    <strong>Nama Departemen</strong>
                                </div>
                                <div class="col-xs-2 text-center">
                                    <strong>Status</strong>
                                </div>
                            </div>

                            @foreach($department as $key => $value )
                                <div class="row btm">
                                    <div class="col-xs-3">
                                        {{$value->dept_id}}
                                    </div>
                                    <div class="col-xs-7">
                                        {{$value->dept_name}}
                                    </div>
                                    <div class="col-xs-2 text-center">
                                    
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </body>
</html>