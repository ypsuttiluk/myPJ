<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ExamModel
 *
 * @author YEDPED_STL
 */
class ExamModel extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    /* public function testGet() {
      $rs = $this->db->get_where('answerdim', array('quesKey' => 1));
      return $rs;
      } */

    public function getNumrow($sql) {
        $rs = $this->db->query($sql);

        return $rs->num_rows();
    }

    public function QueryBySQL($sql) {
        $this->db->query($sql);
    }

    public function updateToRoom($room, $rKey) {
        $this->db->where('rKey', $rKey);
        $this->db->update('roomdim', $room);
    }

    public function questionInExam($quesKey) {
        $sql = 'select quesKey,quesText,chapterKey from questiondim where quesKey = ' . $quesKey;
        $rs = $this->db->query($sql);
        return $rs->result_array();
    }

    public function getData($sql) {
        $rs = $this->db->query($sql);
        return $rs->result_array();
    }

    public function insertToChapter($chapter) {
        $this->db->insert('chapterdim', $chapter);
    }

    public function insertToExam($exam) {
        $this->db->insert('examinationdim', $exam);
    }

    public function insertToQuestion($ques) {
        $this->db->insert('questiondim', $ques);
    }

    public function insertToAnswer($ans) {
        $this->db->insert('answerdim', $ans);
    }

    public function updateToQuestion($ques, $qID) {
        $this->db->where('quesKey', $qID);
        $this->db->update('questiondim', $ques);
    }

    public function updateToAnswer($ans, $aID) {
        $this->db->where('ansKey', $aID);
        $this->db->update('answerdim', $ans);
    }

    public function updateToChapter($chapter, $cID) {
        $this->db->where('chapterKey', $cID);
        $this->db->update('chapterdim', $chapter);
    }

    public function updateToExam($exam, $examKey) {
        $this->db->where('examKey', $examKey);
        $this->db->update('examinationdim', $exam);
    }

    public function incrementalHash() {
        $Caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMOPQRSTUVXWYZ0123456789';
        $QuantidadeCaracteres = strlen($Caracteres);
        $QuantidadeCaracteres--;

        $Hash = NULL;
        for ($x = 1; $x <= 5; $x++) {
            $Posicao = rand(0, $QuantidadeCaracteres);
            $Hash .= substr($Caracteres, $Posicao, 1);
        }

        return $Hash;
    }

//put your code here
}
