@extends('layouts.app')

@section('template_title')
    Product-{{$product->title}} Variation - {{$variation->title}}
@endsection

@section('template_linked_css')
    @if(config('usersmanagement.enabledDatatablesJs'))
        <link rel="stylesheet" type="text/css" href="{{ config('usersmanagement.datatablesCssCDN') }}">
    @endif
    <style type="text/css" media="screen">
        .users-table {
            border: 0;
        }
        .users-table tr td:first-child {
            padding-left: 15px;
        }
        .users-table tr td:last-child {
            padding-right: 15px;
        }
        .users-table.table-responsive,
        .users-table.table-responsive table {
            margin-bottom: 0;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">

                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                               Showing all sizes and styles of {{$variation->title}} & Product <b>{{$product->title}}</b>
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        {!! trans('usersmanagement.users-menu-alt') !!}
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{route('admin.products.variations.sizes.attach', [$product->slug, $variation->id])}}">
                                        <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                        Attach New size & style
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fa fa-fw fa-group" aria-hidden="true"></i>
                                        Deleted Products
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                <caption id="user_count">
                                    {{$childVariations->count()}} sizes & styles
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>#</th>
                                    <th>Size</th>
                                    <th>Style</th>
                                    <th>Price</th>
                                    <th>Product Image</th>
                                    <th>Option Image</th>
                                    <th>Back Image</th>
                                    <th>{!! trans('usersmanagement.users-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="users_table">
                                @php($i = 1)
                                @foreach($childVariations as $var)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>
                                            @if($var->size != null)
                                                {{$var->size->title}}
                                            @else
                                                No size
                                            @endif
                                           </td>
                                        <td>
                                            @if($var->style != null)
                                                {{$var->style->title}}
                                                @else
                                                No style
                                            @endif
                                        </td>
                                        <td>{{$var->price}}</td>
                                        <td>
                                            @if(str_contains($var->image, 'http'))
                                                <img width="25%" src="{{$var->image}}">
                                                @else
                                                <img width="25%" src="{{asset('storage/product-style-images/'.$var->image)}}">
                                            @endif
                                        </td>
                                        <td>
                                            @if($var->style != null)
                                                <img src="{{asset('storage/variation-style-option-images/'.$var->style->option_image)}}">
                                            @else
                                                No style image
                                            @endif
                                        </td>
                                        <td><img width="25%" src="{{asset('storage/product-style-images/'.$var->back_image)}}"></td>
                                        <td>
                                            {!! Form::open(array('url' => 'products/' . $var->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button("Delete", array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Variation', 'data-message' => 'Are you sure you want to delete this variation ?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block" href="#" data-toggle="tooltip" title="Edit">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                    @php($i++)
                                @endforeach
                                </tbody>
                            </table>
                            @if(config('usersmanagement.enablePagination'))
                                {{ $childVariations->links() }}
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('modals.modal-delete')

@endsection

@section('footer_scripts')
    @if ((count($childVariations) > config('usersmanagement.datatablesJsStartCount')) && config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
