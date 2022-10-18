{{--    top panel--}}
<nav class="navbar navbar-default top-navbar" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{route('admin::plants::plantList')}}"><strong>Админка</strong></a>
    </div>
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <a class="dropdown-toggle" href="{{route('admin::plants::plantList')}}">
                {{Auth::user()->name}}
                <img class="img-profile rounded-circle" src="{{Auth::user()->avatar}}" width="25" height="25" alt="">
                <!-- <i class="fa fa-caret-down"></i> -->
            </a>
            <!-- <ul class="dropdown-menu dropdown-user">
                <li><a href="#">
                        <i class="fa fa-user fa-fw"></i>
                        {{Auth::user()->name}}
                    </a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> Настройки</a>
                </li>
                <li class="divider"></li>
                <li><a href="#"><i class="fa fa-sign-out fa-fw"></i> Выход</a>
                </li>
            </ul> -->
            <!-- /.dropdown-user -->
        </li>
    </ul>
</nav>