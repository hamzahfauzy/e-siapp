<?php

Page::set_title("Laporan Capaian");
$conn = conn();
$db   = new Database($conn);

$groups = [];

if(isset($_GET['filter']['tahun']))
{
    if($_GET['filter']['tahun'] == 'Semua')
    {
        $db->query = "SELECT 
                        prioritas, program_prioritas, kegiatan, keterangan,
                        (SELECT total_target FROM kegiatan WHERE kegiatan.kd_prioritas = capaian.prioritas AND kegiatan.program_prioritas = capaian.program_prioritas AND kegiatan.kegiatan_2021 = capaian.kegiatan) as JLH,
                        (SELECT SUM(target) FROM capaian c2 WHERE c2.tahun = capaian.tahun AND c2.prioritas = capaian.prioritas AND c2.program_prioritas = capaian.program_prioritas AND c2.kegiatan = capaian.kegiatan) as total_target,
                        (SELECT SUM(realisasi) FROM capaian c3 WHERE c3.tahun = capaian.tahun AND c3.prioritas = capaian.prioritas AND c3.program_prioritas = capaian.program_prioritas AND c3.kegiatan = capaian.kegiatan) as total_realisasi
                      FROM 
                        `capaian` 
                      group by prioritas, program_prioritas, kegiatan";

    }
    else
    {
        if($_GET['filter']['bulan'] == 'Semua')
        {
            $db->query = "SELECT 
                        tahun, prioritas, program_prioritas, kegiatan, keterangan,
                        (SELECT SUM(target) FROM capaian c2 WHERE c2.tahun = capaian.tahun AND c2.prioritas = capaian.prioritas AND c2.program_prioritas = capaian.program_prioritas AND c2.kegiatan = capaian.kegiatan) as total_target,
                        (SELECT SUM(realisasi) FROM capaian c3 WHERE c3.tahun = capaian.tahun AND c3.prioritas = capaian.prioritas AND c3.program_prioritas = capaian.program_prioritas AND c3.kegiatan = capaian.kegiatan) as total_realisasi
                      FROM 
                        `capaian` 
                      WHERE tahun = ".$_GET['filter']['tahun']." group by tahun, prioritas, program_prioritas, kegiatan";
        }
        else
        {
            $db->query = "SELECT 
                        tahun, prioritas, program_prioritas, kegiatan, keterangan,
                        (SELECT SUM(target) FROM capaian c2 WHERE c2.tahun = capaian.tahun AND c2.prioritas = capaian.prioritas AND c2.program_prioritas = capaian.program_prioritas AND c2.kegiatan = capaian.kegiatan) as total_target,
                        (SELECT SUM(realisasi) FROM capaian c3 WHERE c3.tahun = capaian.tahun AND c3.prioritas = capaian.prioritas AND c3.program_prioritas = capaian.program_prioritas AND c3.kegiatan = capaian.kegiatan) as total_realisasi
                      FROM 
                        `capaian` 
                      WHERE tahun = ".$_GET['filter']['tahun']." AND bulan = '".$_GET['filter']['bulan']."' group by tahun, prioritas, program_prioritas, kegiatan";
        }
        

    }
    $groups = $db->exec('all');

    $groups = array_map(function($group) use ($db){
        $db->query = "SELECT * FROM kegiatan WHERE kd_prioritas = '$group->prioritas' AND program_prioritas = '$group->program_prioritas'";
        $kegiatan = $db->exec('single');

        if($_GET['filter']['tahun'] == 'Semua')
        {
          
          foreach(['2021','2022','2023','2024','2025','2026'] as $thn)
          {

            // $db->query = "SELECT * FROM capaian WHERE prioritas = '$group->prioritas' AND program_prioritas = '$group->program_prioritas' AND kegiatan = '$group->kegiatan' AND tahun = $thn";
            // $cp = $db->exec('single');

            // $group->target_{$thn} = $cp->target ?? '';
            $group->target_{$thn} = $kegiatan->{"target_$thn"} ?? 0;
            
            $db->query = "SELECT SUM(realisasi) as total_realisasi FROM capaian WHERE prioritas = '$group->prioritas' AND program_prioritas = '$group->program_prioritas' AND kegiatan = '$group->kegiatan' AND tahun = $thn";
            $group->angka_{$thn} = $db->exec('single')->total_realisasi;

            $group->persen_{$thn} = $group->angka_{$thn} == 0 || $group->target_{$thn} == 0 ? '' : ($group->angka_{$thn}/$group->target_{$thn}) * 100;

            $group->satuan_{$thn} = $kegiatan->{"satuan_".$thn};

          }
        }
        $group->JLH = $kegiatan->total_target;
        $group->nm_prioritas = $db->single('prioritas',['kd_prioritas'=>$group->prioritas])->nm_prioritas;
        $group->persen = ($group->total_realisasi/$group->total_target)*100;
        $group->ket = $group->persen < 100 ? "Belum Tercapai" : "Tercapai";
        return $group;

    }, $groups);
}

return compact('groups');