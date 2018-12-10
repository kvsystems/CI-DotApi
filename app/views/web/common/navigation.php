<aside class="main-sidebar">

    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">

        <? if(!empty($navigation) && $navigation) { ?>

            <li class="header">Панель управления</li>

            <? foreach( $navigation as $item )  { ?>

                <? if( isset( $item['parentList'] ) ) { ?>

                <li class="<? if( isset( $item['active'] ) ) echo 'active' ?> treeview">
                    <a href="#">
                        <i class="fa <?=$item['icon']?>"></i> <span><?=$item['navigationName']?></span>
                        <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
                    </a>

                    <ul class="treeview-menu">

                        <? foreach( $item['parentList'] as $child ) { ?>

                            <li <? if( isset( $child['active'] ) ) echo 'class="active"' ?>>
                                <a href="<?=$child['routeUri']?>"><i class="fa <?=$child['icon']?>">
                                    </i><?=$child['navigationName']?>
                                </a>
                            </li>

                        <? } ?>

                    </ul>

                </li>

                <? } else { ?>

                    <li <? if( isset( $item['active'] ) ) echo 'class="active"' ?>>
                        <a href="<?=$item['routeUri']?>">
                            <i class="fa <?=$item['icon']?>"></i> <span><?=$item['navigationName']?></span>
                        </a>
                    </li>

                <? } ?>

            <? } ?>

        <? } ?>

        </ul>
    </section>

</aside>