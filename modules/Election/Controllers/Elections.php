<?php
namespace Modules\Election\Controllers;

use App\Controllers\BaseController;
use Modules\Users\Models\UserModel;
use Modules\Election\Models\ElectionsModel;

class Elections extends BaseController {

	public function index() {
		helper('form', 'url');
		$session = session();
		$userModel = new UserModel();
		$electionModel = new ElectionsModel();

        $user = $userModel->where('username', $session->get('username'))
                          ->first();				  

        $data['elections'] = $electionModel->findAll();
        $data['logged_in'] = $user;
        $data['active'] = 'elections';
        $data['electionTab'] = 'elections';
        return view('Modules\Election\Views\Elections\index', $data);
	}

    public function set() {
		helper('form', 'url');
		$session = session();
		$userModel = new UserModel();
		$electionModel = new ElectionsModel();
        $validation =  \Config\Services::validation();
			
        if(!empty($_POST)) {
            // validation rules
            $validation->setRules([
				'election_title' => ['label' => 'Election Title', 'rules' => 'required|min_length[5]|max_length[30]'],
				'description' => ['label' => 'Description', 'rules' => 'required|min_length[10]|max_length[50]']
			]);
            
            // run validations
            if (!$validation->withRequest($this->request)->run()) {
                session()->setFlashdata('failedmsg', 'Failed to add, please try again');
                return redirect()->back();
			}
            else {
                $data = [
                    'election_title' => $this->request->getVar('election_title'),
                    'description' => $this->request->getVar('description'),
                    'status' => 'a',
                ];

                if($electionModel->insert($data)) {
                    session()->setFlashdata('msg', 'Successfully added election');
                    return redirect()->back();
                }
                else {
                    session()->setFlashdata('msg', 'Failed to add, please try again');
                    return redirect()->back();
                }
            }
        }
    }

	public function castVote() {

    }
}