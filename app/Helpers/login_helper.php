<?php
function LoginDB()
{
return $db= \Config\Database::connect(); 
}

// User is login true
function UserLogin()
{
return $builder = LoginDB()
->table('user_akses')
->join('users','user_akses.user_id=users.id')
->join('user_role','user_akses.role_user_id=user_role.id')
->where('users.id',session('ADMIN_SESSION'))
->get()
->getRow();
}