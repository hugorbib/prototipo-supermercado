<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use App\Complaint;
use App\Unconfirmed;
use Twilio\Rest\Client;
use RealRashid\SweetAlert\Facades\Alert;
use Mail;


class ComplaintsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $complaints = DB::table('complaints')->where('status', 1)->get();
        $complaints2 = DB::table('complaints')->where('status', 2)->get();
        $complaints3 = DB::table('complaints')->where('status', 3)->get();
        return view('complaints.index', compact('complaints','complaints2','complaints3'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('complaints.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $confirmation = DB::table('unconfirmeds')->latest()->pluck('code')->first();
        $code = $request->authnumber;

        if ($confirmation == $code) {        
            if ($request->hasFile('img')) {

            $filename = $request->img->getClientOriginalName();
            $request->file('img')->storeAs('public', $filename);

                $comp=new Complaint;
                $comp->img = $filename;
                $comp->name = $request->name;
                $comp->lastname = $request->lastname;
                $comp->email = $request->email;
                $comp->phone = $request->phone;
                $comp->ref = $request->ref;
                $comp->latitude = $request->latitude;
                $comp->length = $request->length;
                $comp->description = $request->description;
                $comp->save();
                Alert::success('¡Mensaje Enviado!', 'Su denuncia ha sido registrada correctamente.');

                $email = $request->email;
                Mail::send('complaints.mailconfirmation', $request->all(), function($message) use ($email){
                    $message->from('asapfergsleepy@gmail.com', 'Gestion de Colectores Pluviales');
                    $message->subject('CONFIRMACIÓN DE RECEPCIÓN');
                    $message->to($email);
                });
                return view('complaints.received');

            }
            else {
                // Alert::success('Denuncias Registrada!');
                // alert()->success('Success Message', 'Optional Title');

                $comp=new Complaint;
                $comp->name = $request->name;
                $comp->img = $request->img;
                $comp->lastname = $request->lastname;
                $comp->email = $request->email;
                $comp->phone = $request->phone;
                $comp->ref = $request->ref;
                $comp->latitude = $request->latitude;
                $comp->length = $request->length;
                $comp->description = $request->description;
                $comp->save();
                Alert::success('¡Mensaje Enviado!', 'Su denuncia ha sido registrada correctamente.');

                $email = $request->email;
                Mail::send('complaints.mailconfirmation', $request->all(), function($message) use ($email){
                    $message->from('asapfergsleepy@gmail.com', 'Gestion de Colectores Pluviales');
                    $message->subject('CONFIRMACIÓN DE RECEPCIÓN');
                    $message->to($email);
                });
                return view('complaints.received');

            }
            
        }
        else {
            $confirmation = DB::table('unconfirmeds')->latest()->first();
             Alert::error('Error', 'El número introducido no coincide, verifique e intente nuevamente');
            return view('complaints.confirm', compact('confirmation'));
        }
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
        $status = $request->radiobt;
        
        $complaint = Complaint::findOrFail($id);
        $complaint->status = $status;
        $complaint->save();
        Alert::success('¡Estado Actualizado!', 'Estado actualizado correctamente.');


        $complaints = DB::table('complaints')->where('status', 1)->get();
        $complaints2 = DB::table('complaints')->where('status', 2)->get();
        $complaints3 = DB::table('complaints')->where('status', 3)->get();
        
        return view('complaints.index', compact('complaints','complaints2','complaints3'));
    }
    public function fixing(Request $request)
    {
        $email = $request->mailcompliment2;
        // dd($email);
        
        $id=$request->idcompliment2;

        $status = $request->fixingbtn;
        
        $complaint = Complaint::findOrFail($id);
        $complaint->status = $status;
        $complaint->save();
        if ($status == 3) {
            
        Alert::success('¡Estado Actualizado!', 'SE NOTIFICÓ MEDIANTE EMAIL AL EMISOR.');

        Mail::send('complaints.mailsolved', $request->all(), function($message) use ($email){
            $message->from('asapfergsleepy@gmail.com', 'Gestion de Colectores Pluviales');
            $message->subject('RESOLUCIÓN DE DENUNCIA');
            $message->to($email);
        });
        }

        $complaints = DB::table('complaints')->where('status', 1)->get();
        $complaints2 = DB::table('complaints')->where('status', 2)->get();
        $complaints3 = DB::table('complaints')->where('status', 3)->get();
        
        return view('complaints.index', compact('complaints','complaints2','complaints3'));
    }
    
    public function sendsms(Request $request)
    {

        $this->validate($request, [
            'name' => 'required|alpha',
            'lastname' => 'required|alpha',
            'phone' => 'required|numeric',
            'email' => 'required|email',
        ]);

        $phonenumber = $request->phone;
        $auth = rand(53500000, 99999999);

        $sid='AC1374e4f02903ba717b5ecac69af65645';
        $token='803d6a917fbb75d0ef1a942c084cf87b';
        $client= new Client($sid, $token);

        $client->messages->create(
            '+591'.$phonenumber,
            array(
                'from' => '+13345106761',
                'body' => 'Su código de confirmación es: '.$auth
            )
        );
        

        if ($request->hasFile('img')) {
            $filename = $request->img->getClientOriginalName();
            $request->file('img')->storeAs('public', $filename);
    
            $comp=new Unconfirmed;
            $comp->img = $filename;
            $comp->name = $request->name;
            $comp->lastname = $request->lastname;
            $comp->email = $request->email;
            $comp->phone = $request->phone;
            $comp->ref = $request->ref;
            $comp->latitude = $request->latitude;
            $comp->length = $request->length;
            $comp->description = $request->description;
            $comp->code = $auth;            
            $comp->save();
            }
            else {
            Unconfirmed::create($request->all());
            }
            $confirmation = DB::table('unconfirmeds')->latest()->first();
            return view('complaints.confirm', compact('confirmation'));
    }
    public function generatePDF()
    {
        $complaints = DB::table('complaints')->where('status', 1)->get();
        $pdf = PDF::loadView('complaints.pdf', compact('complaints'));
        return $pdf->stream('Denuncias.pdf', array('Attachment' => 0));
        set_time_limit(10);
    }
    public function generatePDFfixing()
    {
        $complaints = DB::table('complaints')->where('status', 2)->get();
        $pdf = PDF::loadView('complaints.pdf', compact('complaints'));
        return $pdf->stream('Denuncias.pdf', array('Attachment' => 0));
        set_time_limit(10);
    }
    public function generatePDFsolved()
    {
        $complaints = DB::table('complaints')->where('status', 3)->get();
        $pdf = PDF::loadView('complaints.pdf', compact('complaints'));
        return $pdf->stream('Denuncias.pdf', array('Attachment' => 0));
        set_time_limit(10);
    }
}

