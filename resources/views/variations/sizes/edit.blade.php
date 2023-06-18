@extends('layouts.app')

@section('template_title')
    Edit Variation Size - {{$variation->title}}
@endsection

@section('template_fastload_css')
@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            Edit Variation Size - {{$variation->title}}
                            <div class="pull-right">
                                <a href="{{ route('admin.variations.sizes.list') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back to Sub Categories">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to Variations Sizes
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['admin.variations.sizes.update', $variation->id], 'method' => 'PUT', 'role' => 'form', 'class' => 'needs-validation', 'enctype' => 'multipart/form-data')) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('title') ? ' has-error ' : '' }}">
                            {!! Form::label('title', 'Variation Title', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('title', $variation->title, array('id' => 'title', 'class' => 'form-control', 'placeholder' => 'Enter Title')) !!}
                                    <div class="input-group-append">
                                        <label for="email" class="input-group-text">
                                            <i class="fa fa-fw fa-sort" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                            {!! Form::label('description', 'Description', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <textarea class="form-control {{ $errors->has('description') ? ' has-error ' : '' }}" name="description" id="description">{{$variation->description}}</textarea>
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-sort-alpha-desc" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('description'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        {!! Form::button('Update', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>
@endsection
