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

    //setar os eventos

    //setar a agenda do dia

/*
 *
 *  talvez a solução seja passar os eventos com o setDays($eventos,$agenda)
 *  assim você criaria os eventos dentro do loop de dias somente umas vez
 *  passar um array collection com o dia
 * https://www.calendarr.com/brasil/
 * https://www.calendarioonline.com.br/calendario-2021/
 * talvez criar um array ou uma classe onde você possa pegar os eventos e fazer um loop neles
 * ou você pode extender a classe de calendário e criar a classe de eventos
 *
 * para resolver o problema dos eventos
 * https://codeshack.io/event-calendar-php/
 *
 * $calendar = new Calendar(1,2021)
 * ->setFirstDayWeek(0)
 * ->addEvent('Aniversário de São Paulo',25)
 * ->addEvent('Confraternização Universal',1)
 * ->addEvent('Suruba dos ninjas da folha',10,13)
 * ->setDays(true);
 *
 *  $month = $calendar->getMonth();
    $year = $calendar->getYear();
    $days = $calendar->getDays();
    $daysWeek = $calendar->getDaysWeek();
    $events = $calendar->getEvents();
 *
 * versão 1 - apenas o caledário 
 * versão 2 - adiciona os eventos 
 * versão 3 - adiciona a agenda para o dia com os horários 
 * versão 4 - pega a visualização por semana https://fullcalendar.io/demos
 * 
 * a classe que add os eventos e agenda extende do calendário
 */
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