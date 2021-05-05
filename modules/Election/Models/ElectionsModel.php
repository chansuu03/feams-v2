<?php
namespace Modules\Election\Models;

use CodeIgniter\Model;

class ElectionsModel extends Model
{
    protected $table      = 'fea_elections';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['election_title', 'description', 'start_date', 'end_date', 'status'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getPosCan() {
        
    }
}