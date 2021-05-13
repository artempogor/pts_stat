<?php

declare(strict_types=1);

namespace App\Orchid\Layouts;

use Orchid\Screen\Field;

/**
 * Class Map.
 *
 * @method PtsMaps name(string $value = null)
 * @method PtsMaps value($value = true)
 * @method PtsMaps help(string $value = null)
 * @method PtsMaps popover(string $value = null)
 * @method PtsMaps zoom($value = true)
 * @method PtsMaps height($value = '300px')
 * @method PtsMaps title(string $value = null)
 * @method PtsMaps required(bool $value = true)
 */
class AllPtsMaps extends Field
{
    /**
     * @var string
     */
    protected $view = 'allmaps';

    /**
     * Default attributes value.
     *
     * @var array
     */
    protected $attributes = [
        'zoom'   => 20,
        'height' => '300px',
    ];

    /**
     * Attributes available for a particular tag.
     *
     * @var array
     */
    protected $inlineAttributes = [
        'place',
        'name',
        'required',
        'height',
    ];
}