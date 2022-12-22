@extends('admin.layouts.main')
@section('title_page')
    Phiếu Mượn
@endsection
@section('name_user')
    {{auth()->user()->Ten}}
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
    <script>
        $(document).on('click','.btn-return',function (){
            Swal.fire({
                title: 'Are you sure?',
                text: "Xác Nhận Đã Trả Sách?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    let btn = $(this);
                    let id = btn.attr('data-action');
                    let url = '/admin/phieumuon/trasach/' + id;
                    console.log(url);
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: function (result) {
                            if(result.check === true) {
                                let row = btn.closest('tr');
                                row.removeClass('bg-danger');
                                row.removeClass('bg-warning');
                                row.addClass('bg-success');
                                row.find('td').eq(9).text(result.NgayTra);
                                @auth
                                    var userName = "{{auth()->user()->Ten}}";
                                    row.find('td').eq(10).text(userName);
                                @endauth
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thành công!',
                                    text: result.message,
                                })
                                $("#btn-return"+id).attr('disabled', true);
                                $('#btn-delete'+id).removeAttr('disabled');
                            }
                        },error: function (result) {
                            Swal.fire({
                                icon:'error',
                                title: 'Lỗi...',
                                text: result.responseJSON.message,
                            })
                        }

                    })
                }
            })

        })
    </script>
    <script>
        $(document).on('click','#btn-send',function (){
            Swal.fire({
                title: 'Are you sure?',
                text: "Xác nhận gửi Email thông báo thời hạn trả sách!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, send it!',
            }).then((result) => {
                if (result.isConfirmed) {
                    let btn = $(this);
                    let id = btn.attr('data-action');
                    let url = '/admin/send/' + id;
                    console.log(url);
                    $.ajax({
                        url: url,
                        type: 'get',
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Loading...',
                                text: 'Please wait!',
                                icon: 'info',
                                showConfirmButton: false,
                                showCancelButton: false,
                                showCloseButton: false,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                onOpen: () => {
                                    Swal.showLoading()
                                },
                                onClose: () => {
                                    Swal.hideLoading()
                                }
                            })
                        },
                        success: function (result) {
                            if(result.check === true) {
                                let row = btn.closest('tr');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thành công!',
                                    text: result.message,
                                })
                            }
                        },error: function (result) {
                            Swal.fire({
                                icon:'error',
                                title: 'Lỗi...',
                                text: result.responseJSON.message,
                            })
                        }

                    })
                }
            })

        })
    </script>
    <script>
        $(document).on('click','.btn-delete',function (){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let btn = $(this);
                    let id = btn.attr('data-action');
                    let url = '/admin/phieumuon/delete/' + id;
                    console.log(url);
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: function (result) {
                            if(result.check === true) {
                                let row = btn.closest('tr');
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Thành công!',
                                    text: result.message,
                                })
                                row.remove();
                            }
                        },error: function (result) {
                            Swal.fire({
                                icon:'error',
                                title: 'Lỗi...',
                                text: result.responseJSON.message,
                            })
                        }

                    })
                }
            })

        })
    </script>
@endsection
@section('menu')
    @php
        $menu_parent = 'phieumuon';
        $menu_child = 'index';
    @endphp
@endsection
@section('title_component')
    Phiếu Mượn
@endsection
@section('title_layout')
    Danh Sách Phiếu Mượn
@endsection
@section('actions_layout')
    <a href="{{route('admin.phieumuon.create')}}" class="btn btn-primary btn-sm mr-2 mb-2 mb-lg-0">
        <i class="fa fa-plus"></i> Thêm Phiếu Mượn
    </a>
@endsection
@section('title_card')
    Danh Sách Phiếu Mượn
@endsection
@section('content_card')
    <div class="table-responsive">

        <table id="kt_datatable_horizontal_scroll" class="table table-row-dashed gy-5 gs-7">
            <thead>
            <tr class="fw-semibold fs-6 text-gray-800">
                <th class="w-10px pe-2 sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 29.9px;">
                    #
                </th>
                <th class="w-50px">Mã Phiếu Mượn</th>
                <th class="min-w-50">Mã Độc Giả</th>
                <th class="min-w-100">Tên Độc Giả</th>
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
            @foreach($phieuMuons as $item)
                <tr @if($item->NgayTra != null) class="bg-success"
                    @elseif($item->HanTra < date("Y-m-d")) class="bg-danger"
                    @elseif(\Carbon\Carbon::parse($item->HanTra)->diffInDays() <= 2) class="bg-warning"
                    @endif >
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$item->MaPhieuMuon}}</td>
                    <td>{{$item->MaDG}}</td>
                    <td>{{$item->DocGia->Ten}}</td>
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
                        <button data-action="{{$item->MaPhieuMuon}}"
                                class="btn btn-sm btn-clean btn-icon btn-icon-md btn-info btn-send"
                                id = "btn-send"
                                title="Send Mail" {{$item->NgayTra != null ? 'disabled' : ''}}>
                           <span class="svg-icon svg-icon-primary svg-icon-1">
                               <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo1/dist/../src/media/svg/icons/Communication/Sending mail.svg-->
                               <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M4,16 L5,16 C5.55228475,16 6,16.4477153 6,17 C6,17.5522847 5.55228475,18 5,18 L4,18 C3.44771525,18 3,17.5522847 3,17 C3,16.4477153 3.44771525,16 4,16 Z M1,11 L5,11 C5.55228475,11 6,11.4477153 6,12 C6,12.5522847 5.55228475,13 5,13 L1,13 C0.44771525,13 6.76353751e-17,12.5522847 0,12 C-6.76353751e-17,11.4477153 0.44771525,11 1,11 Z M3,6 L5,6 C5.55228475,6 6,6.44771525 6,7 C6,7.55228475 5.55228475,8 5,8 L3,8 C2.44771525,8 2,7.55228475 2,7 C2,6.44771525 2.44771525,6 3,6 Z" fill="#000000" opacity="0.3"/>
                                    <path d="M10,6 L22,6 C23.1045695,6 24,6.8954305 24,8 L24,16 C24,17.1045695 23.1045695,18 22,18 L10,18 C8.8954305,18 8,17.1045695 8,16 L8,8 C8,6.8954305 8.8954305,6 10,6 Z M21.0849395,8.0718316 L16,10.7185839 L10.9150605,8.0718316 C10.6132433,7.91473331 10.2368262,8.02389331 10.0743092,8.31564728 C9.91179228,8.60740125 10.0247174,8.9712679 10.3265346,9.12836619 L15.705737,11.9282847 C15.8894428,12.0239051 16.1105572,12.0239051 16.294263,11.9282847 L21.6734654,9.12836619 C21.9752826,8.9712679 22.0882077,8.60740125 21.9256908,8.31564728 C21.7631738,8.02389331 21.3867567,7.91473331 21.0849395,8.0718316 Z" fill="#000000"/>
                                </g>
                            </svg>
                               <!--end::Svg Icon-->
                           </span>
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
@section('footer_card')
     {{$phieuMuons->links()}}

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

