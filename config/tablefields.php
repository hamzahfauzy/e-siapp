<?php

return [
    'tblname'    => [
        'field1','field2'
    ],
    'opd' => [
        'kd_opd','nm_opd'
    ],
    'prioritas' => [
        'kd_prioritas','nm_prioritas'
    ],
    'kegiatan' => [
        'kd_kegiatan',
        'kd_prioritas' => [
            'label' => 'Kd Prioritas',
            'type'  => 'options-obj:prioritas,kd_prioritas,nm_prioritas'
        ],
        'program_prioritas',
        'total_target',
        'satuan',
        'kegiatan_2021',
        'kegiatan_2022',
        'kegiatan_2023',
        'kegiatan_2024',
        'kegiatan_2025',
        'kegiatan_2026',
        'target_2021',
        'target_2022',
        'target_2023',
        'target_2024',
        'target_2025',
        'target_2026',
        'opd_penanggung_jawab' => [
            'label' => 'OPD Penanggung Jawab',
            'type'  => 'options-obj-multiple:opd,kd_opd,nm_opd'
        ]
    ],
    'capaian' => [
        'tahun' => [
            'label' => 'Tahun',
            'type'  => 'options:2021|2022|2023|2024|2025|2026'
        ],
        'prioritas' => [
            'label' => 'Prioritas',
            'type'  => 'options-obj:prioritas,kd_prioritas,nm_prioritas'
        ],
        'program_prioritas' => [
            'label' => 'Program Prioritas',
            'type'  => 'options-obj:kegiatan,kd_kegiatan,program_prioritas'
        ],
        'kegiatan',
        'target_2021',
        'capaian_tahun_sebelumnya',
        'realisasi',
        'alasan'
    ]
];