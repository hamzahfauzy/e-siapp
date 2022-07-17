<?php

return [
    'dashboard' => 'default/index',
    'referensi'  => [
        'Organisasi Perangkat Daerah (OPD)' => 'crud/index&table=opd',
        'Prioritas Pembangunan 2021/2026' => 'crud/index&table=prioritas',
        'Kegiatan Prioritas' => 'crud/index&table=kegiatan'
    ],
    'evaluasi'  => [
        'Capaian' => 'reports/index',
        'Laporan Capaian' => 'reports/capaian'
    ],
    'pengguna'  => [
        'semua pengguna' => 'users/index',
        'roles' => 'roles/index'
    ],
    'pengaturan' => 'application/index'
];