@extends('admin.layout')

@section('title') Settings @stop

@section('link')
<link href="{{ URL::asset('css/datatables/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@stop

@section('script_files')
<script src="{{ URL::asset('js/plugins/datatables/jquery.dataTables.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('js/plugins/datatables/dataTables.bootstrap.js') }}" type="text/javascript"></script>
@stop

@section('content')
<!-- Main content -->
<section class="content">
    @include('admin.partials.flash_message')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">               
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Section Positions</th>  
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($settings as $key => $sinfo)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $sinfo->section_position }}</td>                            
                                
                                <td align="center">
                                    <a href="{{route('admin.adssetting.edit',$sinfo->s_id)}}" >
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

