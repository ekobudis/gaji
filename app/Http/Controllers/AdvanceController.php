<?php

namespace App\Http\Controllers;

use Auth;
use App\Advance;
use App\Employee;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdvanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $advances = Advance::all();

        $params = [
            'title' => 'Daftar Kasbon',
            'advances' => $advances,
        ];

        return view('advances.index')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $advances = new Advance;
        $emp = Employee::pluck('employee_name','id')->toArray();
        $params = [
            'title' => 'Kasbon Baru',
            'advances' => $advances,
            'emp' => $emp,
        ];

        return view('advances.form')->with($params);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $erros = $this->validate($request,[
            'emp_id' => 'required',
            'advance_date' => 'required',
            'advance_desc' => 'required',
            'advance_amount' => 'required'
        ]);

        $kasbon = new Advance();
        $kasbon->employee_id =  $request->employee_id;
        $kasbon->advance_date =  $request->advance_date;
        $kasbon->advance_refund =  $request->advance_refund;
        $kasbon->advance_desc =  $request->advance_desc;
        $kasbon->advance_amount =  $request->advance_amount;
        $kasbon->advance_balance =  $request->advance_amount;
        $kasbon->user_id = Auth::user()->id;
        $kasbon->save();

        return redirect()->route('advanceds.index')->with('success','Kasbon berhasil di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function show(Advance $advance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $advances = Advance::findOrFail($id);
        $emp = Employee::pluck('employee_name','id')->toArray();
        $params = [
            'title' => 'Edit Kasbon',
            'advances' => $advances,
            'emp' => $emp,
        ];

        return view('advances.form')->with($params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $kasbon = Advance::findOrFail($id);
        $kasbon->employee_id =  $request->employee_id;
        $kasbon->advance_date =  $request->advance_date;
        $kasbon->advance_refund =  $request->advance_refund;
        $kasbon->advance_desc =  $request->advance_desc;
        $kasbon->advance_amount =  $request->advance_amount;
        $kasbon->advance_balance =  $request->advance_amount;
        $kasbon->save();

        return redirect()->route('advanceds.index')->with('success','Kasbon berhasil di simpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Advance  $advance
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $adv = Advance::findOrFail($id);
        $adv->delete();

        return redirect()->route('advanceds.index')->with('success','Kasbon berhasil di hapus');
    }
}
