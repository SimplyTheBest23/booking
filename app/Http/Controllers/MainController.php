<?php

namespace Svityaz\Http\Controllers;

//use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Svityaz\Models\sms as SmsModel;
use Svityaz\Models\hotelTypes;
use Svityaz\Models\genpass;
use Svityaz\Models\sms_code;
use Svityaz\Models\cities;
use Svityaz\Models\beach;
use Svityaz\User;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Svityaz\Models\hotels as HotelModel;
use Svityaz\Models\rooms;
use Svityaz\Models\phone;
use Svityaz\Models\feed;
use Svityaz\Models\visit;
use Illuminate\Support\Facades\Cache;

class MainController extends Controller
{
    public function checkCode(Request $request)//проверяет код из СМС
    {
        $phone = $request->phone;
        $code = sms_code::where('phone', '=', $phone)->first();
        if (!$code){//телефон не найден
            echo false;
        } else {
            if (strtoupper($request->code) == $code->code){
                echo true; //код правильный
            } else {
                echo false; //код неправильный
            }
        }
    }

    public function addphoto(Request $request)//добавляем фото
    {
		$path = $request->file(0)->store('images');
        echo $path;
    }

    public function selectCityMap(Request $request)//получаем координаты города по id
    {
        $city = cities::find($request->city);
        echo json_encode(["lng"=>$city->gps_alt, "lat"=>$city->gps_lng]);
    }

    public function getBeach()//выдаёт все точки пляжа
    {
        $all = beach::all();
        echo json_encode($all);
    }

    public function publishHotel(Request $request)
    {
        if (!preg_match('/^\d{12}$/i' , $request->user['phone'])) return 'error';
        if (!preg_match('/^\w{2,20}$/i' , $request->user['name'])) return 'error';
        if (!preg_match('/^\w{2,30}$/i' , $request->hotel['title'])) return 'error';
        if (!preg_match('/^\w{5,50}$/i' , $request->hotel['address'])) return 'error';
        if (!preg_match('/^\w{2,249}$/i' , $request->hotel['about'])) return 'error';
        if (!preg_match('/^\d{1,4}$/i' , $request->hotel['price'])) return 'error';
        if (!preg_match('/^\d{1,4}$/i' , $request->hotel['to_beach'])) return 'error';
        if (!preg_match('/^\d{1,4}$/i' , $request->hotel['to_shop'])) return 'error';
        if (!preg_match('/^\d{1,4}$/i' , $request->hotel['to_rest'])) return 'error';
        if (!preg_match('/^\d{1,4}$/i' , $request->hotel['to_bath'])) return 'error';
        if (!preg_match('/^\d{1,4}$/i' , $request->hotel['to_disco'])) return 'error';
        if (!preg_match('/^\d{1,3}$/i' , $request->hotel['lux'])) return 'error';
        if (!preg_match('/^\d{1,3}$/i' , $request->hotel['rooms'])) return 'error';
        $old_phone = phone::where('phone','=',$request->user['phone'])->first();
        if ($old_phone){
            $user = User::find($old_phone->user_id);
        } else{
            $user = new User;
            $user->name = $request->user['name'];
            $user->role =1;
            $user->password = genpass::genPass();
            $user->save();
            session(['user_id' => $user->id]);
            $new_phone = new phone;
            $new_phone->phone = $request->user['phone'];
            $new_phone->user_id = $user->id;
            $new_phone->save();
        }
        $hotel = new HotelModel;
        $hotel->city_id = $request->hotel['city_id'];
        $hotel->bath = $request->hotel['bath'];
        $hotel->parking = $request->hotel['parking'];
        $hotel->kitchen = $request->hotel['kitchen'];
        $hotel->altan = $request->hotel['altan'];
        $hotel->kids = $request->hotel['kids'];
        $hotel->hotel_type_id = $request->hotel['hotel_type_id'];
        $hotel->gps_alt = $request->hotel['gps_alt'];
        $hotel->gps_lng = $request->hotel['gps_lng'];
        $hotel->title = $request->hotel['title'];
        $hotel->address = $request->hotel['address'];
        $hotel->rooms = $request->hotel['rooms'];
        $hotel->lux = $request->hotel['lux'];
        $hotel->about = $request->hotel['about'];
        $hotel->price = $request->hotel['price'];
        $hotel->user_id = $user->id;
        $hotel->price_type = $request->hotel['price_type'];
        $hotel->to_beach = $request->hotel['to_beach'];
        $hotel->to_shop = $request->hotel['to_shop'];
        $hotel->to_disco = $request->hotel['to_disco'];
        $hotel->to_rest = $request->hotel['to_rest'];
        $hotel->to_bus = $request->hotel['to_bus'];
        $hotel->date_out = date("Y-m-d H:i:s",time()+15*24*60*60);
        $hotel->date_pay = date("Y-m-d H:i:s",time()-1);
        $hotel->date_vip = date("Y-m-d H:i:s",time()-1);
        $hotel->date_top = date("Y-m-d H:i:s",time()-1);
        $hotel->date_up = date("Y-m-d H:i:s",time());
        $count_photos = count($request->hotel['photos']);
        if ($count_photos>0){
            $hotel->foto1 = $request->hotel['photos'][0];
        }
        if ($count_photos>1){
            $hotel->foto2 = $request->hotel['photos'][1];
        }
        if ($count_photos>2){
            $hotel->foto3 = $request->hotel['photos'][2];
        }
        if ($count_photos>3){
            $hotel->foto4 = $request->hotel['photos'][3];
        }
        if ($count_photos>4){
            $hotel->foto5 = $request->hotel['photos'][4];
        }
        $hotel->save();

        foreach ($request->rooms as $rroom) {
            if (!preg_match('/^\w{1,30}$/i' , $rroom['title'])) return 'error';
            if (!preg_match('/^\d{1,4}$/i' , $rroom['price'])) return 'error';
            if (!preg_match('/^\w{5,249}$/i' , $rroom['about'])) return 'error';
            $room = new rooms;
            $room->hotel_id = $hotel->id;
            $room->title = $rroom['title'];
            $room->beds = $rroom['beds'];
            $room->price = $rroom['price'];
            $room->price_type = $rroom['price_type'];
            $room->about = $rroom['about'];
            $room->wc = $rroom['wc'];
            $room->bath = $rroom['bath'];
            $room->tv = $rroom['tv'];
            $room->cond = $rroom['cond'];
            $room->holo = $rroom['holo'];
            $room->kitchen = $rroom['kitchen'];
            $room->wifi = $rroom['wifi'];
            $count_photos = count($rroom['photos']);
            if ($count_photos>0){
                $room->foto1 = $rroom['photos'][0];
            }
            if ($count_photos>1){
                $room->foto2 = $rroom['photos'][1];
            }
            if ($count_photos>2){
                $room->foto3 = $rroom['photos'][2];
            }
            if ($count_photos>3){
                $room->foto4 = $rroom['photos'][3];
            }
            if ($count_photos>4){
                $room->foto5 = $rroom['photos'][4];
            }
            $room->save();
        }
        echo $hotel->date_out;
    }

    public function login(Request $request)
    {

        if (session('user_id')){
            //alerady in
            echo true;
        } else{
            if (!preg_match('/^\d{12}$/i' , $request->phone)) return 'error';
            if (!preg_match('/^\w{2,50}$/i' , $request->password)) return 'error';
            $phone = phone::where('phone','=',$request->phone)->first();
            if ($phone){
                $user = User::find($phone->user_id);
                //echo $user->password;
                if (strtoupper($request->password) == $user->password){
                        session(['user_id' => $user->id]);
                        echo true;
                    }
                else{
                    echo false;//bad pass
                }
            } else {
                echo false;//not user
            }
        }
    }

    public function setCode(Request $request)//устанавливаем новый пароль
    {
        if (!preg_match('/^\d{12}$/i' , $request->phone)) return 'error';
        $phone = phone::where('phone','=',$request->phone)->first();
        if ($phone){//телефон есть в базе
            $user = User::find($phone->user_id);

        } else {//телефона нет в базе
            $user = new User;
            $user->name = 'Новий користувач';
            $user->role =1;
        }
        $code = genpass::genPass();
        $user->password = $code;
        $user->save();
        SmsModel::send($request->phone, 'пароль:'.$code, 'пароль');
        echo $user->name;
    }

    public function putFeed(Request $request)
    {
        if (!preg_match('/^\d{12}$/i' , $request->phone)) return 'error';
        if (!preg_match('/^\w{2,30}$/i' , $request->name)) return 'error';
        if (!preg_match('/^\w{2,249}$/i' , $request->comment)) return 'error';
        $new = true;
        $hotel = HotelModel::find($request->hotel_id);
        $user = User::find($hotel->user_id);//хозяин
        $phones = phone::where('user_id','=',$user->id)->get();
        foreach ($phones as $p) {
            if ($p->phone == $request->phone){
                $new = false;
            }
        }
        $now = User::getCurrent();
        if ($now){
            if ($now->id == $hotel->user_id){
                $new = false;
            }
        }
        if ($new){
            $feed = new feed;
            $feed->phone = $request->phone;
            $feed->name = $request->name;
            $feed->reight = $request->reight;
            $feed->comment = $request->comment;
            $feed->hotel_id = $request->hotel_id;
            $feed->status =1;
            $feed->save();
            $phone = phone::where('user_id','=',$user->id)->first();
            SmsModel::send($phone->phone, 'новий відгук по '.$hotel->title, 'відгук');
        } else{
            SmsModel::send($request->phone, 'відгук на своє оголошення!', 'блок відгука');
        }
        $feeds = feed::where('hotel_id','=',$hotel->id)->latest()->take(4)->get();
        echo json_encode($feeds);
    }

    public function feedsList(Request $request)
    {
        $feeds = feed::where('hotel_id','=',$request->hotel_id)->get();
        echo json_encode($feeds);
    }

    public function feedsSave(Request $request)
    {
        $feed = feed::find($request->id);
        $feed->status = $request->status;
        $feed->save();
        echo "ok";
    }

    public function cabinet(){
        $user = User::find(session('user_id'));
        $phones = phone::where('user_id','=',$user->id)->get();
        $hotels = HotelModel::where('user_id','=',$user->id)->get();
        $cities = cities::all();
        $hotel_types = hotelTypes::all();
        $data =[
            'user'=>$user,
            'phones'=>$phones,
            'cities'=>$cities,
            'htypes'=>$hotel_types,
            'hotels'=>$hotels,
            'cuser'=>User::getCurrent(),
        ];
        return view('cabinet', $data);
    }

    public function testPost(Request $request)
    {
        echo 'start';
        $user = $request->user;
        var_dump($user['name']);
        if (!preg_match('/^\w{1,5}$/i' , $user['name'])) return 'error';
        echo ' end';
    }

    public function testGet()
    {
        echo 'start... ';
        $client = new SoapClient('http://turbosms.in.ua/api/wsdl.html');
        echo $client->__getFunctions();
    }

    public function saveUserData(Request $request)
    {
        if (!preg_match('/^\w{2,30}$/i' , $request->change_user_name)) return 'error';
        $name = $request->change_user_name;
        if (strlen($name)<3){
            return false;
        } else {
            $user = User::find(session('user_id'));
            $user->name = $name;
            $user->save();
        }
        $phones = $request->phones;
        if ($phones){
            $first = phone::where('user_id','=',session('user_id'))->first();
            $first_phone = $first->phone;
            phone::where('user_id','=',session('user_id'))->delete();
            phone::insert([
                'user_id'=>session('user_id'),
                'phone'=>$first_phone
            ]);
            foreach($phones as $phone){
                $del=['(',' ',')','+','-'];
                $p = str_replace($del, "", $phone);
                if ($p<999999999999 && $p>99999999999){
                    $find = phone::where('phone','=',$p)->first();
                    if (!$find){
                        $new_phone = new phone;
                        $new_phone->user_id = session('user_id');
                        $new_phone->phone = $p;
                        $new_phone->save();
                    }
                }
            }
        }
        echo "OK";
    }
}
