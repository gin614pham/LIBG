@extends('admin.layouts.main')
@section('title_page')
    List User - Admin - {{ config('app.name') }}
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
        $(document).on('click','#btn-delete',function (){
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
                    let url = '/admin/user/delete/' + id;
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
        $menu_parent = 'user';
        $menu_child = 'index';
    @endphp
@endsection
@section('title_component')
    User
@endsection
@section('title_layout')
    List User
@endsection
@section('actions_layout')
    <a href="{{route('admin.user.create')}}" class="btn btn-primary btn-sm mr-2 mb-2 mb-lg-0">
        <i class="fa fa-plus"></i> Add User
    </a>
@endsection
@section('title_card')
    List User
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
                <th class="min-w-50">ID</th>
                <th class="min-w-200px">Tên</th>
                <th class="min-w-50px">Giới Tính</th>
                <th class="min-w-50px">Năm Sinh</th>
                <th class="min-w-50px">SDT</th>
                <th class="min-w-50px">Email</th>
                <th class="min-w-50px">Chức Danh</th>
                <th class="min-w-200px">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>
                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="1">
                        </div>
                    </td>
                    <td>{{$user->id}}</td>
                    <td>{{$user->Ten}}</td>
                    <td>{{$user->GioiTinh}}</td>
                    <td>{{$user->NamSinh}}</td>
                    <td>{{$user->SDT}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->ChucDanh}}</td>
                    <td>
                        <div class="btn-toolbar justify-content-between" role="toolbar" aria-label="Toolbar with button groups">
                            <div class="btn-group" role="group" aria-label="First group">
                        <a href="{{route('admin.user.edit', $user->id)}}"
                           class="btn btn-sm btn-clean btn-icon btn-icon-md btn-primary mr-2" title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>
                        <button data-action="{{$user->id}}"
                                class="btn btn-sm btn-clean btn-icon btn-icon-md btn-danger"
                                title="Delete" id = "btn-delete">
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
{{--    {{$users->links()}}--}}

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

