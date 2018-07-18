@extends('layouts.app')

@section('head')
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Payroll | User Baru</title>
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.7 -->
        <link rel="stylesheet" href="{{ asset('bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{ asset('bower_components/font-awesome/css/font-awesome.min.css') }}">
        <!-- Ionicons -->
        <link rel="stylesheet" href="{{ asset('bower_components/Ionicons/css/ionicons.min.css') }}">
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
    <div class="row">
          <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ $title }}</h3>
                </div>
            <!-- /.card-header -->
                <!-- form start -->
                @if(!$user->id)
                    {{ Form::model( $user,['url'=> 'users']) }}
                @else
                    {{ Form::model( $user, ['method' => 'PATCH','url'=> ['users', $user->id ]]) }}
                @endif
                    <div class="box-body">
                        <div class="form-group">
                            {{ Form::label('name','Name',['class'=>'control-label']) }}
                            {{ Form::text('name', null, ['id'=>'name', 'class'=>'form-control','placeholder'=>'Masukkan Nama']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('email','Email',['class'=>'control-label']) }}
                            {{ Form::email('email', null, ['id'=>'email', 'class'=>'form-control','placeholder'=>'Masukkan Email']) }}
                        </div>
                        <div class="form-group @if ($errors->has('roles')) has-error @endif">
                            @if(!$user->id)
                                @foreach ($roles as $role)
                                    {{ Form::checkbox('roles[]',  $role->id,'',['class'=>'styled'] ) }}
                                    {{ Form::label($role->name,  ucfirst($role->name),['class'=>'control-label']) }}<br>
                                @endforeach
                            @else
                                @foreach ($roles as $role)
                                    {{ Form::checkbox('roles[]',  $role->id,$user->roles,['class'=>'styled'] ) }}
                                    {{ Form::label($role->name,  ucfirst($role->name),['class'=>'control-label']) }}<br>
                                @endforeach
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('password','Password',['class'=>'control-label']) }}
                            {{ Form::password('password', null, ['id'=>'password', 'class'=>'form-control','placeholder'=>'Password']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('password-confirm','Konfirmasi Password',['class'=>'control-label']) }}
                            {{ Form::password('password-confirm', null, ['id'=>'password-confirm', 'class'=>'form-control','placeholder'=>'Password']) }}
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@stop

@section('footer')
    <script src="{{ asset('bower_components/jquery/dist/jquery.min.js') }}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{ asset('bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('bower_components/fastclick/lib/fastclick.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
	@push('scripts')
    
	<script type="text/javascript">
		
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
	</script>
	@endpush
@stop
