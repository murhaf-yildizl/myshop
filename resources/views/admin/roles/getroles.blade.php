

@extends ('layouts.app')


@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card ">
                <div class="card-header text-center"><h3>Roles</h3></div>

                <div class="card-body ">
                  <div class="row">
                   @foreach($users as $user)
                    <div class="col-md-4">

                    <div class="alert alert-primary " role="alert">
                    <h6>Name:{{$user->getFullName()}}</h6>

                   @if(count($user->roles)>0)
                    <h6>Roles</h6>
                    <h4>----------------</h4>

                       @foreach($user->roles  as $role)
                       <p>{{$role->role}}</p>
                       @endforeach

                     @endif
                    </div>
                    </div>
                   @endforeach

                 {{$users->links()}}

                 </dive>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
