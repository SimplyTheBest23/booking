@extends('layouts.admin')

@section('content')

<div id="editModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal hotel content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Редактировать</h4>
      </div>
      <div class="modal-body">
        <form id="edit_form">
        	<input type="hidden" id="edit_id" name="edit_id">
        	<label class="form-inline">Название <input type="text" class="form-control" id="edit_name" name="tittle"></label>
        	<select name="htype" id="htype" class="form-control">
				<option value="0">Выберите тип жилья</option>
				@foreach ($hotel_types as $type)
					<option value="{{$type->id}}">{{$type->hotel_type}}</option>
				@endforeach
			</select>
			<select name="city" id="city" class="form-control">
				<option value="0">Выберите населённый пункт</option>
				@foreach ($cities as $city)
					<option value="{{$city->id}}">{{$city->city}}</option>
				@endforeach
			</select>
			<input type="text" placeholder="адрес..." class="form-control" id="edit_address" name="address">
			<textarea class="form-control" rows="10" id="edit_text" name="text">
			</textarea>
			<label class="form-inline">Дата создания<input type="date" class="form-control" id="create_date" name="create_date"></label><br>
			<label class="form-inline">Дата окончания<input type="date" class="form-control" id="date_out" name="date_out"></label><br>
			<label class="form-inline">Дата платного<input type="date" class="form-control" id="date_pay" name="date_pay"></label><br>
			<label class="form-inline">Дата ТОП<input type="date" class="form-control" id="date_top" name="date_top"></label><br>
			<label class="form-inline">Дата VIP<input type="date" class="form-control" id="date_vip" name="date_vip"></label>
        </form>
      </div>
      <div class="modal-footer">
      <button type="button" class="btn btn-success" id="save_but">Сохранить</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
      </div>
    </div>

  </div>
</div>


<!-- end modal -->

<div id="roomsModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal rooms list content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Комнаты</h4>
      </div>
      <div class="modal-body">
      	<form action="" id="room_form">
      		<div class="row">
				<div class="col-md-6" id="room_edit">
					<input type="text" placeholder="название..." class="form-control" name="room_name" id="room_name">
					<input type="text" placeholder="цена...грн" class="form-control" name="room_price" id="room_price">
					<input type="text" placeholder="спальных мест" class="form-control" name="room_places" id="room_places">
					<input type="hidden" id="room_id" name="room_id" value="0">
					<input type="hidden" id="hotel_id" name="hotel_id" value="">
					<input type="submit" id="save_room" value="сохратить" class="btn btn-success">

				</div>
				<div class="col-md-6" id="features">

				</div>
			</div>
		</form>
	</div>
        <table class="table table-striped" id="rooms_list">
        	<tbody>

        	</tbody>
        </table>
      </div>
      <div class="modal-footer">

      </div>
    </div>

  </div>
</div>


<!-- end modal -->

<h1 class="h3">Объявления</h1>
<table class="table table-striped" id="add_list">
	<tbody>
		@foreach ($hotels as $hotel)
				<tr>
					<td>{{$hotel->id}} </td>
					<td>{{$hotel->title}} </td>
					<td>{{$hotel->phone}} </td>
					@if (strtotime($hotel->date_vip)>time())
						<td>платное</td>
					@else
						<td>бесплатное</td>
					@endif
					<td>
						<button class="btn btn-xs btn-success">поднять</button>
						<button class="btn btn-xs btn-danger" id="del{{$hotel->id}}">удалить</button>
						<button class="btn btn-xs btn-success">продлить</button>
						<button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#editModal" id="edit{{$hotel->id}}">
							редактировать
						</button>
						<button class="btn btn-xs btn-info">просмотреть</button>
						<button class="btn btn-xs btn-success">VIP</button>
						<button class="btn btn-xs btn-success">TOP</button>
						<button class="btn btn-xs btn-success">Сделать платным</button>
						<button class="btn btn-xs btn-info" data-toggle="modal" data-target="#roomsModal" id="rooms{{$hotel->id}}">
							комнаты
						</button>
					</td>
				</tr>
			@endforeach
	</tbody>
	<thead>
		<tr>
			<th>№</th>
			<th>Название</th>
			<th>Телефон</th>
			<th>Платное</th>
			<th>Действия</th>
		</tr>
	</thead>
</table>
<form class="form-inline text-center">
	<input type="text" class="form-control" id='filter'>
	<input type="submit" value="найти" class="form-control" id="find">
</form>
<script src="{{ url('js/admin_ads.js')}}"></script>
@endsection
