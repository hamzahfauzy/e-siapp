<?php

$table = 'kegiatan';
Page::set_title(ucwords($table));
$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

$data = $db->all($table);
$data = array_map(function($d){
    if($d->opd_2021)
    {
        $d->opd = $d->opd_2021;
    }
    else if($d->opd_2022)
    {
        $d->opd = $d->opd_2022;
    }
    else if($d->opd_2023)
    {
        $d->opd = $d->opd_2023;
    }
    else if($d->opd_2023)
    {
        $d->opd = $d->opd_2023;
    }
    else if($d->opd_2024)
    {
        $d->opd = $d->opd_2024;
    }
    else if($d->opd_2025)
    {
        $d->opd = $d->opd_2025;
    }
    else if($d->opd_2026)
    {
        $d->opd = $d->opd_2026;
    }
    return $d;
}, $data);

$fields = [
    'kd_prioritas' => [
        'label' => 'Program Prioritas',
        'type'  => 'options-obj:prioritas,kd_prioritas,nm_prioritas'
    ],
    'program_prioritas' => [
        'label' => 'Kegiatan Prioritas',
        'type'  => 'text'
    ],
    'kegiatan_2021' => [
        'label' => 'Kegiatan',
        'type'  => 'text'
    ],
    'total_target',
    'target_2021' => [
        'label' => '2021',
        'type'  => 'text'
    ],
    'target_2022' => [
        'label' => '2022',
        'type'  => 'text'
    ],
    'target_2023' => [
        'label' => '2023',
        'type'  => 'text'
    ],
    'target_2024' => [
        'label' => '2024',
        'type'  => 'text'
    ],
    'target_2025' => [
        'label' => '2025',
        'type'  => 'text'
    ],
    'target_2026' => [
        'label' => '2026',
        'type'  => 'text'
    ],
    'opd'  => [
        'label' => 'OPD Penanggung Jawab',
        'type'  => 'options-obj:opd,kd_opd,nm_opd'
    ],
];

return [
    'datas' => $data,
    'table' => $table,
    'success_msg' => $success_msg,
    'fields' => $fields
];