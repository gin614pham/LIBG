@extends('admin.layouts.main')
@section('title_page')
{{--    Edit Đầu Sách - Admin - {{$DauSach->TenSach}}--}}
@endsection
@section('name_user')
    {{auth()->user()->Ten}}
@endsection
@section('css_custom')
    <link href="{{asset('/admin/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>

@endsection
@section('js_custom')
    <script src="{{asset('/admin/assets/plugins/global/plugins.bundle.js')}}"></script>



@endsection
@section('menu')
    @php
        $menu_parent = 'docgia';
        $menu_child = 'edit';
    @endphp
@endsection
@section('title_component')
    Đầu Sách
@endsection
@section('title_layout')
    Edit Đầu Sách [  ]
@endsection
@section('actions_layout')
    @can('create-blog')
        <a href="{{route('admin.nhacungcap.create')}}" class="btn btn-primary">
            <i class="la la-plus-circle"></i>
            Create Blog
        </a>
    @endcan
@endsection
@section('title_card')
    Edit Đầu Sách [ ]
@endsection
@section('content_card')
    <form action="{{route('admin.nhacungcap.update', $nhaCungCap->MaNCC)}}" method="post" class="form-control-sm">
        @csrf
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Tên Nhà Cung Cấp</label>
            <input name="TenNCC" type="text" class="form-control form-control-solid"
                   placeholder="Nhập Tên Nhà Cung Cấp" value="{{$nhaCungCap->TenNCC}}" autocomplete="off">
        </div>

        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Địa Chỉ</label>
            <input name="DiaChi" type="text" class="form-control form-control-solid"
                   placeholder="Nhập Địa Chỉ" value="{{$nhaCungCap->DiaChi}}" autocomplete="off">
        </div>

        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">SDT</label>
            <input name="SDT" type="tel" class="form-control form-control-solid"
                   placeholder="Nhập SDT" value="{{$nhaCungCap->SDT}}" autocomplete="off">
        </div>

        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Email</label>
            <input name="Email" type="email" class="form-control form-control-solid"
                   placeholder="Nhập Email" value="{{$nhaCungCap->Email}}" autocomplete="off">
        </div>


        <div class="mb-10">
            <button class="btn btn-primary btn-sm mr-2 mb-2 mb-lg-0">
                <i class="fa fa-save"></i> Save
            </button>
        </div>

    </form>
@endsection
@section('footer_card')

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

