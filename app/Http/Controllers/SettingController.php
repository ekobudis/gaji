<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $params = [
            'title' => 'Sistem Setting',
        ];

        return view('settings.index')->with($params);
    }
}
