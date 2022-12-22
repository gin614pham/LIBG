@extends('admin.layouts.main')
@section('title_page')
    Thông Tin Độc Giả
@endsection
@section('name_user')
    {{auth()->user()->Ten}}
@endsection
@section('css_custom')
    <link href="{{asset('/admin/assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet"
          type="text/css"/>
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.5.0/themes/prism.min.css"
    />

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
        $menu_parent = 'docgia';
        $menu_child = 'view';
    @endphp
@endsection
@section('title_component')
    Độc Giả
@endsection
@section('title_layout')
    Thông Tin Độc Giả
@endsection
@section('actions_layout')

@endsection
@section('title_card_1')
    Thông Tin Độc Giả
@endsection
@section('content_card_1')

    <div class="table-responsive">
        <table id="kt_datatable_horizontal_scroll" class="table table-row-dashed gy-5 gs-7">
            <thead>
            <tr class="fw-semibold fs-6 text-gray-800">
                <th class="min-w-50">Mã Sinh Viên</th>
                <th class="min-w-200">Tên </th>
                <th class="min-w-100">Giới Tính</th>
                <th class="min-w-100">Ngày Sinh</th>
                <th class="min-w-100">SDT</th>
                <th class="min-w-100">Email</th>
                <th class="min-w-50">Tổng Số Lượt Mượn Sách</th>
                <th class="min-w-50">Tổng Số Lần Trả Quá Hạn</th>
                <th class="min-w-50">Tổng Số Vi Phạm</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{$docGia->MaDG}}</td>
                    <td>{{$docGia->Ten}}</td>
                    <td>{{$docGia->GioiTinh}}</td>
                    <td>{{$docGia->NgaySinh}}</td>
                    <td>{{$docGia->SDT}}</td>
                    <td>{{$docGia->Email}}</td>
                    <td>{{count($docGia->PhieuMuon)}}</td>
                    <td>{{$docGia->PhieuMuon->filter(function ($phieuMuon) {
                        return ($phieuMuon['NgayTra'] > $phieuMuon['HanTra']) ||
                                (!$phieuMuon['NgayTra'] && $phieuMuon['HanTra'] < time());
                                    })->count()}}</td>
                    <td>{{count($docGia->viPhams)}}</td>
                </tr>
            </tbody>
        </table>
    </div>






@endsection
@section('footer_card_1')

@endsection

@section('title_card_2')
    Lịch sử mượn sách
@endsection

@section('content_card_2')
    <div class="table-responsive">
        <table id="kt_datatable_horizontal_scroll" class="table table-row-dashed gy-5 gs-7">
            <thead>
            <tr class="fw-semibold fs-6 text-gray-800">
                <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 29.9px;">
                    #
                </th>
                <th class="w-50px">Mã Phiếu Mượn</th>
                <th class="min-w-25">Mã Sách</th>
                <th class="min-w-100">Tên Sách</th>
                <th class="min-w-100">Người Cho Mượn</th>
                <th class="min-w-200">Ngày Mượn</th>
                <th class="min-w-200">Hạn Trả</th>
                <th class="min-w-200">Ngày Trả</th>
                <th class="min-w-200">Người Nhận</th>
                <th class="min-w-100">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($docGia->PhieuMuon->sortByDesc('MaPhieuMuon') as $item)
                <tr @if($item->NgayTra != null) class="bg-success"
                    @elseif($item->HanTra < date("Y-m-d")) class="bg-danger"
                    @elseif(\Carbon\Carbon::parse($item->HanTra)->diffInDays() <= 2) class="bg-warning"
                    @endif >
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$item->MaPhieuMuon}}</td>
                    <td>{{$item->MaSach}}</td>
                    <td>{{$item->Sach->DauSach->TenSach}}</td>
                    <td>{{$item->NguoiChoMuon}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>{{$item->HanTra}}</td>
                    <td>
                        @if($item->NgayTra != null) {{$item->NgayTra}}
                        @elseif($item->HanTra < date("Y-m-d")) {{'Quá hạn'}}
                        @elseif(\Carbon\Carbon::parse($item->HanTra)->diffInDays() <= 2) {{'Sắp đến hạn trả'}}
                        @endif
                    </td>
                    <td>{{$item->NguoiNhan}}</td>
                    <td>
                        <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group" role="group" aria-label="First group">
                                <button data-action="{{$item->MaPhieuMuon}}"
                                        class="btn btn-sm btn-clean btn-icon btn-icon-md btn-success btn-return"
                                        id = "btn-return{{$item->MaPhieuMuon}}"
                                        title="Tra_sach" {{$item->NgayTra != null ? 'disabled' : ''}}>
                                    <i class="fa fa-check-to-slot"></i>
                                </button>
                                <a href="{{route('admin.phieumuon.edit', $item->MaPhieuMuon)}}"
                                   class="btn btn-sm btn-clean btn-icon btn-icon-md btn-primary mr-2"
                                   title="Edit">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <button data-action="{{$item->MaPhieuMuon}}"
                                        {{$item->NgayTra == null ? 'disabled' : ''}}
                                        class="btn btn-sm btn-clean btn-icon btn-icon-md btn-danger btn-delete"
                                        id="btn-delete{{$item->MaPhieuMuon}}"
                                        title="Delete">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('footer_card_2')

@endsection

@section('title_card_3')
    Lịch sử vi phạm
@endsection

@section('content_card_3')
    <div class="table-responsive">
        <table id="kt_datatable_horizontal_scroll" class="table table-row-dashed gy-5 gs-7">
            <thead>
            <tr class="fw-semibold fs-6 text-gray-800">
                <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 29.9px;">
                    #
                </th>
                <th class="min-w-50">Mã Vi Phạm</th>
                <th class="min-w-200px">Mã Độc Giả</th>
                <th class="min-w-50px">Lý Do Vi Phạm</th>
                <th class="min-w-50px">Hình Thức Xử Lý</th>
                <th class="min-w-50px">Người Xử Lý</th>
            </tr>
            </thead>
            <tbody>
            @foreach($docGia->viPhams as $item)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$item->MaVP}}</td>
                    <td>{{$item->MaDG}}</td>
                    <td>{{$item->LyDoVP}}</td>
                    <td>{{$item->HinhThucXL}}</td>
                    <td>{{$item->NguoiXL}}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@endsection

@section('footer_card_3')

@endsection

@section('content_layout')
    <!--begin::Card-->
    <div class="card shadow-sm card-bordered">
        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse"
             data-bs-target="#kt_docs_card_collapsible1">
            <h3 class="card-title">@yield('title_card_1')</h3>
            <div class="card-toolbar rotate-180">
                <span class="svg-icon svg-icon-1">
                   <i class="fa fa-angle-down"></i>
                </span>
            </div>
        </div>
        <div id="kt_docs_card_collapsible1" class="collapse show">
            <div class="card-body">
                @yield('content_card_1')
            </div>
            <div class="card-footer">
                @yield('footer_card_1')
            </div>
        </div>
    </div>
    <!--end::Card-->
<br>
    <!--begin::Card-->
    <div class="card shadow-sm card-bordered">
        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse"
             data-bs-target="#kt_docs_card_collapsible2">
            <h3 class="card-title">@yield('title_card_2')</h3>
            <div class="card-toolbar rotate-180">
                <span class="svg-icon svg-icon-1">
                   <i class="fa fa-angle-down"></i>
                </span>
            </div>
        </div>
        <div id="kt_docs_card_collapsible2" class="collapse show">
            <div class="card-body">
                @yield('content_card_2')
            </div>
            <div class="card-footer">
                @yield('footer_card_2')
            </div>
        </div>
    </div>
    <!--end::Card-->
<br>
    <!--begin::Card-->
    <div class="card shadow-sm card-bordered">
        <div class="card-header collapsible cursor-pointer rotate" data-bs-toggle="collapse"
             data-bs-target="#kt_docs_card_collapsible3">
            <h3 class="card-title">@yield('title_card_3')</h3>
            <div class="card-toolbar rotate-180">
                <span class="svg-icon svg-icon-1">
                   <i class="fa fa-angle-down"></i>
                </span>
            </div>
        </div>
        <div id="kt_docs_card_collapsible3" class="collapse show">
            <div class="card-body">
                @yield('content_card_3')
            </div>
            <div class="card-footer">
                @yield('footer_card_3')
            </div>
        </div>
    </div>
    <!--end::Card-->
@endsection

