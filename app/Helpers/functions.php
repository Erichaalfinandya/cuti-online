<?php

if (!function_exists('status_required_for')) {
    function status_required_for($golongan)
    {
        $golongan = strtolower(trim($golongan));

        return match($golongan) {
            'kepegawaian' => 1,
            'panmud_1', 'panmud_2', 'panmud_3', 'kasubbag_1', 'kasubbag_2', 'kasubbag_3' => 2,
            'panitera', 'sekretaris' => 3,
            'ketua' => 4,
            default => 0,
        };
    }
}
