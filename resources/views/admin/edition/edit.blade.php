@extends('admin.layout')

@section('title') Edition @stop

@section('content')
<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Edit Edition  </h3>
                </div><!-- /.box-header -->
                <!-- form start -->
                {!! Form::model($edition, ['method' => 'PATCH', 'role' => 'form','route'=>['admin.editions.update',$edition->edition_id]]) !!}
                    <div class="box-body">
                        <div class="form-group">
                            {!! Form::label('edition_name_en', 'Edition Name En:') !!}
                            {!! Form::text('edition_name_en', null, ['placeholder' => 'Edition Name En', 'class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('edition_name_fr', 'Edition Name Fr:') !!}
                            {!! Form::text('edition_name_fr', null, ['placeholder' => 'Edition Name Fr', 'class' => 'form-control']) !!}
                        </div>
                    </div><!-- /.box-body -->

                    <div class="box-footer">
                        {!! Form::submit('Edit', ['class' => 'btn btn-primary']) !!}
                    </div>
                {!! Form::close() !!}
            </div><!-- /.box -->
        </div>
    </div>   
    <!-- /.row -->
</section>
<!-- /.content -->
@stop