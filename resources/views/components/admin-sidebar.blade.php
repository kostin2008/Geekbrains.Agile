<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav main-nav" id="main-menu">
            <li>
                <a href="{{route('catalog')}}">
                    <img src="{{ asset('Images/logo/logo-footer.png')}}" alt="logo" /> В каталог
                </a>
            </li>
            <li>
                <h2 class="title-style title-style-1 text-center"><span class="title-left">Управление </span></h2>
            </li>
            <li>
                <a href="{{route('admin::plants::plantList')}}"><i class="fa fa-leaf"></i> Список растений</a>
            </li>
            <li>
                <a href="{{route('admin.users.index')}}"><i class="fa fa-user"></i> Список пользователей</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-cogs"></i>Логи</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-paper-plane"></i>Уведомления</a>
            </li>
            <li>
                <a href="#"><i class="fa fa-sitemap"></i> Статистика<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    {{--                    <li><h1>Базовые категории</h1></li>--}}
                    <li>
                        <a href="#">Посещения</a>
                    </li>
                    <li>
                        <a href="#">Регистрации</a>
                    </li>
                    <li>
                        <a href="#">Добавления в избранное</a>
                    </li>
                    <li>
                        <a href="#">Действия пользователей<span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li>
                                <a href="#">Выполненные</a>
                            </li>
                            <li>
                                <a href="#">Просроченные</a>
                            </li>
                        </ul>

                    </li>
                </ul>
            </li>
        </ul>

    </div>

</nav>