<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //================================= Config File Upload =========================//

        $config['upload_path'] = './asset/uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);

//////////////////////////////////////////////////////////////////////////////////
    }

    public function createUser($type) {
        if ($this->input->post('btnCreUser')) {
            if ($type == 't') {
                $arr = array(
                    'tPic' => $this->input->post('newTPic'),
                    'ID' => 'T' . $this->input->post('newTID'),
                    'tPassword' => $this->input->post('newTPassword'),
                    'tName' => $this->input->post('newTName'),
                    'tPhone' => $this->input->post('newTPhone'),
                    'tRoom' => $this->input->post('newTRoom'),
                    'tEmail' => $this->input->post('newTEmail'),
                    'License' => $this->input->post('License')
                );
//================================ upload file ===================================
                if (!$this->upload->do_upload('newTPic')) {
                    echo $this->upload->display_errors();
                } else {
                    $this->upload->data();
                }

//////////////////////////////////////////////////////////////////////////////////
                $sql = 'insert into teacherdim(ID,tName,tPhone,tRoom,tPassword,License,tEmail,tPic) value("' . $arr['ID'] . '","' . $arr['tName'] . '","' . $arr['tPhone'] . '","' . $arr['tRoom'] . '",md5("' . $arr['tPassword'] . '"),"' . $arr['License'] . '","' . $arr['tEmail'] . '","' . $arr['tPic'] . '")';
            }
            if ($type == 's') {
                $arr = array(
                    'sPic' => $this->input->post('newSPic'),
                    'ID' => 'S' . $this->input->post('newSID'),
                    'sID' => $this->input->post('newSID'),
                    'sPassword' => $this->input->post('newSPassword'),
                    'sName' => $this->input->post('newSName'),
                    'sPhone' => $this->input->post('newSPhone'),
                    'sYear' => $this->input->post('newSYear'),
                    'sDegree' => $this->input->post('newSDegree'),
                    'sEmail' => $this->input->post('newSEmail'),
                    'License' => $this->input->post('License')
                );
//================================ upload file ===================================
                if (!$this->upload->do_upload('newSPic')) {
                    echo $this->upload->display_errors();
                } else {
                    $this->upload->data();
                }

//////////////////////////////////////////////////////////////////////////////////
                $sql = 'insert into studentdim(ID,sID,sName,sPhone,sYear,sDegree,sPassword,License,sEmail,sPic) value("' . $arr['ID'] . '","' . $arr['sID'] . '","' . $arr['sName'] . '","' . $arr['sPhone'] . '","' . $arr['sYear'] . '","' . $arr['sDegree'] . '",md5("' . $arr['sPassword'] . '","' . $arr['License'] . '","' . $arr['sEmail'] . '","' . $arr['sPic'] . '")';
            }
            $this->ExamModel->QueryBySQL($sql);
            redirect('index.php/AjaxController/getUser/' . $type, 'refresh');
            exit();
        }
    }

    public function editPass($type, $userKey, $newPass) {

        if ($type == 't') {
            $sql = 'update teacherdim set tPassword = md5("' . $newPass . '") where tKey = ' . $userKey;
        }
        if ($type == 's') {
            $sql = 'update studentdim set sPassword = md5("' . $newPass . '") where sKey = ' . $userKey;
        }

        $this->ExamModel->QueryBySQL($sql);
    }

    public function editUser($userType) {
        if ($this->input->post('btnEditUser')) {
            if ($userType == 't') {

//================================ upload file ===================================
                if (!$this->upload->do_upload('tPic')) {
                    echo $this->upload->display_errors();
                    die();
                } else {
                    $this->upload->data();
                }
/////////////////////////////////////////////////////////////////////////////////

                $arr = array(
                    'tPic' => $this->input->post('tPic'),
                    'tKey' => $this->input->post('tKey'),
                    'tName' => $this->input->post('tName'),
                    'tPhone' => $this->input->post('tPhone'),
                    'tRoom' => $this->input->post('tRoom'),
                    'tEmail' => $this->input->post('tEmail'),
                    'License' => $this->input->post('License')
                );

                $sql = 'update teacherdim set tPic= "' . $arr['tPic'] . '",tEmail = "' . $arr['tEmail'] . '",tName = "' . $arr['tName'] . '",tPhone = "' . $arr['tPhone'] . '",tRoom = "' . $arr['tRoom'] . '",License = "' . $arr['License'] . '" where tKey = ' . $arr['tKey'];
                $this->ExamModel->QueryBySQL($sql);
                redirect('index.php/AjaxController/getUser/t', 'refresh');
                exit();
            }
            if ($userType == 's') {

//================================ upload file ===================================
                if (!$this->upload->do_upload('sPic')) {
                    echo $this->upload->display_errors();
                    die();
                } else {
                    $this->upload->data();
                }
//////////////////////////////////////////////////////////////////////////////////

                $arr = array(
                    'sPic' => $this->input->post('sPic'),
                    'sKey' => $this->input->post('sKey'),
                    'sName' => $this->input->post('sName'),
                    'sPhone' => $this->input->post('sPhone'),
                    'sYear' => $this->input->post('sYear'),
                    'sDegree' => $this->input->post('sDegree'),
                    'sEmail' => $this->input->post('sEmail'),
                    'License' => $this->input->post('License')
                );

                $sql = 'update studentdim set sPic="' . $arr['sPic'] . '",sEmail = "' . $arr['sEmail'] . '",sName = "' . $arr['sName'] . '",sPhone = "' . $arr['sPhone'] . '",sYear = "' . $arr['sYear'] . '",sDegree = "' . $arr['sDegree'] . '",License = "' . $arr['License'] . '" where sKey = ' . $arr['sKey'];
                $this->ExamModel->QueryBySQL($sql);
                redirect('index.php/AjaxController/getUser/s', 'refresh');
                exit();
            }
        }
    }

    public function resultDetail() {

        $data['page'] = 'showDetail';
        $this->load->view('Template/template', $data);
    }

    public function userDetail() {

        $data['page'] = 'userDetail';
        $this->load->view('Template/template', $data);
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

        if ($result[0]['License'] == 'NH') {
            redirect('index.php/MainController/login', 'refresh');
            exit();
        } else if ($result != false) {
            $chkUser = $result[0]['ID'];
            if ($chkUser[0] == 'T' || $chkUser[0] == 't') {
                $session_data = array(
                    'userType' => 't',
                    'userKey' => $result[0]['tKey'],
                    'userID' => $result[0]['ID'],
                    'userName' => $result[0]['tName'],
                    'userPhone' => $result[0]['tPhone'],
                    'userRoom' => $result[0]['tRoom'],
                    'userEmail' => $result[0]['tEmail'],
                    'userPic' => $result[0]['tPic']
                );

                $sql = 'select rKey from roomdim where tKey = ' . $result[0]['tKey'];
                $rs = $this->ExamModel->getData($sql);
                if (count($rs) == 0) {
                    $pass = $this->ExamModel->incrementalHash();
                    $sql = 'insert into roomdim(rName,rPassword,rStatus,tKey) value ("' . $result[0]['tName'] . '","' . $pass . '", 0, ' . $result[0]['tKey'] . ')';
                    $this->ExamModel->QueryBySQL($sql);
                }
            } else if ($chkUser[0] == 'S' || $chkUser[0] == 's') {
                $session_data = array(
                    'userType' => 's',
                    'userKey' => $result[0]['sKey'],
                    'userID' => $result[0]['ID'],
                    'studentID' => $result[0]['sID'],
                    'userName' => $result[0]['sName'],
                    'userPhone' => $result[0]['sPhone'],
                    'userYear' => $result[0]['sYear'],
                    'userDegree' => $result[0]['sDegree'],
                    'userEmail' => $result[0]['sEmail'],
                    'userPic' => $result[0]['sPic']
                );
            } else if ($chkUser[0] != 's' || $chkUser[0] != 'S' || $chkUser[0] != 't' || $chkUser[0] != 'T') {
                $session_data = array(
                    'userType' => 'a',
                    'userName' => $result[0]['aName'],
                    'userPic' => $result[0]['aPic']
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
