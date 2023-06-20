@extends('layouts.app')

@section('template_title')
    Create Prodcut
@endsection
@section('template_linked_css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" integrity="sha512-WvVX1YO12zmsvTpUQV8s7ZU98DnkaAokcciMZJfnNWyNzm7//QRV61t4aEr0WdIa4pe854QHLTV302vH92FSMw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
                            Create New Product
                            <div class="pull-right">
                                <a href="{{ route('admin.products.list') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back to Products">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to Products
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => 'admin.products.store', 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('title') ? ' has-error ' : '' }}">
                            {!! Form::label('title', 'Product Title', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('title', NULL, array('id' => 'email', 'class' => 'form-control', 'placeholder' => 'Enter Title')) !!}
                                    <div class="input-group-append">
                                        <label for="email" class="input-group-text">
                                            <i class="fa fa-fw fa-edit" aria-hidden="true"></i>
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

                        <div class="form-group has-feedback row {{ $errors->has('tagline') ? ' has-error ' : '' }}">
                            {!! Form::label('tagline', 'Product Tagline', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    {!! Form::text('tagline', NULL, array('id' => 'tagline', 'class' => 'form-control', 'placeholder' => 'Enter Tagline')) !!}
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="name">
                                            <i class="fa fa-fw fa-sort-alpha-desc" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                                @if ($errors->has('tagline'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('tagline') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('description') ? ' has-error ' : '' }}">
                            {!! Form::label('description', 'Description', array('class' => 'col-md-3 control-label')); !!}
                            <div class="col-md-9">
                                <div class="input-group">
                                    <textarea class="form-control {{ $errors->has('description') ? ' has-error ' : '' }}" name="description" id="description">{{old('description')}}</textarea>
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

                        <div class="form-group has-feedback row {{ $errors->has('category') ? ' has-error ' : '' }}">
                            <label for="exampleFormControlSelect1" class="col-md-3 control-label">Category</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="form-control{{ $errors->has('category') ? ' is-invalid' : '' }}" id="category-select" name="category">
                                        <option value="">Choose</option>
                                        @foreach($categories as $category)
                                            <option @if(old('category') == $category->id) selected @endif value="{{$category->id}}" data-slug="{{$category->slug}}">{{$category->title}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <label for="email" class="input-group-text">
                                            <i class="fa fa-fw fa-edit" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('category'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('category') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group has-feedback row {{ $errors->has('sub_category') ? ' has-error ' : '' }} d-none" id="sub-category-div">
                            <label for="exampleFormControlSelect1" class="col-md-3 control-label">Sub Category</label>
                            <div class="col-md-9">
                                <div class="input-group">
                                    <select class="form-control{{ $errors->has('sub_category') ? ' is-invalid' : '' }}" id="sub-category-select" name="sub_category">

                                    </select>
                                    <div class="input-group-append">
                                        <label for="email" class="input-group-text">
                                            <i class="fa fa-fw fa-edit" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('sub_category'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sub_category') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlFile1">Product Image</label>
                            <div class="needsclick-sec needsclick dropzone" id="document-dropzone" ></div>
                            @if ($errors->has('document'))
                                <span class="help-block">
                                     @foreach($errors->get('document') as $error)
                                        <strong>{{ $error }}</strong>
                                    @endforeach
                                </span>
                            @endif
                        </div>

                        {!! Form::button('Create', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        let getSubCatRoute = "{{route('ajax.get.sub.category', '')}}";
        let getStoreProductMediaRoute = "{{route('ajax.product.media.store')}}";
        let getRemoveProductMediaRoute = "{{route('ajax.product.media.remove')}}";

        let project = '';
        @if(isset($project) && $project->document)
            project = {!! json_encode($project->document) !!};
        @endif
    </script>

    <script src="{{asset('js/admin/product-create.js')}}"></script>
@endsection
