<?php

class View_Schedule_index extends Viewmodel
{
	public function view()
	{
		$now = Date::time();
		
		$schedules = Model_Schedule::query()->where('start_date', 'between', array(Date::create_from_string('201405'.'00'.'000000'), Date::create_from_string('201407'.'235959')));
		$this->content = "Schedule &raquo; topic";
	}
}
