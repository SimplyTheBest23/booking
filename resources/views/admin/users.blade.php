@extends('layouts.app')

@section('content')
<h1 class="h1 text-success">Администрирование объявления</h1>
<ul class="breadcrumb">
  <li><a href="{{url('/home')}}">Главная</a></li>
  <li><a href="{{url('admin/index')}}">Администрирование</a></li>
  <li class="active">пользователи</li> 
</ul>
<div class="row">
	
	<div class="col-md-3">
		<table id="user_list" class="table table-striped">
			@foreach ($users as $user)
				<tr class="pointer">
					<td class="hidden">{{$user->id}}</td>
					<td>{{$user->name}}</td>
					<td>{{$user->tel1}}</td>
					<td>{{$user->email}}</td>
					<td>{{$user->status()->value('status')}}</td>
				</tr>
			@endforeach
		</table>
	</div>
	<div class="col-md-3">
		<div id="user_info">
			<h4 id="user_name">Имя: <span></span></h3>
			<p id="user_tel1">тел 1: <span></span></p>
			<p id="user_tel2">тел 2: <span></span></p>
			<p id="user_tel3">тел 3: <span></span></p>
			<p id="user_tel4">тел 4: <span></span></p>
			<p id="user_tel5">тел 5: <span></span></p>
			<p id="user_mail">E-mail: <span></span> грн.</p>
			<p id="user_date">Добавлен: <span></span></p>
		</div>
	</div>
	<div class="col-md-2">
		<form id="user_edit">
			<select name="status" id="status" class="form-control">
				<option value="0">Выберите статус</option>
				@foreach ($statuses as $status)
					<option value="{{$status->id}}">{{$status->status}}</option>
				@endforeach
			</select>
			<input type="hidden" name="user_id" id="user_id">
			<input type="submit" name="set_but" id="set_but" class="btn btn-warning form-control" value="изменить статус">
		</form>
	</div>
	<div class="col-md-2">
		<nav class="btn-group-vertical">
			
		</nav>
	</div>
</div>


<script src="{{ url('js/admin_users.js')}}"></script>
@endsection