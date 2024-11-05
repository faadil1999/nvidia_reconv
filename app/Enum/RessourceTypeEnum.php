<?php

namespace App\Enum;

use App\Traits\Enums\Names;
use App\Traits\Enums\Values;

enum RessourceTypeEnum: string
{
    use Names, Values;

    case ARTICLE = 'article';
    case VIDEO = 'video';
}
