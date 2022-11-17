<?php

namespace app\helpers;

use app\models\Interview;
use yii\helpers\ArrayHelper;

class InterviewHelper
{
    public static function getStatusList(): array
    {
        return [
            Interview::STATUS_NEW => 'New',
            Interview::STATUS_PASS => 'Passed',
            Interview::STATUS_REJECT => 'Rejected',
        ];
    }

    public static function getStatusName($status)
    {
        return ArrayHelper::getValue(self::getStatusList(), $status);
    }
}
