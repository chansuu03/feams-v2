<?php
namespace Modules\Files\Controllers;

use CodeIgniter\Controller;
use Modules\Users\Models\UserModel;
use Modules\Files\Models\FileModel;
use CodeIgniter\HTTP\IncomingRequest;
use App\Controllers\UserFilter;

class Files extends \CodeIgniter\Controller
{
    public function __construct() {
        date_default_timezone_set('Asia/Manila');
        helper('filesystem');
    }

    public function index() {
        //need always
        $session = session();
        $userModel = new UserModel();
        $data['logged_in'] = $userModel->viewProfile($session->get('username'));
        $data['active'] = 'files';

        // dapat separate yung admin pati mga user na files
        $fileModel = new FileModel();
        $data['files2'] = $fileModel->where('uploader', '1')->findAll();
        $data['files'] = $fileModel->viewAdmin();
        // echo '<pre>';
        // print_r($data['files2']);
        // die();
        $data['members2'] = $fileModel->where('uploader !=', '1')->findAll();
        $data['members'] = $fileModel->viewMembers();
        return view('Modules\Files\Views\index', $data);
    }

    public function add() {
        helper(['form', 'url']);
        $request = service('request');
        $validation =  \Config\Services::validation();

        $session = session();
        $userModel = new UserModel();
        $fileModel = new FileModel();
        $data['logged_in'] = $userModel->viewProfile($session->get('username'));

        if(empty($_POST)) {
            //need always
            $data['active'] = 'files';

            return view('Modules\Files\Views\add', $data);
        }
        else {
            $fileCheck = $validation->setRules([
                'title' => [
                    'label' => 'file name',
                    'rules' => 'required|alpha_numeric_punct',
                ],
                'assocFile' => [
                    'label' => 'File',
                    'rules' => 'uploaded[assocFile]|ext_in[assocFile,doc,docx,pdf,xls,xlsx, pptx,ppt,epub,pub]',
                ],
            ]);

            if(!$validation->run($_POST)) {
                $session->setFlashdata('errors', $validation->getErrors());
                return redirect()->back();
            }

            $upload = $this->request->getFile('assocFile');
            $data = [
                'name' => $request->getPost('title'),
                'uploader' => $data['logged_in']['user_id'],
                'name' =>  $request->getPost('title').'.'.$upload->guessExtension(),
                'size' =>  $upload->getSize(),
                'extension'  => $upload->guessExtension(),
                'uploaded_at' => date('Y-m-d H:i:s')
            ];
            if($upload->move('uploads/files/assoc', $data['name'])) {
                if($fileModel->insert($data)) {
                    session()->setFlashdata('successMsg', 'File uploaded successfully');
                    return redirect()->to(base_url() . '/files');
                }
                else {
                    session()->setFlashdata('failMsg', 'Warning: File saved but info not saved');
                    return redirect()->to(base_url() . '/files');
                }
            }
            else {
                session()->setFlashdata('failMsg', 'Error uploading file, please try again');
                return redirect()->to(base_url() . '/files');
            }
        }
    }

    public function member($username = NULL) {
        $session = session();

        if($session->get('logged_in') == true) {
            //need always
            $userModel = new UserModel();
            $data['logged_in'] = $userModel->viewProfile($session->get('username'));
            $data['active'] = 'files';
    
            $fileModel = new FileModel();
            $data['files2'] = $fileModel->where('uploader', '1')->findAll();
            $data['files'] = $fileModel->viewAdmin();
            $data['members2'] = $fileModel->where('uploader', $session->get('user_id'))->findAll();
            $data['members'] = $fileModel->viewMember($session->get('user_id'));
            // echo '<pre>';
            // print_r($data['members']);
            // die();
            return view('Modules\Files\Views\index', $data);
        }
        else {
            session()->setFlashdata('msg', 'Please login to access this page.');
            return redirect()->to(base_url() . '/login');
        }
    }

    public function memberAdd($username = null) {
        helper(['form', 'url']);
        $request = service('request');

        $session = session();
        $userModel = new UserModel();
        $fileModel = new FileModel();
        $data['logged_in'] = $userModel->viewProfile($session->get('username'));

        if($session->get('logged_in') == true) {
            if(empty($_POST)) {
                //need always
                $data['active'] = 'files';
    
                return view('Modules\Files\Views\add', $data);
            }
            else {
                $upload = $this->request->getFile('assocFile');
                $data = [
                    'name' => $request->getPost('title'),
                    'uploader' => $data['logged_in']['user_id'],
                    'name' =>  $request->getPost('title').'.'.$upload->guessExtension(),
                    'size' =>  $upload->getSize(),
                    'extension'  => $upload->guessExtension(),
                    'uploaded_at' => date('Y-m-d H:i:s')
                ];
                $upload->move('uploads/files/assoc', $data['name']);
                $fileModel->insert($data);
                // if successfully send
                $session = session();
                $session->setFlashdata('msg', 'File uploaded! Wait for the officer review');
                return redirect()->to(route_to('\Modules\Files\Controllers\Files::member/$1', $username)); 
            }
        }
        else {
            session()->setFlashdata('msg', 'Please login to access this page.');
            return redirect()->to(base_url() . '/login');
        }
    } 
    
    public function delete($username = null, $id = null)
    {
        $session = session();
        if($session->get('logged_in') == true) {
            $fileModel = new FileModel();
            if($fileModel->find($id)) {
                $fileModel->delFile($id);
                $session->setFlashdata('successMsg', 'Sucessfully deleted data');
                return redirect()->back(); 
            }
            else {
                $session->setFlashdata('failMsg', 'Failed to delete data');
                return redirect()->back(); 
            }
        }
        else {
            session()->setFlashdata('msg', 'Please login to access this page.');
            return redirect()->to(base_url() . '/login');
        }
    }
}