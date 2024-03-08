<div class="sidebar-inner slimscrollleft" id="sidebar-main">

    <div id="sidebar-menu">
        <ul>
            <li class="menu-title">Dashboard</li>

            <li>
                <a href="{{ route('dashboard-dashboard-page') }}" class="waves-effect">
                    <i class="mdi mdi-view-dashboard"></i>
                    <span> Dashboard
                        <span class="badge badge-pill badge-primary float-right">7</span>
                    </span>
                </a>
            </li>

            <li class="menu-title">Main</li>

            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="mdi mdi-account-multiple"></i>
                    <span> Users </span>
                    <span class="float-right">
                        <i class="mdi mdi-chevron-right"></i>
                    </span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="{{ route('dashboard-account-profile-page') }}">Your Profile</a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard-change-password-page') }}">Change Password</a>
                    </li>
                    @can('role-read', 'web')
                        <li>
                            <a href="{{ route('dashboard-roles-page') }}">Manage Roles</a>
                        </li>
                    @endcan
                    @can('user-read', 'web')
                        <li>
                            <a href="ui-buttons.html">Manage Users</a>
                        </li>
                    @endcan
                </ul>
            </li>
            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="mdi mdi-table"></i>
                    <span> Tables </span>
                    <span class="float-right">
                        <i class="mdi mdi-chevron-right"></i>
                    </span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="tables-basic.html">Basic Tables</a>
                    </li>
                    <li>
                        <a href="tables-datatable.html">Data Table</a>
                    </li>
                </ul>
            </li>

            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="mdi mdi-cards"></i>
                    <span> Forms </span>
                    <span class="badge badge-pill badge-info float-right">8</span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="form-elements.html">Form Elements</a>
                    </li>
                    <li>
                        <a href="form-validation.html">Form Validation</a>
                    </li>
                    <li>
                        <a href="form-advanced.html">Form Advanced</a>
                    </li>
                    <li>
                        <a href="form-mask.html">Form Mask</a>
                    </li>
                    <li>
                        <a href="form-editors.html">Form Editors</a>
                    </li>
                    <li>
                        <a href="form-uploads.html">Form File Upload</a>
                    </li>
                </ul>
            </li>

            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="mdi mdi-emoticon-poop"></i>
                    <span> Icons </span>
                    <span class="float-right">
                        <i class="mdi mdi-chevron-right"></i>
                    </span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="icons-material.html">Material Design</a>
                    </li>
                    <li>
                        <a href="icons-fontawesome.html">Font Awesome</a>
                    </li>
                    <li>
                        <a href="icons-themify.html">Themify Icons</a>
                    </li>
                </ul>
            </li>

            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="mdi mdi-chart-areaspline"></i>
                    <span> Charts </span>
                    <span class="float-right">
                        <i class="mdi mdi-chevron-right"></i>
                    </span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="charts-morris.html">Morris Chart</a>
                    </li>
                    <li>
                        <a href="charts-chartist.html">Chartist Chart</a>
                    </li>
                    <li>
                        <a href="charts-chartjs.html">Chartjs Chart</a>
                    </li>
                    <li>
                        <a href="charts-flot.html">Flot Chart</a>
                    </li>
                    <li>
                        <a href="charts-c3.html">C3 Chart</a>
                    </li>
                    <li>
                        <a href="charts-xchart.html">X Chart</a>
                    </li>
                    <li>
                        <a href="charts-other.html">Jquery Knob Chart</a>
                    </li>
                </ul>
            </li>

            <li class="menu-title">Extra</li>

            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="mdi mdi-map-marker-multiple"></i>
                    <span> Maps </span>
                    <span class="badge badge-pill badge-danger float-right">2</span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="maps-google.html"> Google Map</a>
                    </li>
                    <li>
                        <a href="maps-vector.html"> Vector Map</a>
                    </li>
                </ul>
            </li>

            <li class="has_sub">
                <a href="javascript:void(0);" class="waves-effect">
                    <i class="mdi mdi-layers"></i>
                    <span> Pages </span>
                    <span class="float-right">
                        <i class="mdi mdi-chevron-right"></i>
                    </span>
                </a>
                <ul class="list-unstyled">
                    <li>
                        <a href="pages-login.html">Login</a>
                    </li>
                    <li>
                        <a href="pages-register.html">Register</a>
                    </li>
                    <li>
                        <a href="pages-recoverpw.html">Recover Password</a>
                    </li>
                    <li>
                        <a href="pages-lock-screen.html">Lock Screen</a>
                    </li>
                    <li>
                        <a href="pages-blank.html">Blank Page</a>
                    </li>
                    <li>
                        <a href="pages-404.html">Error 404</a>
                    </li>
                    <li>
                        <a href="pages-500.html">Error 500</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    <div class="clearfix"></div>
</div>