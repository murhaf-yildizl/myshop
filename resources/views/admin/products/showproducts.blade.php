
@extends ('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header text-center"><h3>Products</h3></div>

                <div class="card-body ">
                  <div class="row">
                  <form class="" action="{{url('addproduct')}}" method="post">
                    @csrf
                    <div class="col-md-6 offset-3">
                    <input class="btn-primary form-control" type="submit" name="" value="Add New Product"/>
                  </div>
                    </div>
                    </form>

                  <div class="row">
                   @foreach($products as $product)

                    <div class="col-md-4">

                    <div class="alert alert-primary " role="alert">{{$product->name}} : Quantity= {{$product->available}}

                        <h5>Category: {{$product->categories->name}}</h5>
                          @if(count($product->images)>0)
                            <img class="img-thumbnail " src="{{asset('storage/'.$product->images[0]->url)}}"/>

                         @endif

                      <form  method="post" action="{{url('editproduct/'.$product->product_id)}}">
                       @csrf
                       <div class="row mt-4">

                        <div class="col-md-4" >
                       <input type="submit" value="edit"/>
                       </div>

                     <div class="col-md-4" >
                     <h6 style="color:red">{{$product->price }}  {{$currency_code}}</h6>
                     </div>

                     </div>

                  </form>


                    </div>

                    </div>
                   @endforeach

                   {{$products->links()}}

                 </dive>
                </div>
            </div>
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
