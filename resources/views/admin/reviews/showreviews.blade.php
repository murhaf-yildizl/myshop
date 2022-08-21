@extends ('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header text-center"><h3>Reviwes</h3></div>

                <div class="card-body ">
                  <div class="row">
                   @foreach($products as $product)

                    <div class="col-md-4">

                    <div class="alert alert-primary " role="alert"> product name: {{$product->name}}
                        <h5>Category: {{$product->categories->name}}</h5>
                        {!! (count($product->images)>0) ?  '<img class="img-thumbnail" src="' .$product->images[0]->url .'"/>':"" !!}

                                <div class="row mt-2 ml-1">Reviews</div>
                                <div class="row mt-2 ml-1">-----------</div>
                                @foreach($product->reviews as $review)
                                   <h6>{{$review->users->getFullName()}} :

                                      @for($i=0;$i<$review->stars;$i++)
                                      <i class="fa fa-star" aria-hidden="true"></i>
                                          @php
                                            $stars=$i;
                                            $total=5;
                                          @endphp

                                      @endfor


                                        @for($i=$stars;$i<$total-1;$i++)
                                          <i class="fa fa-star-o" aria-hidden="true"></i>
                                           @endfor
                                   </h6>
                                    <p>{{$review->text}}</p>
                                    <p>{{$review->updated_at->diffForHumans()}}</p>
                                    <p>---------------</p>
                                    @endforeach

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
