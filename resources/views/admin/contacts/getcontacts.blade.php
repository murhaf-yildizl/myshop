@extends ('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header text-center"><h3>Contacts Box</h3></div>

                <div class="card-body ">
                  <div class="row">
                   @foreach($contacts as $contact)
                    <div class="col-md-4">

                    <div class="alert alert-primary " role="alert">
                      <h6>Name: {{$contact->users->getFullName()}}</h6><br>
                      <h6>Support Type: {{$contact->supports->type}}</h6><br>
                      <h6>Order Id:   {{$contact->orders->order_id}}</h6><br>
                      <h6>Title:      {{$contact->title}}</h6><br>
                      <h6>Content:      {{$contact->content}}</h6><br>
                      <h6>Status:      {{$contact->status}}</h6><br>
                      <h5> {{$contact->created_at->diffForHumans()}}</h5>


                    </div>
                    </div>
                   @endforeach

                   {{$contacts->links()}}

                 </dive>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
