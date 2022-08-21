@extends ('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header text-center"><h3>Tags</h3></div>

                <div class="card-body ">
                  <div class="row">
                   @foreach($products as $product)

                    <div class="col-md-4">

                    <div class="alert alert-primary " role="alert"> product name: {{$product->name}}
                        <h5>Category: {{$product->categories->name}}</h5>
                        {!! (count($product->images)>0) ?  '<img class="img-thumbnail" src="' .$product->images[0]->url .'"/>':"" !!}

                                <div class="row mt-2 ml-1">Tags</div>
                                <div class="row mt-2 ml-1">-----------</div>
                              @foreach($product->tags as $tag)
                              {!! (count($product->tags)>0) ? '<p> '.$tag->tag.'</p>'  :" "       !!}
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
