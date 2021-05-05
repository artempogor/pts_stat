<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Examples;

use Orchid\Screen\Layouts\Metric;

class MetricsExample extends Metric
{
    /**
     * @var string
     */
    protected $title = 'Cтатистика за неделю';

    /**
     * @var string
     */
    protected $target = 'metrics';

    /**
     * @var array
     */
    protected $labels = [
        'Cостояние А',
        'Cостояние B',
        'Cостояние C',
        'Отремонтированно',
    ];
}
