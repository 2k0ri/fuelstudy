<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $title ?></title>
    <?php echo Asset::css('style.css') ?>
</head>
<body>
	<?php echo $content ?>
    <?php echo Asset::js(array('jquery-2.1.1.min.js', 'tools.js'), array(), null, true) ?>
</body>
</html>
