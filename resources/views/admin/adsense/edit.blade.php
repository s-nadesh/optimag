@extends('admin.layout')

@section('title') Edit Adsense @stop

@section('content')
<!-- Main content -->
<section class="content">
    
    @include('admin.partials.errors')
    
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                
                <!-- form start -->
                {!! Form::model($adsense, ['class' => 'form-horizontal','method' => 'PATCH', 'role' => 'form', 'route'=>['admin.adsenses.update', $adsense->ads_id]]) !!}
                <div class="box-body">                    
                        <div class="form-group">
                            {!! Form::label('position', 'Position:*', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::select('position', $positions, null, ['class' => 'form-control']) !!}                                  
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('ads_content', 'Content:*', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::textarea('ads_content', null, ['class' => 'form-control', 'placeholder' => '', 'size' => '20x2']) !!}  
                            </div>
                        </div>
                        <div class="form-group">
                            {!! Form::label('status', 'Status:*', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::radio('status', '1', true) !!} Enable
                                {!! Form::radio('status', '0', true) !!}Disable
                            </div>
                        </div>                    
                </div>
                 

                <div class="box-footer">
                    <div class="col-sm-0 col-sm-offset-2">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ URL::to('/admin/adsenses') }}" class="btn btn-info">
                        Cancel
                    </a>
                    </div>
                </div>
                {!! Form::close() !!}
            </div><!-- /.box -->
        </div>
    </div>   
    <!-- /.row -->
</section>
<!-- /.content -->
@stop