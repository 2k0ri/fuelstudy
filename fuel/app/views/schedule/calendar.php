<ul class="nav nav-pills">
	<li class='<?php echo Arr::get($subnav, "calendar" ); ?>'><?php echo Html::anchor('schedule/calendar','Calendar');?></li>
	<li class='<?php echo Arr::get($subnav, "topic" ); ?>'><?php echo Html::anchor('schedule/topic','Topic');?></li>

</ul>
<p><?php echo $content; ?></p>