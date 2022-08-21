<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>


  </head>


  <body>

<form  method="get">
    <div class="form-group row">
      <label for="content" class="col-2">select country...</label>

      <div class="col-10">
        <select class="form-control" name="selected_count_id" onchange="count_function()">

          @foreach ($countryList as $count)
          @if($count->id==$selected_country)
           <option value="{{$count->id}}" selected>{{$count->name}} {{$count->id}}</option>
            @else
           <option value="{{$count->id}}">{{$count->name}} {{$count->id}}</option>
        @endif
         @endforeach

        </select>
      </div>


      <div class="col-10">
        <select class="form-control" name="selected_state_id" onchange="state_function()">

          @foreach ($stateList as $st)
          @if($st->id==$selected_state)
             <option value="{{$st->id}}" selected>{{$st->name}}  {{$st->country_id}}</option>
          @else
           <option value="{{$st->id}}" >{{$st->name}}  {{$st->country_id}}</option>
           @endif
         @endforeach

        </select>
      </div>

      <div class="col-10">
        <select class="form-control" name="selected_city_id" onchange="city_function()">

          @foreach ($cityList as $ct)
          @if($ct->id==$selected_city)
             <option value="{{$ct->id}}" selected>{{$ct->name}}  {{$ct->state_id}}</option>
          @else
           <option value="{{$ct->id}}" >{{$ct->name}}  {{$ct->state_id}}</option>
           @endif
         @endforeach

        </select>
      </div>

      <script>
      function count_function()
      {
        var id=document.getElementById("selected_count_id");
        echo '$id.value'

      }
      </script>


<input type="submit" value="ok" action="{{url('countries')}}"/>
    </div>


</form>
  </body>
</html>
