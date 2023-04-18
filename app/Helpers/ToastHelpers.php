<?php

namespace App\Helpers;

class ToastHelpers
{
    public static function toastOK($toast, $message)
    {
        $toast->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => $message
        ]);
        return $toast;
    }
    public static function toastNotOK($toast, $message)
    {
        $toast->dispatchBrowserEvent('alert', [
            'type' => 'error',
            'message' => $message
        ]);
    }
}
