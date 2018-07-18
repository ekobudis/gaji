<?php

namespace App\Http\Controllers;

use Auth;
use App\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
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
        $positions = Position::all();

        $params = [
            'title' => 'Daftar Jabatan',
            'positions' => $positions,
        ];

        return view('positions.index')->with($params);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Position;
        $params = [
            'title' => 'Jabatan Baru',
            'post' => $post,
        ];

        return view('positions.form')->with($params);
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
            'position_name' => 'required'
        ]);

        $pos = new Position();
        $pos->position_name =  $request->position_name;
        $pos->user_id = Auth::user()->id;
        $pos->save();

        return redirect()->route('positions.index')->with('success','Jabatan berhasil di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function show(Position $position)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Position::findOrFail($id);
        $params = [
            'title' => 'Edit Jabatan',
            'post' => $post,
        ];

        return view('positions.form')->with($params);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Position $position)
    {
        $position = Position::findOrFail($id);
        $position->position_name =  $request->position_name;
        //$cat->category_description = $request->category_description;
        $position->save();
        
        return redirect()->route('positions.index')->with('success','Jabatan berhasil di update');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Position  $position
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $position = Position::findOrFail($id);
        $position->delete();

        return redirect()->route('positions.index')->with('success','Jabatan berhasil di hapus');
    }
}
