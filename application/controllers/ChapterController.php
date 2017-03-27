<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ChapterController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function editChapter($chapterKey) {
        if ($this->input->post('btnSave')) {
            $chapter = array(
                'chapterName' => $this->input->post('chapterName')
            );
            $this->ExamModel->updateToChapter($chapter, $chapterKey);
            redirect('index.php/ChapterController/chapterDetail/' . $chapterKey, 'refresh');
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
            redirect('index.php/ChapterController/manageChapter/' . $tKey, 'refresh');
            exit();
        }
    }

    public function manageChapter($tKey) {
        $data['page'] = 'manageChapter';
        $sql = "select * from chapterdim where tKey = " . $tKey;
        $data['rs'] = $this->ExamModel->getData($sql);
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

}
