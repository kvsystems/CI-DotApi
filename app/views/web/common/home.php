<!DOCTYPE html>

<html>

    <? if($meta)        echo $meta; ?>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <? if($header)      echo $header; ?>
    <? if($navigation)  echo $navigation; ?>
    <? if($content)     echo $content; ?>
    <? if($copyright)   echo $copyright; ?>


    <div class="control-sidebar-bg"></div>

</div>

    <? if($scripts)     echo $scripts; ?>

</body>

</html>