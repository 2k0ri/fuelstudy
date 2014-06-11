<h2>Listing <span class='muted'>Schedules</span></h2>
<br>
<?php if ($schedules): ?>
<table class="table table-striped">
	<thead>
		<tr>
			<th>Start time</th>
			<th>End time</th>
			<th>Schedule title</th>
			<th>Schedule contents</th>
			<th>&nbsp;</th>
		</tr>
	</thead>
	<tbody>
<?php foreach ($schedules as $item): ?>		<tr>

			<td><?php echo $item->start_time; ?></td>
			<td><?php echo $item->end_time; ?></td>
			<td><?php echo $item->schedule_title; ?></td>
			<td><?php echo $item->schedule_contents; ?></td>
			<td>
				<div class="btn-toolbar">
					<div class="btn-group">
						<?php echo Html::anchor('schedule/view/'.$item->id, '<i class="icon-eye-open"></i> View', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('schedule/edit/'.$item->id, '<i class="icon-wrench"></i> Edit', array('class' => 'btn btn-small')); ?>						<?php echo Html::anchor('schedule/delete/'.$item->id, '<i class="icon-trash icon-white"></i> Delete', array('class' => 'btn btn-small btn-danger', 'onclick' => "return confirm('Are you sure?')")); ?>					</div>
				</div>

			</td>
		</tr>
<?php endforeach; ?>	</tbody>
</table>

<?php else: ?>
<p>No Schedules.</p>

<?php endif; ?><p>
	<?php echo Html::anchor('schedule/create', 'Add new Schedule', array('class' => 'btn btn-success')); ?>

</p>
