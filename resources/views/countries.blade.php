
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="{{ asset('js/app.js') }}"></script>


    <title></title>


  </head>


  <body>

     <div class="container content-center">
    <div class="card-body ">

    <div class="row mt-10">

  <div class="col-md-6 offset-3 ">
    <select class="form-select" name="" id="select_country">
      <option value="" disabled selected>select the country...</option>
       @if($countryList!=null)
                  @foreach($countryList as $country)
                   <option value="{{$country->id}}">{{$country->name}}</option>
                  @endforeach
       @endif
    </select>

  </div>
</div>

 <br><br>
  <div class="row mt-10">
  <div class="col-md-6 offset-3">
    <select class="form-select" name="" id="select_state">
      <option value="" disabled selected>select the state...</option>

    </select>
  </div>
</div>
<br><br>
<div class="row mt-10">
  <div class="col-md-6 offset-3 ">
    <select class="form-select" name="" id="select_city">
      <option value="" disabled selected>select the city...</option>

    </select>
  </div>
</div>

</div>
</div>
</div>

  </body>
</html>


<script>

$(document).ready(function(){

 $country=$('#select_country');
 $state=$('#select_state');
 $city=$('#select_city');


   $.ajaxSetup({
   headers: {
  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
     });

$country.on('change',function(e){
  $country_id=$country.val();

  $.ajax({
    url:'{{url("select_state")}}',
    data:{
      country_id:$country_id,
    },
    type:"post",
    dataType:"json",
    success:function(data){
      def_st=`
          <option selected disabled mt-2>select the state...</option>
          <option disabled>------------------</option>`;

      def_city=`
              <option selected disabled mt-2>select the city...</option>
              <option disabled>------------------</option>`;

         $state.empty();
         $city.empty();

         $state.append(def_st);
         $city.append(def_city);

       for(i=0;i<data.length;i++)
       {
         op=`
             <option value="`+data[i]['id']+`">`+data[i]['name']+`</option>
         `;
             $state.append(op);

       }
     }

  });
 });



 $state.on('change',function(e){
   $state_id=$state.val();

   $.ajax({
     url:'{{url("select_city")}}',
     data:{
       state_id:$state_id,
     },
     type:"post",
     dataType:"json",
     success:function(data){

       def_city=`
               <option selected disabled mt-2>select the city...</option>
               <option disabled>------------------</option>`;

           $city.empty();
           $city.append(def_city);

        for(i=0;i<data.length;i++)
        {
          op=`
              <option value="`+data[i]['id']+`">`+data[i]['name']+`</option>
          `;
              $city.append(op);

        }
      }

   });
  });


});

</script>
