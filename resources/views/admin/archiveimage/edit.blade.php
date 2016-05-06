@extends('admin.layout')

@section('title') Edit Archivage Image @stop

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
                {!! Form::model($archiveimage, ['role' => 'form' ,'class' => 'form-horizontal','url'=>['admin/archiveimages/update'], 'files'=>'true']) !!} 
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
                                
                                @if($image_file!=null)
                                
                                {!! Form::hidden('image', $image_file) !!} 
                                {!! Form::hidden('extension', $extension) !!}
                                {!! Html::image('uploads/ads/'.$archiveimage->id_category.'/'.$image_file, 'Ad Picture', array('width' => 70, 'height' => 70 ,'class' => 'thumb')) !!}
                                @endif
                                {!! Form::hidden('id_image', $id_image) !!} 
                            </div>
                            
                        </div> 
                    
<!--                    <div class="form-group">
                        {!! Form::label('status', 'Status:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                            {!! Form::radio('status', '1', true) !!} Enable
                            {!! Form::radio('status', '0', null) !!} Disable
                        </div>
                    </div>-->
                           
                           

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="form-group">
                        <div class="col-sm-0 col-sm-offset-2">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                             <a href="{{ URL::to('/admin/archiveimages/index/'.$archiveimage->id_category) }}" class="btn btn-info">
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
@stop