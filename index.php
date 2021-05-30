<style>
table {
    margin: 10px;
    float: left;
}
td {
    padding: 6px;
    color: #555;
    text-align: center;
}
.current {
    background: #CCC;
    color: #000;
}
.clear {
    float: none;
    width: 100%;
    height: 1px;
    margin: 2px 0;
    clear: both;
}
.today {
    background: #000;
    color: #FFF;
}
</style>
<?php 
include 'vendor/autoload.php';

use Calendar\Calendar;

foreach (range(1,12) as $mes):
    $calendar = new Calendar($mes,2021, 0, true);
    $month = $calendar->getMonth();
    $year = $calendar->getYear();
    $days = $calendar->getDays();
    $daysWeek = $calendar->getDaysWeek();
?>
<table>
    <caption><?php echo $month->fullName; ?> <?php echo $year; ?></caption>
    <thead>
        <tr>
            <?php foreach($daysWeek as $week): ?>
                <th><?php echo $week->letter; ?></th>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <?php 
            $loop = 0;
            foreach($days as $day):
                
        ?>
            <?php if ($loop == 0): ?><tr><?php endif; ?>
            
            <td class="<?php echo (($day->currentMonth)?'current':''); ?> <?php echo (($day->carbon->isToday() && $day->currentMonth)?'today':''); ?>"><?php echo $day->day; ?></td>

            <?php if ($loop == 6): ?></tr><?php endif; ?> 
        <?php 
            $loop++; 

            if ($loop > 6) $loop = 0;

            endforeach; 
        ?>
    </tbody>
</table>
<?php 
    if (($mes % 3) == 0): echo '<div class="clear"></div>'; endif;

    endforeach; 
?>