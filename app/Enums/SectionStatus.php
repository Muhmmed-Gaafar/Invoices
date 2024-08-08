<?php

namespace App\Enums;



enum SectionStatus {
    const Active = 0;
    const UnActive = 1;

    public static function getStatusText($status)
    {
        switch ($status) {
            case 0:
                return "مفعل";
            case 1:
                return "غير مفعل";
            default:
                return "Null";
        }
    }
}
