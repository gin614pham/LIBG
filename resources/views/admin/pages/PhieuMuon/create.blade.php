@extends('admin.layouts.main')
@section('title_page')
    Create PhieuMuon - Admin - {{ config('app.name') }}
@endsection
@section('name_user')
    {{auth()->user()->Ten}}
@endsection
@section('css_custom')
    <link href="{{asset('/admin/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>

@endsection
@section('js_custom')
    <script src="{{asset('/admin/assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/jbtl59mg1cy9ucbkg1klu08mvj1ywhzd3usvxtv59j6kj7ug/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script !src="">
        $('#lfm').filemanager('image');
    </script>
@endsection
@section('menu')
    @php
        $menu_parent = 'phieumuon';
        $menu_child = 'create';
    @endphp
@endsection
@section('title_component')
    Phiếu Mượn
@endsection
@section('title_layout')
    Thêm Phiếu Mượn
@endsection
@section('actions_layout')

@endsection
@section('title_card')
    Phiếu Mượn
@endsection
@section('content_card')
   @include('admin.Includes.error')
    <form action="{{route('admin.phieumuon.store')}}" method="post" class="form-control-sm">
        @csrf
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Độc Giả</label>
            <select class="form-select form-select-solid" data-control="select2"
                    data-placeholder="Chọn Đầu Sách" data-select2-id="1" name="MaDG">
                <option value=""></option>
                @foreach($docGias as $item)
                    <option {{$item->MaDG == old('MaDG') ? 'selected' : ''}} value="{{$item->MaDG}}">{{$item->Ten}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Sách</label>
            <select class="form-select form-select-solid" data-control="select2"
                    data-placeholder="Chọn Đầu Sách" data-select2-id="2" name="MaSach">
                <option value=""></option>
                @foreach($saches as $item)
                    <option {{$item->MaSach == old('MaSach') ? 'selected' : ''}} value="{{$item->MaSach}}">{{$item->MaSach.'-'.$item->DauSach->TenSach.'-'.$item->DauSach->TacGia.'-'.$item->DauSach->NamXuatBan}}</option>
                @endforeach
            </select>
        </div>
        @php(date_default_timezone_set("Asia/Ho_Chi_Minh"))
        <input type="hidden" name="HanTra" value="{{date("Y-m-d", strtotime("+1 Weeks"))}}">


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

