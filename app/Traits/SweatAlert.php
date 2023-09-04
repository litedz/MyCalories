<?php

namespace App\Traits;

trait SweatAlert
{
    public function SweatAlert(string $title, string $type)
    {
        $this->dispatch('testwal', [
            'title' => $title,
            'icon' => $type,
        ]);
    }
}
