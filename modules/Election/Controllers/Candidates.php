<?php
namespace Modules\Election\Controllers;

use App\Controllers\BaseController;
use Modules\Election\Models\CandidateModel;
use Modules\Election\Models\PositionsModel;
use Modules\Election\Models\ElectionsModel;
use Modules\Users\Models\UserModel;

class Candidates extends BaseController {
	public function index() {
		helper('form', 'url');
		$session = session();
		$candidateModel = new CandidateModel();
		$userModel = new UserModel();
		$positionsModel = new PositionsModel();
		$electionsModel = new ElectionsModel();

        if($session->get('logged_in') != true) {
			session()->setFlashdata('msg', 'Please login to access this page.');
            return redirect()->to(site_url());
        }
		
        $status = $electionsModel->where('status','a')->first();
        
		$data['users'] = $userModel->findAll();
		$data['positions'] = $positionsModel->where('election_id', $status['id'])->findAll();
		$data['candidates'] = $candidateModel->viewCandidates($status['id']);
		
		// echo '<pre>';
		// print_r($data['candidates']);
		// echo '</pre>';
		// die();
        $user = $userModel->where('username', $session->get('username'))
                          ->first();				  
        
        $data['activeElection'] = $status['id'];
        $data['logged_in'] = $user;
        $data['active'] = 'elections';
        $data['electionTab'] = 'candidates';
		return view('Modules\Election\Views\Candidates\index', $data);
	}

    public function add() {
		// echo '<pre>';
		// print_r($_POST);
        // die();
        
		$validation =  \Config\Services::validation();
		$session = session();
		$candidateModel = new CandidateModel();

		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d H:i:s', time());

		$candidateCheck = $validation->setRules([
			'candidate_name' => 'required',
			'position' => 'required',
			'platform' => 'required',
		]);
        
        if(!$validation->run($_POST)) {
			$session->setFlashdata('failMsg', 'Please enter values');
			return redirect()->back();
		}
		else {
			$data = [
                'election_id' => $this->request->getVar('election_id'),
				'position_id' => $this->request->getVar('position'),
				'user_id' => $this->request->getVar('candidate_name'),
				'platform' => $this->request->getVar('platform'),
				'created_at' => date('Y-m-d H:i:s', time())
			];

			if($candidateModel->insertData($data)) {
				$session->setFlashdata('successMsg', 'Successfully added candidate');
				return redirect()->back();
			}
			else {
				$session->setFlashdata('failMsg', 'Failed to add candidate, please try again');
				return redirect()->back();
			}
		}
    }

    public function delete($id) {
		$session = session();
		$candidateModel = new CandidateModel();

        if($candidateModel->delete($id)) {
            $session->setFlashdata('successMsg', '<i class="fas fa-check-circle"></i> Candidate deleted successfully!');
            return redirect()->back();
        }
        else {
            $session->setFlashdata('failMsg', '<i class="fas fa-times-circle"></i> Candidate failed to delete!');
            return redirect()->back();
        }
    }

	public function posEdit() { 
        // echo '<pre>';
        // print_r($_POST);
        // die();
        $session = session();
        $candidateModel = new CandidateModel();
		// Loading db instance
		$this->db = db_connect();
		// Loading Query builder instance
		$this->builder = $this->db->table("fea_candidates");
        
        // Updated data
		$this->builder->set([
			"position_id" => $_POST['pos_id'],
		]);
		$this->builder->where([
            "user_id" => $_POST['user_id'],
		]);
		if($this->builder->update()) {
			$session->setFlashdata('successMsg', '<i class="fas fa-check-circle"></i> Candidate position updated successfully!');
			return redirect()->route('election/candidates');
		}
		else {
			$session->setFlashdata('failMsg', '<i class="fas fa-check-circle"></i> Candidate position update fail!');
			return redirect()->route('election/candidates');
		}
    }
}