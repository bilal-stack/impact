@extends('layouts.app')

@section('template_title')
    Product Variations - {{$product->title}}
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
                               Showing All <b>{{$product->title}}</b>Product Variations
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        {!! trans('usersmanagement.users-menu-alt') !!}
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{route('admin.products.variations.attach', $product->slug)}}">
                                        <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                        Attach New
                                    </a>
                                    <a class="dropdown-item" href="/products/deleted">
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
                                    {{$variations->count()}} variations
                                </caption>
                                <thead class="thead">
                                <tr>
                                    <th>$</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th class="hidden-sm hidden-xs hidden-md">{!! trans('usersmanagement.users-table.created') !!}</th>
                                    <th class="hidden-sm hidden-xs hidden-md">{!! trans('usersmanagement.users-table.updated') !!}</th>
                                    <th>{!! trans('usersmanagement.users-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="users_table">
                                @php($i = 1)
                                @foreach($variations as $variation)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$variation->title}}</td>
                                        <td>{!! substr($variation->description, 0, 110) !!}</td>
                                        <td class="hidden-sm hidden-xs hidden-md">{{$variation->created_at}}</td>
                                        <td class="hidden-sm hidden-xs hidden-md">{{$variation->updated_at}}</td>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block" href="{{route('admin.products.variations.sizes.attach', [$product->slug, $variation->id])}}" data-toggle="tooltip" title="Attach Sizes">
                                                Attach Size with style
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-primary btn-block" href="{{route('admin.products.variations.sizes.styles.list', [$product->slug, $variation->id])}}" data-toggle="tooltip" title="View siazes & styles">
                                              View sizes & styles
                                            </a>
                                        </td>
                                        <td>
                                            {!! Form::open(array('url' => 'products/' . $variation->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
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
                                {{ $variations->links() }}
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
    @if ((count($variations) > config('usersmanagement.datatablesJsStartCount')) && config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
