
@extends('layouts.master')

@section('nav')
 <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
      <div class="container">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            Menu
            <i class="fa fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                    <a class="nav-link" href="javascript:void(0);"> Login As : {{ Session::get('name') }}</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ url('/') }}">View Site</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
                    </li>
                </ul>
            </div>    
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
        <div class="col-sm-12 paddingBottom15">
             @if(Session::has('flash_message'))
                <div class="alert alert-success">
                    {{ Session::get('flash_message') }}
                </div>
            @endif
        </div>
        <div class="col-sm-12">
            <table class="table table-bordered">
                <tr>
                    <th>Post ID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Date Created</th>
                    <th>Date Updated</th>
                    <th>Actions</th>
                </tr>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td>{{ $post->title }}</td>
                <th>{{ $post->status }}</th>
                <td>{{ $post->created_at->diffForHumans() }}</td>
                <td>{{ $post->updated_at->diffForHumans() }}</td>  
                <td align="center">
                        <a class="row-action" href="{{ url('/edit/') }}/{{ $post->id }}">Edit</a>
                        <a class="row-action" href="{{ url('/delete/') }}/{{ $post->id }}">Delete</a>
                </td> 
            </tr>
            @endforeach
            </table>
            {!! $posts->render() !!}
        </div>    
    </div>
@endsection    
