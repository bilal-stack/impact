@extends('layouts.app')

@section('template_title')
    Edit Variation Sizes - {{$product->title}}
@endsection
@section('template_linked_css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('head')

@endsection

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-lg-10 offset-lg-1">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <label>Attach Variation size & styles - <b>{{$variation->title}}</b></label>
                            <div class="pull-right">
                                <a href="{{ route('admin.products.variations.list', $product->slug) }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back to Products">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to product variations list
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['admin.products.variations.sizes.update', [$productVariations->id]], 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('size') ? ' has-error ' : '' }}">
                            <label for="exampleFormControlSelect1" class="col-md-3 control-label">Sizes </label>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <select id="size" name="variation_size_id" class="form-control sizes">
                                        <option value="{{$size->id}}">{{$size->title}}</option>
                                    </select>

                                    <div class="input-group-append">
                                        <label for="email" class="input-group-text">
                                            <i class="fa fa-fw fa-edit" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('size'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('size') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('title') ? ' has-error ' : '' }}">
                            <label for="exampleFormControlSelect1" class="col-md-3 control-label">Search Title:
                            </label>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <select id="title_id" name="variation_style_id" class="form-control title_id">
                                        <option value="{{$style->id}}">{{$style->title}}</option>
                                    </select>

                                    <div class="input-group-append">
                                        <label for="email" class="input-group-text">
                                            <i class="fa fa-fw fa-file-text-o" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('title'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                            @endif
                        </div>

                        <hr>

                        <div class="form-group has-feedback row">
                            {!! Form::label('image', 'Uploaded Product Image', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    @php
                                        if (strpos($productVariations->image, "https") !== false) {
                                            $image = $productVariations->image;
                                        } else {
                                            $image = asset('storage/product-style-images/' . $productVariations->image);
                                        }
                                    @endphp
                                    <img width="50%" src="{{$image}}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('product_image') ? ' has-error ' : '' }}">
                            {!! Form::label('product_image', 'Product Image (it will replace the old one)', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="file" name="product_image" id="product_image" class="form-control {{ $errors->has('product_image') ? ' has-error ' : '' }}" accept="image/png, image/gif, image/jpeg">
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="product_image">
                                            <i class="fa fa-fw fa-file" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('product_image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('product_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <hr>

                        <div class="form-group has-feedback row">
                            {!! Form::label('image', 'Uploaded Back Image', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <img width="50%" src="{{asset('storage/product-style-images/' . $productVariations->back_image)}}">
                                </div>
                            </div>
                        </div>
                        <div class="form-group has-feedback row {{ $errors->has('back_product_image') ? ' has-error ' : '' }}">
                            {!! Form::label('back_product_image', 'Product Back Image (it will replace the old one)', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="file" name="back_product_image" id="back_image" class="form-control {{ $errors->has('back_product_image') ? ' has-error ' : '' }}" accept="image/png, image/gif, image/jpeg">
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="product_image">
                                            <i class="fa fa-fw fa-file" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('back_product_image'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('back_image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('price') ? ' has-error ' : '' }}">
                            {!! Form::label('price', 'Price', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <input type="number" step="any" name="price" id="price" class="form-control {{ $errors->has('price') ? ' has-error ' : '' }}" value="{{old('price', $productVariations->price)}}">
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="price">
                                            <i class="fa fa-fw fa-dollar" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('price'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('price') }}</strong>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>tinymce.init({selector:'textarea'});</script>

    <script>
        $('#size').select2({
            ajax: {
                url: '{{route('ajax.get.variation.sizes')}}',
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data
                    };
                }
            },
            placeholder: 'Search for a size',
        });

        $('#title_id').select2({
            ajax: {
                url: '{{route('ajax.get.variations.style')}}',
                processResults: function (data) {
                    // Transforms the top-level key of the response object from 'items' to 'results'
                    return {
                        results: data.data
                    };
                }
            },
            placeholder: 'Search for a style',
        });
    </script>
@endsection
