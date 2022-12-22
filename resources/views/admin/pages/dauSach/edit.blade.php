@extends('admin.layouts.main')
@section('title_page')
    Edit DauSach - Admin - {{$DauSach->TenSach}}
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
        $menu_parent = 'dausach';
        $menu_child = 'edit';
    @endphp
@endsection
@section('title_component')
    Đầu Sách
@endsection
@section('title_layout')
    Edit Đầu Sách [ {{$DauSach->TenSach}} ]
@endsection
@section('actions_layout')
{{--    @can('create-blog')--}}
{{--        <a href="{{route('admin.dausach.create')}}" class="btn btn-primary">--}}
{{--            <i class="la la-plus-circle"></i>--}}
{{--            Create Blog--}}
{{--        </a>--}}
{{--    @endcan--}}
@endsection
@section('title_card')
    Edit Đầu Sách [{{$DauSach->TenSach}} ]
@endsection
@section('content_card')

    @include('admin.includes.error')

    <form action="{{route('admin.dausach.update', $DauSach->MaDauSach)}}" method="post" class="form-control-sm">
        @csrf
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Tên Sách</label>
            <input name="TenSach" type="text" class="form-control form-control-solid"
                   placeholder="Nhập Tên Sách" value="{{$DauSach->TenSach}}" autocomplete="off">
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Tác Giả</label>
            <input name="TacGia" type="text" class="form-control form-control-solid"
                   placeholder="Nhập Tác Giả" value="{{$DauSach->TacGia}}" autocomplete="off">
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Thể Loại</label>
            <select class="form-select form-select-solid" data-control="select2"
                    data-placeholder="Chọn Thể Loại" data-select2-id="1" name="MaTL">
                <option value=""></option>
                @foreach($TheLoais as $item)
                    <option {{$item->MaTL==$DauSach->MaTL ? 'selected': ''}} value="{{$item->MaTL}}">{{$item->TenTL}}</option>

                @endforeach
            </select>
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Phân Loại</label>
            <select class="form-select form-select-solid" data-control="select2"
                    data-placeholder="Chọn Phân Loại" data-select2-id="2" name="MaPL">
                <option value=""></option>
                @foreach($PhanLoais as $item)
                    <option {{$item->MaPL == $DauSach->MaPL ? 'selected' : ''}} value="{{$item->MaPL}}">{{$item->TenPL}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Nhà Xuất Bản</label>
            <input name="NhaXuatBan" type="text" class="form-control form-control-solid"
                   placeholder="Nhập Nhà Xuất Bản" value="{{$DauSach->NhaXuatBan}}" autocomplete="off">
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Năm Xuất Bản</label>
            <input name="NamXuatBan" type="number" class="form-control form-control-solid"
                   placeholder="Nhập Năm Xuất Bản" value="{{$DauSach->NamXuatBan}}" autocomplete="off">
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Ngôn Ngữ</label>
            <select class="form-select form-select-solid" data-control="select2"
                    data-placeholder="Chọn Ngôn Ngữ" data-select2-id="3" name="MaNN">
                <option value=""></option>
                @foreach($NgonNgus as $item)
                    <option {{$item->MaNN == $DauSach->MaNN ? 'selected' : ''}} value="{{$item->MaNN}}">{{$item->TenNN}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="form-label">Ghi Chú</label>
            <input name="GhiChu" type="text" class="form-control form-control-solid"
                   placeholder="Nhập Ghi Chú" value="{{$DauSach->GhiChu}}" autocomplete="off">
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Giá</label>
            <input name="Gia" type="number" class="form-control form-control-solid"
                   placeholder="Nhập Giá" value="{{$DauSach->Gia}}" autocomplete="off">
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

