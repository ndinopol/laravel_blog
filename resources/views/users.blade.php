
@extends('layouts.master')

@section('nav')
 <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/signin') }}">Login with Google</a>
            </li>
          </ul>
      </div>
    </nav>
@endsection

@section('content')
    <div class="row">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Login Time</th>
            </tr>
        @foreach ($users as $user)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->updated_at->diffForHumans() }}</td>   
        </tr>
        @endforeach
        </table>
        {!! $users->render() !!}
    </div>
@endsection    
