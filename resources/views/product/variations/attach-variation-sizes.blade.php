@extends('layouts.app')

@section('template_title')
    Attach Variation Sizes - {{$product->title}}
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
                            Attach Variation Sizes
                            <div class="pull-right">
                                <a href="{{ route('admin.products.list') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back to Products">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to Products
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['admin.products.variations.sizes.store', [$product->slug, $variation->id]], 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('sizes.*') ? ' has-error ' : '' }}">
                            <label for="exampleFormControlSelect1" class="col-md-3 control-label">Sizes </label>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <select id="sizes" name="sizes[]" multiple class="form-control js-data-example-ajax"></select>

                                    <div class="input-group-append">
                                        <label for="email" class="input-group-text">
                                            <i class="fa fa-fw fa-edit" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('sizes.*'))
                                <span class="help-block">
                                 @foreach($errors->get('sizes.*') as $errrs)
                                        @foreach($errrs as $error)
                                            <strong>{{ $error }}</strong><br>
                                        @endforeach
                                    @endforeach
                            </span>
                            @endif
                        </div>


                        {!! Form::button('Attach', array('class' => 'btn btn-success margin-bottom-1 mb-1 float-right','type' => 'submit' )) !!}
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer_scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $('#sizes').select2({
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
    </script>
@endsection
