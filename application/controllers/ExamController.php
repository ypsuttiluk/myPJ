<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ExamController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function createExam($userKey) {
        if ($this->input->post('btnSave')) {
            $chapter = array();
            if ($this->input->post('chapter')) {
                $chapter = $this->input->post('chapter');
            }
            $numOfQuestion = $this->input->post('numberOfQues');

            $text = '';
            $union = 'UNION';
            for ($i = 0; $i < count($numOfQuestion); $i++) {
                $text = $text . '(select * from questiondim where chapterKey = ' . $chapter[$i] . ' order by RAND() limit ' . $numOfQuestion[$i] . ')';
                if($i!=  count($numOfQuestion)-1){
                    $text = $text.$union;
                }
            }
            
            $sql = $text;
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
            redirect('index.php/ExamController/manageExam/' . $userKey, 'refresh');
            exit();
        }
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
            redirect('index.php/ExamController/examDetail/' . $examKey, 'refresh');
            exit();
        }
    }

}
