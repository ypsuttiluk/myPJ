<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function login() {
        if (isset($this->session->userdata['logged_in'])) {
            redirect('index.php/MainController', 'refresh');
            exit();
        } else {
            $this->load->view('loginPage');
        }
    }

    public function chkLogin() {
        $this->load->model('userModel');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

        /*       if ($this->form_validation->run() == FALSE) {
          if (isset($this->session->userdata['logged_in'])) {
          $data['page'] = 'mainPage';
          } else {
          $data['page'] = 'loginPage';
          }
          $this->load->view('Template/template', $data);
          } else { */
        $input = array(
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        );
        $result = $this->userModel->login($input);

        if ($result != false) {
            $chkUser = $result[0]['ID'];
            if ($chkUser[0] == 'T' || $chkUser[0] == 't') {
                $session_data = array(
                    'userType' => 't',
                    'userKey' => $result[0]['tKey'],
                    'userID' => $result[0]['ID'],
                    'userName' => $result[0]['tName'],
                    'userPhone' => $result[0]['tPhone'],
                    'userRoom' => $result[0]['tRoom']
                );

                $sql = 'select rKey from roomdim where tKey = ' . $result[0]['tKey'];
                $rs = $this->ExamModel->getData($sql);
                if (count($rs) == 0) {
                    $pass = $this->ExamModel->incrementalHash();
                    $sql = 'insert into roomdim(rName,rPassword,rStatus,tKey) value ("' . $result[0]['tName'] . '","' . $pass . '", 0, ' . $result[0]['tKey'] . ')';
                    $this->ExamModel->QueryBySQL($sql);
                }
            }
            if ($chkUser[0] == 'S' || $chkUser[0] == 's') {
                $session_data = array(
                    'userType' => 's',
                    'userKey' => $result[0]['sKey'],
                    'userID' => $result[0]['ID'],
                    'studentID' => $result[0]['sID'],
                    'userName' => $result[0]['sName'],
                    'userPhone' => $result[0]['sPhone'],
                    'userYear' => $result[0]['sYear'],
                    'userDegree' => $result[0]['sDegree']
                    
                );
            }
            $this->session->set_userdata('logged_in', $session_data);


//            if (count($rs) == 0) {
//                $sql1 = 'insert into roomdim(rName,rPassword,tKey) value(rName="'.$result[0]['tName'].'",rPassword = "")'
//            }
            redirect('index.php/MainController', 'refresh');
            exit();
        } else {
            redirect('index.php/MainController/login', 'refresh');
            exit();
//$data['page'] = 'loginPage';
        }
//$this->load->view('Template/template', $data);
//    }
    }

    public function logout() {
        $sess_array = array(
            'userType' => '',
            'userKey' => '',
            'userID' => '',
            'userName' => '',
            'userPhone' => '',
            'userRoom' => '',
            'userYear' => '',
            'userDegree' => ''
        );
        $this->session->unset_userdata('logged_in', $sess_array);
        session_destroy();
        redirect('index.php/MainController/login', 'refresh');
        exit();
    }

    public function index() {
//$data['test'] = '';
        if (isset($this->session->userdata['logged_in'])) {
            $data['page'] = 'mainPage';
            $this->load->view('Template/template', $data);
        } else {
            $data['page'] = 'loginPage';
            $this->load->view('Template/template', $data);
        }
        //$this->load->view('test');
    }

}
