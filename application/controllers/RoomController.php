<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class RoomController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function createRoom($rKey) {
        if ($this->input->post('btnCreRoom')) {
            date_default_timezone_set("Asia/Bangkok");
            $str = date("d-m-Y");
            $date = explode('-', $str);

            $timeKey = $this->ExamModel->getData('select timeKey from timedim where day = "' . $date[0] . '" and month = "' . $date[1] . '" and year = "' . $date[2] . '"');
            if (count($timeKey) == 0) {
                $this->ExamModel->QueryBySQL('insert into timedim(day,month,year) value("' . $date[0] . '","' . $date[1] . '","' . $date[2] . '")');
                $timeKey = $this->ExamModel->getData('select timeKey from timedim where day = "' . $date[0] . '" and month = "' . $date[1] . '" and year = "' . $date[2] . '"');
            }

            $arr = array(
                'nameOfExam' => $this->input->post('nameOfExam'),
                'examKey' => $this->input->post('examInRoom'),
                'time' => $this->input->post('time'),
                'timeKey' => $timeKey[0]['timeKey']
            );

            $sql = 'update roomdim set timeKey=' . $arr['timeKey'] . ',rStatus = 1,nameOfExam = "' . $arr['nameOfExam'] . '",examKey = ' . $arr['examKey'] . ',time = "' . $arr['time'] . '" where rKey = ' . $rKey;
            $this->ExamModel->QueryBySQL($sql);
            $this->ExamModel->QueryBySQL('update examinationdim set flag = 1 where examKey = '.$this->input->post('examInRoom'));
            redirect('index.php/RoomController/roomDetail/' . $rKey . '/t', 'refresh');
        }
    }

    public function changeStatus($rKey, $rStatus) {
        if ($rStatus == 0) {
            $sql = 'update roomdim set rStatus = 1 where rKey = ' . $rKey;
        } else {
            $sql = 'update roomdim set rStatus = 0,examKey = NULL,nameOfExam = "",time = "" where rKey = ' . $rKey;
            $sql2 = 'update studentdim set rKey = NULL where rKey = ' . $rKey;
            $this->ExamModel->QueryBySQL($sql2);
        }
        $this->ExamModel->QueryBySQL($sql);
        redirect('index.php/MainController', 'refresh');
        exit();
    }

    public function addStudentToRoom($rKey, $userKey) {
        $rs = $this->ExamModel->getData('select rKey from studentdim where inRoom = 1 and sKey = ' . $userKey);
        if (count($rs) == 0) {
            $sql = 'update studentdim set inRoom = 1,rKey = ' . $rKey . ' where sKey = ' . $userKey;
        } else {
            $this->ExamModel->QueryBySQL('update inRoom = 0 where rKey = ' . $rs[0]['rKey']);
            $sql = 'update studentdim set inRoom = 1,rKey = ' . $rKey . ' where sKey = ' . $userKey;
        }
        $this->ExamModel->QueryBySQL($sql);
        redirect('index.php/RoomController/joinToRoom/' . $rKey . '/' . $userKey, 'refresh');
        exit();
    }

    public function joinToRoom($rKey, $sKey) {
        $sql1 = 'select rKey,inRoom from studentdim where sKey = ' . $sKey;
        
        $data['result'] = $this->ExamModel->getData($sql1);
        $sql2 = 'select * from roomdim where rKey = ' . $rKey;
        $rs = $this->ExamModel->getData($sql2);
        $data['room'] = $rs;
        $sql3 = 'select questionKey from examinationdim where examKey = (select examKey from roomDim where rKey = ' . $rKey . ')';
        $questionKey = $this->ExamModel->getData($sql3);
       
        $sql4 = 'select tempKey from temp where sKey = ' . $sKey;
        $data['temp'] = $this->ExamModel->getData($sql4);
        //test again by noy use github in desktop
        if (count($questionKey) != 0) {
            $quesID = explode(',', $questionKey[0]['questionKey']);
            // $data['rs'] = $this->getQuestion($quesID);
            $data['rs'] = $quesID;
            $data['numOfQues'] = count($quesID);
        }
        $data['page'] = 'testDoExam';
        $this->load->view('Template/template', $data);
//        if ($result[0]['rKey'] == NULL) {
//            if ($rs[0]['rStatus'] == 1) {
//                $sql = 'update studentdim set rKey = ' . $rKey . ' where sKey = ' . $sKey;
//                $this->ExamModel->QueryBySQL($sql);
//                $data['page'] = 'testDoExam';
//                //$data['page'] = 'roomPageStudent';
//                $this->load->view('Template/template', $data);
//            } else {
//                redirect('index.php/RoomController/roomDetail/' . $sKey . '/s', 'refresh');
//                exit();
//            }
//        } else if ($result[0]['rKey'] == $rKey && $rs[0]['rStatus'] == 1) {
//            $data['page'] = 'testDoExam';
//            //$data['page'] = 'roomPageStudent';
//            $this->load->view('Template/template', $data);
//        } else {
//            redirect('index.php/RoomController/roomDetail/' . $sKey . '/s', 'refresh');
//            exit();
//        }
    }

    public function editRoom($rKey, $userKey, $userType) {
        if ($this->input->post('btnSave')) {
            $room = array(
                'rName' => $this->input->post('rName')
            );
            $this->ExamModel->updateToRoom($room, $rKey);
            redirect('index.php/RoomController/roomDetail/' . $userKey . '/' . $userType, 'refresh');
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
                $rKey = $rs[0]['rKey'];
                $examKey = $rs[0]['examKey'];
                $sql2 = "select * from examinationdim where tKey = " . $userKey;
                $data['exam'] = $this->ExamModel->getData($sql2);
                if ($examKey == NULL) {
                    $data['haveExam'] = '0';
                    $sql3 = "select * from studentdim where rKey = " . $rKey;
                    $data['rs3'] = $this->ExamModel->getData($sql3);
                    $data['rs2'] = array('0' => array('examText' => 'ยังไม่มีแบบทดสอบ'));
                } else {

                    $data['haveExam'] = '1';
                    $sql2 = "select examText from examinationdim where examKey = " . $examKey;
                    $data['rs2'] = $this->ExamModel->getData($sql2);
                    $sql3 = "select * from studentdim where rKey = " . $rKey;
                    $data['rs3'] = $this->ExamModel->getData($sql3);
                }
            }
        } else {
            $data['page'] = 'roomList';
            $sql = "select * from roomdim";
            $data['rs'] = $this->ExamModel->getData($sql);
        }
        $this->load->view('Template/template', $data);
    }

}
