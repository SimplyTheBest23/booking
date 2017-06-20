@extends('layouts.admin')

@section('content')
<h1 class="h3 text-success">Города</h1>
	<div class="row">

	<div class="col-md-3">
		<table id="list" class="table table-striped">
			@foreach ($cities as $city)
				<tr class="pointer">
					<td class="hidden">{{$city->id}}</td>
					<td>{{$city->city}}</td>
				</tr>
			@endforeach
		</table>
	</div>
	<div class="col-md-2">
		<nav class="btn-group-vertical">
			<form action="">
				<input type="text" id="new_city"  class="form-control">
				<input type="hidden" id="city_id" value="0">
		    	<button class="btn btn-success" id="add_city">Добавить</button>
		    	<button class="btn btn-danger" id="del_city">Удалить</button>
		    </form>
		</nav>
	</div>
</div>


<script src="{{url('js/admin_cities.js')}}"></script>
@endsection
