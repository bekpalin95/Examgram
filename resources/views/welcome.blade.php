@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        @foreach($users as $user)
            <div class="col-md-2 pb-4">
                <a href="/profile/{{  $user->id  }}">
                    <div class="card text-center shadow-sm border-0 rounded-lg p-3">
                        <img src="/storage/{{ $user->profile->image  }}" 
                            class="rounded-circle mx-auto d-block" 
                            style="width: 100px; height: 100px; object-fit: cover;">
                        <h5 class="mt-3 mb-0">{{ $user->username }}</h5>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

</div>
@endsection
