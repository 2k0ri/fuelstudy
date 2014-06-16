<?php
/**
 * APIコントローラー
 * @author Kei Kori
 */
class Controller_Api extends Controller_Rest
{
    /**
     * 予定全取得(schedule()のエイリアス)
     * 
     * @author Kei Kori
     */
    public function get_schedules()
    {
        return $this->get_schedule();
    }

    /**
     * 特定の予定を取得
     * @param  string $id スケジュールID
     * 
     * @author Kei Kori
     */
    public function get_schedule($id = 'all')
    {
        $schedule = Model_Schedule::find($id);
        return $this->response($schedule);
    }

    /**
     * 予定を作成
     * @param  string $id スケジュールID
     * 
     * @author Kei Kori
     * @todo ビジネスロジック実装
     */
    public function post_schedule()
    {
        $schedule = Model_Schedule::find($id);
        return $this->response($schedule);
    }

}
