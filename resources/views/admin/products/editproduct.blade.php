 @extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="card">
      <div class="card-header text-center">
        <h3>{{$product->product_id==0?'New Product':'Edit Product'}}</h3>
      </div>
      <div class="card-body">


            <form  action="{{url('save_product')}}" enctype="multipart/form-data" class="text-styling row" method="post">
              @csrf

            <label for="p_name" >Product Name:</label>
             <div class="col-md-3">
              <input type="hidden" name="product_id" value="{{$product->product_id}}"/>
              <input class="form-control" name="product_name" type="text"  id="p_name" value="{{$product->name}}" required/>
            </div>

              <div class="form-floating mt-4 mb-3">
                <textarea name="product_discription" class="form-control " required placeholder="write product description here..." id="floatingTextarea2" style="height: 150px" >{{$product->description}}</textarea>
                <label for="floatingTextarea2">Product Description</label>
              </div>


             <div class="col-md-3">
              <label for="p_price" >Price:({{env('CURRENCY_CODE')}})</label>
               <input name="product_price" type="number" step="any" class="form-control mb-4" id="p_price" value="{{$product->price}}" required/>
          </div>

           <div class="col-md-3">
             <label for="p_discount" >Discount:</label>
              <input name="product_discount" type="number" step="any" class="form-control mb-4" id="p_discount" value="{{$product->discount}}" required/>
           </div>

                <div class="col-md-3">
                  <label for="p_quantity" >Quantity:</label>
                   <input name="product_qnty" type="number" step="any" class="form-control mb-4" id="p_quantity" value="{{$product->available}}" required/>

                   </div>


                 <label for="categories_list" >Category:</label>
                  <div class="col-md-3">
                  <select name="category_id" class="form-select mb-4" id="categories_list" required>
                   <option selected>select the category...</option>

                     @foreach($cats as $cat)
                        @if($product->categories!=null && $cat->name==$product->categories->name)
                       <option value="{{$cat->cat_id}}" selected>{{$cat->name}}</option>
                        @else
                      <option value="{{$cat->cat_id}}">{{$cat->name}}</option>
                        @endif
                      @endforeach
                   </select>
                 </div>

                   <label for="units_list" >Unit:</label>
                   <div class="col-md-3">
                   <select name="unit_id" class="form-select mb-4" id="units_list" required>
                     <option selected>select the unit...</option>
                       @foreach($units as $unit)
                         @if($product->units!=null && $unit->unit_name==$product->units->unit_name)
                           <option value="{{$unit->unit_id}}" selected>{{$unit->unit_name}}: {{$unit->unit_code}}</option>
                          @else
                          <option value="{{$unit->unit_id}}">{{$unit->unit_name}}: {{$unit->unit_code}}</option>
                          @endif
                       @endforeach
                     </select>
                   </div>



                   <div class="card">
                       <div class="card-header text-center">
                         <h4>Options</h4>
                       </div>

                    <div class="card-body row" >
                       <div class="col-md-3">
                       <label for="options_list" >option:</label>
                       <select class="form-select mb-4 options_list" id="options_list" name="options_list" required>
                         <option selected disabled mt-2>select the option...</option>
                         <option disabled>------------------</option>

                           @foreach($options as $option)
                              <option value='{{$option->option_id}}'>{{$option->name}}</option>
                          @endforeach


                         </select>
                      </div>



                      <div class="col-md-3">
                      <label for="value_list" >value:</label>
                      <select class="form-select mb-4 value_list" name="value_list" required>
                        <option selected disabled mt-2>select the value...</option>
                        <option disabled>------------------</option>

                         </select>
                     </div>

                     <div class="col-md-6" style="align-self: center;">
                      <button type="button" class="btn btn-primary add-option" style="width:150px;" >Add</button>

                     </div>

                </div>



               @if($product->optionlists!=null)
               <table class="table table-striped" id="option-table" style="text-align:center;">
              <tr class="text-center" >

                 <td><h4 style="color:crimson;">option name</h4></td>
                 <td><h4 style="color:crimson;">option value</h4></td>
              </tr>
                 @foreach($product->optionlists as $opt)
                 <tr>
                 <td> {{$opt->options->name}} </td>
                 <td> {{$opt->value }}</td>
                 <td>
                    <a href="" data-optionid="{{$opt->optionlist_id}}" class="delete_option2"><i class="fa fa-trash" style="color:red" aria-hidden="true"></i></a>
                  <!-- <input type="hidden" name="{{$opt->options->name}}[]" value="{{$opt->value }}"/>
                   <input type="hidden" name="optionList[]" value="{{$opt->options->name}}"/>
                    -->
                 </td>

                 </tr>
                 @endforeach
               </table>
              @endif

          </div>



                             <div class="card">
                                 <div class="card-header text-center">
                                   <h4>Images</h4>
                                 </div>
                                 <div class="row mb-5 choose_file">

                                 <div class="col-md-6 offset-5 mt-4 mb-4">
                                  <button class="btn-primary add-file" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add New Image</button>
                                 </div>
                                 </div>



                         @if($product->images!=null)
                         <div class="row images"   id="images" style="text-align:center;margin-bottom:50px;margin-right:50px">
                         @foreach($product->images as $image)
                            <div class="col-md-4 mb-4" >

                           <img height="400px" width="400px" src="{{asset('storage/'.$image->url)}}" class="card-img-top" alt="...">
                           <a href="" data-imageid="{{$image->image_id}}"  class="row mt-4 delete_image_icon"><i class="fa fa-trash" style="color:red" aria-hidden="true"></i></a>

                           </div>
                           @endforeach
                         </div>
                        @endif

                    </div>


        </div>
          </div>
         <div class="col-md-6 offset-5 mt-4 mb-4">
          <input type="submit" class="btn btn-primary save-btn"  style="width:150px;" value="Save"/>
        </div>

       </div>
        </form>

     </div>
   </div>


<div class="modal delete_window" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">delete image </h5>

      </div>
      <form action="{{url('getimages')}}" method="post">
        @csrf
      <div class="modal-body">
        <p id="delete_message"></p>
        <input type="hidden" name="_method" value="delete"/>
        <input type="hidden" name="delete_modal_image_id"  id="delete_modal_image_id" value=""/>
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



<div class="modal delete_option_window" tabindex="-1" role="dialog" >
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">delete option </h5>

      </div>
      <form action="{{url('delete_option')}}" method="post">
        @csrf
      <div class="modal-body">
        <p id="delete_message2"></p>
         <input type="hidden" name="delete_modal_option_id"  id="delete_modal_option_id" value=""/>
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

@endsection




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



@section('scripts')


<script>

function readurl(input,$id)
{


  if(input.files && input.files[0])
  {

    var filereader=new FileReader();
       filereader.onload=function(e){

            $('.'+$id).attr('src',e.target.result);
       }

       filereader.readAsDataURL(input.files[0]);



  }
}


$(document).ready(function(){

  var $option_selection=$('.options_list');
  var $value_selection=$('.value_list');
  var $add_btn=$('.add-option');

  var  option_list=[];
  var row='';
  var  $delete_wind=$('.delete_window');
  var  $icon_delete_image=$('.delete_image_icon');
  var file_id=0;
  var  $delete_option_wind=$('.delete_option_window');



  $.ajaxSetup({
   headers: {
 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
 }
     });

  $icon_delete_image.on('click',function(element){
  element.preventDefault();

  var $image_id=$(this).data('imageid');
    $('#delete_modal_image_id').val($image_id);

   $('#delete_message').text("are you sure you want to delete this image ?");

   $delete_wind.modal('show');
});

$('.cancel_btn_delete').on('click',function(element){
  element.preventDefault();
  $delete_wind.modal('hide');
  $delete_option_wind.modal('hide');
});

    //$('.values_list').hide();
    $row_count=$('.table').find('tr').length;
    if($row_count==1)
      $('.table').hide();
  else $('.table').show();

    $(document).on('click','.add-option',function(e){
      e.preventDefault();
      var sel = document.getElementById("options_list");
      $option= sel.options[sel.selectedIndex].text;
      $value =$value_selection.val();

   if($option!=null && $value!=null)
     {

   $('.table').show();

    if(!option_list.includes($option))
  {
     option_list.push($option);

     row=`
    <tr><td>`+$option+`</td>
    <td>`+$value+`</td>
    <td>
    <a href="" class="remove-option"><i class="fa fa-trash" style="color:red" aria-hidden="true"></i></a>
    <input type="hidden" name="`+$option+`[]" value="`+$value+`"/>
    <input type="hidden" name="optionList[]" value="`+$option+`"/>

    </td>
    </tr>`;
   }

  else {
     row=`
    <tr><td>`+$option+`</td>
    <td>`+$value+`</td>
    <td>
    <a href="" class="remove-option"><i class="fa fa-trash" style="color:red" aria-hidden="true"></i></a>
    <input type="hidden" name="`+$option+`[]" value="`+$value+`"/>


    </td>
    </tr>`;

  }


      $('#option-table > tbody:last-child').append(row);

    }
    });




$(document).on('click','.delete_image',function(e){
            e.preventDefault();

       $(this).parent().remove();
     });


 $(document).on('click','.delete_option2',function(e){
                 e.preventDefault();

                 $option_id=$(this).data('optionid');

                $("#delete_modal_option_id").val($option_id);
                $('#delete_message2').text("are you sure you want to delete this option ?");

                 $delete_option_wind.modal('show');

       });
   $(document).on('click','.remove-option',function(e){
               e.preventDefault();

          $(this).parent().parent().remove();

          $row_count=$('.table').find('tr').length;
          if($row_count==1)
            $('.table').hide();
       else $('.table').show();



   });

  $('.add-file').on('click',function(element){
    file_id++;
    var im=`
    <div class="col-md-4 mb-4" >
    <input type="file" style="display:none" name="files[]" class="form-control-file" id="image_id`+file_id+`">

      <a href=""  data-imageid="image_id`+file_id+`" id="anchertag">
              <div class="card-body">
               <input type="image" src="{{asset('storage/public/empty.png')}}" height="400px" width="400px"class="image_id`+file_id+`"/>
              </div>
      </a>
      <a href="" class="delete_image"><i class="fa fa-trash" style="color:red" aria-hidden="true"></i></a>




    </div>
    `;
    $('.images').append(im);

  });


$(document).on('change','.options_list',function(e){

            $option_id=$option_selection.val();
            $.ajax({

             url:'{{url("select_option")}}',
             type: "POST",
             data:{
               option_id:$option_id,

             },
             dataType: 'json',
             success: function (data) {

                $('.value_list').empty();

                def_op=`
                    <option selected disabled mt-2>select the value...</option>
                    <option disabled>------------------</option>`;

                $('.value_list').append(def_op);

               for(i=0;i<data.length;i++)
               {

                 op=`<option id="`+data[i]['option_id']+`">`+data[i]['value']+`</option>`;
                  $('.value_list').append(op);
                }
                //$('.writeinfo').append(data.msg);
                //$('#ruleRow'+id).remove();
                }
           });
});

$(document).on('change','value_list',function(e){

});

$(document).on('click','#anchertag',function(e){
  e.preventDefault();
   $id=$(this).data('imageid');
   $('#'+$id).trigger('click');
   $('#'+$id).on('change',function(e){

       readurl(this,$id);

   });


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
    {{Session::forget('message')}}


});

</script>

@endif

@endsection
