<?php
namespace Modules\Users\Models;

use CodeIgniter\Model;

class RoleModel extends Model
{
    protected $table      = 'fea_roles';
    protected $primaryKey = 'role_id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['role_name', 'status'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

}