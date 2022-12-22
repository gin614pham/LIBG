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
    <script src="{{asset('/admin/assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="https://cdn.tiny.cloud/1/jbtl59mg1cy9ucbkg1klu08mvj1ywhzd3usvxtv59j6kj7ug/tinymce/5/tinymce.min.js"
            referrerpolicy="origin"></script>

    <script>
        var input = document.querySelector("#kt_tagify_6");
        new Tagify(input, {
            whitelist: ["Ada", "Adenine", "Agda", "Agilent VEE"],
            maxTags: 10,
            dropdown: {
                maxItems: 20,
                classname: "",
                enabled: 0,
                closeOnSelect: false
            }
        });
        $(".tag2").select2({
            tags: true,
            tokenSeparators: [',']
        })
        var editor_config = {
            path_absolute: "/",
            selector: 'textarea.my-editor',
            relative_urls: false,

            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern autoresize"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            file_picker_callback: function (callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight || document.documentElement.clientHeight || document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url: cmsURL,
                    title: 'Filemanager',
                    width: x * 0.8,
                    height: y * 0.8,
                    resizable: "yes",
                    close_previous: "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        };
        tinymce.init(editor_config);
    </script>
    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <script !src="">
        //

        $('#lfm').filemanager('image');

    </script>
@endsection
@section('menu')
    @php
        $menu_parent = 'docgia';
        $menu_child = 'edit';
    @endphp
@endsection
@section('title_component')
    Đầu Sách
@endsection
@section('title_layout')
    Edit Đầu Sách [  ]
@endsection
@section('actions_layout')
    @can('create-blog')
        <a href="{{route('admin.nhacungcap.create')}}" class="btn btn-primary">
            <i class="la la-plus-circle"></i>
            Create Blog
        </a>
    @endcan
@endsection
@section('title_card')
    Edit Đầu Sách [ ]
@endsection
@section('content_card')
    <form action="{{route('admin.nhacungcap.update', $nhaCungCap->MaNCC)}}" method="post" class="form-control-sm">
        @csrf
        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Tên Nhà Cung Cấp</label>
            <input name="TenNCC" type="text" class="form-control form-control-solid"
                   placeholder="Nhập Tên Nhà Cung Cấp" value="{{$nhaCungCap->TenNCC}}" autocomplete="off">
        </div>

        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Địa Chỉ</label>
            <input name="DiaChi" type="text" class="form-control form-control-solid"
                   placeholder="Nhập Địa Chỉ" value="{{$nhaCungCap->DiaChi}}" autocomplete="off">
        </div>

        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">SDT</label>
            <input name="SDT" type="tel" class="form-control form-control-solid"
                   placeholder="Nhập SDT" value="{{$nhaCungCap->SDT}}" autocomplete="off">
        </div>

        <div class="mb-10">
            <label for="exampleFormControlInput1" class="required form-label">Email</label>
            <input name="Email" type="email" class="form-control form-control-solid"
                   placeholder="Nhập Email" value="{{$nhaCungCap->Email}}" autocomplete="off">
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

