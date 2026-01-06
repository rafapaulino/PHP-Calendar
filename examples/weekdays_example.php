<?php
include __DIR__ . '/../vendor/autoload.php';

use Calendar\WeekDays;

// exemplo: semana contendo 17 de dezembro de 2025
$week = new WeekDays(0, new \DateTime('2025-12-17'));
$days = $week->getDays();
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Exemplo WeekDays</title>
    <style>
        .week-bar { display:flex; gap:8px; max-width:700px; margin:20px; }
        .week-day { flex:1 1 0; border:1px solid #e6e6e6; padding:8px; text-align:center; border-radius:4px; }
        .week-day .letter { font-weight:700; font-size:14px; color:#333; }
        .week-day .num { margin-top:6px; font-size:18px; }
        .current { background:#f0f8ff; }
        .today { background:#000; color:#fff; }
    </style>
</head>
<body>

<h2>Semana contendo <?php echo htmlspecialchars($week->getDays()->first()->date); ?></h2>

<div class="week-bar">
    <?php foreach ($days as $d): ?>
        <div class="week-day <?php echo ($d->currentMonth ? 'current' : ''); ?> <?php echo ($d->carbon->isToday() ? 'today' : ''); ?>" title="<?php echo $d->date; ?>">
            <div class="letter"><?php echo htmlspecialchars($d->dayOfWeek->letter); ?></div>
            <div class="num"><?php echo htmlspecialchars($d->day); ?> <small><?php echo htmlspecialchars($d->month->shortName ?? $d->month->fullName); ?></small></div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>
