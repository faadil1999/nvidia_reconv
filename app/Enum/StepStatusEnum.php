<?php

namespace App\Enum;

use App\Traits\Enums\Names;
use App\Traits\Enums\Values;

enum StepStatusEnum: string
{
    use Names, Values;

    case NOT_STARTED = 'not_started';
    case ONGOING = 'on_going';
    case FINISHED = 'finished';
}
