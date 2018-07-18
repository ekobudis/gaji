        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="{{ asset('images/default-avatar.png') }}" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        @if(Auth::check())
                        <p>{{ Auth::user()->name }}</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                        @else
                        <p>Not Available</p>
                        <a href="#"><i class="fa fa-circle text-success"></i> Offline</a>
                        @endif
                    </div>
                </div>
                <!-- search form -->
                <form action="#" method="get" class="sidebar-form">
                    {!! csrf_field() !!}
                    <div class="input-group">
                        <input type="text" name="q" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <button type="submit" name="search" id="search-btn" class="btn btn-flat">
                                <i class="fa fa-search"></i>
                            </button>
                        </span>
                    </div>
                </form>
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="active menu-open">
                        <a href="{{ url('home') }}">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-files-o"></i>
                            <span>Data Master</span>
                            <span class="pull-right-container">
                                <span class="label label-primary pull-right">4</span>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                        <li><a href="{{ url('departments') }}"><i class="fa fa-circle-o"></i> Departemen</a></li>
                        <li><a href="{{ url('positions') }}"><i class="fa fa-circle-o"></i> Jabatan</a></li>
                        <li><a href="{{ url('employees') }}"><i class="fa fa-circle-o"></i> Karyawan</a></li>
                        <li><a href="{{ url('projects') }}"><i class="fa fa-circle-o"></i> Proyek</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                        <i class="fa fa-pie-chart"></i>
                        <span>Proses</span>
                        <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>
                        <ul class="treeview-menu">
                        <li><a href="{{ url('attends') }}"><i class="fa fa-circle-o"></i> Absensi</a></li>
                        <li><a href="{{ url('advanceds') }}"><i class="fa fa-circle-o"></i> Pengajuan Kasbon</a></li>
                        <li><a href="{{ url('calculates') }}"><i class="fa fa-circle-o"></i> Perhitungan Gaji</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-laptop"></i>
                            <span>Laporan</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                        <li><a href=""><i class="fa fa-circle-o"></i> Laporan Kasbon</a></li>
                        <li><a href=""><i class="fa fa-circle-o"></i> Laporan Gaji</a></li>
                        <li><a href=""><i class="fa fa-circle-o"></i> Laporan Proyek</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('settings') }}">
                            <i class="fa fa-gear"></i> <span>Settings</span>
                        </a>
                    </li>
                    <li><a href="{{ route('logout') }}"><i class="fa fa-circle-o text-red"></i> <span>Log Out</span></a></li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>