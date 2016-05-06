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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($editions as $key => $edition)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $edition->edition_name_en }}</td>
                                <td>{{ $edition->edition_name_fr }}</td>
                                <td align="center">
                                    <a href="{{route('admin.editions.edit',$edition->edition_id)}}" >
                                        <i class="glyphicon glyphicon-pencil"></i>
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

