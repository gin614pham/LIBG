@extends('admin.layouts.main')
@section('title_page')
    List Test
@endsection
@section('name_user')
    Phuc
@endsection
@section('css_custom')
    <link href="{{asset('/admin/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet"
          type="text/css"/>

@endsection
@section('js_custom')
    <script src="{{asset('/admin/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <script !src="">
        $("#kt_datatable_horizontal_scroll").DataTable({
            dom: 'Bfrtip',
            order: [],
        });
    </script>
@endsection
@section('menu')
    @php
        $menu_parent = 'category';
        $menu_child = 'index';
    @endphp
@endsection
@section('title_component')
    test
@endsection
@section('title_layout')
    List test
@endsection
@section('actions_layout')
    {{-- <a href="{{route('admin.blogs.create')}}" class="btn btn-primary btn-sm mr-2 mb-2 mb-lg-0">
        <i class="fa fa-plus"></i> Add Blog
    </a> --}}
    <a href="admin.auth.login" class="btn btn-primary btn-sm mr-2 mb-2 mb-lg-0">
        <i class="fa fa-plus"></i> Add Blog
    </a>
@endsection
@section('title_card')
    List test
@endsection
@section('content_card')
    <div class="table-responsive">
        <table id="kt_datatable_horizontal_scroll" class="table table-row-dashed gy-5 gs-7">
            <thead>
            <tr class="fw-semibold fs-6 text-gray-800">
                <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 29.9px;">
                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        <input class="form-check-input" type="checkbox" data-kt-check="true"
                               data-kt-check-target="#kt_datatable_horizontal_scroll .form-check-input" value="1">
                    </div>
                </th>
                <th class="min-w-50">#</th>
                <th class="min-w-200">Title</th>
                <th class="min-w-150">Slug</th>
                <th class="min-w-200">Category</th>
                <th class="min-w-200">Image</th>
                <th class="min-w-200">Description</th>
                <th class="min-w-200">Status</th>
                <th class="min-w-200">Action</th>
            </tr>
            </thead>
            <tbody>
{{--            @foreach($DocGias as $item)--}}
{{--                <tr>--}}
{{--                    <td>--}}
{{--                        <div class="form-check form-check-sm form-check-custom form-check-solid">--}}
{{--                            <input class="form-check-input" type="checkbox" value="1">--}}
{{--                        </div>--}}
{{--                    </td>--}}
{{--                    <td>{{$blog->id}}</td>--}}
{{--                    <td>{{$blog->title}}</td>--}}
{{--                    <td>{{$blog->slug}}</td>--}}
{{--                    <td>{{$blog->category->name}}</td>--}}
{{--                    <td>--}}
{{--                        <img src="{{$blog->image_path}}" alt="{{$blog->title}}" width="100px">--}}
{{--                    </td>--}}
{{--                    <td class="mw-125px">{{$blog->description}}</td>--}}
{{--                    <td>--}}
{{--                        @if($blog->status == 1)--}}
{{--                            <span class="badge badge-success">Publish</span>--}}
{{--                        @elseif($blog->status == 0)--}}
{{--                            <span class="badge badge-info">Draft</span>--}}
{{--                        @elseif($blog->status == 2)--}}
{{--                            <span class="badge badge-warning">Private</span>--}}
{{--                        @elseif($blog->status == 3)--}}
{{--                            <span class="badge badge-danger">Trash</span>--}}
{{--                    @endif--}}
{{--                    <td>--}}
{{--                        <a href="{{route('admin.blogs.edit', $blog->id)}}"--}}
{{--                           class="btn btn-sm btn-clean btn-icon btn-icon-md btn-circle btn-primary mr-2" title="Edit">--}}
{{--                            <i class="fa fa-edit"></i>--}}
{{--                        </a>--}}
{{--                        <a href="{{route('admin.blogs.view', $blog->id)}}"--}}
{{--                           class="btn btn-sm btn-clean btn-icon btn-icon-md btn-circle btn-success mr-2" title="View">--}}
{{--                            <i class="fa fa-eye"></i>--}}
{{--                        </a>--}}
{{--                        @if($blog->status == 1)--}}
{{--                            <a href="{{route('admin.blogs.delete', $blog->id)}}"--}}
{{--                               class="btn btn-sm btn-clean btn-icon btn-icon-md btn-circle btn-danger" title="Delete">--}}
{{--                                <i class="fa fa-trash"></i>--}}
{{--                            </a>--}}
{{--                        @elseif($blog->status == 3)--}}
{{--                            <a href="{{route('admin.blogs.restore', $blog->id)}}"--}}
{{--                               class="btn btn-sm btn-clean btn-icon btn-icon-md btn-circle btn-warning" title="Restore">--}}
{{--                                <i class="fa fa-undo"></i>--}}
{{--                            </a>--}}
{{--                        @endif--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endforeach--}}
            </tbody>
        </table>
    </div>
@endsection
@section('footer_card')
    {{-- {{$blogs->links()}} --}}

@endsection
@section('content_layout')
    <!--begin::Card-->
    <div class="card shadow-sm card-bordered">
        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse"
             data-bs-target="#kt_docs_card_collapsible">
            <h3 class="card-title">@yield('title_card')</h3>
            <div class="card-toolbar rotate-180">
                <span class="svg-icon svg-icon-1">
                   <i class="fa fa-angle-down"></i>
                </span>
            </div>
        </div>
        <div id="kt_docs_card_collapsible" class="collapse show">
            <div class="card-body">
                @yield('content_card')
            </div>
            <div class="card-footer">
                @yield('footer_card')
            </div>
        </div>
    </div>
    <!--end::Card-->
@endsection

