<?php

Page::set_title('Dashboard');
$conn = conn();
$db   = new Database($conn);

$prioritas = $db->all('prioritas');

$data = [];
foreach($prioritas as $p)
{
    $db->query = "SELECT * FROM `capaian` WHERE prioritas = '$p->kd_prioritas'";

    $groups = $db->exec('all');

    $total_persen = 0;
    foreach($groups as $group)
    {
        $persen = 0;
        foreach(['2021','2022','2023','2024','2025','2026'] as $thn)
        {
            $db->query = "SELECT SUM(target) as total_target FROM capaian WHERE prioritas = '$group->prioritas' AND program_prioritas = '$group->program_prioritas' AND kegiatan = '$group->kegiatan' AND tahun = $thn";
            $group->target_{$thn} = $db->exec('single')->total_target;
            
            $db->query = "SELECT SUM(realisasi) as total_realisasi FROM capaian WHERE prioritas = '$group->prioritas' AND program_prioritas = '$group->program_prioritas' AND kegiatan = '$group->kegiatan' AND tahun = $thn";
            $group->angka_{$thn} = $db->exec('single')->total_realisasi;

            $persen += ($group->angka_{$thn} == 0 ? 0 : ($group->angka_{$thn}/$group->target_{$thn}) * 100);
        }
        $total_persen += ($persen == 0 ? 0 : ($persen / 6));
    }

    $total_persen = $total_persen == 0 ? 0 : $total_persen / count($groups);

    $data[] = ceil($total_persen);
    
}

$all_prioritas = $prioritas;
$prioritas = array_map(function($p){return $p->kd_prioritas; },$prioritas);
$prioritas = (array) $prioritas;

return compact('all_prioritas','prioritas','data');