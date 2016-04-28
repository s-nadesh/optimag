@extends('admin.layout')

@section('title') Create Ads @stop

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
                {!! Form::open(['role' => 'form' ,'class' => 'form-horizontal','url'=>['admin/ads/store'], 'files'=>'true']) !!} 
                <div class="box-body">
                    
                    <div class="form-group">
                        {!! Form::label('lang', 'Language:', array( 'class' => 'col-sm-2 control-label')) !!}
                        <div class="col-sm-5">
                        {!! Form::select('lang', $langs, null, ['class' => 'form-control']) !!}   
                        </div>
                    </div>
                    
                    <div class="form-group">
                       {!! Form::label('ad_title', 'Ad Title:*', array( 'class' => 'col-sm-2 control-label')) !!}                
                       <div class="col-sm-5">
                            {!! Form::text('ad_title', null, ['placeholder' => 'Ad Title', 'class' => 'form-control']) !!} 
                       </div>
                    </div>  
                    
                    <div class="form-group">
                        {!! Form::label('client_name', 'Client name:', array( 'class' => 'col-sm-2 control-label')) !!}
                        <div class="col-sm-5">
                        {!! Form::text('client_name', null, ['placeholder' => 'Client name', 'class' => 'form-control']) !!}
                        </div>
                    </div>    
                    
                    <div class="form-group">
                        {!! Form::label('start_date', 'Start date:', array( 'class' => 'col-sm-2 control-label')) !!}
                        <div class="col-sm-5"> 
                        {!! Form::text('start_date', null, array('type' => 'text','readonly' => 'readonly' ,'class' => 'form-control date', 'id' => 'calendar1')) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('end_date', 'End date:', array( 'class' => 'col-sm-2 control-label')) !!}
                        <div class="col-sm-5">
                        {!! Form::text('end_date',  null, array('type' => 'text','readonly' => 'readonly' ,'class' => 'form-control date', 'id' => 'calendar2')) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('page', 'Page:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                            {!! Form::select('page', $pages, null, ['class' => 'form-control']) !!}                                                            
                        </div>
                    </div>
                    
                    <div class="form-group" id="sec_positions" style="display:none;">
                        {!! Form::label('position', 'Position:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                            {!! Form::select('position', $positions, null, ['class' => 'form-control']) !!}                                                            
                        </div>
                    </div>
                    
                    <div class="form-group" id="hom_type">
                        {!! Form::label('ad_type', 'Type:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                            {!! Form::radio('ad_type', 'video', true) !!} Video
                            {!! Form::radio('ad_type', 'image') !!} Image
                        </div>
                    </div>  
                    
                    <div id="video_cnt"> 
                        <div class="form-group">
                            {!! Form::label('video_embed', 'Embed Code:', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::textarea('video_embed', null, ['class' => 'form-control', 'size' => '20x2']) !!}  
                            </div>
                        </div>
                    
                        <div class="form-group">
                            {!! Form::label('advertiser_url', 'Advertiser’s Website:', array( 'class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-5">
                            {!! Form::text('advertiser_url', null, ['placeholder' => 'Advertiser’s Website', 'class' => 'form-control']) !!}
                            </div>   
                        </div>  
                    </div>
                    
                    <div id="img_cnt" style="display:none;"> 
                        <div class="form-group">
                            {!! Form::label('image', 'Image:', array( 'class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-5">
                                {!! Form::file('image') !!}                           
                            </div>
                        </div>    
                        <div class="form-group">
                            {!! Form::label('ad_link', 'Ad Link:', array( 'class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-5">
                            {!! Form::text('ad_link', null, ['placeholder' => 'Ad Link', 'class' => 'form-control']) !!}
                            </div>   
                        </div>    
                    </div>
                    
                    <div class="form-group">
                        {!! Form::label('status', 'Status:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                            {!! Form::radio('status', '1', true) !!} Enable
                            {!! Form::radio('status', '0', null) !!} Disable
                        </div>
                    </div>     

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
    
    $( "#calendar1" ).datepicker( "setDate" , new Date());
    $( "#calendar2" ).datepicker( "setDate" , new Date());
    
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
         }else{
            $('#hom_type').show();
            $('#video_cnt').show();  
            $('#img_cnt').hide(); 
         }
         
         if(pos_val==2){
            $('#sec_positions').show();
         }else{
            $('#sec_positions').hide();
            $('#position').val("Top");
         }
    });
});
</script>
@stop