@extends('admin.layout')

@section('title') Adsenses @stop

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
                    <a href="{{route('admin.adsenses.create')}}" class="btn btn-primary btn-link pull-right">
                        Add
                    </a>
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Position</th>
                                <th>Size</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($adsenses as $key => $adsense)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $adsense->adsPosition->title }}</td>
                                <td>{{ $adsense->adsPosition->format }}</td>
                                <td align="center">
                                    <?php if($adsense->status == 1){ ?>
                                    
                                        <i class="fa fa-circle text-green"></i>
                                    <?php }else{?>
                                        <i class="fa fa-circle text-red"></i>
                                    <?php }?>
                                </td>
                                <td align="center">
                                    <a href="{{route('admin.adsenses.edit',$adsense->ads_id)}}" >
                                       <i class="glyphicon glyphicon-pencil"></i>
                                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{URL::to('admin/adsenses/destroy',$adsense->ads_id)}}" onclick="return confirm('Are you sure you want to delete?')" >
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

