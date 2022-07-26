<?php

$table = 'kegiatan';
Page::set_title(ucwords($table));
$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');

$data = $db->all($table);
$data = array_map(function($d) use ($db){
    $opds = [];
    $no = 1;
    for($i=1;$i<=6;$i++)
    {
        if(!$d->{"opd_202".$i}) continue;
        $opds[] = ['no'=>$i,'opd'=>$d->{"opd_202".$i},'tahun'=>(2020+$i)];
        $no++;
    }

    if(count(array_unique(array_column($opds,'opd'))) > 1)
    {
        $opds = array_map(function($opd) use ($db){
            $nm_opd = $db->single('opd',['kd_opd'=>$opd['opd']])->nm_opd;
            return $opd['no'].'. '.$nm_opd.' ('.$opd['tahun'].')';
        }, $opds);

        $d->opd = implode('<br>',$opds);
    }
    else
    {
        $nm_opd = $db->single('opd',['kd_opd'=>$opds[0]['opd']])->nm_opd;
        $d->opd = $nm_opd;
    }

    $kegiatans = [];
    $no = 1;
    for($i=1;$i<=6;$i++)
    {
        if(!$d->{"kegiatan_202".$i}) continue;
        $kegiatans[] = ['no'=>$i,'kegiatan'=>$d->{"kegiatan_202".$i},'tahun'=>(2020+$i)];
        $no++;
    }
    
    if(count(array_unique(array_column($kegiatans,'kegiatan'))) > 1)
    {
        $kegiatans = array_map(function($opd) use ($db){
            return $opd['no'].'. '.$opd['kegiatan'].' ('.$opd['tahun'].')';
        }, $kegiatans);

        $d->kegiatan = implode('<br>',$kegiatans);
    }
    else
    {
        $d->kegiatan = $kegiatans[0]['kegiatan'];
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
    'kegiatan' => [
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