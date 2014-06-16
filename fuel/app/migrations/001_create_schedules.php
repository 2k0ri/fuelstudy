<?php

namespace Fuel\Migrations;

class Create_schedules
{
	public function up()
	{
		\DBUtil::create_table('schedules', array(
			'schedule_id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'start_time' => array('type' => 'datetime'),
			'end_time' => array('type' => 'datetime'),
			'schedule_title' => array('constraint' => 50, 'type' => 'varchar'),
			'schedule_contents' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('schedule_id'));
	}

	public function down()
	{
		\DBUtil::drop_table('schedules');
	}
}
