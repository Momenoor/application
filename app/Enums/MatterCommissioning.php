<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class MatterCommissioning extends Enum
{
    const INDIVIDUAL =   0;
    const COMMITTEE =   1;
}
