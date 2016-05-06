@extends('admin.layout')

@section('title') Editions @stop

@section('link')
<link href="{{ URL::asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('script_files')
<script src="{{ URL::asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>
@stop

@section('scripts')
<script>
$(function () {
    $("#example1").dataTable();
});
</script>
@stop

@section('content')
<!-- Main content -->
<section class="content">

    @include('admin.partials.flash_message')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{URL::to('admin/editions/create')}}" class="btn btn-primary btn-link pull-right">
                        Add
                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Name En</th>
                                <th>Name Fr</th>
                                <th>Default</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($editions as $key => $edition)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $edition->edition_name_en }}</td>
                                <td>{{ $edition->edition_name_fr }}</td>
                                <td>
                                 @if($edition->is_current_edition == 1)                               
                                        <i class="fa fa-circle text-green"></i>                                   
                                 @endif
                                </td>
                                <td align="center">
                                    <a href="{{route('admin.editions.edit',$edition->edition_id)}}" >
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                                     <a href="{{URL::to('admin/editions/destroy',array($edition->edition_id))}}" onclick="return confirm('Are you sure you want to delete? Because this action will delete related articles below these edition.')" >
                                        <i class="glyphicon glyphicon-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
</section>
<!-- /.content -->
@stop

