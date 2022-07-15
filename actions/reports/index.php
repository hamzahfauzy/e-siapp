<?php

$table = 'capaian';
Page::set_title(ucwords($table));
$conn = conn();
$db   = new Database($conn);
$success_msg = get_flash_msg('success');
$user = auth()->user;
if(get_role($user->id)->name == 'admin opd')
{
    $data = $db->all($table,[
        'user_id' => $user->id
    ]);
}
else
{
    $data = $db->all($table);
}

return [
    'datas' => $data,
    'table' => $table,
    'success_msg' => $success_msg
];