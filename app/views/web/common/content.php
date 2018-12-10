<div class="content-wrapper">

        <? if (isset($breadcrumbs))   echo $breadcrumbs; ?>

<section class="content">

    <div class="row">

        <? if (isset($registration))  echo $registration; ?>
        <? if (isset($authorization)) echo $authorization; ?>
        <? if (isset($dashboard))     echo $dashboard; ?>
        <? if (isset($crud))          echo $crud; ?>

    </div>

</section>

</div>  