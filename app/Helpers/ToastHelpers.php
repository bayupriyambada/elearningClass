<?php

namespace App\Helpers;

use Livewire\Component;

class ToastHelpers
{
    public static function success(Component $component, $message)
    {
        $component->dispatchBrowserEvent('alert', [
            'type' => 'success',
            'message' => $message,
        ]);
    }
    public static function error(Component $component, $message)
    {
        $component->dispatchBrowserEvent('alert', [
            'type' => 'error',
            'message' => $message,
        ]);
    }
    public static function info(Component $component, $message)
    {
        $component->dispatchBrowserEvent('alert', [
            'type' => 'info',
            'message' => $message,
        ]);
    }
    public static function warning(Component $component, $message)
    {
        $component->dispatchBrowserEvent('alert', [
            'type' => 'warning',
            'message' => $message,
        ]);
    }
}
