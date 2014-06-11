<?php

namespace Fuel\Migrations;

class Create_schedules
{
	public function up()
	{
		\DBUtil::create_table('schedules', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true, 'unsigned' => true),
			'start_time' => array('type' => 'timestamp'),
			'end_time' => array('type' => 'timestamp'),
			'schedule_title' => array('constraint' => 50, 'type' => 'varchar'),
			'schedule_contents' => array('type' => 'text'),
			'created_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'updated_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),
			'deleted_at' => array('constraint' => 11, 'type' => 'int', 'null' => true),

		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('schedules');
	}
}