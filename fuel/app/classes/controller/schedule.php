<?php
class Controller_Schedule extends Controller_Hybrid{

	public function action_index()
	{
		$data['schedules'] = Model_Schedule::find('all');
		$this->template->title = "Schedules";
		$this->template->content = View::forge('schedule/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('schedule');

		if ( ! $data['schedule'] = Model_Schedule::find($id))
		{
			Session::set_flash('error', 'Could not find schedule #'.$id);
			Response::redirect('schedule');
		}

		$this->template->title = "Schedule";
		$this->template->content = View::forge('schedule/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST')
		{
			$val = Model_Schedule::validate('create');
			
			if ($val->run())
			{
				$schedule = Model_Schedule::forge(array(
					'start_time' => Input::post('start_time'),
					'end_time' => Input::post('end_time'),
					'schedule_title' => Input::post('schedule_title'),
					'schedule_contents' => Input::post('schedule_contents'),
				));

				if ($schedule and $schedule->save())
				{
					Session::set_flash('success', 'Added schedule #'.$schedule->id.'.');

					Response::redirect('schedule');
				}

				else
				{
					Session::set_flash('error', 'Could not save schedule.');
				}
			}
			else
			{
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Schedules";
		$this->template->content = View::forge('schedule/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('schedule');

		if ( ! $schedule = Model_Schedule::find($id))
		{
			Session::set_flash('error', 'Could not find schedule #'.$id);
			Response::redirect('schedule');
		}

		$val = Model_Schedule::validate('edit');

		if ($val->run())
		{
			$schedule->start_time = Input::post('start_time');
			$schedule->end_time = Input::post('end_time');
			$schedule->schedule_title = Input::post('schedule_title');
			$schedule->schedule_contents = Input::post('schedule_contents');

			if ($schedule->save())
			{
				Session::set_flash('success', 'Updated schedule #' . $id);

				Response::redirect('schedule');
			}

			else
			{
				Session::set_flash('error', 'Could not update schedule #' . $id);
			}
		}

		else
		{
			if (Input::method() == 'POST')
			{
				$schedule->start_time = $val->validated('start_time');
				$schedule->end_time = $val->validated('end_time');
				$schedule->schedule_title = $val->validated('schedule_title');
				$schedule->schedule_contents = $val->validated('schedule_contents');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('schedule', $schedule, false);
		}

		$this->template->title = "Schedules";
		$this->template->content = View::forge('schedule/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('schedule');

		if ($schedule = Model_Schedule::find($id))
		{
			$schedule->delete();

			Session::set_flash('success', 'Deleted schedule #'.$id);
		}

		else
		{
			Session::set_flash('error', 'Could not delete schedule #'.$id);
		}

		Response::redirect('schedule');

	}

    public function get_detail()
    {

        return $this->response(array(

        ));
    }

}
