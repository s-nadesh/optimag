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
                        {!! Form::label('ad_type', 'Type:*', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                            {!! Form::radio('ad_type', 'video',true) !!} Video
                            {!! Form::radio('ad_type', 'image') !!} Image
                        </div>
                    </div>  
                    
                    <div id="video_cnt"> 
                        <div class="form-group">
                            {!! Form::label('video_embed', 'Embed Code:*', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::textarea('video_embed', null, ['class' => 'form-control', 'size' => '20x2']) !!}  
                            </div>
                        </div>
                    
                        <div class="form-group">
                            {!! Form::label('advertiser_url', 'Advertiser’s Website:*', array( 'class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-5">
                            {!! Form::text('advertiser_url', null, ['placeholder' => 'Advertiser’s Website', 'class' => 'form-control']) !!}
                            </div>   
                        </div>  
                    </div>
                    
                    <div id="img_cnt" style="display:none;"> 
                        <div class="form-group">
                            {!! Form::label('image', 'Image:*', array( 'class' => 'col-sm-2 control-label')) !!}
                            <div class="col-sm-3">
                                {!! Form::select('image_category', $archivecategories, null, ['class' => 'form-control','id'=>'image_category']) !!}   
                                <!--{!! Form::file('image') !!}-->                           
<!--                                <select name="image_category" id="image_category" class="form-control">
                                    <option value="">--Select Category--</option>
                                    @foreach($archivecategories as $key=>$archivecategory )
                                    <option value="{{ $key }}">{{ $archivecategory }}</option>
                                    @endforeach
                                </select>-->
                                
                            </div>
                            <div class="col-sm-2">
                                <select name="id_image" id="id_image" class="form-control">
                                    <option value="">--Select Image--</option>
                                </select>
                                <a class="pop" href="javascript:void(0);">
                                    <img src="" style="display:none;" class="viewficherfile">
                                    <img src={{asset('img/preview.gif')}} alt="preview">
                                </a>
                            </div>
                        </div>   
                        
                        <div class="form-group">
                            {!! Form::label('ad_link', 'Ad Link:*', array( 'class' => 'col-sm-2 control-label')) !!}
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
       <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreview" style="width: 100%;" >
      </div>
    </div>
  </div>
</div>
</section>
<!-- /.content -->
<script type="text/javascript">
    $(function() {
		$('.pop').on('click', function() {
                    
			$('.imagepreview').attr('src', $('.viewficherfile').attr('src'));
			$('#imagemodal').modal('show');   
                        $(this).attr('src','javascript:void(0);')
		});		

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
    
    
    $("#image_category").change(function()
    {
        var id=$(this).val();

        $.ajax({
            type: "GET",
            url: '/admin/ads/show/'+id,
            cache: false,
            success: function(html)
            {
                $("#id_image").html(html);
            }
        });

    });
    $("#id_image").change(function(e){
        var id_image=$(this).val();
        $.ajax({
            type: "GET",
            url: '/admin/ads/previewimage/'+id_image,
            cache: false,
            success: function(html){    
                $(".viewficherfile").attr("src", html);                         
            }
         });
    }); 
    
    var image_category=$("#image_category").val();
    var id_images=$("#id_image").val();
    
    if(image_category){
        $.ajax({
            type: "GET",
            url: '/admin/ads/show/'+image_category,
            cache: false,
            success: function(html)
            {
                $("#id_image").html(html);
            }
        });
    }
    if(id_images){
         $.ajax({
            type: "GET",
            url: '/admin/ads/previewimage/'+id_images,
            cache: false,
            success: function(html){    
                $(".viewficherfile").attr("src", html);                         
            }
         });
    }
// Click to preview the ficher file in popup window   
            
//    $('.viewficherfile').click(function(event) {
//        event.preventDefault();           
//        window.open($(this).attr("href"), "popupWindow", "width=600,height=600,scrollbars=yes");
//    });    
    
});
</script>
@stop