@extends('admin.layouts.main')
@section('title_page')
    Phân Loại
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
                    let url = '/admin/phanloai/delete/' + id;
                    console.log(url);
                    $.ajax({
                        url: url,
                        type: 'get',
                        success: function (result) {
                            if(result.check == true) {
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
        $menu_parent = 'phanloai';
        $menu_child = 'index';
    @endphp
@endsection
@section('title_component')
    Phân Loại
@endsection
@section('title_layout')
    Danh Sách Phân Loại
@endsection
@section('actions_layout')
    <a href="{{route('admin.phanloai.create')}}" class="btn btn-primary btn-sm mr-2 mb-2 mb-lg-0">
        <i class="fa fa-plus"></i> Thêm Phân Loại
    </a>
@endsection
@section('title_card')
    Danh Sách Phân Loại
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
                <th class="min-w-50">Mã Phân Loại</th>
                <th class="min-w-200">Tên Phân Loại</th>
                <th class="min-w-150">Ghi Chú</th>
                <th class="min-w-100">Action</th>

            </tr>
            </thead>
            <tbody>
            @foreach($phanLoais as $item)
                <tr>
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1">
                        </div>
                    </td>
                    <td>{{$item->MaPL}}</td>
                    <td>{{$item->TenPL}}</td>
                    <td>{{$item->GhiChu}}</td>
                    <td>
                        <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group" role="group" aria-label="First group">
                        <a href="{{route('admin.phanloai.edit', $item->MaPL)}}"
                           class="btn btn-sm btn-clean btn-icon btn-icon-md btn-primary mr-2"
                           title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button data-action="{{$item->MaPL}}"
                                {{$item->MaPL == 1 ? 'disabled' : ''}}
                                {{$item->MaPL == 2 ? 'disabled' : ''}}
                                class="btn btn-sm btn-clean btn-icon btn-icon-md btn-danger btn-delete"
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
