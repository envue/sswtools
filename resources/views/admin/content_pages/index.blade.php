@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.content-pages.title')</h3>
    @can('content_page_create')
    <p>
        <a href="{{ route('admin.content_pages.create') }}" class="btn btn-success">@lang('quickadmin.qa_add_new')</a>
        
    </p>
    @endcan

    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_list')
        </div>

        <div class="panel-body table-responsive">
            <table class="table table-bordered table-striped ajaxTable @can('content_page_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('content_page_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('quickadmin.content-pages.fields.title')</th>
                        <th>@lang('quickadmin.content-pages.fields.category-id')</th>
                        <th>@lang('quickadmin.content-pages.fields.tag-id')</th>
                        <th>@lang('quickadmin.content-pages.fields.page-text')</th>
                        <th>@lang('quickadmin.content-pages.fields.excerpt')</th>
                        <th>@lang('quickadmin.content-pages.fields.featured-image')</th>
                        <th>@lang('quickadmin.content-pages.fields.attachments')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('content_page_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.content_pages.mass_destroy') }}';
        @endcan
        $(document).ready(function () {
            window.dtDefaultOptions.ajax = '{!! route('admin.content_pages.index') !!}';
            window.dtDefaultOptions.columns = [@can('content_page_delete')
                    {data: 'massDelete', name: 'id', searchable: false, sortable: false},
                @endcan{data: 'title', name: 'title'},
                {data: 'category_id.title', name: 'category_id.title'},
                {data: 'tag_id.title', name: 'tag_id.title'},
                {data: 'page_text', name: 'page_text'},
                {data: 'excerpt', name: 'excerpt'},
                {data: 'featured_image', name: 'featured_image'},
                {data: 'attachments', name: 'attachments'},
                
                {data: 'actions', name: 'actions', searchable: false, sortable: false}
            ];
            processAjaxTables();
        });
    </script>
@endsection