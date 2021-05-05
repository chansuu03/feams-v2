<?php
namespace App\Controllers;

use App\Models\RegisterModel;
use App\Models\UserModel;

class Register extends BaseController
{
	public function index() {
        helper(['form', 'url']);
		return view('register/register');
	}

    public function verify() {
        // echo '<pre>';
        // print_r($_POST);
        // print_r($_FILES);
        // echo '</pre>';
        // die();
        helper(['form', 'url', 'text']);
		$email = \Config\Services::email();
        $validation =  \Config\Services::validation();
        $session = session();
        $model = new RegisterModel();

        if($validation->run($_POST, 'users') == false) {
            $session->setFlashdata('user', 'Username taken, please use other username.');
            return redirect()->back();
        }
        else {
            $orgDate = $this->request->getVar('birthdate');
            $date = date("Y-m-d", strtotime($orgDate));
            $code = random_string('alnum', 12);
            // die($date);
            $file = $this->request->getFile('image');
            $newName = $file->getRandomName();
            $file->move('../public/uploads/profile_pic/', $newName);

            $account = $model->insert([
                'first_name' => $this->request->getVar('first_name'),
                'middle_name' => $this->request->getVar('middle_name'),
                'last_name' => $this->request->getVar('last_name'),
                'birthdate' => $date,
                'gender' => $this->request->getVar('gender'),
                'address' => $this->request->getVar('address'),
                'email' => $this->request->getVar('email'),
                'contact_number' => $this->request->getVar('contact_number'),
                'username' => $this->request->getVar('username'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'profile_pic' => $newName,
                'role' => '2',
                'email_code' => $code,
                'status' => 'v',
            ]);
            
            if($account) {
                $user = $model->where('username', $_POST['username'])->first();
                $message = 	"<html>
						<head>
							<title>Verification Code</title>
						</head>
						<body>
							<h2>Thank you for Registering. ".$this->request->getVar('first_name'). " ". $this->request->getVar('last_name')."</h2>
							<p>Your Account:</p>
							<p>Email: ".$this->request->getVar('email')."</p>
							<p>Please click the link below to activate your account.</p>
							<h4><a href='".base_url()."/register/activate/".$user['user_id']."/".$code."'>Activate My Account</a></h4>
						</body>
						</html>
						";
                // execute code
                $email->clear();
                $email->setFrom('facultyea@gmail.com');
                $email->setTo($_POST['email']);
                $email->setSubject('Signup Verification Email');
                $email->setMessage($message);
                if($email->send()) {
                    $session->setFlashdata('msg', 'Activation email sent, please check mail to verify');
                    return redirect()->to('/');
                }
                else {
                    die($email->printDebugger());
                }
            }
        }
    }

    public function activate() {
		$uri = new \CodeIgniter\HTTP\URI();
        $id = $this->request->uri->getSegment(3);
        $code = $this->request->uri->getSegment(4);

		$model = new UserModel();
		//fetch user details
		$user = $model->where('user_id', $id)->first();

		if($user['email_code'] == $code) {
            if($user['status'] == 'a') {
                $session = session();
                $session->setFlashdata('msg', 'Account already activated! Please login.');
                return redirect()->to('/login');
            }
            elseif($user['status'] == 'i') {
                $session = session();
                $session->setFlashdata('msg', 'Wait for the admin approval of the account.');
                return redirect()->to('/login');
            }
            else {
                $data = [
                    'status' => 'i'
                ];
                if($model->update($id, $data)) {
                    $session = session();
                    $session->setFlashdata('msg', 'Email verified, please wait for the admin approval');
                    return redirect()->to('/login');
                }
                else {
                    die('Activation failed, contact admin.');
                }
            }
        }
        else {
            die('Activation code error, please contact admin.');
        }
	}
}
