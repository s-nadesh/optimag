@extends('admin.layout')

@section('title') Articles @stop

@section('link')
<link href="{{ URL::asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('script_files')
<script src="{{ URL::asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/plugins/datatables/jquery.dataTables.rowGrouping.js') }}" type="text/javascript"></script>
@stop

@section('scripts')
<script>
$(function () {
    $("#example1").dataTable({
       iDisplayLength: 25, 
    }).rowGrouping({    
        bExpandableGrouping: true,
        iGroupingColumnIndex: 0,
        sGroupingColumnSortDirection: "desc",
    });
});
</script>
@stop
<style>     
tr:hover th, tr:hover td
{
    background-color: #ebebeb;
    background-image: none;
}
td
{
    height: 26px;
    padding: 5px 5px 5px 20px !important;
    text-align: left;
    border-bottom: 1px solid #d0d0d0;
    vertical-align: middle;
    color: #555555;
    background-color: #ffffff;
}        
</style>
@section('content')
<!-- Main content -->
<section class="content">

    @include('admin.partials.flash_message')

    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <a href="{{URL::to('admin/article/create')}}" class="btn btn-primary btn-link pull-right">
                        Add an article
                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>  
                                <th>Year</th>    
                                <th>Title</th>                               
                                <th>Section</th>
                                <th>Edition</th>
                                <th>Language</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $key => $article)
                            <tr>
                               <td>{{ $article->year }} {{ $article->edition->edition_name_en }}</td>
                               <td>{{ $article->title }}</td>                                
                                <td>{{ $article->section->section_name_en }}</td>
                                <td>{{ $article->edition->edition_name_en }}</td>                               
                                <td>{{ $article->language }}</td>    
                                 <td align="center">
                                    @if($article->status == 1)                               
                                        <i class="fa fa-circle text-green"></i>
                                    @else
                                        <i class="fa fa-circle text-red"></i>
                                    @endif
                                </td>
                                <td align="center">
                                    <a href="{{URL::to('admin/article/edit',$article->article_id)}}">
                                       <i class="glyphicon glyphicon-pencil"></i>
                                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                                     <a href="{{URL::to('admin/article/destroy',$article->article_id)}}" onclick="return confirm('Are you sure you want to delete?')" >
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

