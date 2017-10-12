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
                @if( !empty(Session::get('name')) && !empty(Session::get('email')) )
                  <a class="nav-link" href="{{ url('/dashboard') }}">Go To Dashboard</a>
                @else
                  <a class="nav-link" href="{{ url('/signin') }}">Sign In</a>
                @endif
            </li>
          </ul>
        </div>
      </div>
    </nav>
@endsection
@section('content')
   <!-- Main Content -->
    
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          
            @foreach ($posts as $post)
              <div class="post-preview">
                    <a href="javascript:void();">
                      <h2 class="post-title">
                          {{ $post->title }}
                      </h2>
                      
                    </a>
                    <div class="post-subtitle">
                        {!! $post->body_html !!}
                    </div>
                    <p class="post-meta">Posted by
                      <a href="#">{{ $post->email }}</a>
                   on {{ \Carbon\Carbon::parse($post->created_at)->format('M, d Y H:i:s')  }}</p>
                    
              </div>
              <hr/>
              @endforeach
           
            
          <div class="post-preview">
            
          </div>
          <hr>
          <!-- Pager -->
          <div class="clearfix">
            {!! $posts->render() !!}
          </div>
        </div>
      </div>
  
@endsection

