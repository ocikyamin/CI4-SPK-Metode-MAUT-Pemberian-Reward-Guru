<?php
function SuperVDB()
{
return $db= \Config\Database::connect(); 
}

// User is login true
function UserLogin()
{
return $builder = SuperVDB()
->table('user_akses')
->select('user_akses.id as superv_id,
 users.*,
 user_role.role_name,
 user_akses.sekolah_id,
 sekolah.npsn,
 sekolah.nama_sekolah')
->join('users','user_akses.user_id=users.id')
->join('user_role','user_akses.role_user_id=user_role.id')
->join('sekolah','user_akses.sekolah_id=sekolah.id')
->where('users.id',session('SUPERV_SESSION'))
->get()
->getRow();
}