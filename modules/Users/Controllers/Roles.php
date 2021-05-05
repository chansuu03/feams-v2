<?php
namespace Modules\Users\Controllers;

use CodeIgniter\Controller;
use Modules\Users\Models\UserModel;
use Modules\Users\Models\RoleModel;

class Roles extends \CodeIgniter\Controller {
    public function __construct() {
        date_default_timezone_set('Asia/Manila');
    }

    public function index() {
        //need always
		helper('form', 'url');
        $session = session();
        $userModel = new UserModel();
        $roleModel = new RoleModel();

        $data['roles'] = $roleModel->findAll();

        $data['logged_in'] = $userModel->viewProfile($session->get('username'));
        $data['active'] = 'users';
        $data['userTab'] = 'roles';

        $data['users'] = $userModel->viewActive();

        return view('Modules\Users\Views\Roles\index', $data);
    }

    public function add() {
        $validation =  \Config\Services::validation();
		$session = session();
		$roleModel = new RoleModel();

		date_default_timezone_set('Asia/Manila');
		$date = date('Y-m-d H:i:s', time());

		$positionCheck = $validation->setRules([
			'role_name' => 'required|alpha_numeric_punct',
			// 'max_vote' => 'required|integer',
		]);

		if(!$validation->run($_POST)) {
			$session->setFlashdata('failMsg', 'There is an error at your role name');
			return redirect()->back();
		}
		else {
			$data = [
				'role_name' => $this->request->getVar('role_name'),
				'status' => 'a',
			];
            // echo '<pre>';
            // print_r($data);
            // die();
			
			if($roleModel->insert($data)) {
				$session->setFlashdata('successMsg', 'Successfully added role');
				return redirect()->back();
			}
			else {
				$session->setFlashdata('failMsg', 'Failed to add role, please try again');
				return redirect()->back();
			}
		}
    }

    public function delete($id) {
		$session = session();
		$roleModel = new RoleModel();

        if($roleModel->delete($id)) {
            $session->setFlashdata('successMsg', '<i class="fas fa-check-circle"></i> Role deleted successfully!');
            return redirect()->back();
        }
        else {
            $session->setFlashdata('failMsg', '<i class="fas fa-times-circle"></i> Role failed to delete!');
            return redirect()->back();
        }
    }
}