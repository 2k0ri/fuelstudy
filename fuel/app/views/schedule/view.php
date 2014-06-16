<h2>Viewing <span class='muted'>#<?php echo $schedule->schedule_id; ?></span></h2>

<p>
	<strong>Start time:</strong>
	<?php echo $schedule->start_time; ?></p>
<p>
	<strong>End time:</strong>
	<?php echo $schedule->end_time; ?></p>
<p>
	<strong>Schedule title:</strong>
	<?php echo $schedule->schedule_title; ?></p>
<p>
	<strong>Schedule contents:</strong>
	<?php echo $schedule->schedule_contents; ?></p>

<?php echo Html::anchor('schedule/edit/'.$schedule->schedule_id, 'Edit'); ?> |
<?php echo Html::anchor('schedule', 'Back'); ?>
