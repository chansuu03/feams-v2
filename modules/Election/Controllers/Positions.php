<?php
namespace Modules\Election\Controllers;

use App\Controllers\BaseController;
use Modules\Election\Models\CandidateModel;
use Modules\Election\Models\PositionsModel;
use Modules\Election\Models\ElectionsModel;
use Modules\Users\Models\UserModel;

class Positions extends BaseController {
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

        if(empty($status)) {
			session()->setFlashdata('failedmsg', 'Please set an election first.');
            return redirect()->to('/election');
        }

		$data['positions'] = $positionsModel->findAll();
        $data['activeElection'] = $status['id'];

        $user = $userModel->where('username', $session->get('username'))
                          ->first();				  
        
        $data['logged_in'] = $user;
        $data['active'] = 'elections';
        $data['electionTab'] = 'positions';
		return view('Modules\Election\Views\Positions\index', $data);
	}

	public function add() {
		$validation =  \Config\Services::validation();
		$session = session();
		$positionsModel = new PositionsModel();

		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d H:i:s', time());

		$positionCheck = $validation->setRules([
			'description' => 'required|alpha_numeric_punct',
			// 'max_vote' => 'required|integer',
		]);

		if(!$validation->run($_POST)) {
			$session->setFlashdata('failMsg', 'Please enter values');
			return redirect()->back();
		}
		else {
			$data = [
                'election_id' => $this->request->getVar('election_id'),
				'description' => $this->request->getVar('description'),
				// 'max_vote' => $this->request->getVar('max_vote'),
                'created_at' => $date,
			];
            // echo '<pre>';
            // print_r($data);
            // die();
			
			if($positionsModel->addPosition($data)) {
				$session->setFlashdata('successMsg', 'Successfully added position');
				return redirect()->back();
			}
			else {
				$session->setFlashdata('failMsg', 'Failed to add position, please try again');
				return redirect()->back();
			}
		}
	}    

    public function delete($id) {
		$session = session();
		$positionsModel = new PositionsModel();

        if($positionsModel->delete($id)) {
            $session->setFlashdata('successMsg', '<i class="fas fa-check-circle"></i> Position deleted successfully!');
            return redirect()->back();
        }
        else {
            $session->setFlashdata('failMsg', '<i class="fas fa-times-circle"></i> Position failed to delete!');
            return redirect()->back();
        }
    }

    public function edit() {
        // echo '<pre>';
        // print_r($_POST);
        // die();
		$validation =  \Config\Services::validation();
		$session = session();
		$positionsModel = new PositionsModel();

        $positionCheck = $validation->setRules([
			'description' => 'required|alpha_numeric_punct',
			// 'max_vote' => 'required|integer',
		]);

        if(!$validation->run($_POST)) {
			$session->setFlashdata('failMsg', 'Please enter values');
			return redirect()->back();
		}
		else {
			$data = [
                'election_id' => $this->request->getVar('election_id'),
				'description' => $this->request->getVar('description'),
				// 'max_vote' => $this->request->getVar('max_vote'),
			];
            // echo '<pre>';
            // print_r($data);
            // die();
			
			if($positionsModel->update($this->request->getVar('posID'),$data)) {
				$session->setFlashdata('successMsg', 'Successfully edited position');
				return redirect()->back();
			}
			else {
				$session->setFlashdata('failMsg', 'Failed to add position, please try again');
				return redirect()->back();
			}
		}
    }
}