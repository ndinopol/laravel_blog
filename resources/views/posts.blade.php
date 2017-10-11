
@extends('layouts.master')

@section('nav')
 <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
        
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
               <a class="nav-link" href="javascript:void(0);"> Login As : {{ Session::get('name') }}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/') }}">View Site</a>
            </li>
            <!--<li class="nav-item">
              <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
            </li>-->
          </ul>
      </div>
    </nav>
@endsection

@section('content')
    <div class="row paddingBottom15">
        <div class="col-sm-12">
            <a href="{{ url('/dashboard/post') }}" class="btn btn-info pull-right">Add Post</a>
        </div>    
    </div>
    <div class="row">
        <div class="col-sm-12">
            <table class="table table-bordered">
                <tr>
                    <th>Post ID</th>
                    <th>Title</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th>Actions</th>
                </tr>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->post_id }}</td>
                <td>{{ $post->name }}</td>
                <td>{{ $post->created_at->diffForHumans() }}</td>
                <td>{{ $post->updated_at->diffForHumans() }}</td>  
                <td></td> 
            </tr>
            @endforeach
            </table>
            {!! $posts->render() !!}
        </div>    
    </div>
@endsection    
