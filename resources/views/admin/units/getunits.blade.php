
@extends ('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header text-center">
                  <h3>Units</h3>
                  <form class="search-form" action="{{url('getunits')}}" method="post">
                    @csrf
                     <input type="hidden"  name="_method" value="PUT"/>
                     <input type="text" name="search_word" id="search_word" value="" name="search" placeholder="search..." required/>
                     <button type="submit" name="search_icon" id="search_icon" ><i class="fa fa-search" aria-hidden="true"></i></a>
                  </form>
                </div>

                <div class="card-body ">

                  <form class="" action="{{url('addunit')}}" method="post">
                     @csrf

                    <div class="row justify-content-center mb-4">
                         <div class="col-md-6">
                           <input type="text" name="un_name" id="un_name" class="form-control" placeholder="unit name"  required/>
                          </div>
                           <div class="col-md-6">
                          <input type="text"  name="un_code" id="un_code" class="form-control" placeholder="unit code"  required/>
                         </div>
                         </div>


                           <div class="row mt-2 mb-3  " >
                             <div class="col-md-12">
                           <button type="submit" class="btn-primary" value="" >Add New Unit</button>
                             </div>
                         </div>


                       </form>


                  <div class="row">

                    @foreach($units as $unit)
                    <div class="col-md-4">

                    <div class="alert alert-primary " role="alert">
                      <span class="btns-span">
                        <span class='edit-icons'>
                          <a class="icon_edit_unit"
                                 data-unitid="{{$unit->id}}"
                                 data-unitname="{{$unit->unit_name}}"
                                 data-unitcode="{{$unit->unit_code}}">
                                 <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                          </span>


                        <span class="edit-icons">
                          <a class="icon_delete_unit"
                                    data-unitid="{{$unit->id}}"
                                    data-unitname="{{$unit->unit_name}}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                          </a>
                        </span>
                     </span>
                    <p> {{$unit->unit_name}} : {{$unit->unit_code}}</p>
                    </div>
                    </div>
                   @endforeach

                  {{ ($showlinks && $units!=null)? $units->links():""}}


                 </dive>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


<div class="modal edit_window" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">edit unit</h5>

      </div>
      <form action="{{url('editunits')}}" method="post">
        @csrf
      <div class="modal-body">

        <div class="form-group row">

          <div class="col-md-6">
          <label for="unit_name">Unit Name:</label>
         <input name="unit_name" id="modal_unit_name" value="" type="text" placeholder="new unit name" required/>
       </div>

       <div class="col-md-6">
        <label for="unit_code">Unit Code:</label>
         <input name="unit_code" type="text" id="modal_unit_code" value="" placeholder="new unit code" required/>
       </div>
       </div>


       <div class="modal-footer">
       <div class="form-group buttons-style">
        <input  type="hidden"   name="edit_modal_unit_id" id="edit_modal_unit_id" value=""/>
        <button type="submit"  class="modal-btns btn-primary" >OK</button>
        <button type="button"  class="modal-btns cancel_btn_edit btn-primary" class="modal-btns btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
    </div>
        </div>
    </form>

  </div>
  </div>
</div>



<div class="modal delete_window" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">delete unit </h5>

      </div>
      <form action="{{url('getunits')}}" method="post">
        @csrf
      <div class="modal-body">
        <p id="delete_message"></p>
        <input type="hidden" name="_method" value="delete"/>
        <input type="hidden" name="delete_modal_unit_id"  id="delete_modal_unit_id" value=""/>
      </div>
            <div class="modal-footer">
         <div class="form-group buttons-style">
         <button type="submit" class="modal-btns btn-primary">OK</button>
        <button type="button" class="modal-btns cancel_btn_delete btn-primary" class="modal-btns btn-secondary" data-dismiss="modal">Cancel</button>
      </div>
       </div>
    </form>


    </div>
  </div>
</div>



<div class="toast success bg-light" id="success-toast"  role="alert" style="position:absolute;z-index:1000;top:15%;right:35%;" >
  <div class="toast-header ">
     <strong class="toast-title"> Success</strong>
    </div>
  <div class="toast-body">


    @if(Session::has('message'))
      {{ Session::get('message')}}
    @endif
  </div>
</div>

<div class="toast error bg-light" id="error-toast"  role="alert" style="position:absolute;z-index:1000;top:15%;right:35%;" >
  <div class="toast-header ">
     <strong class="toast-title"> Error!!</strong>
    </div>
  <div class="toast-body">


    @if(Session::has('message'))
      {{ Session::get('message')}}
    @endif

    @if(Session::has('error-message'))
      {{ Session::get('error-message')}}
    @endif
  </div>
</div>

@section('scripts')
<script>



$(document).ready(function(){


  var  $delete_wind=$('.delete_window');
  var  $edit_wind=$('.edit_window');

  var  $icon_delete_unit=$('.icon_delete_unit');
  var  $icon_edit_unit=$('.icon_edit_unit');


      $icon_delete_unit.on('click',function(element){
      element.preventDefault();

      var $unit_id=$(this).data('unitid');
      var $unitName=$(this).data('unitname');

       $('#delete_modal_unit_id').val($unit_id);

       $('#delete_message').text("are you sure you want to delete the unit ["+ $unitName +" ] ?");

       $delete_wind.modal('show');
    });

      $icon_edit_unit.on('click',function(element){
      element.preventDefault();
      var $unit_id=$(this).data('unitid');
      var $unit_name=$(this).data('unitname');
      var $unit_code=$(this).data('unitcode');

      $('#edit_modal_unit_id').val($unit_id);
      $('#modal_unit_name').val($unit_name);
      $('#modal_unit_code').val($unit_code);

      $edit_wind.modal('show');

    });

    $('.cancel_btn_delete').on('click',function(element){
      element.preventDefault();
      $delete_wind.modal('hide');
    });

    $('.cancel_btn_edit').on('click',function(element){
      element.preventDefault();
      $edit_wind.modal('hide');
    });



});

</script>

@if(Session::has('message'))

<script>

//$=jQuery
$(document).ready(function(){

    var $toast=$('#success-toast').toast({
      delay:2000,


    });
    $toast.toast('show');


});

</script>

{{Session::forget('error-message')}}

@endif


@if(Session::has('error-message'))

<script>

//$=jQuery
$(document).ready(function(){

    var $toast=$('#error-toast').toast({
      delay:2000,



    });
    $toast.toast('show');


});

</script>

{{Session::forget('error-message')}}

@endif



@endsection
