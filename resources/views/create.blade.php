
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
            <li class="nav-item">
              <a class="nav-link" href="{{ url('/logout') }}">Logout</a>
            </li>
          </ul>
      </div>
    </nav>
@endsection

@section('content')
    <div class="row paddingBottom15">
        <div class="col-sm-12">
            <h1>Creating New Post</h1>
            <hr/>
        </div>
        <div class="col-sm-12">
            <a href="{{ url('/dashboard/') }}" class="pull-right">Back To Dashboard</a>
        </div>    
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form>
                <div class="form-group">
                    <label for="email">Title</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                <div class="form-group">
                    <label for="body">Body:</label>
                    <div id="layout">
                            <div id="test-editormd">
                                <textarea style="display:none;"></textarea>
                            </div>
                        </div>
                </div>
                <div class="form-group pull-right">
                    <button type="submit" style="" class="btn btn-primary">Publish</button>
                    <button type="submit" class="btn btn-default">Unpublish</button>
                </div>
            </form>
        </div>    
    </div>
    
@endsection   
@section('md')
        <script src="{{URL::asset('/js/editormd.min.js')}}"></script>
        <script type="text/javascript">
			var testEditor;

            $(function() {
                testEditor = editormd("test-editormd", {
                    width   : "100%",
                    height  : 640,
                    syncScrolling : "single",
                    path    : "../lib/"
                });
            });
        </script>
@endsection 
