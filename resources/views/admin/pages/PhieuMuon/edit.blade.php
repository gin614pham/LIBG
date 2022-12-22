@extends('admin.layouts.main')
@section('title_page')
    Edit PhieuMuon - Admin - {{$phieuMuon->MaPhieuMuon}}
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
        $menu_parent = 'phieumuon';
        $menu_child = 'edit';
    @endphp
@endsection
@section('title_component')
    Phiếu Mượn
@endsection
@section('title_layout')
    Edit Phiếu Mượn [{{$phieuMuon->MaPhieuMuon}}]
@endsection
@section('actions_layout')
    <a href="{{route('admin.phieumuon.create')}}" class="btn btn-primary btn-sm mr-2 mb-2 mb-lg-0">
        <i class="fa fa-plus"></i> Thêm Phiếu Mượn
    </a>
@endsection
@section('title_card')
    Edit Phiếu Mượn [{{$phieuMuon->MaPhieuMuon}}]
@endsection
@section('content_card')
    <form action="{{route('admin.phieumuon.update', $phieuMuon->MaPhieuMuon)}}" method="post" class="form-control-sm">
        @csrf
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Độc Giả</label>
            <select class="form-select form-select-solid" data-control="select2"
                    {{$phieuMuon->NgayTra != null ? 'disabled' : ''}}
                    data-placeholder="Chọn Đầu Sách" data-select2-id="1" name="MaDG">
                <option value=""></option>
                @foreach($docGias as $item)
                    <option {{$phieuMuon->MaDG == $item->MaDG ? 'selected' : ''}} value="{{$item->MaDG}}">{{$item->Ten}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Sách</label>
            <select class="form-select form-select-solid" data-control="select2"
                    {{$phieuMuon->NgayTra != null ? 'disabled' : ''}}
                    data-placeholder="Chọn Đầu Sách" data-select2-id="2" name="MaSach">
                <option value=""></option>
                <option selected value="{{$phieuMuon->MaSach}}" >{{$phieuMuon->Sach->MaSach.'-'.$phieuMuon->Sach->DauSach->TenSach.'-'.$phieuMuon->Sach->DauSach->TacGia.'-'.$phieuMuon->Sach->DauSach->NamXuatBan}}</option>
                @foreach($saches as $item)
                    <option value="{{$item->MaSach}}">{{$item->MaSach.'-'.$item->DauSach->TenSach.'-'.$item->DauSach->TacGia.'-'.$item->DauSach->NamXuatBan}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Ngày Trả</label>
            <select class="form-select form-select-solid" data-control="select2"
                    data-placeholder="Chọn Ngày Trả" data-select2-id="3" name="NgayTra">
                <option value="NULL">NULL</option>
                <option {{$phieuMuon->NgayTra != null ? 'selected' : ''}} value="{{$phieuMuon->NgayTra}}">{{$phieuMuon->NgayTra}}</option>

            </select>
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Người Nhận</label>
            <select class="form-select form-select-solid" data-control="select2"
                    data-placeholder="Chọn Người Nhận" data-select2-id="4" name="NguoiNhan">
                <option value="NULL">NULL</option>
                <option {{$phieuMuon->NgayTra != null ? 'selected' : ''}}
                        value="{{$phieuMuon->NguoiNhan}}">{{$phieuMuon->NguoiNhan}}</option>

            </select>
        </div>

        <input type="hidden" name="NguoiChoMuon" value="Phuc">
        @php(date_default_timezone_set("Asia/Ho_Chi_Minh"))
        <input type="hidden" name="TinhTrang" value="Sẵn sàng">


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

