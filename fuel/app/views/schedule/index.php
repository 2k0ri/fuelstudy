<header>
    <span>3ViewCalendar</span>
</header>
<div class="cal_view">
    <div class="header_link">
        <a href="<?php echo '?year='.$prev['year'].'&month='.$prev['month'] ?>" class="button move_month">先月</a>
        <a href="index.php" class="button">今月</a>
        <a href="<?php echo '?year='.$next['year'].'&month='.$next['month'] ?>" class="button move_month">次月</a>
        <form class="index-form" method="get" action="<?php $_SERVER['PHP_SELF']; ?>">
            <select class="submit_btn move_ym" name="year">
                <?php for ($i=$start_combo_year; $i <= $end_combo_year; $i++) : ?>
                    <option value="<?php echo $i ?>"<?php if($i == $year) echo 'selected' ?>><?php echo $i ?></option>
                <?php endfor ?>
            </select>年
            <select class="submit_btn move_ym" name="month">
                <?php for ($i=1; $i <= 12; $i++) : ?>
                    <option value="<?php echo $i ?>"<?php if($i == $month) echo 'selected' ?>><?php echo $i ?></option>
                <?php endfor ?>
            </select>月
            <input class="submit_btn" id="view_output" type="button" value="表示">
        </form>
    </div>
    <div id="wrapper">
        <div class="main_box">
            <?php foreach ($calendars as $calendar) :?>
                <div class="view_row">
                <table class="cal">
                    <caption><?php echo $calendar['year'].'年'.$calendar['month'].'月';?></caption>
                    <thead>
                        <tr>
                            <th class="sun">日</th>
                            <th>月</th>
                            <th>火</th>
                            <th>水</th>
                            <th>木</th>
                            <th>金</th>
                            <th class="sat">土</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <?php for($i=1; $i<=$calendar['month_begin_cell']; $i++):?>
                                <td></td>
                            <?php endfor ?>
                            <?php $week=$calendar['month_begin_cell'];
                            for($day = 1; $day <= $calendar['month_date']; $day++):
                                $date_str = $calendar['year'].'-'.$calendar['month'].'-'.sprintf('%02d',$day);
                                $class = '';
                                switch ($week) {
                                    case 6:
                                        $class .= 'sat ';
                                        break;
                                    case 0:
                                        $class .= 'sun ';
                                        break;
                                }
                                if(isset($holidays[$date_str])){
                                    $class .= 'holiday ';
                                }
                                if(isset($auc_topic[$date_str])){
                                    $class .= 'topic ';
                                }
                                if($date_str == $today){
                                    $class .= 'today';
                                }
                                ?>
                                <td class="<?php echo $class ?>">
                                    <a class="calendar_days" href="schedule.php?year=<?php echo $calendar['year']; ?>&month=<?php echo $calendar['month']; ?>&day=<?php echo $day; ?>"><?php echo $day;?></a>
                                    <?php if($holidays):?>
                                        <?php echo h($holidays[$date_str]); ?><br />
                                    <?php endif ?>
                                    <?php if(!empty($auc_topic[$date_str])):?>
                                        <a class="topic" href="<?php echo $auc_link[$date_str];?>" target="_blank" >
                                            <?php echo mb_strimwidth($auc_topic[$date_str], 0, 13,'…'); ?>
                                            <span><strong>トピック内容</strong><br /><?php echo h(mb_strimwidth($auc_topic[$date_str], 0, 50,'…')); ?></span>
                                        </a><br />
                                    <?php endif ?>
                                    <?php $tmp = $schedules[$calendar['year']][$calendar['month']][$day];
                                    if(!empty($tmp)) foreach ($tmp as $schedule) : ?>
                                        <a class="tooltip calendar_days" href="schedule.php?year=<?php echo $calendar['year']; ?>&month=<?php echo $calendar['month']; ?>&day=<?php echo $day; ?>&id=<?php echo $schedule['schedule_id'] ?>">
                                            <?php echo h(mb_strimwidth($schedule['title'], 0, 10,'…')); ?><br />
                                            <span><strong>スケジュール内容</strong><br /><?php echo h(mb_strimwidth($schedule['contents'], 0, 30,'…')); ?></span>
                                        </a>
                                    <?php endforeach ?>
                                </td>
                            <?php $week++ ?>
                                <?php if($week == 7): ?>
                                    </tr><tr>
                                <?php $week=0; ?>
                                <?php endif ?>
                            <?php endfor?>
                            <?php for($i=1; $i<=$calendar['month_end_cell']; $i++):?>
                                <td><?php echo '' ?></td>
                            <?php endfor;?>
                        </tr>
                    </tbody>
                </table>
                </div>
            <?php endforeach ?>
        </div>
    </div>
</div>
