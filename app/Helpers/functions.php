<?php
if (!function_exists('levels_for_user')) {
    function levels_for_user($user)
    {
        if (!$user) return [];

        $golongan = strtolower(trim($user->golongan));
        $roles = $user->getRoleNames()->toArray();
        $levels = [];

        // LEVEL DARI GOLONGAN
        $golongan_level = match ($golongan) {
            'kepegawaian' => 1,
            'panmud_1', 'panmud_2', 'panmud_3',
            'kasubbag_1', 'kasubbag_2', 'kasubbag_3' => 2,
            'panitera', 'sekretaris' => 3,
            'ketua' => 4,
            default => null,
        };

        if (!is_null($golongan_level)) $levels[] = $golongan_level;

        // LEVEL DARI ROLE TAMBAHAN
        if (in_array('kasubbag_3', $roles)) $levels[] = 2;

        // hilangkan duplikat dan urutkan
        $levels = array_unique($levels);
        sort($levels);

        return $levels;
    }
}

function can_user_act_level($userLevels, $sudahAccPerLevel)
{
    $available = [];
    foreach ($userLevels as $lvl) {
        // cek apakah semua level sebelum lvl sudah di-ACC
        $allPreviousAcc = true;
        for ($i = 1; $i < $lvl; $i++) {
            if (!$sudahAccPerLevel[$i]) {
                $allPreviousAcc = false;
                break;
            }
        }
        if ($allPreviousAcc) $available[] = $lvl;
    }
    return $available;
}
