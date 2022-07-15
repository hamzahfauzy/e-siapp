<?php

return [
    'tblname'    => [
        'field1','field2'
    ],
    'opd' => [
        'kd_opd' => [
            'label' => 'Kode OPD',
            'type'  => 'text'
        ],
        'nm_opd' => [
            'label' => 'Nama OPD',
            'type'  => 'text'
        ]
    ],
    'prioritas' => [
        'kd_prioritas' => [
            'label' => 'Kode Prioritas',
            'type'  => 'text'
        ],
        'nm_prioritas' => [
            'label' => 'Nama Prioritas',
            'type'  => 'text'
        ]
    ],
    'kegiatan' => [
        'kd_kegiatan' => [
            'label' => 'Kode Kegiatan',
            'type'  => 'text'
        ],
        'kd_prioritas' => [
            'label' => 'Kode Prioritas',
            'type'  => 'options-obj:prioritas,kd_prioritas,nm_prioritas'
        ],
        'program_prioritas' => [
            'label' => 'Kegiatan Prioritas',
            'type'  => 'text'
        ],
        'total_target',
        'kegiatan_2021',
        'target_2021',
        'satuan_2021',
        'opd_2021'  => [
            'label' => 'OPD Penanggung Jawab',
            'type'  => 'options-obj:opd,kd_opd,nm_opd'
        ],
        'kegiatan_2022',
        'target_2022',
        'satuan_2022',
        'opd_2022'  => [
            'label' => 'OPD Penanggung Jawab',
            'type'  => 'options-obj:opd,kd_opd,nm_opd'
        ],
        'kegiatan_2023',
        'target_2023',
        'satuan_2023',
        'opd_2023'  => [
            'label' => 'OPD Penanggung Jawab',
            'type'  => 'options-obj:opd,kd_opd,nm_opd'
        ],
        'kegiatan_2024',
        'target_2024',
        'satuan_2024',
        'opd_2024'  => [
            'label' => 'OPD Penanggung Jawab',
            'type'  => 'options-obj:opd,kd_opd,nm_opd'
        ],
        'kegiatan_2025',
        'target_2025',
        'satuan_2025',
        'opd_2025'  => [
            'label' => 'OPD Penanggung Jawab',
            'type'  => 'options-obj:opd,kd_opd,nm_opd'
        ],
        'kegiatan_2026',
        'target_2026',
        'satuan_2026',
        'opd_2026'  => [
            'label' => 'OPD Penanggung Jawab',
            'type'  => 'options-obj:opd,kd_opd,nm_opd'
        ],
    ],
    'capaian' => [
        'tahun' => [
            'label' => 'Tahun',
            'type'  => 'options:2021|2022|2023|2024|2025|2026'
        ],
        'bulan' => [
            'label' => 'Bulan',
            'type'  => 'options:Januari|Februari|Maret|April|Mei|Juni|Juli|Agustus|September|Oktober|November|Desember'
        ],
        'prioritas' => [
            'label' => 'Prioritas',
            'type'  => 'options-obj:prioritas,kd_prioritas,nm_prioritas'
        ],
        'program_prioritas' => [
            'label' => 'Kegiatan Prioritas',
            'type'  => 'options:- Pilih -'
        ],
        'kegiatan' => [
            'label' => 'Kegiatan',
            'type'  => 'options:- Pilih -'
        ],
        'target',
        'capaian_tahun_sebelumnya',
        'realisasi',
        'keterangan'
    ]
];