@extends('admin.layout')

@section('title') {{ trans('profile.heading') }} @stop

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">{{ trans('profile.heading') }}</h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($user, ['role' => 'form']) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('name', trans('profile.name')) !!}
                            {!! Form::text('name', null, ['placeholder' => trans('profile.name'), 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('email', trans('profile.email')) !!}
                            {!! Form::text('email', null, ['placeholder' => trans('profile.email'), 'class' => 'form-control']) !!}
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        {!! Form::submit(trans('profile.button'), ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
            </div><!-- /.box -->
        </div>
    </div>   
    <!-- /.row -->
</section>
<!-- /.content -->
@stop