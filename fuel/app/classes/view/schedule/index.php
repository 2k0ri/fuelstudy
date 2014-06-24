<?php

class View_Schedule_index extends ViewModel
{
	public function view()
	{
		$this->schedules = Model_Schedule::find('all');

		$this->year = Input::get('year', date('Y'));
		$this->month = Input::get('month', date('m'));

		$this->today   = date('Y-m-d');// 本日取得
		$this->month_date       = date('t', mktime(0, 0, 0, $this->month, 1, $this->year));// 月の日数表示(4月なら30日分)
		$this->month_begin_cell = date('w', mktime(0, 0, 0, $this->month, 1, $this->year));// 当月の曜日の数値取得
		$this->last_day         = date('w', mktime(0, 0, 0, $this->month, $this->month_date, $this->year));// 月末の曜日の数値の取得
		$this->month_end_cell   = 6-$this->last_day;// 空マス計算

		// カレンダー表示配列
		$this->calendars = array();
		// カレンダー表示数
		$this->calendar_count = 3;

		// 真ん中にくる月計算
		$this->half = floor($this->calendar_count/2);
		// 真ん中の月
		$this->half_month = strtotime($this->year.$this->month.'01');

		// カレンダー生成
		for($i=0; $i < $this->calendar_count; $i++){
		// カレンダー表示数の半分の数値取得
		    $this->count_num   = -$this->half + $i;
		// 中心からの差分
		    $this->count_month = sprintf('%02d',$this->month+$this->count_num);
		    $this->format_time = mktime(0, 0, 0, $this->count_month, 1, $this->year);
		// カレンダー計算
		    $this->calendars[]= array(
		        'year'             => $this->year_num = date('Y',$this->format_time),// 年取得
		        'month'            => $this->count_month = date('m',$this->format_time),// 月取得
		        'month_begin_cell' => date('w',mktime(0,0,0,$this->count_month,1,$this->year_num)),// 月の日数表示(4月なら30日分)
		        'month_date'       => $this->month_date = date('t',mktime(0,0,0,$this->count_month,1,$this->year_num)),// 当月の曜日の数値取得
		        'month_end_cell'   => 6-date('w', mktime(0, 0, 0, $this->count_month, $this->month_date, $this->year_num))// 空マス計算
		    );
		}

		// 先月
		$this->prev = array(
		    'year'  => date('Y', strtotime('last month', $this->half_month)),
		    'month' => date('m', strtotime('last month', $this->half_month))
		);
		// 次月
		$this->next = array(
		    'year'  => date('Y', strtotime('next month', $this->half_month)),
		    'month' => date('m', strtotime('next month', $this->half_month))
		);

		// 現在の年より年初～年末までを取得
		$this->nowYear = date('Y');
		$this->holiday_first = date('Y-m-d', strtotime("{$this->nowYear}0101"));
		$this->holiday_end   = date('Y-m-d', strtotime("{$this->nowYear}1231"));

		// 祝日出力
		// $this->holidays = getGoogleCalender($this->holiday_first, $this->holiday_end);
		$this->holidays = array();

		// +オクトピ取得
		$this->rss  = simplexml_load_file('http://aucfan.com/article/feed/');// フィード取得URL

		$this->date  = array();// 日付の値挿入
		$this->title = array();// オクトピタイトル挿入
		$this->link  = array();// リンクURL挿入
		$this->auc_topic = array();// オクトピの配列
		$this->auc_link = array();// オクトピのリンクの配列

		foreach ($this->rss->channel->item as $key => $value) {
		    $this->title = (string)$value->title;
		    $this->date  = date('Y-m-d', strtotime((string)$value->pubDate));// 日付を整形して代入
		    $this->link  = (string)$value->link;
		    $this->auc_topic[$this->date] = $this->title;
		    $this->auc_link[$this->date]  = $this->link;
		}

		//スケジュールSQL実行代入
		$schedules_obj = Model_Schedule::find('all');
		$this->schedules = array();
		foreach ($schedules_obj as $schedule) {
			$start_time = Date::create_from_string($schedule->start_time, 'mysql');
			$end_time = Date::create_from_string($schedule->end_time, 'mysql');

			$days = Date::range_to_array($start_time, $end_time);

			foreach ($days as $day) {
				$start_year = $day->format('%Y');
				$start_month = $day->format('%m');
				$start_day = $day->format('%d');
				$this->schedules[$start_year][$start_month][$start_day][] = array(
					'title' => $schedule->schedule_title,
					'contents' => $schedule->schedule_contents,
					'schedule_id' => $schedule->schedule_id,
				);
			}
		}

		// 年可変用変数
		$this->start_combo_year = $this->year-5;
		$this->end_combo_year = $this->year+5;

	}
}
