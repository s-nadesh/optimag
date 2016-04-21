@extends('admin.layout')

@section('title') Edit Edition @stop

@section('content')
<!-- Main content -->
<section class="content">
    
    @include('admin.partials.errors')
    
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                
                <!-- form start -->
                {!! Form::model($edition, ['class' => 'form-horizontal','method' => 'PATCH', 'role' => 'form','route'=>['admin.editions.update',$edition->edition_id]]) !!}
                <div class="box-body">                    
                    <div class="form-group">
                        {!! Form::label('edition_name_en', 'Edition Name En:*', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('edition_name_en', null, ['placeholder' => 'Edition Name En', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('edition_name_fr', 'Edition Name Fr:*', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                            {!! Form::text('edition_name_fr', null, ['placeholder' => 'Edition Name Fr', 'class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

                    <div class="box-footer">
                        <div class="col-sm-0 col-sm-offset-2">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ URL::to('/admin/editions') }}" class="btn btn-info">
                                Back
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