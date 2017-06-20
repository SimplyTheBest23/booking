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
	$('#add_list button[id^="edit"]').each(function(){
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

function adInfo(id){//проверено
	$.ajax({
		url:'../ajax/hotelinfo',
		type:'POST',
		data:'id='+id,
		success: function(data){
			var add=JSON.parse(data);
			$('#edit_name').val(add.name);
			
			$('#edit_address').val(add.address);
			$('#edit_id').val(add.id);
			$('#edit_text').val(add.text);
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
				if ($(this).val()==add.type_id) $(this).attr('selected','selected');
			});
			$('#city option').each(function(){
				if ($(this).val()==add.city_id) $(this).attr('selected','selected');
			});
			$('#status option').each(function(){
				if ($(this).val()==add.status_id) $(this).attr('selected','selected');
			});
		}
	})	
}

function rooms(id){
	$('#room_form').hide();
	$.ajax({
		url:'../ajax/roomsInfo',
		type:'POST',
		data:'id='+id,
		success: function(data){
			$('#rooms_list tbody').html(data);
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
