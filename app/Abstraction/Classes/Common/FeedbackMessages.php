<?php

namespace App\Abstraction\Classes\Common;

class FeedbackMessages
{
    const SUCCESS = 'success';
    const ERROR = 'error';
    const TOASTR_SUCCESS = 'Created Successfully';
    const TOASTR_ERROR = 'Error Occurred !';

    public static function feedback(string $type, string $message = null): array
    {
        switch ($type) {
            case self::ERROR:
                $message = $message ?? self::TOASTR_ERROR;
                break;
            default:
                $message = $message ?? self::TOASTR_SUCCESS;
                break;
        }
        return [
            'type' => $type,
            'message' => $message
        ];
    }
}
