<div class="menu menu-column menu-rounded menu-sub-indention px-3" id="#kt_app_sidebar_menu" data-kt-menu="true"
     data-kt-menu-expand="false">
    @php
        $menus = config('menus');
    @endphp

    @foreach ($menus as $menu)
        @if(auth()->user()->checkAllow($menu['name']) &&(isset($menu['type']) && $menu['type'] == 'public'))
            <div data-kt-menu-trigger="click"
                 class="menu-item menu-accordion @if( $menu_parent == $menu['name']) hover show  @endif ">
                <!--begin:Menu link-->
                <span class="menu-link">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/art/art007.svg-->
                                            <i class='{{$menu['icon']}}'></i>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">{{$menu['title']}}</span>
                                        <span class="menu-arrow"></span>
                                    </span>
                <!--end:Menu link-->
                <!--begin:Menu sub-->
                @if(isset($menu['children']) && count($menu['children']) > 0)
                    <div class="menu-sub menu-sub-accordion " kt-hidden-height="121" style="">
                        @foreach($menu['children'] as $item)
                            <!--begin:Menu item-->
                            @if((isset($item['type']) && $item['type'] == 'public'))
                            <div class="menu-item ">
                                <!--begin:Menu link-->
                                <a class="menu-link @if($menu_parent == $menu['name'] && $menu_child == $item['name']) active @endif "
                                   href="@if(isset($item['route'])) {{route($item['route'])}} @else # @endif">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                    <span class="menu-title">{{$item['title']}}</span>
                                </a>
                                <!--end:Menu link-->
                            </div>
                            @endif

                            <!--end:Menu item-->
                        @endforeach
                    </div>
                @endif
                <!--end:Menu sub-->
            </div>
            <!--end:Menu item-->
        @endif
    @endforeach


</div>
