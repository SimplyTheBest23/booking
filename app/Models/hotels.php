<?php

namespace Svityaz\Models;

use Illuminate\Database\Eloquent\Model;
use Svityaz\Models\phone;

class hotels extends Model
{
    //
    protected $table = 'hotels';
    static function list($page, $filter = false){
    $fil = '';
    $ord = '';
    //return $filter['text'];
    if ($filter){
        $filter['text'] = trim($filter['text']);
        if ($filter['text']!=""){
            $fil = ' and hotels.title like "%'.$filter['text'].'%"';
        } else{
            if ($filter['city_id']>0){
                $fil .= ' and hotels.city_id='.$filter['city_id'];
            }
            if ($filter['hotel_type_id']>0){
                $fil .= ' and hotels.hotel_type_id='.$filter['hotel_type_id'];
            }
            if ($filter['beds']>0){
                $fil .= ' and rooms.beds='.$filter['beds'];
            }
            if ($filter['bath']>0){
                $fil .= ' and rooms.bath=1';
            }
            if ($filter['wc']>0){
                $fil .= ' and rooms.wc=1';
            }
            if ($filter['cond']>0){
                $fil .= ' and rooms.cond=1';
            }
            if ($filter['tv']>0){
                $fil .= ' and rooms.tv=1';
            }
            if ($filter['wifi']>0){
                $fil .= ' and rooms.wifi=1';
            }
            if ($filter['kitchen']>0){
                $fil .= ' and rooms.kitchen=1';
            }
            if ($filter['reight']>0){
                $ord .= ',hotels.plus ASC ';
            }
            if ($filter['sort']==1){
                $ord .= ',hotels.price ASC ';
            }
            if ($filter['sort']==2){
                $ord .= ',hotels.price DESC ';
            }
        }
    }
        $num = 5;
        $c = \DB::select('select count(hotels.id) as c from hotels where hotels.id in (select hotels.id from hotels, rooms where rooms.hotel_id=hotels.id '.$fil.' group by hotels.id)');
        $count = $c[0]->c;//всего позиций
        $pages = ceil($count / $num);//всего страниц
        $pagg ='<ul class="pagg" id="hotel_pagg">';
        if ($page == 1){
            $pagg .= '<li class="disabled"><a href="#" id="prev_hotel"><</a></li>';
        } else {
            $pagg .= '<li><a href="#" id="prev_hotel"><</a></li>';
        }
        switch ($pages){
            case 0:
                $pagg .= '<li><a href="#">1</a></li>';
                break;
            case 1:
                $pagg .= '<li><a href="#">1</a></li>';
                break;
            case 2:
                $pagg .= '<li><a href="#">1</a></li>';
                $pagg .= '<li><a href="#">2</a></li>';
                break;
            default:
                if ($page == 1){
                    $a1 = 1;
                    $a2 = 2;
                    $a3 = 3;
                } elseif ($page == $pages) {
                    $a1 = $page-2;
                    $a2 = $page-1;
                    $a3 = $page;
                } else {
                    $a1 = $page-1;
                    $a2 = $page;
                    $a3 = $page+1;
                }
                $pagg .= '<li><a href="#">'.$a1.'</a></li>';
                $pagg .= '<li><a href="#">'.$a2.'</a></li>';
                $pagg .= '<li><a href="#">'.$a3.'</a></li>';
                break;
        }
        if ($page == $pages){
            $pagg .= '<li class="disabled"><a href="#" id="next_hotel">></a></li>';
        } else {
            $pagg .= '<li><a href="#" id="next_hotel">></a></li>';
        }
        $s = 'select DISTINCT hotels.id as h_id from hotels, rooms';
        $s .= ' where hotels.id=rooms.hotel_id '.$fil;

        $row = \DB::select($s);
        $imp ='';
        foreach ($row as $r) {
            if ($imp!=''){
                $imp .= ',';
            }
            $imp .= $r->h_id;
        }
        if ($imp==''){
            $imp = 0;
        }
        $sel = 'select * from hotels, users';
        $sel .= ' where hotels.user_id=users.id and hotels.id in ('.$imp.')';
        $sel .= ' order by hotels.date_vip ASC, hotels.date_top ASC, hotels.date_pay ASC, hotels.date_up ASC ';
        $sel .= $ord.' limit ' . (($page - 1) * $num) . ',' .$num;
        $list = \DB::select($sel);
        for ($i=0; $i < count($list); $i++) {
            $phone = phone::where('user_id','=',$list[$i]->user_id)->first();
            $list[$i]->phone= $phone->phone;
        }
        $data = ['list'=>$list, 'pagg'=>$pagg,'count'=>$count];
        return $data;
    }
}
