<?php
namespace Modules\Election\Controllers;

use App\Controllers\BaseController;
use Modules\Election\Models\CandidateModel;
use Modules\Election\Models\PositionsModel;
use Modules\Election\Models\VoteModel;
use Modules\Election\Models\ElectionsModel;
use Modules\Users\Models\UserModel;

class Voting extends BaseController {
	public function index() {
		helper(['form', 'url']);
		$session = session();
		$candidateModel = new CandidateModel();
		$positionsModel = new PositionsModel();
		$userModel = new UserModel();
		$voteModel = new VoteModel();
		$electionsModel = new ElectionsModel();

		$checkVoter = $voteModel->checkVote($session->get('user_id'));
		if(!empty($checkVoter)) {
            $data['voted'] = true;
            $data['votes'] = $checkVoter;
            // echo '<pre>';
            // print_r($data['votes']);
            // die();
		}

		// echo '<pre>';
		// print_r($data['candidates']);
		// echo '</pre>';
		// die();
		$user = $userModel->where('username', $session->get('username'))
		->first();				  
        $status = $electionsModel->where('status','a')->first();
        $data['activeElection'] = $status['id'];
		$data['candidates'] = $candidateModel->viewCandidates($status['id']);
		$data['positions'] = $positionsModel->where('election_id', $status['id'])->findAll();

		$data['logged_in'] = $user;
		$data['active'] = 'elections';
		$data['electionTab'] = 'voting';
		return view('Modules\Election\Views\Votes\voting', $data);
	}

	public function castVote() {
		$session = session();
		$voteModel = new VoteModel();
		$positionsModel = new PositionsModel();
		$electionsModel = new ElectionsModel();
		$positions = $positionsModel->findAll();

		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d H:i:s', time());
		
            // echo '<pre>';
            // print_r($_POST);
            // echo '</pre>';
            // die();
		
        $status = $electionsModel->where('status','a')->first();
        $data['activeElection'] = $status['id'];
        $data['positions'] = $positionsModel->where('election_id', $status['id'])->findAll();
		foreach($data['positions'] as $position) {
			$data['vote'] = [
                'election_id' => $this->request->getVar('election_id'),
				'position_id' => $position['id'],
				'candidate_id' => $this->request->getVar($position['id']),
				'voters_id' => $session->get('user_id'),
			];
            // echo '<pre>';
            // print_r($data['vote']);
            // echo '</pre>';
            // die();
			if($voteModel->save($data['vote'])) {
				continue;
			}
			else {
				$session->setFlashdata('failMsg', 'Failed to cast vote, please try again');
				return redirect()->back();
			}
		}
		$session->setFlashdata('successMsg', 'Successfully casted vote');
		return redirect()->back();
	}
}