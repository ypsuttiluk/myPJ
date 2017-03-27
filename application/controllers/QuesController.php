<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {

    public function __construct() {
        parent::__construct();
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
            redirect('index.php/ChapterController/chapterDetail/' . $chapterKey);
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


            redirect('index.php/ChapterController/chapterDetail/' . $chapterKey);
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

            redirect('index.php/ChapterController/chapterDetail/' . $chapterKey, 'refresh');
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
        redirect('index.php/ChapterController/chapterDetail/' . $chapterKey, 'refresh');
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

}
