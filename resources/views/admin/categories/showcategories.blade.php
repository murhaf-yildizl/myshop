@extends ('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header text-center">
                  <h3>Categories</h3>
                  <form class="search-form" action="{{url('getcategories')}}" method="post">
                    @csrf
                     <input type="hidden"  name="_method" value="PUT"/>
                     <input type="text" name="search_word" id="search_word" value="" name="search" placeholder="search..." required/>
                     <button type="submit" name="search_icon" id="search_icon" ><i class="fa fa-search" aria-hidden="true"></i></a>
                  </form>
                </div>

                <div class="card-body ">

                  <form class="" action="{{url('getcategories')}}" method="post">
                     @csrf

                    <div class="row justify-content-center mb-4">
                         <div class="col-md-6">
                           <input type="text" name="cat_name" id="cat_name" class="form-control" placeholder="category name"  required/>
                          </div>

                         </div>


                           <div class="row mt-2 mb-3  " >
                             <div class="col-md-12">
                           <button type="submit" class="btn-primary" value="" >Add New Category</button>
                             </div>
                         </div>


                       </form>


                  <div class="row">

                    @foreach($cats as $cat)
                    <div class="col-md-4">

                    <div class="alert alert-primary " role="alert">
                      <span class="btns-span">
                        <span class='edit-icons'>
                          <a class="icon_edit_cat"
                                 data-catid="{{$cat->cat_id}}"
                                 data-catname="{{$cat->name}}">
                                 <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                          </span>


                        <span class="edit-icons">
                          <a class="icon_delete_cat"
                                    data-catid="{{$cat->cat_id}}"
                                    data-catname="{{$cat->name}}">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                          </a>
                        </span>
                     </span>
                    <p> {{$cat->name}}</p>
                    </div>
                    </div>
                   @endforeach

                  {{ ($showlinks && $cats!=null)? $cats->links():""}}


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
        <h5 class="modal-title">edit category</h5>

      </div>
      <form action="{{url('editcategory')}}" method="post">
        @csrf
      <div class="modal-body">

        <div class="form-group row">

          <div class="col-md-6">
          <label for="cat_name">Category Name:</label>
         <input name="cat_name" id="modal_cat_name" value="" type="text" placeholder="new Category name" required/>
       </div>
       </div>


       <div class="modal-footer">
       <div class="form-group buttons-style">
        <input  type="hidden"   name="edit_modal_cat_id" id="edit_modal_cat_id" value=""/>
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
        <h5 class="modal-title">delete category </h5>

      </div>
      <form action="{{url('getcategories')}}" method="post">
        @csrf
      <div class="modal-body">
        <p id="delete_message"></p>
        <input type="hidden" name="_method" value="delete"/>
        <input type="hidden" name="delete_modal_cat_id"  id="delete_modal_cat_id" value=""/>
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

  var  $icon_delete_cat=$('.icon_delete_cat');
  var  $icon_edit_cat=$('.icon_edit_cat');


      $icon_delete_cat.on('click',function(element){
      element.preventDefault();

      var $cat_id=$(this).data('catid');
      var $catName=$(this).data('catname');

       $('#delete_modal_cat_id').val($cat_id);

       $('#delete_message').text("are you sure you want to delete the category ["+ $catName +" ] ?");

       $delete_wind.modal('show');
    });

      $icon_edit_cat.on('click',function(element){
      element.preventDefault();
      var $cat_id=$(this).data('catid');
      var $cat_name=$(this).data('catname');

      $('#edit_modal_cat_id').val($cat_id);
      $('#modal_cat_name').val($cat_name);

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
