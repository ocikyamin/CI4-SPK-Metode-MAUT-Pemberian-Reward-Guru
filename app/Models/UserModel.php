<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];
    
    public function CheckUserEmail($email)
    {
        return $this->db->table('user_akses')
        ->select('user_akses.*,users.password')
        ->join('users','user_akses.user_id=users.id')
        ->join('user_role','user_akses.role_user_id=user_role.id')
        ->where('users.email', $email)->get()->getRow();
    }

    public function AllUsers()
    {
        return $this->db->table('user_akses')
        ->select('users.*,user_role.role_name')
        ->join('users','user_akses.user_id=users.id')
        ->join('user_role','user_akses.role_user_id=user_role.id')
        ->get()->getResultArray();
    }

    public function SaveUserAccess($user_id, $role_user_id, $sekolah_id = null)
    {
        // Pengecekan parameter
        if ($user_id && $role_user_id) {
            $data = [
                'user_id' => $user_id,
                'role_user_id' => $role_user_id,
                'sekolah_id' => $sekolah_id
            ];
            $this->db->insert('user_akses', $data); 
        } else {
            // Parameter tidak valid, tangani sesuai kebutuhan
        }
    }
    

}