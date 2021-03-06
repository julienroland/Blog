@extends('core::layouts.master')

@section('styles')
<script src="{{ Module::asset('core:js/vendor/ckeditor/ckeditor.js') }}" type="text/javascript"></script>
<link href="{{{ Module::asset('blog:css/selectize.css') }}}" rel="stylesheet" type="text/css" />
@stop

@section('content-header')
<h1>
    {{ trans('blog::post.title.create post') }}
</h1>
<ol class="breadcrumb">
    <li><a href="{{ URL::route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
    <li><a href="{{ URL::route('dashboard.post.index') }}">{{ trans('blog::post.title.post') }}</a></li>
    <li class="active">{{ trans('blog::post.title.create post') }}</li>
</ol>
@stop

@section('content')
{!! Form::open(['route' => ['dashboard.post.store'], 'method' => 'post']) !!}
<div class="row">
    <div class="col-md-10">
        <div class="nav-tabs-custom">
            @include('core::partials.form-tab-headers')
            <div class="tab-content">
                <?php $i = 0; ?>
                <?php foreach(LaravelLocalization::getSupportedLocales() as $locale => $language): ?>
                    <?php $i++; ?>
                    <div class="tab-pane {{ App::getLocale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                        @include('blog::admin.posts.partials.create-fields', ['lang' => $locale])
                    </div>
                <?php endforeach; ?>
                <div class="box-footer">
                    <button type="submit" class="btn btn-primary btn-flat">{{ trans('blog::post.button.create post') }}</button>
                    <a class="btn btn-danger pull-right btn-flat" href="{{ URL::route('dashboard.post.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                </div>
            </div>
        </div> {{-- end nav-tabs-custom --}}
    </div>
    <div class="col-md-2">
        <div class="box box-info">
            <div class="box-body">
                <div class="form-group">
                    {!! Form::label("category", 'Category:') !!}
                    <select name="category_id" id="category" class="form-control">
                        <?php foreach($categories as $category): ?>
                           <option value="{{ $category->id }}">{{ $category->name }}</option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class='form-group{{ $errors->has("tags") ? ' has-error' : '' }}'>
                   {!! Form::label("tags", 'Tags:') !!}
                   {{--{!! Form::text("tags", Input::old("tags"), ['class' => 'input-tags', 'placeholder' => 'Tags']) !!}--}}
                   <select name="tags[]" id="tags" class="input-tags" multiple></select>
                   {!! $errors->first("tags", '<span class="help-block">:message</span>') !!}
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop

@section('scripts')
<script src="{{ Module::asset('blog:js/selectize.min.js') }}" type="text/javascript"></script>
<script src="{{ Module::asset('blog:js/MySelectize.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(function() {
        CKEDITOR.replaceAll(function( textarea, config ) {
            config.language = '<?php echo App::getLocale() ?>';
        } );
    });

    $( document ).ready(function() {
        $('.input-tags').MySelectize({
            'findUri' : '/api/tag/findByName/',
            'createUri' : '/api/tag'
        });
    });
</script>
@stop
