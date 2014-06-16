<h2>Editing <span class='muted'>Schedule</span></h2>
<br>

<?php echo render('schedule/_form'); ?>
<p>
	<?php echo Html::anchor('schedule/view/'.$schedule->schedule_id, 'View'); ?> |
	<?php echo Html::anchor('schedule', 'Back'); ?></p>
