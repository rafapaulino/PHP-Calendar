# PHP Calendar

This package creates a calendar using PHP, the callbacks are in string and array format.

The parameters for generating the calendar are:
- `month` Month number 1 to 12.
- `year` Year of calendar.
- `first day of week` Day of the week the calendar starts.
- `full days` Whether or not to display the 42 days on the calendar.

See the examples folder for using the class easily.

[![Latest Stable Version](https://poser.pugx.org/php-pagination/php-pagination/v/stable)](https://packagist.org/packages/php-pagination/php-pagination)
[![Total Downloads](https://poser.pugx.org/php-pagination/php-pagination/downloads)](https://packagist.org/packages/php-pagination/php-pagination)
[![Latest Unstable Version](https://poser.pugx.org/php-pagination/php-pagination/v/unstable)](https://packagist.org/packages/php-pagination/php-pagination)
[![Monthly Downloads](https://poser.pugx.org/php-pagination/php-pagination/d/monthly)](https://packagist.org/packages/php-pagination/php-pagination)

[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=SN4SZRSL5HPZU)

## Features

- `v1.0.0` Package creation and unit tests.


### Important informations

- You need PHP 7.2 or higher to use this class.

- This package is ready to use, just install it via composer install.

-----

## Example of use

To use this class you must follow the code below. Do not forget to access the [examples folder here in the repository](https://github.com/rafapaulino/PHP-Calendar/tree/master/examples) with the usage examples.
Also access [rafapaulino.com](http://rapaulino.com/) for tips and tutorials on php and use of this package.

Install: composer require php-calendar/php-calendar

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