<style>
table {
    margin: 10px;
}
td {
    padding: 6px;
    color: #555;
    text-align: center;
}
.current {
    background: #f5f5f5;
    color: #000;
}
.clear {
    display: none;
}
.today {
    background: #000;
    color: #FFF;
}

.events {
    background: #6363f8ff;
    color: #FFF;
}

.calendars {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    align-items: flex-start;
}

.calendars table {
    margin: 10px;
}

.month {
    width: 250px;
    border: 1px solid #e6e6e6;
    padding: 6px;
    box-sizing: border-box;
    background: #fff;
}

.month-caption {
    text-align: center;
    font-weight: 600;
    margin-bottom: 6px;
}

.weekdays {
    display: flex;
}
.weekday {
    flex: 1 1 14.2857%;
    text-align: center;
    font-size: 12px;
    padding: 4px 0;
    color: #666;
}

.days {
    display: flex;
    flex-wrap: wrap;
}
.day {
    flex: 0 0 14.2857%;
    box-sizing: border-box;
    padding: 8px 4px;
    text-align: center;
    min-height: 36px;
}
</style>
<?php 
setlocale(LC_ALL, 'pt_BR.UTF-8', 'pt_BR', 'Portuguese_Brazil');

include 'vendor/autoload.php';

use Calendar\Calendar;
use Calendar\Events;

echo '<div class="calendars">';
foreach (range(1,12) as $mes):
    $calendar = new Calendar($mes,2025, 0, true);
    $month = $calendar->getMonth();
    $year = $calendar->getYear();
    $days = $calendar->getDays();
    $daysWeek = $calendar->getDaysWeek();
?>
<div class="month">
    <div class="month-caption"><?php echo $month->fullName; ?> <?php echo $year; ?></div>
    <div class="weekdays">
        <?php foreach($daysWeek as $week): ?>
            <div class="weekday"><?php echo $week->letter; ?></div>
        <?php endforeach; ?>
    </div>
    <div class="days">
        <?php foreach($days as $day): ?>
            <div class="day <?php echo (($day->currentMonth)?'current':''); ?> <?php echo (($day->carbon->isToday() && $day->currentMonth)?'today':''); ?>">
                <?php echo $day->day; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php 
    endforeach; 
echo '</div>';
?>
<hr>
<?php
$events = new Events(12,2025);
$events->addEvent("Festa", new \DateTime('2025-12-17 00:00:00'), ["Festa de confraternização"], 1);
$events->addEvent("Futebol", new \DateTime('2025-12-17 15:00:00'), ["Jogo amistoso"], 1);
$events->addEvent("Saída", new \DateTime('2025-12-17 16:00:00'), null, 1);
$events->addEvent("Quase um mês para a saída", new \DateTime('2025-12-26 00:00:00'), ["Preparativos"], 1);
$month = $events->getMonth();
$year = $events->getYear();
$days = $events->getDays();
$daysWeek = $events->getDaysWeek();
?>
<div class="month">
    <div class="month-caption"><?php echo $month->fullName; ?> <?php echo $year; ?></div>
    <div class="weekdays">
        <?php foreach($daysWeek as $week): ?>
            <div class="weekday"><?php echo $week->letter; ?></div>
        <?php endforeach; ?>
    </div>
    <div class="days">
        <?php foreach($days as $day): ?>
            <div title="<?php echo ((count($day->events) > 0)? implode(", ", array_column($day->events,'event')) : ''); ?>" class="day <?php echo (($day->currentMonth)?'current':''); ?> <?php echo (($day->carbon->isToday() && $day->currentMonth)?'today':''); ?> <?php echo ((count($day->events) > 0)? 'events':''); ?>">
                <?php echo $day->day; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
