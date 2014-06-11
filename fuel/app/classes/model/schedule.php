<?php

/**
 * @property $id
 * @property $start_time
 * @property $end_time
 * @property $schedule_title
 * @property $schedule_contents
 * @property $created_at
 * @property $updated_at
 * @property $deleted_at
 *
 * @method Model_Schedule forge($data = array(), $new = true, $view = null)
 **/
class Model_Schedule extends \Orm\Model_Soft
{
    protected static $_properties = array(
        'schedule_id',
        'start_time',
        'end_time',
        'schedule_title',
        'schedule_contents',
        'created_at',
        'updated_at',
        'deleted_at',
    );

    /**
     * 主キーを明示
     * @var array
     */
    protected static $_primary_key = array('schedule_id');

    protected static $_observers = array(
        'Orm\Observer_CreatedAt' => array(
            'events' => array('before_insert'),
            'mysql_timestamp' => false,
        ),
        'Orm\Observer_UpdatedAt' => array(
            'events' => array('before_update'),
            'mysql_timestamp' => false,
        ),
    );

    /**
     * 論理削除
     * @var array
     */
    protected static $_soft_delete = array(
        'mysql_timestamp' => false,
    );

    protected static $_table_name = 'schedules';

    public static function validate($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('start_time', '開始日時', 'required');
        $val->add_field('end_time', '終了日時', 'required');
        $val->add_field('schedule_title', 'タイトル', 'required|max_length[50]');
        $val->add_field('schedule_contents', 'スケジュール内容', 'required');

        return $val;
    }

}
