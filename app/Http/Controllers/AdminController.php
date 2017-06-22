<?php

namespace Svityaz\Http\Controllers;

use Illuminate\Http\Request;
use Svityaz\Models\sms as SmsModel;
use Svityaz\Models\hotelTypes;
use Svityaz\Models\genpass;
use Svityaz\Models\sms_code;
use Svityaz\Models\cities;
use Svityaz\Models\beach;
use Svityaz\User;
use Svityaz\Models\hotels;
use Svityaz\Models\rooms;
use Svityaz\Models\phone;
use Svityaz\Models\feed;
use Svityaz\Models\visit;

class AdminController extends Controller
{
    //
    public function index(Request $request)
    {
        $data = [];
        return view('admin/index', $data);
    }
    public function statistic(Request $request)
    {
        $active = hotels::where('date_out', '>', date('Y-m-d H:i:s',time()))->count();
        $passive = hotels::where('date_out','<', date('Y-m-d H:i:s',time()))->count();
        $all_adds = $passive+$active;
        $all_hotel = hotels::count();
        $all_visits = visit::sum('visits');
        $visit24 = visit::where('updated_at','>',date('Y-m-d H:i:s',time()-24*60*60))->sum('visits');
        $visit1 = visit::where('updated_at','>',date('Y-m-d H:i:s',time()-60*60))->sum('visits');
        $client = new \SoapClient('http://turbosms.in.ua/api/wsdl.html');
        $auth = [
        'login' => 'SiriusWiFi',
        'password' => 'babka007',
        ];
        $client->Auth($auth);
        $sms_amount = $client->GetCreditBalance();
        $sms_all = SmsModel::where('turbo_id','!=','null')->count();
        $data = ['active'=>$active,
                'passive'=>$passive,
                'all_adds'=>$all_adds,
                'all_hotels'=>$all_hotel,
                'all_visits'=>$all_visits,
                'visit24'=>$visit24,
                'visit1'=>$visit1,
                'sms_amount'=>$sms_amount,
                'sms_all'=>$sms_all,
        ];
        return view('admin/statistic', $data);
    }
    public function hotels(Request $request)
    {
        $hotel_types = hotelTypes::get();
        $hotels = hotels::get();
        for ($i=0; $i<count($hotels);$i++){
            $hotels[$i]->phone = phone::where('user_id','=',$hotels[$i]->user_id)->first()->value('phone');
        }
        $cities = cities::get();
        $data = ['hotels'=>$hotels,
                'hotel_types'=>$hotel_types,
                'cities'=>$cities,
        ];
        return view('admin/hotels', $data);
    }
    public function pays(Request $request)
    {
        $data = [];
        return view('admin/pays', $data);
    }
    public function paidservices(Request $request)
    {
        $data = [];
        return view('admin/paidservices', $data);
    }
    public function features(Request $request)
    {
        $data = [];
        return view('admin/features', $data);
    }
    public function sms(Request $request)
    {
        $data = [];
        return view('admin/sms', $data);
    }
    public function cities(Request $request)
    {
        $data = [];
        return view('admin/cities', $data);
    }
    public function other(Request $request)
    {
        $data = [];
        return view('admin/other', $data);
    }

    public function hotelinfo(Request $request)
    {
        $hotel = hotels::find($request->hotel_id);
        echo json_encode($hotel);
    }

    public function roomsInfo(Request $request)
    {
        $rooms = rooms::where('hotel_id', $request->id)->get();
        echo json_encode($rooms);
    }
}
