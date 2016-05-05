@extends('admin.layout')

@section('title') Edit Ads @stop

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
                {!! Form::model($ads, ['role' => 'form' ,'class' => 'form-horizontal','url'=>['admin/ads/update'], 'files'=>'true']) !!} 
                <div class="box-body">
                    
                    <div class="form-group">
                        {!! Form::label('lang', 'Language:', array( 'class' => 'col-sm-2 control-label')) !!}
                        <div class="col-sm-5">
                        {!! Form::select('lang', $langs, null, ['class' => 'form-control']) !!}   
                        {!! Form::hidden('ad_id', $ad_id) !!} 
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
                            {!! Form::radio('ad_type', 'video' ) !!} Video
                            {!! Form::radio('ad_type', 'image' ) !!} Image
                        </div>
                    </div>  
                    
                    <div id="video_cnt"> 
                        <div class="form-group">
                            {!! Form::label('video_embed', 'Embed Code:*', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::textarea('video_embed', "$video_embed", ['class' => 'form-control', 'size' => '20x2']) !!}  
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
                                <!--{!! Form::file('image') !!}-->                           
                                <select name="image_category" id="image_category" class="form-control">
                                    <option value="0">--Select Category--</option>
                                    @foreach($archivecategories as $key1=>$archivecategory )
                                    <option value="{{ $key1 }}" @if($category==$key1) selected  @endif>{{ $archivecategory }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <select name="id_image" id="id_image" class="form-control">
                                    <option value="0">--Select Image--</option>
                                    @foreach($archiveimages as $archiveimage )
                                    <option value="{{ $archiveimage->id_image }}" @if($id_image==$archiveimage->id_image) selected  @endif>{{ $archiveimage->title_image_en }}</option>
                                    @endforeach
                                </select>
                                <a class="viewficherfile" href="{{url('/uploads/ads/'.$image_name)}}" onclick="window.open(this.href, 'archive images',
'left=20,top=20,width=600,height=600,toolbar=0,resizable=0'); return false;"><img src={{asset('img/preview.gif')}} alt="preview"></a>
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
                            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                             <a href="{{ URL::to('/admin/ads/index') }}" class="btn btn-info">
                                Cancel
                            </a>
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
<?php
$startdate = $ads->start_date;
$enddate   = $ads->end_date;
$page      = $ads->page;
$position  = $ads->position;
$ad_type   = $ads->ad_type;
//echo '<pre>';
//print_r($ads);
?>
<script type="text/javascript">
$(function() {
    
    $('.year').datepicker({ dateFormat: 'yyyy',autoclose: true });
    $('.date').datepicker({ format: 'yyyy-mm-dd',autoclose: true });   
    
    
    
    if($( "#page" ).val() == null ){
        var page  = '{{ $page }}';
    }else{
        var page = $( "#page" ).val();
    }
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
         }else{
            $('#hom_type').show();
            var typeval2 = $('input[name="ad_type"]:checked').val();
            if(typeval2 == "image")
            {
                $('#video_cnt').hide();  
                $('#img_cnt').show(); 
            } 

            if(typeval2 == "video")
            {
                $('#video_cnt').show();  
                $('#img_cnt').hide(); 
            }
         }
         
         if(pos_val==2){
            $('#sec_positions').show();
         }else{
            $('#sec_positions').hide();
            $('#position').val("Top");
         }
    });
    
     
    
//        var id=$("#image_category").val();
//        if(id){
//            $.ajax({
//                type: "GET",
//                url: '/admin/ads/show/'+id,
//                cache: false,
//                success: function(html)
//                {
//                    $("#id_image").html(html);
//                }
//            });
//        }
//        var image_val = '{{$id_image}}';
//        if(image_val){
//            
//            $.ajax({
//                type: "GET",
//                url: '/admin/ads/previewimage/'+image_val,
//                cache: false,
//                success: function(html)
//                {
//                    $(".viewficherfile").attr("href", html);     
//                }
//            });
//            $("#id_image").val(image_val);
//        }
    
    
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
                $(".viewficherfile").attr("href", html);                         
            }
         });
    }); 
    
    
    
//    pos_val_show_hide(page);
//    
//    $('#page').on('change', function() {
//        var pos_val = this.value    
//        pos_val_show_hide(pos_val);         
//    });
//        
//    var ad_type  = '{{ $ad_type }}';
//    ad_type_show_hide(ad_type)
//    
//    $('input[name="ad_type"]').on('ifChecked', function(event){
//        var typeval = $(this).val();   
//        ad_type_show_hide(typeval);
//    });
//    
//    function pos_val_show_hide(pos_val)
//    {         
//        // For home page video or image content display
//        if(pos_val!=1)
//        {            
//           $('#hom_type').hide(); 
//           $('#video_cnt').hide();  
//           $('#img_cnt').show(); 
//        }else{
//           $('#hom_type').show();
//           $('#video_cnt').show();  
//           $('#img_cnt').hide(); 
//        }
//
//        if(pos_val==2){
//           $('#sec_positions').show();
//        }else{
//           $('#sec_positions').hide();
//           $('#position').val("Top");
//        }
//     }
//    
//    function ad_type_show_hide(ad_type)
//    {      
//         // If admin choose video , and hide image enter area   
//        if(ad_type=="image")
//        {
//            $('#video_cnt').hide();  
//            $('#img_cnt').show(); 
//        } 
//
//        if(ad_type=="video")
//        {
//            $('#video_cnt').show();  
//            $('#img_cnt').hide(); 
//        }
//    }
    
    
});
</script>
@stop