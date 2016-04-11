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
                <div class="box-header">
                    <h3 class="box-title">Edit Section  </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($section, ['method' => 'PATCH', 'role' => 'form', 'route'=>['admin.sections.update', $section->section_id]]) !!}
                <div class="box-body">
                    <div class="form-group">
                        {!! Form::label('section_name_en', 'Section Name En:*') !!}
                        {!! Form::text('section_name_en', null, ['placeholder' => 'Section Name En', 'class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('section_name_fr', 'Section Name Fr:*') !!}
                        {!! Form::text('section_name_fr', null, ['placeholder' => 'Section Name Fr', 'class' => 'form-control']) !!}
                    </div>
                </div><!-- /.box-body -->

                <div class="box-footer">
                    {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ URL::to('/admin/sections') }}" class="btn btn-info">
                        Back
                    </a>
                </div>
                {!! Form::close() !!}
            </div><!-- /.box -->
        </div>
    </div>   
    <!-- /.row -->
</section>
<!-- /.content -->
@stop