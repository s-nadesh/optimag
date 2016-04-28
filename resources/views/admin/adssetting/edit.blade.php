@extends('admin.layout')

@section('title') Edit Setting @stop

@section('content')
<!-- Main content -->
<section class="content">    
    @include('admin.partials.errors')    
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                
                <!-- form start -->
                {!! Form::model($settings, ['class' => 'form-horizontal','method' => 'PATCH', 'role' => 'form', 'route'=>['admin.adssetting.update', $settings->s_id]]) !!}
                <div class="box-body">                    
                      <div class="form-group">
                       {!! Form::label('section_position', 'Section Positions:*', array( 'class' => 'col-sm-2 control-label')) !!}                
                       <div class="col-sm-5">
                            {!! Form::text('section_position', null, ['placeholder' => 'Section Positions', 'class' => 'form-control']) !!} 
                       </div>
                    </div>           
                </div>
                 

                <div class="box-footer">
                    <div class="col-sm-0 col-sm-offset-2">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ URL::to('/admin/adssetting') }}" class="btn btn-info">
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