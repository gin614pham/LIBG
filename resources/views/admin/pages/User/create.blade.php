@extends('admin.layouts.main')
@section('title_page')
    Create User - Admin - {{ config('app.name') }}
@endsection
@section('name_user')
    {{auth()->user()->Ten}}

@endsection
@section('email_user')
    {{auth()->user()->email}}
@endsection
@section('css_custom')
    <link href="{{asset('/admin/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('js_custom')
    <script src="{{asset('/admin/assets/plugins/global/plugins.bundle.js')}}"></script>

@endsection
@section('menu')
    @php
        $menu_parent = 'user';
        $menu_child = 'create';
    @endphp
@endsection
@section('title_component')
    User
@endsection
@section('title_layout')
    Create User
@endsection
@section('actions_layout')
    <a href="{{route('admin.user.index')}}" class="btn btn-primary btn-sm mr-2 mb-2 mb-lg-0">
        <i class="fa fa-list"></i> List User
    </a>
@endsection
@section('title_card')
    Create User
@endsection
@section('content_card')
    <form action="{{route('admin.user.store')}}" method="post" class="form-control-sm">
        @csrf
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Tên</label>
            <input name="Ten" type="text" class="form-control form-control-solid"
                   placeholder="Nhập Tên" {{old('name')}}>
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Giới Tính</label>
            <select class="form-select form-select-solid" data-control="select2"
                    data-placeholder="Chọn Giới Tính" data-select2-id="1" name="GioiTinh">
                <option value=""></option>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
            </select>
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Năm Sinh</label>
            <input name="NamSinh" type="number" class="form-control form-control-solid"
                   placeholder="Nhập Năm Sinh" value="{{old('NamSinh')}}" autocomplete="off">
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">SDT</label>
            <input name="SDT" type="tel" class="form-control form-control-solid"
                   placeholder="Nhập SDT" value="{{old('SDT')}}" autocomplete="off">
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">email</label>
            <input name="email" type="text" class="form-control form-control-solid"
                   placeholder="Nhập email" {{old('email')}}>
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Password User</label>
            <input name="password" type="password" class="form-control form-control-solid"
                   placeholder="Enter Password" {{old('password')}}>
        </div>
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Chức Danhh</label>
            <select class="form-select form-select-solid" data-control="select2"
                    data-placeholder="Chọn Chức Danh" data-select2-id="2" name="ChucDanh">
                <option value=""></option>
                <option value="Admin">Admin</option>
                <option value="User">User</option>
            </select>
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

