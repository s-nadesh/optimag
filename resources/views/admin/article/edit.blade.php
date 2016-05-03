@extends('admin.layout')

@section('title') Edit Article @stop

@section('script_files')
<script src="{{ URL::asset('js/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
@stop

@section('scripts')
<script>
$(document).ready(function () {

    $('#articlewizard').bootstrapWizard({
        'nextSelector': '.button-next',
        'previousSelector': '.button-previous',
    });

    var en_max_fields = 10;
    var en_wrapper = $("#en_images");
    var en_add_button = $(".en_add_button");
    var en_x = <?php echo count($data['article']['article_image']) ?>;

    $(en_add_button).click(function (e) {
        e.preventDefault();
        if (en_x < en_max_fields) {
            var en_html = '<div class="box-body" id="remove_en' + en_x + '"><div class="row">';
            en_html += '<div class="col-xs-3"><input type="file" name="article[article_image][' + en_x + '][image]"></div>';
            en_html += '<div class="col-xs-2"><input type="text" name="article[article_image][' + en_x + '][text]" placeholder="Image Text" class="form-control"></div>';
            en_html += '<div class="col-xs-2"><input type="text" name="article[article_image][' + en_x + '][link]" placeholder="Image Link" class="form-control"></div>';
            en_html += '<div class="col-xs-4"><textarea rows="2" cols="10" name="article[article_image][' + en_x + '][description]" placeholder="Image Description" class="form-control"></textarea></div>';
            en_html += '<div class="col-xs-1"><button class="btn btn-danger en_remove_field" data-remove-id="remove_en' + en_x + '"><i class="fa fa-trash"></i></button></div>';
            en_html += '</div></div>';
            $(en_wrapper).append(en_html);
            en_x++;
        }
    });

    $(en_wrapper).on("click", ".en_remove_field", function (e) {
        e.preventDefault();
        var remove_id = $(this).data("remove-id");
        $('#' + remove_id).remove();
        en_x--;
    })

});
</script>
@stop

@section('content')
<!-- Main content -->
<section class="content">
    @include('admin.partials.errors')
    <div class="row">
        <div class="col-md-12">

            {!! Form::model($data, ['class' => 'form-horizontal', 'id' => 'articleForm', 'role' => 'form','url'=>['admin/article/update'], 'files'=>true]) !!}
            <div class="nav-tabs-custom" id="articlewizard">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">General</a></li>
                    <li><a href="#tab_2" data-toggle="tab">Article Info</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="form-group">
                            {!! Form::label('article[edition_id]', 'Edition:', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::select('article[edition_id]', $editions, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('article[section_id]', 'Section:', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::select('article[section_id]', $sections, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('article[year]', 'Year:', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::select('article[year]', $years, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('article[language]', 'Language:', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::select('article[language]', $languages, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        
                         <div class="form-group">
                        {!! Form::label('article[status]', 'Status:', ['class' => 'col-sm-2 control-label']) !!}
                        <div class="col-sm-5">
                            {!! Form::radio('article[status]', '1', true) !!} Enable
                            {!! Form::radio('article[status]', '0', null) !!} Disable
                        </div>
                    </div>     
                    </div>

                    <div class="tab-pane" id="tab_2">
                        <div class="row">
                            {!! Form::hidden('article[article_id]') !!}
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('article[title]', 'Title:', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class="col-sm-7">
                                        {!! Form::text('article[title]', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('article[writer_name]', 'Writer Name:', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class="col-sm-7">
                                        {!! Form::text('article[writer_name]', null, ['class' => 'form-control', 'placeholder' => 'Writer Name']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('article[writer_company]', 'Writer Company:', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class="col-sm-7">
                                        {!! Form::text('article[writer_company]', null, ['class' => 'form-control', 'placeholder' => 'Writer Company']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('article[description]', 'Description:', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class="col-sm-7">
                                        {!! Form::textarea('article[description]', null, ['class' => 'form-control', 'placeholder' => 'Description', 'size' => '20x2']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('article[embed_video]', 'Embed Video:', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class="col-sm-7">
                                        {!! Form::textarea('article[embed_video]', null, ['class' => 'form-control', 'placeholder' => 'Embed Video', 'size' => '20x2']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-info">
                                    <div class="box-header">
                                        <h3 class="box-title">Images</h3>
                                        <button class="btn btn-primary en_add_button pull-right">
                                            <i class="fa fa-plus"></i> Add More 
                                        </button>
                                    </div>
                                    <div id="en_images">
                                        @if(!empty($data['article']['article_image']))
                                        @foreach($data['article']['article_image'] as $key => $images)
                                        <div class="box-body" id="remove_en{{$key}}">
                                            <div class="row">
                                                <input type="hidden" name="article[article_image][{{$key}}][article_image_id]" value="{{$images['article_image_id']}}" >
                                                <div class="col-xs-3">
                                                    <input type="file" name="article[article_image][{{$key}}][image]">
                                                    <img src="{{ asset('uploads/' . $images['image']) }}" height="80" />
                                                </div>
                                                <div class="col-xs-2">
                                                    <input type="text" name="article[article_image][{{$key}}][text]" placeholder="Image Text" class="form-control" value="{{$images['text']}}" >
                                                </div>
                                                <div class="col-xs-2">
                                                    <input type="text" name="article[article_image][{{$key}}][link]" placeholder="Image Link" class="form-control" value="{{$images['link']}}">
                                                </div>
                                                <div class="col-xs-4">
                                                    <textarea rows="2" cols="10" name="article[article_image][{{$key}}][description]" placeholder="Image Description" class="form-control">{{$images['description']}}</textarea>
                                                </div>
                                                <div class="col-xs-1">
                                                    <button class="btn btn-danger en_remove_field" data-remove-id="remove_en{{$key}}"><i class="fa fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- /.tab-pane -->

                    <div class="form-group">
                        <div class="col-sm-3 pull-right">
                            <input type='button' class='btn btn-default button-previous' name='previous' value='Previous' />
                            <input type='button' class='btn btn-default button-next' name='next' value='Next' />
                            <input type='submit' class='btn btn-primary button-last' name='last' value='Submit' />
                        </div>
                    </div>

                </div><!-- /.tab-content -->
            </div>
            {!! Form::close() !!}
        </div>
    </div>   
    <!-- /.row -->
</section>
<!-- /.content -->
@stop