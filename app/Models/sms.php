<?php

namespace Svityaz\Models;

use Illuminate\Database\Eloquent\Model;

class sms extends Model
{
    protected $table="sms";

    static function send($destination,$message,$about=''){
	    $data=array('destination'=>$destination,'message'=>$message,'about'=>$about);
	    /*$validator = Validator::make($data, [
	    	'message'=>'required|min:5',
	    	'destination'=>'numeric|min:10000000|max:999999999'
	    	]);
	    if ($validator->fails()==true) return false;*/
	    \DB::table('sms')->insert([
	    	'destination'=>$destination,
	    	'message'=>$message,
	    	'about'=>$about,
	    	'created_at'=>date('Y-m-d H:i:s',time()),
	    ]);
	    session(['sms_mess'=>$message]);
      session(['sms_phone'=>$destination]);
	    return true;
    }
}
