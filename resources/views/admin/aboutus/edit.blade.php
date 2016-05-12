@extends('admin.layout')

@section('title') Edit About us @stop

@section('content')

<!-- Main content -->
<section class="content">
       @include('admin.partials.errors')
       @include('admin.partials.flash_message')
<div class="user-create">
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            <div class="box box-primary">
                {!! Form::model($aboutus_date, ['role' => 'form' ,'class' => 'form-horizontal','url'=>['admin/aboutus/update'], 'files'=>'true']) !!} 
                <div class="box-body">
                    
                    <div class="form-group">
                        {!! Form::label('content_fr', 'Content Fr:*', array( 'class' => 'col-sm-2 control-label')) !!}
                        <div class="col-sm-5">
                        {!! Form::textarea('content_fr', null, ['class' => 'form-control', 'placeholder' => 'Description', 'size' => '20x5']) !!}
                        </div>
                    </div>
                    
                    <div class="form-group">
                       {!! Form::label('content_en', 'Content En:*', array( 'class' => 'col-sm-2 control-label')) !!}                
                       <div class="col-sm-5">
                        {!! Form::textarea('content_en', null, ['class' => 'form-control', 'placeholder' => 'Description', 'size' => '20x5']) !!}
                       </div>
                    </div>  
                </div><!-- /.box-body -->
                <div class="box-footer">
                    <div class="form-group">
                        <div class="col-sm-0 col-sm-offset-2">
                            {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                             <a href="{{ URL::to('/admin/dashboard') }}" class="btn btn-info">
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