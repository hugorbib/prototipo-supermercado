<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Sewer;

class AlertsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sewers = DB::table('sewers')->where('status', 1)->get();
        $sewers2 = DB::table('sewers')->where('status', 2)->get();
        $sewers3 = DB::table('sewers')->where('status', 3)->get();
        return view('alerts.index', compact('sewers','sewers2','sewers3'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function status(Request $request)
    {

        $id=$request->idcompliment;
        // dd($id);
        $status = $request->radiobt;
        
        $swr = Sewer::findOrFail($id);
        $swr->status = $status;
        $swr->save();
        Alert::success('¡Estado Actualizado!', 'Estado actualizado correctamente.');


        $sewers = DB::table('sewers')->where('status', 1)->get();
        $sewers2 = DB::table('sewers')->where('status', 2)->get();
        $sewers3 = DB::table('sewers')->where('status', 3)->get();
        return view('alerts.index', compact('sewers','sewers2','sewers3'));
    }

    public function fixing(Request $request)
    {
        // $sasd = DB::table('sewers')->where('id', 26)->pluck('status');
        // dd($sasd);
       $id=$request->idcompliment2;
        $status = $request->fixingbtn;
        $swr = Sewer::findOrFail($id);
        $swr->status = $status;
        $swr->save();
            
        Alert::success('¡Estado Actualizado!', 'Estado actualizado correctamente.');


        $sewers = DB::table('sewers')->where('status', 1)->get();
        $sewers2 = DB::table('sewers')->where('status', 2)->get();
        $sewers3 = DB::table('sewers')->where('status', 3)->get();
        return view('alerts.index', compact('sewers','sewers2','sewers3'));
    }
}
