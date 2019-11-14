<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\OrderConfirmation;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail($id){
        try{
            $testname="maximilian";
            $testaddress="maxbfrecka@gmail.com";
            $data = array('name'=>$testname, 'email'=>$testaddress);
            Mail::send('emails.testemail', $data, function($message) use ($data){
                $message->to($data['email'],$data['name'])->subject('Test Subject YO');
            });   
            //alert()->success('Emails Sending Complete','Messages sent');
            return redirect()->route('albums.albums');
        }catch (Exception $e){

        }
        
    }




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
}
