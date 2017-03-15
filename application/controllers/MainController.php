<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function changeStatus($rKey, $rStatus) {
        if ($rStatus == 0) {
            $sql = 'update roomdim set rStatus = 1 where rKey = ' . $rKey;
        } else {
            $sql = 'update roomdim set rStatus = 0 where rKey = ' . $rKey;
            $sql2 = 'update studentdim set rKey = NULL where rKey = ' . $rKey;
            $this->ExamModel->QueryBySQL($sql2);
        }
        $this->ExamModel->QueryBySQL($sql);
        redirect('index.php/MainController/roomDetail/' . $rKey . '/t', 'refresh');
        exit();
    }

    public function createExam($userKey) {
        if ($this->input->post('btnSave')) {
            $chapter['chapter'] = $this->input->post('chapter');
            $numOfQuestion = $this->input->post('numberOfQues');
            $numOfChapter = count($chapter, COUNT_RECURSIVE);
            $chap = '';
            $text = 'chapterKey = ';
            for ($i = 0; $i < $numOfChapter - 1; $i++) {
                $chap = $chap . $text . $chapter['chapter'][$i];
                if ($i < $numOfChapter - 2) {
                    $chap = $chap . ' or ';
                }
            }
            $condition = 'where ' . $chap;
            $sql = 'select * from questiondim ' . $condition . ' order by RAND() limit ' . $numOfQuestion;
            $result = $this->ExamModel->getData($sql);

            $quesKey = '';
            foreach ($result as $r) {
                $quesKey = $quesKey . $r['quesKey'] . ',';
            }
            $exam = array(
                'examText' => $this->input->post('examText'),
                'questionKey' => substr($quesKey, 0, -1),
                'tKey' => $userKey
            );
            $this->ExamModel->insertToExam($exam);
            redirect('index.php/MainController/manageExam/' . $userKey, 'refresh');
            exit();
        }
    }

    public function joinToRoom($rKey, $sKey) {
        $sql1 = 'select rKey from studentdim where sKey = ' . $sKey;
        $result = $this->ExamModel->getData($sql1);
        $sql2 = 'select rStatus from roomdim where rKey = ' . $rKey;
        $rs = $this->ExamModel->getData($sql2);
        $sql3 = 'select questionKey from examinationdim where examKey = (select examKey from roomDim where rKey = ' . $rKey . ')';
        $questionKey = $this->ExamModel->getData($sql3);
        echo $questionKey[0]['questionKey'];die();
        $quesID = explode(',', $questionKey[0]['questionKey']);
        print_r($quesID);
        echo count($quesID);
        die();
        echo $numOfQues;
        die();

        if ($result[0]['rKey'] == NULL) {
            if ($rs[0]['rStatus'] == 1) {
                $sql = 'update studentdim set rKey = ' . $rKey . ' where sKey = ' . $sKey;
                $this->ExamModel->QueryBySQL($sql);

                $data['page'] = 'roomPageStudent';
                $this->load->view('Template/template', $data);
            } else {
                redirect('index.php/MainController/roomDetail/' . $sKey . '/s', 'refresh');
                exit();
            }
        } else if ($result[0]['rKey'] == $rKey) {
            $data['page'] = 'roomPageStudent';
            $this->load->view('Template/template', $data);
        } else {
            redirect('index.php/MainController/roomDetail/' . $sKey . '/s', 'refresh');
            exit();
        }
    }

    public function editRoom($rKey, $userKey, $userType) {
        if ($this->input->post('btnSave')) {
            $room = array(
                'rName' => $this->input->post('rName')
            );
            $this->ExamModel->updateToRoom($room, $rKey);
            redirect('index.php/MainController/roomDetail/' . $userKey . '/' . $userType, 'refresh');
            exit();
        }
    }

    public function roomDetail($userKey, $userType) {
        if ($userType == 't') {
            $sql1 = "select tKey from roomdim where tKey = " . $userKey;
            $result = $this->ExamModel->getNumrow($sql1);
            if ($result == 1) {
                $data['page'] = 'roomPageTeacher';
                $sql = "select * from roomdim where tKey = " . $userKey;
                $data['rs'] = $this->ExamModel->getData($sql);
                $rs = $this->ExamModel->getData($sql);
                $examKey = $rs[0]['examKey'];
                $rKey = $rs[0]['rKey'];
                $sql2 = "select examText from examinationdim where examKey = " . $examKey;
                $data['rs2'] = $this->ExamModel->getData($sql2);
                $sql3 = "select * from studentdim where rKey = " . $rKey;
                $data['rs3'] = $this->ExamModel->getData($sql3);
            }
        } else {
            $data['page'] = 'roomList';
            $sql = "select * from roomdim";
            $data['rs'] = $this->ExamModel->getData($sql);
        }
        $this->load->view('Template/template', $data);
    }

    public function examDetail($eKey) {
        $sql = 'select * from examinationdim where examKey =' . $eKey;
        $data['rs'] = $this->ExamModel->getData($sql);
        $data['page'] = 'examDetail';

        $sql2 = 'select examText from examinationdim where examKey=' . $eKey;
        $rs2 = $this->ExamModel->getData($sql2);
        foreach ($rs2 as $r) {
            $data['examText'] = $r['examText'];
        }

        $data['examKey'] = $eKey;
        $this->load->view('Template/template', $data);
    }

    public function manageExam($userKey) {
        $data['page'] = 'manageExam';
        $sql = "select * from examinationdim where tKey = " . $userKey;
        $sql2 = 'select * from chapterdim where tKey = ' . $userKey;
        $data['rs'] = $this->ExamModel->getData($sql);
        $data['rs2'] = $this->ExamModel->getData($sql2);
        $this->load->view('Template/template', $data);
    }

    public function editExam($examKey) {
        if ($this->input->post('btnSave')) {
            $exam = array(
                'examText' => $this->input->post('examText')
            );
            $this->ExamModel->updateToExam($exam, $examKey);
            redirect('index.php/MainController/examDetail/' . $examKey, 'refresh');
            exit();
        }
    }

    public function editChapter($chapterKey) {
        if ($this->input->post('btnSave')) {
            $chapter = array(
                'chapterName' => $this->input->post('chapterName')
            );
            $this->ExamModel->updateToChapter($chapter, $chapterKey);
            redirect('index.php/MainController/chapterDetail/' . $chapterKey, 'refresh');
            exit();
        }
    }

    public function createChapter($tKey) {
        if ($this->input->post('btnSave')) {
            $chapter = array(
                'chapterName' => $this->input->post('chapterName'),
                'tKey' => $tKey
            );
            $this->ExamModel->insertToChapter($chapter);
            redirect('index.php/MainController/manageChapter/' . $tKey, 'refresh');
            exit();
        }
    }

    public function manageChapter($tKey) {
        $data['page'] = 'manageChapter';
        $sql = "select * from chapterdim where tKey = " . $tKey;
        $data['rs'] = $this->ExamModel->getData($sql);
        $this->load->view('Template/template', $data);
    }

    public function editTFQuestion($chapterKey, $quesKey, $a, $b) {
        if ($this->input->post('btnTF') != NULL) {
            $ques = array(
                'quesText' => $this->input->post('quesText'),
                'quesType' => 'TF',
                'chapterKey' => $chapterKey
            );
            $this->ExamModel->updateToQuestion($ques, $quesKey);

            if ($this->input->post('TF1') == 'ถูก') {
                $ans1 = array(
                    'ansText' => 'TRUE',
                    'ansFlag' => 1,
                );
                $ans2 = array(
                    'ansText' => 'FALSE',
                    'ansFlag' => 0,
                );
            } else {
                $ans1 = array(
                    'ansText' => 'TRUE',
                    'ansFlag' => 0,
                );
                $ans2 = array(
                    'ansText' => 'FALSE',
                    'ansFlag' => 1,
                );
            }
            $this->ExamModel->updateToAnswer($ans1, $a);
            $this->ExamModel->updateToAnswer($ans2, $b);
            redirect('index.php/MainController/chapterDetail/' . $chapterKey);
            exit();
        }
    }

    public function editMCQuestion($chapterKey, $quesKey, $a, $b, $c, $d) {
        if ($this->input->post('btnMC') != NULL) {
            $ques = array(
                'quesText' => $this->input->post('quesText'),
                'quesType' => 'MC',
                'chapterKey' => $chapterKey
            );
            $this->ExamModel->updateToQuestion($ques, $quesKey);

            for ($i = 1; $i < 5; $i++) {
                $ansFlag = 0;
                if ($this->input->post('C' . $i . '') == 'ถูก') {
                    $ansFlag = 1;
                }
                $ans = array(
                    'ansText' => $this->input->post('ansT' . $i . ''),
                    'ansFlag' => $ansFlag
                );
                if ($i == 1) {
                    $this->ExamModel->updateToAnswer($ans, $a);
                }
                if ($i == 2) {
                    $this->ExamModel->updateToAnswer($ans, $b);
                }
                if ($i == 3) {
                    $this->ExamModel->updateToAnswer($ans, $c);
                }
                if ($i == 4) {
                    $this->ExamModel->updateToAnswer($ans, $d);
                }
            }


            redirect('index.php/MainController/chapterDetail/' . $chapterKey);
            exit();
        }

        /*
          $sql = 'select quesType,quesText from questiondim where quesKey =' . $n;
          $rs = $this->ExamModel->getData($sql);
          $data['page'] = 'editMCQuestion';
          $data['quesText'] = $r['quesText'];
          $data['quesKey'] = $a;
          $this->load->view('Template/template', $data);
          $sql2 = 'select * from answerdim where quesKey =' . $n;
          //$rs = $this->ExamModel->testGet();
          $data['rs'] = $this->ExamModel->getData($sql2);
          $this->load->view('Template/template', $data); */
    }

    public function editQuestion($cID, $n, $status) {
        $sql = 'select quesType,quesText from questiondim where quesKey =' . $n;
        $rs = $this->ExamModel->getData($sql);
        //$sql2 = 'select examKey from examinationdim where'

        foreach ($rs as $r) {
            if ($r['quesType'] == 'MC' && $status == 0) {
                $data['page'] = 'editMCQuestion';
            } else if ($r['quesType'] == 'TF' && $status == 0) {
                $data['page'] = 'editTFQuestion';
            } else if ($r['quesType'] == 'MC' && $status == 1) {
                $data['page'] = 'questionMCDetail';
            } else {
                $data['page'] = 'questionTFDetail';
            }
            $data['quesText'] = $r['quesText'];
            $data['quesKey'] = $n;
            if ($status == 0) {
                $data['chapterKey'] = $cID;
            }
        }

        $sql2 = 'select * from answerdim where quesKey =' . $n;
        //$rs = $this->ExamModel->getData($sql2);
        $data['rs'] = $this->ExamModel->getData($sql2);
        $this->load->view('Template/template', $data);
    }

    public function chapterDetail($cId) {
        $sql = 'select * from questiondim where chapterKey =' . $cId;
        $data['rs'] = $this->ExamModel->getData($sql);
        $data['page'] = 'chapterDetail';

        $sql2 = 'select chapterName from chapterdim where chapterKey=' . $cId;
        $rs2 = $this->ExamModel->getData($sql2);
        foreach ($rs2 as $r) {
            $data['chapterName'] = $r['chapterName'];
        }

        $data['chapterKey'] = $cId;
        $this->load->view('Template/template', $data);
    }

    public function createMCQuestion($chapterKey) {
        if ($this->input->post('btnMC') != NULL) {
            $ques = array(
                'quesText' => $this->input->post('quesText'),
                'quesType' => 'MC',
                'chapterKey' => $chapterKey
            );
            $this->ExamModel->insertToQuestion($ques);

            $quesText = $this->input->post('quesText');
            $ssql = "select quesKey from questiondim where quesText = '" . $quesText . "'";
            $rs = $this->ExamModel->getData($ssql);
            foreach ($rs as $r) {
                $quesKey = $r['quesKey'];
            }

            for ($i = 1; $i < 5; $i++) {
                $ansFlag = 0;
                if ($this->input->post('C' . $i . '') == 'ถูก') {
                    $ansFlag = 1;
                }
                $ans = array(
                    'ansText' => $this->input->post('ansT' . $i . ''),
                    'ansFlag' => $ansFlag,
                    'quesKey' => $quesKey
                );
                $this->ExamModel->insertToAnswer($ans);
            }

            redirect('index.php/MainController/chapterDetail/' . $chapterKey, 'refresh');
            exit();
        }
        /* $data['examKey'] = $examKey;
          $data['page'] = 'createMCQuestion';
          $this->load->view('Template/template', $data); */
    }

    public function createTFQuestion($chapterKey) {
        if ($this->input->post('btnTF') != NULL) {
            $ques = array(
                'quesText' => $this->input->post('quesText'),
                'quesType' => 'TF',
                'examKey' => 0,
                'chapterKey' => $chapterKey
            );
            $this->ExamModel->insertToQuestion($ques);


            $quesText = $this->input->post('quesText');
            $ssql = "select quesKey from questiondim where quesText = '" . $quesText . "'";
            $rs = $this->ExamModel->getData($ssql);
            foreach ($rs as $r) {
                $quesKey = $r['quesKey'];
            }
            if ($this->input->post('TF1') == 'ถูก') {
                $ans1 = array(
                    'ansText' => 'TRUE',
                    'ansFlag' => 1,
                    'quesKey' => $quesKey
                );
                $ans2 = array(
                    'ansText' => 'FALSE',
                    'ansFlag' => 0,
                    'quesKey' => $quesKey
                );
            } else {
                $ans1 = array(
                    'ansText' => 'TRUE',
                    'ansFlag' => 0,
                    'quesKey' => $quesKey
                );
                $ans2 = array(
                    'ansText' => 'FALSE',
                    'ansFlag' => 1,
                    'quesKey' => $quesKey
                );
            }
            $this->ExamModel->insertToAnswer($ans1);
            $this->ExamModel->insertToAnswer($ans2);
        }
        redirect('index.php/MainController/chapterDetail/' . $chapterKey, 'refresh');
        exit();


        /* $data['$chapterKey'] = $chapterKey;
          $data['page'] = 'createTFQuestion';
          $this->load->view('Template/template', $data); */
    }

    public function createQuestion($chapterKey, $quesType) {
        if ($quesType == 'MC') {
            $data['page'] = 'createMCQuestion';
        } else {
            $data['page'] = 'createTFQuestion';
        }
        $data['chapterKey'] = $chapterKey;
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
