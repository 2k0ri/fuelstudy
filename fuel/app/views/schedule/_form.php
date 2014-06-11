<?php echo Form::open(array("class"=>"form-horizontal")); ?>

	<fieldset>
		<div class="form-group">
			<?php echo Form::label('Start time', 'start_time', array('class'=>'control-label')); ?>

				<?php echo Form::input('start_time', Input::post('start_time', isset($schedule) ? $schedule->start_time : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Start time')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('End time', 'end_time', array('class'=>'control-label')); ?>

				<?php echo Form::input('end_time', Input::post('end_time', isset($schedule) ? $schedule->end_time : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'End time')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Schedule title', 'schedule_title', array('class'=>'control-label')); ?>

				<?php echo Form::input('schedule_title', Input::post('schedule_title', isset($schedule) ? $schedule->schedule_title : ''), array('class' => 'col-md-4 form-control', 'placeholder'=>'Schedule title')); ?>

		</div>
		<div class="form-group">
			<?php echo Form::label('Schedule contents', 'schedule_contents', array('class'=>'control-label')); ?>

				<?php echo Form::textarea('schedule_contents', Input::post('schedule_contents', isset($schedule) ? $schedule->schedule_contents : ''), array('class' => 'col-md-8 form-control', 'rows' => 8, 'placeholder'=>'Schedule contents')); ?>

		</div>
		<div class="form-group">
			<label class='control-label'>&nbsp;</label>
			<?php echo Form::submit('submit', 'Save', array('class' => 'btn btn-primary')); ?>		</div>
	</fieldset>
<?php echo Form::close(); ?>