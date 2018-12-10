<header class="main-header">

    <a href="/" class="logo">
        <span class="logo-mini"><b>CI</b>D</span>
        <span class="logo-lg"><b>CI-DOT</b>.KV-SYS</span>
    </a>

    <nav class="navbar navbar-static-top">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown user user-menu">
                    <a class="dropdown-toggle">
                        <span class="hidden-xs"><?=$admin['group']?></span>
                    </a>
                </li>

                <li class="dropdown user user-menu">
                    <a class="dropdown-toggle">
                        <span class="hidden-xs"><?=$admin['name']?></span>
                    </a>
                </li>

                <li class="dropdown user user-menu">
                    <a class="dropdown-toggle">
                        <span class="hidden-xs"><?=$admin['ipa']?></span>
                    </a>
                </li>

                <? if( $isLogged == true ) { ?>

                    <li>
                        <form action="#" id="logout" method="post">
                            <input type="hidden" name="action" value="1" />
                        </form>
                        <a href="#" id="singleButtonLogOut"><i class="fa fa-power-off"></i></a>
                    </li>

                <? } ?>

            </ul>

        </div>

    </nav>

</header>