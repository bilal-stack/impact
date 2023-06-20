@extends('layouts.app')

@section('template_title')
    Categories
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
                               Showing All Categories
                            </span>

                            <div class="btn-group pull-right btn-group-xs">
                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v fa-fw" aria-hidden="true"></i>
                                    <span class="sr-only">
                                        {!! trans('usersmanagement.users-menu-alt') !!}
                                    </span>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="categories/create">
                                        <i class="fa fa-fw fa-user-plus" aria-hidden="true"></i>
                                        Create New
                                    </a>
                                    <a class="dropdown-item" href="categories/deleted">
                                        <i class="fa fa-fw fa-group" aria-hidden="true"></i>
                                        Deleted Categories
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive users-table">
                            <table class="table table-striped table-sm data-table">
                                    <caption id="user_count">
                                        {{$categories->count()}} categories
                                    </caption>
                                <thead class="thead">
                                <tr>
                                    <th>$</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Image</th>
                                    <th>Active</th>
                                    <th class="hidden-sm hidden-xs hidden-md">{!! trans('usersmanagement.users-table.created') !!}</th>
                                    <th class="hidden-sm hidden-xs hidden-md">{!! trans('usersmanagement.users-table.updated') !!}</th>
                                    <th>{!! trans('usersmanagement.users-table.actions') !!}</th>
                                    <th class="no-search no-sort"></th>
                                    <th class="no-search no-sort"></th>
                                </tr>
                                </thead>
                                <tbody id="users_table">
                                @php($i = 1)
                                @foreach($categories as $category)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$category->title}}</td>
                                        <td>{!! substr($category->description, 0, 110) !!}</td>
                                        <td>
                                            @foreach($category->getMedia('category-images') as $item)
                                                <img width="50%" src="{{$item->getFullUrl()}}"/>
                                            @endforeach
                                        </td>
                                        <td>
                                            @if($category->active == 1)
                                                <label class="badge badge-success">Active</label>
                                            @else
                                                <label class="badge badge-danger">Inactive</label>

                                            @endif
                                        </td>
                                        <td class="hidden-sm hidden-xs hidden-md">{{$category->created_at}}</td>
                                        <td class="hidden-sm hidden-xs hidden-md">{{$category->updated_at}}</td>
                                        <td>
                                            {!! Form::open(array('url' => 'categories/' . $category->id, 'class' => '', 'data-toggle' => 'tooltip', 'title' => 'Delete')) !!}
                                            {!! Form::hidden('_method', 'DELETE') !!}
                                            {!! Form::button("Delete", array('class' => 'btn btn-danger btn-sm','type' => 'button', 'style' =>'width: 100%;' ,'data-toggle' => 'modal', 'data-target' => '#confirmDelete', 'data-title' => 'Delete Category', 'data-message' => 'Are you sure you want to delete this category ?')) !!}
                                            {!! Form::close() !!}
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-success btn-block" href="{{ URL::to('category/' . $category->slug) }}" data-toggle="tooltip" title="Show">
                                                View
                                            </a>
                                        </td>
                                        <td>
                                            <a class="btn btn-sm btn-info btn-block" href="{{ route('admin.categories.edit', $category->slug) }}" data-toggle="tooltip" title="Edit">
                                                Edit
                                            </a>
                                        </td>
                                    </tr>
                                    @php($i++)
                                @endforeach
                                </tbody>
                            </table>

                            @if(config('usersmanagement.enablePagination'))
                                {{ $categories->links() }}
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
    @if ((count($categories) > config('usersmanagement.datatablesJsStartCount')) && config('usersmanagement.enabledDatatablesJs'))
        @include('scripts.datatables')
    @endif
    @include('scripts.delete-modal-script')
    @include('scripts.save-modal-script')
    @if(config('usersmanagement.tooltipsEnabled'))
        @include('scripts.tooltips')
    @endif
@endsection
