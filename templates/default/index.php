<?php load_templates('layouts/top') ?>
    <div class="content">
        <div class="panel-header bg-primary-gradient">
            <div class="page-inner py-5">
                <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
                    <div>
                        <h2 class="text-white pb-2 fw-bold">Dashboard</h2>
                        <h5 class="text-white op-7 mb-2">Sistem Informasi Pelaporan Program Pembangunan Kabupaten Asahan</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-inner mt--5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-head-row">
                                <div class="card-title">Grafik Capaian</div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="chart-container" style="min-height: 375px">
                                <canvas id="statisticsChart"></canvas>
                            </div>
                            <div id="myChartLegend"></div>

                            <div>
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Kode</th>
                                        <th>Nama</th>
                                        <th>Presentase</th>
                                    </tr>
                                    <?php foreach($all_prioritas as $idx => $p): ?>
                                    <tr>
                                        <td><?=$p->kd_prioritas?></td>
                                        <td><?=$p->nm_prioritas?></td>
                                        <td><?=$data[$idx]?>%</td>
                                    </tr>
                                    <?php endforeach ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $script = '<script>statisticsChart('.json_encode($prioritas).','.json_encode($data).')</script>'; ?>
<?php load_templates('layouts/bottom',compact('script')) ?>