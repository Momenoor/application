<?php

namespace App\Enums;

enum RequestTypeEnum: string
{
    case REVISION = 'مراجعة التقرير';
    case CHANGE_LEVEL = 'تغيير المستوى';
    case REPORT_APPROVAL = 'إعتماد التقرير';
}
