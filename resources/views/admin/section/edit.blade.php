@extends('admin.layout')

@section('title') Edit Section @stop

@section('content')
<!-- Main content -->
<section class="content">
    
    @include('admin.partials.errors')
    
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                {!! Form::model($section, ['class' => 'form-horizontal','method' => 'PATCH', 'role' => 'form', 'route'=>['admin.sections.update', $section->section_id]]) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('section_name_en', 'Section Name En:*', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('section_name_en', null, ['placeholder' => 'Section Name En', 'class' => 'form-control']) !!}                                                            
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('section_name_fr', 'Section Name Fr:*', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('section_name_fr', null, ['placeholder' => 'Section Name Fr', 'class' => 'form-control']) !!}                                                            
                        </div>
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    <div class="col-sm-0 col-sm-offset-2">
                        {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                        <a href="{{ URL::to('/admin/sections') }}" class="btn btn-info">
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