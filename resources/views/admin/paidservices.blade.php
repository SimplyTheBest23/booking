@extends('layouts.admin')

@section('content')
<h1 class="h3 text-success">Настройка платные услуги</h1>
<div class="row">
	<div class="col-md-3">
		<table id="list1" class="table table-striped paid_table">
      <tbody>
      @foreach ($paids as $p)
      @if ($p->type()->value('type')=="VIP")
        <tr>
          <td class="hidden">{{$p->id}}</td>
          <td>{{$p->name}}</td>
          <td>{{$p->days}}</td>
          <td>{{$p->price}}</td>
        </tr>
      @endif
      @endforeach
      </tbody>
      <thead>
        <tr>
          <th>VIP</th>
          <th>дней</th>
          <th>грн.</th>
        </tr>
      </thead>
		</table>
	</div>

  <div class="col-md-3">
		<table id="list2" class="table table-striped paid_table">
      <tbody>
      @foreach ($paids as $p)
      @if ($p->type()->value('type')=="TOP")
        <tr>
          <td class="hidden">{{$p->id}}</td>
          <td>{{$p->name}}</td>
          <td>{{$p->days}}</td>
          <td>{{$p->price}}</td>
        </tr>
      @endif
      @endforeach
      </tbody>
      <thead>
        <tr>
          <th>TOP</th>
          <th>дней</th>
          <th>грн.</th>
        </tr>
      </thead>
		</table>
	</div>

  <div class="col-md-3">
    <table id="list3" class="table table-striped paid_table">
      <tbody>
      @foreach ($paids as $p)
      @if ($p->type()->value('type')=="Продлить платное")
        <tr>
          <td class="hidden">{{$p->id}}</td>
          <td>{{$p->name}}</td>
          <td>{{$p->days}}</td>
          <td>{{$p->price}}</td>
        </tr>
      @endif
      @endforeach
      </tbody>
      <thead>
        <tr>
          <th>Продлить платное</th>
          <th>дней</th>
          <th>грн.</th>
        </tr>
      </thead>
    </table>
  </div>

  <div class="col-md-3">
    <table id="list4" class="table table-striped paid_table">
      <tbody>
      @foreach ($paids as $p)
      @if ($p->type()->value('type')=="Продлить бесплатное")
        <tr>
          <td class="hidden">{{$p->id}}</td>
          <td>{{$p->name}}</td>
          <td>{{$p->days}}</td>
          <td>{{$p->price}}</td>
        </tr>
      @endif
      @endforeach
      </tbody>
      <thead>
        <tr>
          <th>Продлить бесплатное</th>
          <th>дней</th>
          <th>грн.</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<div class="row">
<form id="paid_form">
    <div class="col-md-1">

    </div>
    <div class="col-md-2">
      <label for="paid_type" class="form-control">Категория</label>
      <select class="form-control" name="paid_type" id='paid_type'>
        <option value="0">Выберите категорию</option>
        @foreach ($types as $t)
          <option value="{{$t->id}}">{{$t->type}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-2">
      <label for="paid_name" class="form-control">Название</label>
      <input type="text" name="paid_name" id="paid_name" class="form-control">
      <button class="btn btn-success form-control" id="but_add">Добавить</button>
    </div>
    <div class="col-md-2">
      <label for="paid_days" class="form-control">Срок действия дней</label>
      <input type="text" name="paid_days" id="paid_days"  class="form-control">
      <button class="btn btn-warning form-control" id="but_edit">Изменить</button>
    </div>
    <div class="col-md-2">
      <label for="paid_days" class="form-control">Стоимость грн.</label>
      <input type="text" name="paid_price" id="paid_price"  class="form-control">
      <input type="hidden" name="paid_id" id="paid_id" value="0">
      <button class="btn btn-danger form-control" id="but_del">Удалить</button>
    </div>
</form>
</div>


<script src="{{url('js/admin_painservices.js')}}"></script>
@endsection
