<?php

$table = 'kegiatan';
Page::set_title(ucwords($table));
$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

$data = $db->all($table);
$data = array_map(function($d) use ($db){
    $opds = [];
    $opds[] = ['no'=>1,'opd'=>$d->opd_2021,'tahun'=>2021];
    $opds[] = ['no'=>2,'opd'=>$d->opd_2022,'tahun'=>2022];
    $opds[] = ['no'=>3,'opd'=>$d->opd_2023,'tahun'=>2023];
    $opds[] = ['no'=>4,'opd'=>$d->opd_2024,'tahun'=>2024];
    $opds[] = ['no'=>5,'opd'=>$d->opd_2025,'tahun'=>2025];
    $opds[] = ['no'=>6,'opd'=>$d->opd_2026,'tahun'=>2026];

    if(count(array_unique($opds)) > 1)
    {
        $opds = array_map(function($opd, $index) use ($db){
            $nm_opd = $db->single('opd',['kd_opd'=>$opd['opd']])->nm_opd;
            return $opd['no'].'. '.$nm_opd.' ('.$opd['tahun'].')';
        }, $opds);

        $d->opd = implode('<br>',$opds);
    }
    else
    {
        $d->opd = $opds[0];
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
        'type'  => 'text'
    ],
];

return [
    'datas' => $data,
    'table' => $table,
    'success_msg' => $success_msg,
    'fields' => $fields
];