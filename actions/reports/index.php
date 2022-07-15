<?php

$table = 'capaian';
Page::set_title(ucwords($table));
$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');
$user = auth()->user;
$clause = isset($_GET['filter']) ? $_GET['filter'] : [];
if(get_role($user->id)->name == 'admin opd')
{
    $clause['user_id'] = $user->id;
}

$data = $db->all($table, $clause);
return [
    'datas' => $data,
    'table' => $table,
    'success_msg' => $success_msg
];