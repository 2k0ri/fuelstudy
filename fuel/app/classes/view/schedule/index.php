<?php

class View_Schedule_index extends ViewModel
{
	public function view()
	{
		// $this->schedules = Model_Schedule::query()->where('start_date', 
		// 	'between', array(
		// 		Date::create_from_string('201405' . '01' . '000000'), 
		// 		Date::create_from_string('201407' . Date::days_in_month(7) . '235959')
		// 	)
		// );
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

		foreach ( $this->rss->channel->item as $key => $value) {
		    $this->title = (string)$value->title;
		    $this->date  = date('Y-m-d', strtotime((string)$value->pubDate));// 日付を整形して代入
		    $this->link  = (string)$value->link;
		    $this->auc_topic[$this->date] = $this->title;
		    $this->auc_link[$this->date]  = $this->link;
		}

		//TODO: $this->schedulesでリファクタ
		//スケジュールSQL実行代入

		// if ($this->result = mysqli_query($this->db_connect, $this->schedule_sql)) {
		//     while ($this->array_row = mysqli_fetch_array($this->result, MYSQLI_ASSOC)) {
		//         list($this->start_year, $this->start_month, $this->start_day) = explode('-', date('Y-m-j',strtotime($this->array_row['start_time'])));
		//         list($this->end_s_year, $this->end_s_month, $this->end_s_day) = explode('-', date('Y-m-j',strtotime($this->array_row['end_time'])));
		//         $this->schedules[$this->start_year][$this->start_month][$this->start_day][] = array(
		//             'title'       => $this->array_row['schedule_title'],
		//             'contents'    => $this->array_row['schedule_contents'],
		//             'schedule_id' => $this->array_row['schedule_id']
		//         );
		//         if (strtotime($this->array_row['start_time']) >= strtotime($this->array_row['end_time'])) {
		//             continue;
		//         }
		//         //一致した日に＋1日して予定吐き出し
		//         $this->n_day   = $this->start_day;
		//         $this->n_month = $this->start_month;
		//         $this->n_year  = $this->start_year;

		//         while ($this->n_day != $this->end_s_day || $this->n_month != $this->end_s_month || $this->n_year != $this->end_s_year) {
		//             $this->ymd_day = date('Y-m-j',strtotime('tomorrow',strtotime($this->n_year.'-'.$this->n_month.'-'.$this->n_day)));
		//             list($this->n_year, $this->n_month, $this->n_day) = explode('-', $this->ymd_day);
		//             $this->schedules[$this->n_year][$this->n_month][$this->n_day][] = array(
		//                 'title'       => $this->array_row['schedule_title'],
		//                 'contents'    => $this->array_row['schedule_contents'],
		//                 'schedule_id' => $this->array_row['schedule_id']
		//             );
		//         }
		//     }
		//     mysqli_free_result($this->result);
		// }
		// mysqli_close($this->db_connect);

		// 年可変用変数
		$this->start_combo_year = $this->year-5;
		$this->end_combo_year = $this->year+5;

	}
}
