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
@endsection
@section('menu')
    @php
        $menu_parent = 'docgia';
        $menu_child = 'edit';
    @endphp
@endsection
@section('title_component')
    Độc Giả
@endsection
@section('title_layout')
    Edit Độc Giả [{{$docGia->Ten}}]
@endsection
@section('actions_layout')
    <a href="{{route('admin.docgia.create')}}" class="btn btn-primary btn-sm mr-2 mb-2 mb-lg-0">
        <i class="fa fa-plus"></i> Thêm Độc Giả
    </a>
@endsection
@section('title_card')
    Edit Độc Giả [{{$docGia->Ten}}]
@endsection
@section('content_card')
    @include('admin.Includes.error')

    <form action="{{route('admin.docgia.update',$docGia->MaDG)}}" method="post" class="form-control-sm">
        @csrf
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Tên</label>
            <input name="Ten" type="text" class="form-control form-control-solid"
                   placeholder="Nhập Tên " value="{{$docGia->Ten}}" autocomplete="off">
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Giới Tính</label>
            <select class="form-select form-select-solid" data-control="select2"
                    data-placeholder="Chọn Giới Tính" data-select2-id="1" name="GioiTinh">
                <option value=""></option>
                <option {{$docGia->GioiTinh == "Nam" ? 'selected' : ''}} value="Nam">Nam</option>
                <option {{$docGia->GioiTinh == "Nữ" ? 'selected' : ''}} value="Nữ">Nữ</option>
            </select>
        </div>

        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Ngày Sinh</label>
            <input name="NgaySinh" type="date" class="form-control form-control-solid"
                   placeholder="Nhập Ngày Sinh" value="{{$docGia->NgaySinh}}" autocomplete="off">
        </div>

        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">SDT</label>
            <input name="SDT" type="tel" class="form-control form-control-solid"
                   placeholder="Nhập SDT" value="{{$docGia->SDT}}" autocomplete="off">
        </div>

        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Email</label>
            <input name="Email" type="email" class="form-control form-control-solid"
                   placeholder="Nhập Email" value="{{$docGia->Email}}" autocomplete="off">
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

