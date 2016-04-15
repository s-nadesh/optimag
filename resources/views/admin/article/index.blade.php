@extends('admin.layout')

@section('title') Articles @stop

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
                    <h3 class="box-title">Articles</h3>
                    <a href="{{URL::to('admin/article/create')}}" class="btn btn-primary btn-link pull-right">
                        Add
                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Language</th>
                                <th>Edition</th>
                                <th>Section</th>
                                <th>Year</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($articles as $key => $article)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ strtoupper($article->language) }}</td>
                                <td>{{ $article->edition->edition_name_en }}</td>
                                <td>{{ $article->section->section_name_en }}</td>
                                <td>{{ $article->year }}</td>
                                <td>{{ $article->title }}</td>
                                <td>
                                    <a href="{{URL::to('admin/article/edit',$article->article_key)}}" class="btn btn-info">
                                        Edit
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

