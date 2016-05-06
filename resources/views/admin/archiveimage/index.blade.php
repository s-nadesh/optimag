@extends('admin.layout')

@section('title') Archivage Images @stop

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
                    
                    <a href="{{URL::to('admin/archiveimages/create')}}" class="btn btn-primary btn-link pull-right">
                        Add Image
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
                                <th>Image</th>
                                <th>Extension </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($archiveimages as $key => $archiveimage)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $archiveimage->title_image_fr }}</td>  
                                <td>{{ $archiveimage->title_image_en }}</td> 
                                <td>{{ $archiveimage->image }}</td>  
                                <td>{{ $archiveimage->extension }}</td>
                                <td>
<!--                                    <a href="{{URL::to('uploads/ads/'.$archiveimage->id_category,$archiveimage->image)}}" onclick="window.open(this.href, 'archive images',
'left=20,top=20,width=600,height=600,toolbar=0,resizable=0'); return false;" >-->
                                    <a href="javascript:void(0);" class="pop">
                                        <img src="{{URL::to('uploads/ads/'.$archiveimage->id_category,$archiveimage->image)}}" style="display:none;">
                                       <i class="glyphicon glyphicon-eye-open"></i>
                                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                                     <a href="{{URL::to('admin/archiveimages/edit',$archiveimage->id_image)}}" >
                                       <i class="glyphicon glyphicon-pencil"></i>
                                    </a>&nbsp;&nbsp;&nbsp;&nbsp;
                                    <a href="{{URL::to('admin/archiveimages/destroy',$archiveimage->id_image)}}" onclick="return confirm('Are you sure you want to delete?')" >
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
    <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">              
      <div class="modal-body">
      	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <img src="" class="imagepreview" style="width: 100%;" >
      </div>
    </div>
  </div>
</div>
</section>
<!-- /.content -->
<script type="text/javascript">
    $(function() {
		$('.pop').on('click', function() {
			$('.imagepreview').attr('src', $(this).find('img').attr('src'));
			$('#imagemodal').modal('show');   
		});		
});
    </script>
@stop

