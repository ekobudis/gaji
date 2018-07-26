@extends('layouts.app')

@section('head')
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Payroll | User Profile</title>
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>User Profile</h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <!-- Profile Image -->
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">

                        <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>

                        <p class="text-muted text-center">{{--$user->position_name--}}</p>
                    </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->

                <!-- About Me Box -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">About Me</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <strong><i class="fa fa-book margin-r-5"></i> Education</strong>

                        <p class="text-muted">
                        B.S. in Computer Science from the University of Tennessee at Knoxville
                        </p>

                        <hr>

                        <strong><i class="fa fa-map-marker margin-r-5"></i> Location</strong>

                        <p class="text-muted">Malibu, California</p>

                        <hr>

                        <strong><i class="fa fa-pencil margin-r-5"></i> Skills</strong>

                        <p>
                        <span class="label label-danger">UI Design</span>
                        <span class="label label-success">Coding</span>
                        <span class="label label-info">Javascript</span>
                        <span class="label label-warning">PHP</span>
                        <span class="label label-primary">Node.js</span>
                        </p>

                        <hr>

                        <strong><i class="fa fa-file-text-o margin-r-5"></i> Notes</strong>

                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                    </div>
                <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li><a href="#settings" data-toggle="tab">Profile</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane" id="settings">
                            <!--<form class="form-horizontal">
                                <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputName" placeholder="Name">
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputName" placeholder="Name">
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="inputExperience" class="col-sm-2 control-label">Experience</label>

                                <div class="col-sm-10">
                                    <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                </div>
                                </div>
                                <div class="form-group">
                                <label for="inputSkills" class="col-sm-2 control-label">Skills</label>

                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                </div>
                                </div>
                                <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <div class="checkbox">
                                    <label>
                                        <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                    </label>
                                    </div>
                                </div>
                                </div>
                                <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                                </div>
                            </form>-->
                            @if(!$emp->id)
                                {{ Form::model( $emp,['url'=> 'employees']) }}
                            @else
                                {{ Form::model( $emp, ['method' => 'PATCH','url'=> ['employees', $emp->id ]]) }}
                            @endif
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="hidden" name="id" id="id">
                                            <div class="form-group">
                                                {{ Form::label('employee_code','Kode Pegawai',['class'=>'control-label']) }}
                                                {{ Form::text('employee_code', null, ['id'=>'employee_code', 'class'=>'form-control','placeholder'=>'Kode Otomatis']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group">
                                                {{ Form::label('employee_name','Nama Pegawai',['class'=>'control-label']) }}
                                                {{ Form::text('employee_name', null, ['id'=>'employee_name', 'class'=>'form-control','placeholder'=>'Nama Pegawai']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('email','Email',['class'=>'control-label']) }}
                                                {{ Form::email('email', null, ['id'=>'email', 'class'=>'form-control','placeholder'=>'Masukkan Email']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="hidden" name="department_code" id="department_code">
                                            <div class="form-group">
                                                {{ Form::label('password','Password',['class'=>'control-label']) }}
                                                {{ Form::password('password', null, ['id'=>'password', 'class'=>'form-control','placeholder'=>'Password']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('password-confirm','Konfirmasi Password',['class'=>'control-label']) }}
                                                {{ Form::password('password-confirm', null, ['id'=>'password-confirm', 'class'=>'form-control','placeholder'=>'Password']) }}
                                            </div>
                                        </div>
                                    </div>
                                        <div class="form-group @if ($errors->has('roles')) has-error @endif">
                                        @if(!$emp->id)
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
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('employee_join_date','Tanggal Gabung',['class'=>'control-label']) }}
                                                {{ Form::date('employee_join_date', null, ['id'=>'employee_join_date', 'class'=>'form-control','placeholder'=>'Tgl Masuk']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                {{ Form::label('employee_birthdate','Tanggal Lahir',['class'=>'control-label']) }}
                                                {{ Form::date('employee_birthdate', null, ['id'=>'employee_birthdate', 'class'=>'form-control','placeholder'=>'Tgl Lahir']) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('department_id','Departemen') }}
                                                @if(!$emp->id)
                                                {{ Form::select('department_id', $dept , null , ['id'=>'department_id','class'=>'select','placeholder' => 'Pilih Departemen','style'=>'width: 100%;']) }}
                                                @else
                                                {{ Form::select('department_id', $dept , $emp->dept_id , ['id'=>'department_id','class'=>'select','placeholder' => 'Pilih Departemen','style'=>'width: 100%;']) }}
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('position_id','Jabatan') }}
                                                @if(!$emp->id)
                                                {{ Form::select('position_id', $post , null , ['id'=>'position_id','class'=>'select','placeholder' => 'Pilih Jabatan','style'=>'width: 100%;']) }}
                                                @else
                                                {{ Form::select('position_id', $post , $emp->position_id , ['id'=>'position_id','class'=>'select','placeholder' => 'Pilih Jabatan','style'=>'width: 100%;']) }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('employee_basic','Gaji Pokok',['class'=>'control-label']) }}
                                                {{ Form::number('employee_basic', null, ['id'=>'employee_basic', 'class'=>'form-control','placeholder'=>'Gaji Pokok']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ Form::label('employee_allowance','Tunjangan',['class'=>'control-label']) }}
                                                {{ Form::number('employee_allowance', null, ['id'=>'employee_allowanceasic', 'class'=>'form-control','placeholder'=>'Tunjangan Jabatan']) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            {{ Form::close() }}
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
    <script src="{{ asset('bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
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
            $('#del-title').text('Hapus Data User');
            $('#id').val(id);
            $('#del_formspan').text('Yakin ingin menghapus user ini?');
            $('#del-form').modal('show');
        }

        $(document).on("click",'#delConfirm',(function(){
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            var id = $('#id').val();
            console.log(id);
            $.ajax({
                url : "{{ url('users') }}" + '/' + id,
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