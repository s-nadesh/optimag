<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ URL::asset('img/avatar3.png') }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>Hello, {{ Auth::user()->name }}</p>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="{{ Ekko::isActiveURL('/admin/dashboard') }}">
                <a href="{{ URL::to('/admin/dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview {{ Ekko::areActiveURLs(['/admin/editions', '/admin/sections']) }}">
                <a href="#">
                    <i class="fa fa-folder"></i>
                    <span>Master Records</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ Ekko::isActiveURL('/admin/editions') }}">
                        <a href="{{ URL::to('/admin/editions') }}">
                            <i class="fa fa-angle-double-right"></i> Editions 
                        </a>
                    </li>
                    <li class="{{ Ekko::isActiveURL('/admin/sections') }}">
                        <a href="{{ URL::to('/admin/sections') }}">
                            <i class="fa fa-angle-double-right"></i> Sections 
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ Ekko::isActiveURL('/admin/article/index') }}">
                <a href="{{ URL::to('/admin/article/index') }}">
                    <i class="fa fa-edit"></i> <span>Articles</span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>