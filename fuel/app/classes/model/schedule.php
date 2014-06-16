<?php

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

    protected static $_soft_delete = array(
        'mysql_timestamp' => false,
    );

    public static function validate($factory)
    {
        $val = Validation::forge($factory);
        $val->add_field('start_time', 'Start Time', 'required');
        $val->add_field('end_time', 'End Time', 'required');
        $val->add_field('schedule_title', 'Schedule Title', 'required|max_length[50]');
        $val->add_field('schedule_contents', 'Schedule Contents', 'required');

        return $val;
    }

    protected static $_table_name = 'schedules';

}
