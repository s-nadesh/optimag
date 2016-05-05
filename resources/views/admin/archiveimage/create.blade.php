@extends('admin.layout')

@section('title') Create Archivage Image @stop

@section('content')

@section('link')
<link href="{{ URL::asset('css/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('script_files')
<script type="text/javascript" src="{{ URL::asset('js/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
@stop
<!-- Main content -->
<section class="content">
       @include('admin.partials.errors')
<div class="user-create">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="box box-primary">
                {!! Form::open(['role' => 'form' ,'class' => 'form-horizontal','url'=>['admin/archiveimages/store'], 'files'=>'true']) !!} 
                <div class="box-body">
                    
                    <div class="form-group">
                        {!! Form::label('id_category', 'Category:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                            {!! Form::select('id_category', $archivecategory, null, ['class' => 'form-control']) !!}                                                            
                        </div>
                    </div>
                    <div class="form-group">
                            {!! Form::label('title_image_fr', 'Title in French:*', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::text('title_image_fr', null, ['class' => 'form-control']) !!}                                                         
                            </div>
                        </div>
                        <div class="form-group" id="sec_positions">
                            {!! Form::label('title_image_en', 'Title in English:*', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::text('title_image_en', null, ['class' => 'form-control']) !!}                                                          
                            </div>
                        </div>
                    
                    <div class="form-group">
                        {!! Form::label('image', 'Image:*', array( 'class' => 'col-sm-2 control-label')) !!}
                        <div class="col-sm-5">
                            {!! Form::file('image') !!}                           
                        </div>
                    </div>    
                    
<!--                    <div class="form-group">
                        {!! Form::label('status', 'Status:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                            {!! Form::radio('status', '1', true) !!} Enable
                            {!! Form::radio('status', '0', null) !!} Disable
                        </div>
                    </div>     -->

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="form-group">
                        <div class="col-sm-0 col-sm-offset-2">
                            {!! Form::submit('Create', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>
                </form>        
            </div>
        </div><!-- ./col -->
    </div>
</div>
</section>
<!-- /.content -->
<script type="text/javascript">
$(function() {
    $('.year').datepicker({ dateFormat: 'yyyy',autoclose: true });
    $('.date').datepicker({ format: 'yyyy-mm-dd',autoclose: true });    
    
    if($( "#calendar1" ).val().length == 0){
        $( "#calendar1" ).datepicker( "setDate" , new Date());
    }
    if($( "#calendar2" ).val().length == 0){
        $( "#calendar2" ).datepicker( "setDate" , new Date());
    }
    var page = $( "#page" ).val();
    if(page == 1){
        
            var typeval1 = $('input[name="ad_type"]:checked').val();
            if(typeval1 == "image")
            {
                $('#video_cnt').hide();  
                $('#img_cnt').show(); 
            } 

            if(typeval1 == "video")
            {
                $('#video_cnt').show();  
                $('#img_cnt').hide(); 
            }
        
    }else if(page == 2){
       $('#sec_positions').show();
       
       $('#hom_type').hide();
       $('#video_cnt').hide();   
       $('#img_cnt').show(); 
    }else if(page == 3){
       $('#sec_positions').hide();
        $('#hom_type').hide();
       $('#video_cnt').hide();   
       $('#img_cnt').show(); 
    }
    
    $('input[name="ad_type"]').on('ifChecked', function(event){
            var typeval = $('input[name="ad_type"]:checked').val();
            if(typeval=="image")
            {
                $('#video_cnt').hide();  
                $('#img_cnt').show(); 
            } 

            if(typeval=="video")
            {
                $('#video_cnt').show();  
                $('#img_cnt').hide(); 
            }
        });
    $('#page').on('change', function() {
        var pos_val = this.value
        
         if(pos_val!=1)
         {            
            $('#hom_type').hide(); 
            $('#video_cnt').hide();  
            $('#img_cnt').show(); 
            $('input[name="ad_type"]').iCheck('uncheck');
         }else{
            $('#hom_type').show();
            $('#video_cnt').show();  
            $('#img_cnt').hide(); 
         }
         
         if(pos_val==2){
            $('#sec_positions').show();
            $('input[name="ad_type"]').iCheck('uncheck');
         }else{
            $('#sec_positions').hide();
            $('#position').val("Top");
         }
    });
});
</script>
@stop