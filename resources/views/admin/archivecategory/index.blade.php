@extends('admin.layout')

@section('title') Archivage Categories @stop

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
                    <a href="{{route('admin.archivecategories.create')}}" class="btn btn-primary btn-link pull-right">
                        Add Category
                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Title in French</th>
                                <th>Title in English</th>                               
                                <th></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($archivecategories as $key => $archivecategory)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $archivecategory->category_fr }}</td>     
                                <td>{{ $archivecategory->category_en }}</td>
                                <td align="center">
                                    <a href="{{URL::to('admin/archiveimages/index',$archivecategory->id_category)}}" data-toggle="tooltip" title="" class="view" data-original-title="Voir">
                                        <i class="glyphicon glyphicon-eye-open"></i>
                                    </a>
                                </td>
                                <td align="center">
                                    <a href="{{route('admin.archivecategories.edit',$archivecategory->id_category)}}" >
                                       <i class="glyphicon glyphicon-pencil"></i>
                                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{URL::to('admin/archivecategories/destroy',$archivecategory->id_category)}}" onclick="return confirm('Are you sure you want to delete?')" >
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

