<?php if(!isset($_GET['cetak'])): ?>
<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Laporan Capaian</h2>
                        <h5 class="text-white op-7 mb-2">Memanajemen data Laporan Capaian</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="" method="get">
                                <input type="hidden" name="r" value="reports/capaian">
                                <div class="d-flex">
                                    <div style="width:49%;margin-right:2%">
                                        <label for="">Tahun</label>
                                        <?= Form::input('options:Semua|2021|2022|2023|2024|2025|2026', 'filter[tahun]', ['class'=>"form-control","value"=>isset($_GET['filter']['tahun'])?$_GET['filter']['tahun']:'']) ?>
                                    </div>
                                    <div style="width:49%;margin-right:2%">
                                        <label for="">Bulan</label>
                                        <?= Form::input('options:Semua|Januari|Februari|Maret|April|Mei|Juni|Juli|Agustus|September|Oktober|November|Desember', 'filter[bulan]', ['class'=>"form-control","value"=>isset($_GET['filter']['bulan'])?$_GET['filter']['bulan']:'']) ?>
                                    </div>
                                </div>
                                <p></p>
                                <button class="btn btn-primary">Filter</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif ?>
            <?php if(count($groups)): ?>
            <div class="row row-card-no-pd">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <?php if(!isset($_GET['cetak'])): ?>
                            <a href="<?=routeTo('reports/capaian',['filter'=>$_GET['filter'],'cetak'=>true])?>" class="btn btn-primary btn-sm" target="_blank">Cetak</a>
                            <p></p>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                            <?php else: ?>
                                <center>
                                    <h1>Laporan Realisasi Capaian Program Prioritas Pembangunan</h1>
                                    <?php if($_GET['filter']['tahun'] != 'Semua'): ?>
                                    <h2>Tahun <?=$_GET['filter']['tahun']?></h2>
                                    <?php endif ?>
                                </center>
                                <table width="100%" border="1" cellspacing="0" cellpadding="5">
                            <?php endif ?>
                                    <tr>
                                        <td style="white-space:nowrap" rowspan="<?=$_GET['filter']['tahun'] == 'Semua' ? 2 : 1 ?>">No</td>
                                        <td style="white-space:nowrap" rowspan="<?=$_GET['filter']['tahun'] == 'Semua' ? 2 : 1 ?>">Program Prioritas</td>
                                        <td style="white-space:nowrap" rowspan="<?=$_GET['filter']['tahun'] == 'Semua' ? 2 : 1 ?>">Kegiatan Prioritas</td>
                                        <td style="white-space:nowrap" rowspan="<?=$_GET['filter']['tahun'] == 'Semua' ? 2 : 1 ?>">Total Target</td>
                                        <td style="white-space:nowrap" rowspan="<?=$_GET['filter']['tahun'] == 'Semua' ? 2 : 1 ?>">Kegiatan</td>
                                        <?php if($_GET['filter']['tahun'] == 'Semua'): ?>
                                        <?php foreach(['2021','2022','2023','2024','2025','2026'] as $thn): ?>
                                        <td style="white-space:nowrap" rowspan="2">Target <?=$thn?></td>
                                        <td style="white-space:nowrap" colspan="2">Realisasi</td>
                                        <?php endforeach ?>
                                        <?php else: ?>
                                        <td style="white-space:nowrap">Target</td>
                                        <td style="white-space:nowrap">Realisasi</td>
                                        <?php endif ?>
                                        <!-- <td style="white-space:nowrap" rowspan="<?=$_GET['filter']['tahun'] == 'Semua' ? 2 : 1 ?>">% Capaian</td> -->
                                        <td style="white-space:nowrap" rowspan="<?=$_GET['filter']['tahun'] == 'Semua' ? 2 : 1 ?>">Keterangan</td>
                                    </tr>
                                    <?php if($_GET['filter']['tahun'] == 'Semua'): ?>
                                    <tr>
                                        <?php for($i=0;$i<6;$i++):?>
                                        <td>Angka</td>
                                        <td>%</td>
                                        <?php endfor ?>
                                    </tr>
                                    <?php endif ?>
                                    <?php 
                                    $no=1;
                                    foreach($groups as $index => $group): 
                                        $cnt = count(array_filter($groups,function($g) use ($group) {
                                            return $g->prioritas==$group->prioritas;
                                        }));
                                        
                                        $cnt2 = count(array_filter($groups,function($g) use ($group) {
                                            return $g->program_prioritas==$group->program_prioritas;
                                        }));

                                        $group->JLH = preg_replace_callback( "/[0-9]+/", function ($matches) {
                                            return number_format($matches[0]);
                                        }, $group->JLH);
                                        // $cnt = 1;
                                    ?>
                                    <tr>
                                        <?php if(!($index != 0 && $group->prioritas == $groups[$index-1]->prioritas)): ?>
                                        <td style="white-space:nowrap" rowspan="<?=$cnt?>"><?=$no++;?></td>
                                        <td style="white-space:nowrap" rowspan="<?=$cnt?>"><?= $group->prioritas.' - '.$group->nm_prioritas?></td>
                                        <?php endif ?>
                                        <?php if(!($index != 0 && $group->program_prioritas == $groups[$index-1]->program_prioritas)): ?>
                                        <td style="white-space:nowrap" rowspan="<?=$cnt2?>"><?=$group->program_prioritas?></td>
                                        <td style="white-space:nowrap" rowspan="<?=$cnt2?>"><?=$group->JLH?></td>
                                        <?php endif ?>
                                        <td style="white-space:nowrap"><?=$group->kegiatan?></td>
                                        <?php if($_GET['filter']['tahun'] == 'Semua'): ?>
                                        <?php foreach(['2021','2022','2023','2024','2025','2026'] as $thn): ?>
                                        <td style="white-space:nowrap"><?=is_numeric($group->target_{$thn}) ? number_format($group->target_{$thn}) : ''?></td>
                                        <td style="white-space:nowrap"><?=is_numeric($group->angka_{$thn}) ? number_format($group->angka_{$thn}).' '.$group->satuan_{$thn} : ''?></td>
                                        <td style="white-space:nowrap"><?=is_numeric($group->persen_{$thn}) ? number_format($group->persen_{$thn}) : ''?></td>
                                        <?php endforeach ?>
                                        <?php else: ?>
                                        <td style="white-space:nowrap"><?=$group->total_target?></td>
                                        <td style="white-space:nowrap"><?=$group->total_realisasi?></td>
                                        <?php endif ?>
                                        <!-- <td style="white-space:nowrap"><?=number_format($group->persen)?></td> -->
                                        <td style="white-space:nowrap"><?=$group->keterangan?></td>
                                    </tr>
                                    <?php endforeach ?>
                                </table>
                            <?php if(!isset($_GET['cetak'])): ?>
                            </div>
                            <?php else: ?>
                            <script>window.print()</script>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif ?>
            <?php if(!isset($_GET['cetak'])): ?>
        </div>
    </div>
<?php load_templates('layouts/bottom') ?>
<?php endif ?>