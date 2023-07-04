@extends('layouts.app')

@section('template_title')
    Attach Variations - {{$product->title}}
@endsection
@section('template_linked_css')

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
                            Attach Variation
                            <div class="pull-right">
                                <a href="{{ route('admin.products.list') }}" class="btn btn-light btn-sm float-right" data-toggle="tooltip" data-placement="left" title="Back to Products">
                                    <i class="fa fa-fw fa-reply-all" aria-hidden="true"></i>
                                    Back to Products
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        {!! Form::open(array('route' => ['admin.products.variations.store', $product->slug], 'method' => 'POST', 'role' => 'form', 'class' => 'needs-validation', 'files' => true)) !!}

                        {!! csrf_field() !!}

                        <div class="form-group has-feedback row {{ $errors->has('variations.*') ? ' has-error ' : '' }}">
                            <label for="exampleFormControlSelect1" class="col-md-3 control-label">Variations <small>(Ctrl to select multiple)</small></label>

                            <div class="col-md-9">
                                <div class="input-group">
                                    <select size="10" multiple class="form-control{{ $errors->has('variations.*') ? ' is-invalid' : '' }}" id="category-select" name="variations[]" required>
                                        @foreach($product->variations as $variation)
                                            <option selected value="{{$variation->id}}">{{$variation->title}}</option>
                                        @endforeach
                                        @foreach($variations as $variation)
                                            <option value="{{$variation->id}}">{{$variation->title}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                        <label for="email" class="input-group-text">
                                            <i class="fa fa-fw fa-edit" aria-hidden="true"></i>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('variations.*'))
                                <span class="help-block">
                                 @foreach($errors->get('variations.*') as $errrs)
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
@endsection