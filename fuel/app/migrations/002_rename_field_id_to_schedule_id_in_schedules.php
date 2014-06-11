<?php

namespace Fuel\Migrations;

class Rename_field_id_to_schedule_id_in_schedules
{
	public function up()
	{
		\DBUtil::modify_fields('schedules', array(
			'id' => array('name' => 'schedule_id', 'type' => 'int unsigned')
		));
	}

	public function down()
	{
	\DBUtil::modify_fields('schedules', array(
			'schedule_id' => array('name' => 'id', 'type' => 'int unsigned')
		));
	}
}