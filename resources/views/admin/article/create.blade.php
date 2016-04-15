@extends('admin.layout')

@section('title') Create Article @stop

@section('script_files')
<script src="{{ URL::asset('js/jquery.bootstrap.wizard.js') }}" type="text/javascript"></script>
@stop

@section('scripts')

<script>
$(document).ready(function () {

    $('#rootwizard').bootstrapWizard({
        'nextSelector': '.button-next',
        'previousSelector': '.button-previous',
        'firstSelector': '.button-first',
        'lastSelector': '.button-last'
    });

    var en_max_fields = 10;
    var en_wrapper = $("#en_images");
    var en_add_button = $(".en_add_button");
    var en_x = 1;

    $(en_add_button).click(function (e) {
        e.preventDefault();
        if (en_x < en_max_fields) {
            var en_html = '<div class="box-body" id="remove_en' + en_x + '"><div class="row">';
            en_html += '<div class="col-xs-3"><input type="file" name="article[lang][en][article_image][' + en_x + '][image]"></div>';
            en_html += '<div class="col-xs-2"><input type="text" name="article[lang][en][article_image][' + en_x + '][text]" placeholder="Image Text" class="form-control"></div>';
            en_html += '<div class="col-xs-2"><input type="text" name="article[lang][en][article_image][' + en_x + '][link]" placeholder="Image Link" class="form-control"></div>';
            en_html += '<div class="col-xs-3"><textarea rows="3" cols="20" name="article[lang][en][article_image][' + en_x + '][description]" placeholder="Image Description" class="form-control"></textarea></div>';
            en_html += '<div class="col-xs-2"><button class="btn btn-danger en_remove_field" data-remove-id="remove_en' + en_x + '">Remove</button></div>';
            en_html += '</div></div>';
            $(en_wrapper).append(en_html);
            en_x++;
        }
    });

    $(en_wrapper).on("click", ".en_remove_field", function (e) { //user click on remove text
        e.preventDefault();
        var remove_id = $(this).data("remove-id");
        $('#' + remove_id).remove();
        en_x--;
    })

    var fr_max_fields = 10;
    var fr_wrapper = $("#fr_images");
    var fr_add_button = $(".fr_add_button");
    var fr_x = 1;

    $(fr_add_button).click(function (e) {
        e.preventDefault();
        if (fr_x < fr_max_fields) {
            var fr_html = '<div class="box-body" id="remove_fr' + fr_x + '"><div class="row">';
            fr_html += '<div class="col-xs-3"><input type="file" name="article[lang][fr][article_image][' + fr_x + '][image]"></div>';
            fr_html += '<div class="col-xs-2"><input type="text" name="article[lang][fr][article_image][' + fr_x + '][text]" placeholder="Image Text" class="form-control"></div>';
            fr_html += '<div class="col-xs-2"><input type="text" name="article[lang][fr][article_image][' + fr_x + '][link]" placeholder="Image Link" class="form-control"></div>';
            fr_html += '<div class="col-xs-3"><textarea rows="3" cols="20" name="article[lang][fr][article_image][' + fr_x + '][description]" placeholder="Image Description" class="form-control"></textarea></div>';
            fr_html += '<div class="col-xs-2"><button class="btn btn-danger fr_remove_field" data-remove-id="remove_fr' + fr_x + '">Remove</button></div>';
            fr_html += '</div></div>';
            $(fr_wrapper).append(fr_html);
            fr_x++;
        }
    });

    $(fr_wrapper).on("click", ".fr_remove_field", function (e) { //user click on remove text
        e.preventDefault();
        var remove_id = $(this).data("remove-id");
        $('#' + remove_id).remove();
        fr_x--;
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

            {!! Form::open(['class' => 'form-horizontal', 'id' => 'articleForm', 'role' => 'form','route'=>['admin.articles.store'], 'files'=>true]) !!}
            <div class="nav-tabs-custom" id="rootwizard">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_1" data-toggle="tab">General</a></li>
                    <li><a href="#tab_2" data-toggle="tab">English</a></li>
                    <li><a href="#tab_3" data-toggle="tab">French</a></li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="form-group">
                            {!! Form::label('article[edition_id]', 'Edition:*', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::select('article[edition_id]', $editions, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('article[section_id]', 'Section:*', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::select('article[section_id]', $sections, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        
                        <div class="form-group">
                            {!! Form::label('article[year]', 'Year:*', ['class' => 'col-sm-2 control-label']) !!}
                            <div class="col-sm-5">
                                {!! Form::select('article[year]', $years, null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                    </div><!-- /.tab-pane -->

                    <div class="tab-pane" id="tab_2">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('article[lang][en][title]', 'Title:*', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class="col-sm-7">
                                        {!! Form::text('article[lang][en][title]', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('article[lang][en][writer_name]', 'Writer Name:*', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class="col-sm-7">
                                        {!! Form::text('article[lang][en][writer_name]', null, ['class' => 'form-control', 'placeholder' => 'Writer Name']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('article[lang][en][writer_company]', 'Writer Company:*', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class="col-sm-7">
                                        {!! Form::text('article[lang][en][writer_company]', null, ['class' => 'form-control', 'placeholder' => 'Writer Company']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('article[lang][en][description]', 'Description:*', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class="col-sm-7">
                                        {!! Form::textarea('article[lang][en][description]', null, ['class' => 'form-control', 'placeholder' => 'Description', 'size' => '20x2']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('article[lang][en][embed_video]', 'Embed Video:*', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class="col-sm-7">
                                        {!! Form::textarea('article[lang][en][embed_video]', null, ['class' => 'form-control', 'placeholder' => 'Embed Video', 'size' => '20x2']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-danger">
                                    <div class="box-header">
                                        <h3 class="box-title">Images</h3>
                                        <button class="btn btn-primary en_add_button">Add More Fields</button>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                <input type="file" name="article[lang][en][article_image][0][image]">
                                            </div>
                                            <div class="col-xs-2">
                                                <input type="text" name="article[lang][en][article_image][0][text]" placeholder="Image Text" class="form-control">
                                            </div>
                                            <div class="col-xs-2">
                                                <input type="text" name="article[lang][en][article_image][0][link]" placeholder="Image Link" class="form-control">
                                            </div>
                                            <div class="col-xs-3">
                                                <textarea rows="3" cols="20" name="article[lang][en][article_image][0][description]" placeholder="Image Description" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="en_images">

                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane" id="tab_3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('article[lang][fr][title]', 'Title:*', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class="col-sm-7">
                                        {!! Form::text('article[lang][fr][title]', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('article[lang][fr][writer_name]', 'Writer Name:*', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class="col-sm-7">
                                        {!! Form::text('article[lang][fr][writer_name]', null, ['class' => 'form-control', 'placeholder' => 'Writer Name']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('article[lang][fr][writer_company]', 'Writer Company:*', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class="col-sm-7">
                                        {!! Form::text('article[lang][fr][writer_company]', null, ['class' => 'form-control', 'placeholder' => 'Writer Company']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    {!! Form::label('article[lang][fr][description]', 'Description:*', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class="col-sm-7">
                                        {!! Form::textarea('article[lang][fr][description]', null, ['class' => 'form-control', 'placeholder' => 'Description', 'size' => '20x2']) !!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    {!! Form::label('article[lang][fr][embed_video]', 'Embed Video:*', ['class' => 'col-sm-4 control-label']) !!}
                                    <div class="col-sm-7">
                                        {!! Form::textarea('article[lang][fr][embed_video]', null, ['class' => 'form-control', 'placeholder' => 'Embed Video', 'size' => '20x2']) !!}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="box box-danger">
                                    <div class="box-header">
                                        <h3 class="box-title">Images</h3>
                                        <button class="btn btn-primary fr_add_button">Add More Fields</button>
                                    </div>
                                    <div class="box-body">
                                        <div class="row">
                                            <div class="col-xs-3">
                                                {!! Form::file('article[lang][fr][article_image][0][image]') !!}
                                            </div>
                                            <div class="col-xs-2">
                                                {!! Form::text('article[lang][fr][article_image][0][text]', null, ['class' => 'form-control', 'placeholder' => 'Image Text']) !!}
                                            </div>
                                            <div class="col-xs-2">
                                                {!! Form::text('article[lang][fr][article_image][0][link]', null, ['class' => 'form-control', 'placeholder' => 'Image Link']) !!}
                                            </div>
                                            <div class="col-xs-3">
                                                {!! Form::textarea('article[lang][fr][article_image][0][description]', null, ['class' => 'form-control', 'placeholder' => 'Image Description', 'size' => '20x3']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div id="fr_images">

                                    </div>
                                    <!-- /.box-body -->
                                </div>
                            </div>
                        </div>
                    </div><!-- /.tab-pane -->

                    <div class="form-group">
                        <div class="col-sm-6 pull-right">
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