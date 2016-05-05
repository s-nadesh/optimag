@extends('admin.layout')

@section('title') Edit Archivage Category @stop

@section('content')
<!-- Main content -->
<section class="content">
    
    @include('admin.partials.errors')
    
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="box box-primary">
                
                <!-- form start -->
                {!! Form::model($archivecategory, ['class' => 'form-horizontal','method' => 'PATCH', 'role' => 'form', 'route'=>['admin.archivecategories.update', $archivecategory->id_category]]) !!}
                <div class="box-body">                    
                        <div class="form-group">
                            {!! Form::label('category_fr', 'Title in French:*', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::text('category_fr', null, ['class' => 'form-control']) !!}                                                         
                            </div>
                        </div>
                        <div class="form-group" id="sec_positions">
                            {!! Form::label('category_en', 'Title in English:*', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::text('category_en', null, ['class' => 'form-control']) !!}                                                          
                            </div>
                        </div>
                </div>
                 

                <div class="box-footer">
                    <div class="col-sm-0 col-sm-offset-2">
                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ URL::to('/admin/archivecategories') }}" class="btn btn-info">
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