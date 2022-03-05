<?php

namespace App\Abstraction\Classes\Common;

class FeedbackMessagesClass
{
    const SUCCESS = 'success';
    const ERROR = 'error';
    const TOASTR_SUCCESS = 'Created Successfully';
    const TOASTR_ERROR = 'Error Occurred !';

    public static function success(): array
    {
        return [
            'type' => self::SUCCESS,
            'message' => self::TOASTR_SUCCESS
        ];
    }

    public static function error(): array
    {
        return [
            'type' => self::ERROR,
            'message' => self::TOASTR_ERROR
        ];
    }
}
