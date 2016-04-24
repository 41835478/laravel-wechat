
<!-- User Info, Notifications and Menu Bar -->
<nav class="navbar user-info-navbar" role="navigation">

                <!-- Left links for user info navbar -->
                <ul class="user-info-menu left-links list-inline list-unstyled">

                    <li class="hidden-sm hidden-xs">
                        <a href="#" data-toggle="sidebar">
                            <i class="fa-bars"></i>
                        </a>
                    </li>

                </ul>


                <!-- Right links for user info navbar -->
                <ul class="user-info-menu right-links list-inline list-unstyled">

                    <li class="dropdown user-profile">
                        <a href="#" data-toggle="dropdown">
                            {!! Html::image('style/assets/images/user-4.png','user-image',['class'=>'img-circle img-inline userpic-32','width'=>'28']) !!}
                            <span>
                                {{$auth->name}}
                                <i class="fa-angle-down"></i>
                            </span>
                        </a>

                        <ul class="dropdown-menu user-profile-menu list-unstyled">
                            <li class="last">
                                <a href="{{ url('/auth/logout') }}">
                                    <i class="fa-lock"></i>
                                    退出
                                </a>
                            </li>
                        </ul>
                    </li>

                </ul>

</nav>
