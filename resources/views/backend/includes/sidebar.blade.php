<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! access()->user()->picture !!}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{!! access()->user()->name !!}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('strings.backend.general.status.online') }}</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form hide">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('strings.backend.general.search_placeholder') }}"/>
                  <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                  </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('menus.backend.sidebar.general') }}</li>

            <!-- Optionally, you can add icons to the links -->
            <li class="{{ Active::pattern('admin/dashboard') }}">
                <a href="{!! route('admin.dashboard') !!}"><span>{{ trans('menus.backend.sidebar.dashboard') }}</span></a>
            </li>

            @permission('view-master')
            <li class="{{ Active::pattern('admin/master/*') }} treeview">
                <a href="#">
                    <span>{{ trans('menus.backend.master.title') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/master*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/master*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/master/hairstyle*') }}">
                        <a href="{!! url('admin/master/hairstyle') !!}">{{ trans('menus.backend.master.hairstyle.all') }}</a>
                    </li>
                    <li class="{{ Active::pattern('admin/master/frame*') }}">
                        <a href="{!! url('admin/master/frame') !!}">{{ trans('menus.backend.master.frame.all') }}</a>
                    </li>
                    <li class="{{ Active::pattern('admin/master/category*') }}">
                        <a href="{!! url('admin/master/category') !!}">{{ trans('menus.backend.master.category.all') }}</a>
                    </li>
                </ul>
            </li>
            @endauth

            @permission('view-reseller')
                <li class="{{ Active::pattern('admin/reseller/*') }} treeview">

                    <a href="#">
                        <span>{{ trans('menus.backend.reseller.title') }}</span>
                        <i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu {{ Active::pattern('admin/reseller*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/reseller*', 'display: block;') }}">
                        @permission('view-reseller-list')
                        <li class="{{ Active::pattern('admin/reseller/users*') }}">
                            <a href="{!! url('admin/reseller/users') !!}">{{ trans('menus.backend.reseller.all') }}</a>
                        </li>
                        @endauth
                        @permission('view-subscription')
                        <li class="{{ Active::pattern('admin/reseller/subscription*') }}">
                            <a href="#">
                                <span>{{ trans('menus.backend.reseller.subscription.title') }}</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu {{ Active::pattern('admin/reseller/subscription*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/reseller/subscription*', 'display: block;') }}">
                                <li class="{{ Active::pattern('admin/reseller/subscription/plan*') }}">
                                    <a href="{!! url('admin/reseller/subscription/plan') !!}">{{ trans('menus.backend.reseller.subscription.plan') }}</a>
                                </li>
                            </ul>
                        </li>
                        @endauth
                        <li class="{{ Active::pattern('admin/reseller/client*') }}">
                            <a href="{!! url('admin/reseller/client') !!}">{{ trans('menus.backend.reseller.clients.all') }}</a>
                        </li>
                        <li class="{{ Active::pattern('admin/reseller/apikey*') }}">
                            <a href="{!! url('admin/reseller/apikey') !!}">{{ trans('menus.backend.reseller.apikey.all') }}</a>
                        </li>
                    </ul>
                </li>
            @endauth

            @permission('view-access-management')
                <li class="{{ Active::pattern('admin/access/*') }}">
                    <a href="{!!url('admin/access/users')!!}"><span>{{ trans('menus.backend.access.title') }}</span></a>
                </li>
            @endauth

            @permission('view-logs')
            <li class="{{ Active::pattern('admin/log-viewer*') }} treeview">
                <a href="#">
                    <span>{{ trans('menus.backend.log-viewer.main') }}</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu {{ Active::pattern('admin/log-viewer*', 'menu-open') }}" style="display: none; {{ Active::pattern('admin/log-viewer*', 'display: block;') }}">
                    <li class="{{ Active::pattern('admin/log-viewer') }}">
                        <a href="{!! url('admin/log-viewer') !!}">{{ trans('menus.backend.log-viewer.dashboard') }}</a>
                    </li>
                    <li class="{{ Active::pattern('admin/log-viewer/logs') }}">
                        <a href="{!! url('admin/log-viewer/logs') !!}">{{ trans('menus.backend.log-viewer.logs') }}</a>
                    </li>
                </ul>
            </li>
            @endauth
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>