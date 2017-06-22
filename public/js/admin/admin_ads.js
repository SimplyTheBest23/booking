(function($){$(function(){
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('#find').click(function(){
	var filter=$('#filter').val();
	if (filter!='')	adds_filter(filter);
	return false;
});

function adds_filter(filter){
	$.ajax({
		url:'../ajax/filterHotels',
		type:'POST',
		data:'filter='+filter,
		success: function(list){
			$('#add_list tbody').html(list);
			add_click();
		}
	})
}

function add_click(){
	$('#add_list button[id^="edit"]').each(function(){// tested
		$(this).click(function(){
			var id=$(this).attr('id').substr(4);
			adInfo(id);
		});
	});

	$('#add_list button[id^="rooms"]').each(function(){
		$(this).click(function(){
			var id=$(this).attr('id').substr(5);
			rooms(id);
		});
	});

	$('#add_list button[id^="del"]').each(function(){
		$(this).click(function(){
			var id=$(this).attr('id').substr(3);
			console.log('delete',id);
			return false;
		});
	});
}

function room_click(){
	$('#rooms_list button[id^="room_e"]').each(function(){
		$(this).click(function(){
			var id=$(this).attr('id').substr(6);
			load_room(id);
			load_features(id);
		});
	});

	$('#rooms_list button[id^="room_d"]').each(function(){
		$(this).click(function(){
			var id=$(this).attr('id').substr(6);
			room_del(id);
		});
	});
}

function load_room(id) {
	$.ajax({
		url:'../ajax/roominfo1',
		type:'POST',
		data:'id='+id,
		success: function(data){
			data=JSON.parse(data);
			$('#room_name').val(data.name);
			$('#room_price').val(data.price);
			$('#room_places').val(data.places);
			$('#room_id').val(data.id);
			$('#hotel_id').val(data.hotel_id);
			$('#room_form').show();
			console.log(data.status_id);
			$('#room_status option').each(function(){
				if ($(this).val()==data.status_id) $(this).attr('selected','selected');
					else $(this).removeAttr('selected');
			});
		}
	});
}

function load_features(id) {
	$.ajax({
		url:'../ajax/roomFeachures',
		type:'POST',
		data:'id='+id,
		success: function(data){
			$('#features').html(data);
		}
	});
}

function room_del(id) {
	$.ajax({
		url:'../rooms/'+id,
		type:'DELETE',
		success: function(data){
			console.log(data);
		}
	});
}

add_click();

function adInfo(id){
	$.ajax({
		url: baseUrl+'admin/hotelinfo',
		type:'POST',
		data:'hotel_id='+id,
		success: function(data){
			var add=JSON.parse(data);
			$('#edit_name').val(add.title);
			$('#edit_address').val(add.address);
			$('#edit_id').val(add.id);
			$('#edit_text').val(add.about);
			var date=new Date(add.created_at);
			$('#create_date').val(date.toISOString().substr(0,10));
			var date=new Date(add.date_out);
			$('#date_out').val(date.toISOString().substr(0,10));
			var date=new Date(add.date_pay);
			$('#date_pay').val(date.toISOString().substr(0,10));
			var date=new Date(add.date_top);
			$('#date_top').val(date.toISOString().substr(0,10));
			var date=new Date(add.date_vip);
			$('#date_vip').val(date.toISOString().substr(0,10));
			$('#htype option').each(function(){
				if ($(this).val()==add.hotel_type_id) $(this).attr('selected','selected');
			});
			$('#city option').each(function(){
				if ($(this).val()==add.city_id) $(this).attr('selected','selected');
			});
			//console.log(data);
		}
	})
}

function rooms(id){
	$('#room_form').hide();
	$.ajax({
		url: baseUrl+'admin/roomsinfo',
		type:'POST',
		data:'id='+id,
		success: function(data){
            //console.log(data);
            room = JSON.parse(data);
            var list = '';
            for(i=0; i<room.length; i++){
                list += '<tr class="ponter">';
                list +='<td class="hidden">'+room[i].id+'</td>';
                list +='<td>'+room[i].title+'</td>';
                list +='<td>'+room[i].beds+' сп.м.</td>';
                list +='<td>'+room[i].price+' грн.</td>';
                var url= 'room/'+room[i].id;
                list +='<td><a href="'+url+'" class="btn btn-info btn-xs"><span class="glyphicon glyphicon-info-sign"></span></a</td>';
                list +='<td><button id="room_e'+room[i].id+'" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></td>';
                list +='<td><button id="room_d'+room[i].id+'" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span></button></td>';
                list +='</tr>';
            }
			$('#rooms_list tbody').html(list);
			room_click();
		}
	})
}

$('#save_but').click(function(){
	var form=$('#edit_form').serialize();
	$.ajax({
		url:'../ajax/editHotel',
		type:'POST',
		data:form,
		success: function(info){
			adds_filter($('#filter').val());
		}
	})
});

$('#save_room').click(function(){
	var form=$('#room_form').serialize();
	$.ajax({
		url:'../rooms/'+$('#room_id'),
		type:'PUT',
		data:form,
		success: function(info){
			console.log(info);
			rooms($('#hotel_id').val());
			$('#room_form').show();
		}
	})

	return false;
});

})})(jQuery)
