<?php

class Controller_Schedules extends Controller_Template
{

	public function action_index()
	{
		$data["subnav"] = array('index'=> 'active' );
		$this->template->title = 'Schedules &raquo; Index';
		$this->template->content = View::forge('schedules/index', $data);
	}

	public function action_create()
	{
		$data["subnav"] = array('create'=> 'active' );
		$this->template->title = 'Schedules &raquo; Create';
		$this->template->content = View::forge('schedules/create', $data);
	}

	public function action_update()
	{
		$data["subnav"] = array('update'=> 'active' );
		$this->template->title = 'Schedules &raquo; Update';
		$this->template->content = View::forge('schedules/update', $data);
	}

	public function action_delete()
	{
		$data["subnav"] = array('delete'=> 'active' );
		$this->template->title = 'Schedules &raquo; Delete';
		$this->template->content = View::forge('schedules/delete', $data);
	}

}
