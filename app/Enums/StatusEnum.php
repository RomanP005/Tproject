<?php

namespace App\Enums;

enum StatusEnum: string

{
    case NEW = 'Новый';

    case JOB = 'В работе';

    case SUCCESS = 'Выполнена';


public static function values(): array
{
    return array_column(self::cases(), "value");
}

}
