@extends('admin.layouts.main')
@section('title_page')
    Create NgonNgu - Admin - {{ config('app.name') }}
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
        $menu_parent = 'ngonngu';
        $menu_child = 'create';
    @endphp
@endsection
@section('title_component')
    Ngôn Ngữ
@endsection
@section('title_layout')
    Thêm Ngôn Ngữ
@endsection
@section('actions_layout')

@endsection
@section('title_card')
    Thêm Ngôn Ngữ
@endsection
@section('content_card')
    @include('admin.Includes.error')
    <form action="{{route('admin.ngonngu.store', 'phuc')}}" method="post" class="form-control-sm">
        @csrf
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Tên Ngôn Ngữ</label>
            <input name="TenNN" type="text" class="form-control form-control-solid"
                   placeholder="Nhập Tên Ngôn Ngữ" value="{{old('TenNN')}}" autocomplete="off">
        </div>

        <div class="mb-10">
            <label for="exampleFormControlInput1" class="form-label">Ghi Chú</label>
            <input name="GhiChu" type="text" class="form-control form-control-solid"
                   placeholder="Nhập Ghi Chú" value="{{old('GhiChu')}}" autocomplete="off">
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

