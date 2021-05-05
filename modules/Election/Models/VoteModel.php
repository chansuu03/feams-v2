<?php
namespace Modules\Election\Models;

use CodeIgniter\Model;

class VoteModel extends Model
{
    protected $table      = 'fea_votes';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['election_id', 'voters_id', 'candidate_id', 'position_id'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function checkVote($id = null) {
        $db      = \Config\Database::connect();
        $builder = $db->table('fea_votes as a');
        $builder->select('a.id, a.election_id, a.voters_id, a.candidate_id, a.position_id, c.first_name, c.last_name');
        $builder->join('fea_candidates as b', 'b.id = a.candidate_id');
        $builder->join('fea_users as c', 'b.user_id = c.user_id');
        $data = $builder->get();
        // echo '<pre>';
        // print_r($data->getResultArray()) ;
        // die();
        return $data->getResultArray();
    }
}