<?php namespace Modules\Users\Models;

use CodeIgniter\Model;

class UserModel extends \CodeIgniter\Model
{
    protected $table      = 'fea_users';
    protected $primaryKey = 'user_id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['employee_id', 'username', 'password', 'email', 'profile_pic', 'last_name', 'first_name', 'middle_name', 'gender', 'type', 'birthdate', 'contact_number', 'address', 'status'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function verifyUsername($username) {
        return $this->where('username', $username)->first();
    }

    public function viewActive() {
        return $this->findAll();
    }

    public function viewProfile($id) {
        $db      = \Config\Database::connect();
        $builder = $db->table("fea_users as user");
        $builder->select('user.*, roles.role_name as roles');
        $builder->where('username', $id)->limit(0);
        $builder->join('fea_roles as roles', 'user.role = roles.role_id', "left");
        return $builder->get()->getResultArray()[0];
    }

    public function listAll() {
        $db      = \Config\Database::connect();
        $builder = $db->table("fea_users as user");
        $builder->select('user.*, roles.role_name as roles');
        // $builder->where('username', $id)->limit(0);
        $builder->join('fea_roles as roles', 'user.role = roles.role_id', "left");
        return $builder->get()->getResultArray();
    }
}