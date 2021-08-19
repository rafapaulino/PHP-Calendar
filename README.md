# PHP Calendar

<div align="center">
    <p align="center">
        <a href="https://php-calendar.docsforge.com/" target="_blank">&#129146; Visit the Documentation &#129144;</a>
    </p>
</div>

[![Latest Stable Version](https://poser.pugx.org/php-pagination/php-pagination/v/stable)](https://packagist.org/packages/php-pagination/php-pagination)

[![Total Downloads](https://poser.pugx.org/php-pagination/php-pagination/downloads)](https://packagist.org/packages/php-pagination/php-pagination)

[![Latest Unstable Version](https://poser.pugx.org/php-pagination/php-pagination/v/unstable)](https://packagist.org/packages/php-pagination/php-pagination)

[![Monthly Downloads](https://poser.pugx.org/php-pagination/php-pagination/d/monthly)](https://packagist.org/packages/php-pagination/php-pagination)

[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SN4SZRSL5HPZU)

------

# What is the package and what does it do?

PHP Calendar is a php package that generates a calendar from the month and year parameters, besides this functionality it is possible to add events to the calendar days.

---

# Get Started

## 1. Requirements

- [PHP 8](https://www.php.net/releases/8.0/en.php)
- [Composer](https://getcomposer.org/)

## 2. Installation
- composer require php-calendar/php-calendar

## 3. Documentation
[You can access the documentation for this package by clicking here](https://php-calendar.docsforge.com/)

## 4. Code Examples

### How to create a simple calendar:

This package creates a calendar using PHP, the callbacks are in string and array format.

The parameters for generating the calendar are:
- `month` Month number 1 to 12.
- `year` Year of calendar.
- `first day of week` Day of the week the calendar starts.
- `full days` Whether or not to display the 42 days on the calendar.

See the examples folder for using the class easily.

```php
<?php
require '../vendor/autoload.php';

use Calendar\Calendar;

$calendar = new Calendar(
    1, //month
    2021, //year
    0, //first day of week 0-6
    true //show 42 days in calendar collumns
);
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
    if (($mes % 3) == 0): echo '<div style="clear:both;"></div>'; endif;

    endforeach; 
?>
```

### Adding Events to Your Calendar:

```php
<?php 
include 'vendor/autoload.php';

use Calendar\Calendar;
use Calendar\Events;

$calendar = new Calendar(1,2021, 0, true);
$events = new Events(1,2021);
$events->addEvent("My brother's birthday","2021-01-17",1);
$events->addEvent("Vacation","2021-01-01",9);
$month = $events->getMonth();
$year = $events->getYear();
$days = $events->getDays();
$daysWeek = $events->getDaysWeek();
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

        <td title="<?php echo ((count($day->events) > 0)? implode(", ",$day->events):''); ?>" class="<?php echo (($day->currentMonth)?'current':''); ?> <?php echo (($day->carbon->isToday() && $day->currentMonth)?'today':''); ?> <?php echo ((count($day->events) > 0)? 'events':''); ?>">
            <?php echo $day->day; ?>
        </td>

        <?php if ($loop == 6): ?></tr><?php endif; ?>
        <?php
        $loop++;

        if ($loop > 6) $loop = 0;

    endforeach;
    ?>
    </tbody>
</table>
```

### Features

- `v1.1.0` I added the events to the calendar.
- `v1.0.0` Package creation and unit tests.


## 5. Demo

 - [Demo project](https://projects.rafapaulino.com/php-calendar)

## 6. Support

If you need any support, please check our [Issues](https://github.com/rafapaulino/PHP-Calendar/issues). You can ask questions or report problems there.

## 7. Credits

Created by: [Rafael Paulino](https://github.com/rafapaulino/)