<?php
// if (!function_exists('levels_for_user')) {
//     function levels_for_user($user)
//     {
//         if (!$user) return [];

//         $levels = [];

//         // normalisasi
//         $golongan = strtolower(trim($user->golongan ?? ''));
//         $roles = array_map(fn($r) => strtolower(trim($r)), $user->getRoleNames()->toArray());

//         // mapping golongan → level
//         $map = [
//             1 => ['kepegawaian'],
//             2 => ['panmud_1', 'panmud_2', 'panmud_3', 'kasubbag_1', 'kasubbag_2', 'kasubbag_3'],
//             3 => ['panitera', 'sekretaris'],
//             4 => ['ketua'],
//         ];

//         // cek golongan
//         foreach ($map as $lvl => $names) {
//             if (in_array($golongan, $names)) {
//                 $levels[] = $lvl;
//             }
//         }

//         // cek roles
//         foreach ($roles as $role) {
//             foreach ($map as $lvl => $names) {
//                 if (in_array($role, $names)) {
//                     $levels[] = $lvl;
//                 }
//             }
//         }

//         // bersih
//         $levels = array_values(array_unique($levels));
//         sort($levels);
//         return $levels;
//     }
// }

// function can_user_act_level($userLevels, $sudahAccPerLevel)
// {
//     $available = [];

//     foreach ($userLevels as $lvl) {
//         // cek apakah semua level sebelumnya sudah ACC (harus true, bukan sekadar isset)
//         $allPreviousAcc = true;

//         for ($i = 1; $i < $lvl; $i++) {
//             if (!isset($sudahAccPerLevel[$i]) || $sudahAccPerLevel[$i] !== true) {
//                 $allPreviousAcc = false;
//                 break;
//             }
//         }

//         if ($allPreviousAcc) {
//             $available[] = $lvl;
//         }
//     }

//     return $available;
// }

if (!function_exists('status_required_for')) {
    function status_required_for($golongan)
    {
        $golongan = strtolower(trim($golongan));
        return match ($golongan) {
            'kepegawaian' => 1,
            'panmud_1', 'panmud_2', 'panmud_3' => 2,
            'panitera', 'sekretaris' => 3,
            'ketua' => 4,
            default => 0,
        };
    }
}
