<?php

$conn = conn();
$db   = new Database($conn);
unset($_GET['r']);
$kegiatan = $db->all('kegiatan',$_GET);

echo json_encode([
    'status' => 'success',
    'data' => $kegiatan,
]);

die();