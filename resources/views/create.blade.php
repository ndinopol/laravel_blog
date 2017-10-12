
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
            <h1>Creating New Post</h1>
            <hr/>
        </div>
        <div class="col-sm-12">
            <a href="{{ url('/dashboard/') }}" class="pull-right">Back To Dashboard</a>
        </div>    
    </div>
    <div class="row">
        <div class="col-sm-12">
            <form method="POST" id="form_post">
                <div class="alert alert-success" style="display:none;">
                    <strong>Success!</strong> Successfully Submitted.
                </div>
                <div class="alert alert-danger" style="display:none;">
                    <strong>Danger!</strong> Error Submitting Data.
                </div>
                  {{ csrf_field() }}
                <div class="form-group">
                    <label for="email">Title</label>
                    <input type="text" class="form-control" id="title" name="title" req="true" message="Title is required">
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
                    <button type="submit" status="publish" style="" class="btn btn-primary submitForm">Publish</button>
                    <button type="submit" status="unpublish" class="btn btn-default submitForm">Unpublish</button>
                </div>
            </form>
            
        </div>    
    </div>
    
@endsection   
@section('md')
        <script src="{{URL::asset('/js/editormd.min.js')}}"></script>
        <script type="text/javascript">
			

            $(function() {
                var testEditor;
                testEditor = editormd("test-editormd", {
                    width   : "100%",
                    height  : 640,
                    syncScrolling : "single",
                    path    : "../lib/"
                });
              var Form = {
                    validate : function(id){
                        var ret = true;
                            
                            var formInput = $(id+" .form-group .form-control");
                            if(typeof formInput != 'undefined'){
                                if(formInput.length > 0){
                                for(var i = 0; i < formInput.length; i++){
                                    if(typeof $('#'+formInput[i].id).attr("req") != 'undefined'){
                                        $("#"+formInput[i].id).parent().attr("class","form-group");
                                        $("#"+formInput[i].id).parent().find('small').remove();
                                        
                                        if(formInput[i].value.trim().length == 0){
                                            $("#"+formInput[i].id).parent().attr("class","form-group has-error");
                                            $("#"+formInput[i].id).parent().append('<small class="help-block" style="color:red !important">'+$('#'+formInput[i].id).attr("message")+'</small>');
                                            ret = false;
                                        }else{
                                            if(typeof $("#"+formInput[i].id).attr("type") != 'undefined'){
                                            var type =  $("#"+formInput[i].id).attr("type").trim();
                                            var vE = $("#"+formInput[i].id).val();
                                            if(type == "email" ){
                                                var emailRes = Form.isEmail(vE);
                                                if(!emailRes){ 
                                                    $("#"+formInput[i].id).parent().attr("class","form-group has-error");
                                                    $("#"+formInput[i].id).parent().append('<small class="help-block" style="color:red !important">INVALID EMAIL</small>');
                                                    $("#"+formInput[i].id).focus();
                                                    ret = false;
                                                }
                                            }
                                            }
                                        }
                                    }  
                                }
                                }
                            }
                            return ret;
                        },
                    isEmail : function(email){
                        var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                        return regex.test(email);
                    }
                };

               $('.submitForm').click(function(e){
                    e.preventDefault();
                    if(Form.validate('#form_post')){
                        var data = $('#form_post').serializeArray();
                        data.push({name:'title', value : $('#title').val() });
                        data.push({name:'body_md', value : testEditor.getMarkdown() });
                        data.push({name:'body_html', value : $('.editormd-preview-container').html() });
                        data.push({name:'status', value : $(e.currentTarget).attr('status') });

                        $.ajax({
                            type: 'post',
                            url: "{{ url('/dashboard/post') }}",
                            data: data,
                            success: function () {
                                $('#title').val('')
                                $('.alert-success').css({'display':''});
                                $('.alert-danger').css({'display':'none'});
                            },
                            error: function(xhr, textStatus, error){
                                $('.alert-success').css({'display':'none'});
                                $('.alert-danger').css({'display':''});
                            }
                        });
                    }
               });

            });


    
        </script>
@endsection 
