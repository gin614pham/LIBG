@extends('admin.layouts.main')
@section('title_page')
    Create NhaCungCap - Admin - {{ config('app.name') }}
@endsection
@section('name_user')
    {{auth()->user()->Ten}}
@endsection
@section('css_custom')
    <link href="{{asset('/admin/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>

@endsection
@section('js_custom')

@endsection
@section('menu')
    @php
        $menu_parent = 'nhacungcap';
        $menu_child = 'create';
    @endphp
@endsection
@section('title_component')
    Nhà Cung Cấp
@endsection
@section('title_layout')
    Thêm Nhà Cung Cấp
@endsection
@section('actions_layout')

@endsection
@section('title_card')
    Thêm Nhà Cung Cấp
@endsection
@section('content_card')
    @include('admin.Includes.error')
    <form action="{{route('admin.nhacungcap.store')}}" method="post" class="form-control-sm">
        @csrf
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Tên Nhà Cung Cấp</label>
            <input name="TenNCC" type="text" class="form-control form-control-solid"
                   placeholder="Nhập Tên Nhà Cung Cấp" value="{{old('TenNCC')}}" autocomplete="off">
        </div>

        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Địa Chỉ</label>
            <input name="DiaChi" type="text" class="form-control form-control-solid"
                   placeholder="Nhập Địa Chỉ" value="{{old('DiaChi')}}" autocomplete="off">
        </div>

        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">SDT</label>
            <input name="SDT" type="tel" class="form-control form-control-solid"
                   placeholder="Nhập SDT" value="{{old('SDT')}}" autocomplete="off">
        </div>

        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Email</label>
            <input name="Email" type="email" class="form-control form-control-solid"
                   placeholder="Nhập Email" value="{{old('Email')}}" autocomplete="off">
        </div>


        <div class="mb-10">
            <button class="btn btn-primary btn-sm mr-2 mb-2 mb-lg-0">
                <i class="fa fa-save"></i> Lưu
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

