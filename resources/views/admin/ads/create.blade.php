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
<div class="user-create">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="box box-primary">
                {!! Form::open(['role' => 'form' ,'class' => 'form-horizontal','route'=>['admin.ads.store']]) !!}    
                <div class="box-body">
                    <div class="form-group">
                       {!! Form::label('ad_title', 'Ad Title:*', array( 'class' => 'col-sm-2 control-label')) !!}                
                       <div class="col-sm-5">
                            {!! Form::text('ad_title', null, ['placeholder' => 'Ad Title', 'class' => 'form-control']) !!} 
                       </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('ad_title', 'Ad Link:', array( 'class' => 'col-sm-2 control-label')) !!}
                        <div class="col-sm-5">
                        {!! Form::text('ad_title', null, ['placeholder' => 'Ad Link', 'class' => 'form-control']) !!}
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
                        {!! Form::text('start_date', null, array('type' => 'text','readonly' => 'readonly' ,'class' => 'form-control date','placeholder' => 'Pick the date the ad will start', 'id' => 'calendar1')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('end_date', 'End date:', array( 'class' => 'col-sm-2 control-label')) !!}
                        <div class="col-sm-5">
                        {!! Form::text('end_date',  null, array('type' => 'text','readonly' => 'readonly' ,'class' => 'form-control date','placeholder' => 'Pick the date the ad will end', 'id' => 'calendar2')) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('position', 'Position:', array( 'class' => 'col-sm-2 control-label')) !!}
                        <div class="col-sm-5">
                        {!! Form::text('position', null, ['placeholder' => 'Position', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                     <div class="form-group">
                        {!! Form::label('lang', 'Language:', array( 'class' => 'col-sm-2 control-label')) !!}
                        <div class="col-sm-5">
                        {!! Form::text('lang', null, ['placeholder' => 'lang', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                     <div class="form-group">
                        {!! Form::label('status', 'Status:', array( 'class' => 'col-sm-2 control-label')) !!}
                        <div class="col-sm-5">
                        {!! Form::text('status', null, ['placeholder' => 'status', 'class' => 'form-control']) !!}
                        </div>
                    </div>

                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="form-group">
                        <div class="col-sm-0 col-sm-offset-2">
                            <input type="submit" value="Ajouter cette publicité" name="yt0" class="btn btn-success">                    </div>
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
    $('.year').datepicker({ dateFormat: 'yyyy' });
    $('.date').datepicker({ format: 'yyyy-mm-dd' });    
});
</script>
@stop