<?php
Page::set_title('Tambah Pengguna');
if(request() == 'POST')
{
    $conn = conn();
    $db   = new Database($conn);

    $_POST['users']['password'] = md5($_POST['users']['password']);

    
    $user = $db->insert('users',$_POST['users']);
    
    if(!empty($_POST['users']['opd_id']))
    {
        $role = $db->single('roles',['name' => 'admin opd']);
        // assign role to user
        $db->insert('user_roles',[
            'user_id' => $user->id,
            'role_id' => $role->id
        ]);
    }
    set_flash_msg(['success'=>'Pengguna berhasil ditambahkan']);
    header('location:'.routeTo('users/index'));
}