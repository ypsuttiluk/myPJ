<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TempController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function finishDoExam($userKey, $userType, $rKey) {
        if ($userType == 's') {


            $rs = $this->ExamModel->getData('select * from temp where sKey = ' . $userKey);
            $sumOfScore = 0;
            foreach ($rs as $r) {
                if ($r['doAnsFlag'] == '1') {
                    $sumOfScore+=1;
                }
            }
            $rs1 = $this->ExamModel->getData('select * from roomdim where tKey = ' . $rKey);
            $sql = 'insert into resultfact(timeKey,sKey,examKey,sumOfScore) value(' . $rs1[0]["timeKey"] . ',' . $userKey . ',' . $rs1[0]["examKey"] . ',' . $sumOfScore . ')';
            $this->ExamModel->QueryBySQL($sql);
            $this->ExamModel->QueryBySQL('update temp set moveToResult = 1 where sKey = ' . $userKey);
            $this->ExamModel->QueryBySQL('update studentdim set inRoom = 0 where sKey = ' . $userKey);
        }if ($userType == 't') {

            $numOfStudent = $this->ExamModel->getData('select sKey,moveToResult from temp where tKey = ' . $rKey . ' group by sKey');

            for ($i = 0; $i < count($numOfStudent); $i++) {
                $rs = $this->ExamModel->getData('select * from temp where sKey = ' . $numOfStudent[$i]['sKey']);

                $sumOfScore = 0;
                foreach ($rs as $r) {
                    if ($r['doAnsFlag'] == '1') {
                        $sumOfScore+=1;
                    }
                }
                $rs1 = $this->ExamModel->getData('select * from roomdim where tKey = ' . $rKey);
                $sql = '';
                if ($numOfStudent[$i]['moveToResult'] == 0) {
                    $sql = 'insert into resultfact(timeKey,sKey,examKey,sumOfScore) value(' . $rs1[0]["timeKey"] . ',' . $userKey . ',' . $rs1[0]["examKey"] . ',' . $sumOfScore . ')';
                    $this->ExamModel->QueryBySQL($sql);
                }
            }

            $this->ExamModel->QueryBySQL('delete from temp where tKey = ' . $rKey);
            $this->ExamModel->QueryBySQL('update roomdim set rStatus = 0,examKey = NULL,nameOfExam = "", time = 0,timeKey = NULL where rKey = ' . $rKey);
            $this->ExamModel->QueryBySQL('update studentdim set inRoom = 0,rKey = NULL where rKey = ' . $rKey);
        }
    }

    public function whileDoExam($qKey, $userKey, $ansKey, $rKey) {
        $flag = $this->ExamModel->getData('select ansFlag from answerdim where ansKey = ' . $ansKey);
        $doAnsFlag = '';
        if ($flag[0]['ansFlag'] == '1') {
            $doAnsFlag = '1';
        } else {
            $doAnsFlag = '0';
        }
        $sql = 'select tempKey,ansKey from temp where sKey = ' . $userKey . ' and quesKey = ' . $qKey;
        $rs = $this->ExamModel->getData($sql);
        if (count($rs) != 0) {
            $sql1 = 'update temp set doAnsFlag = "' . $doAnsFlag . '", ansKey = ' . $ansKey . ' where sKey = ' . $userKey . ' and quesKey = ' . $qKey;
        } else {
            $sql1 = 'insert into temp(sKey,quesKey,ansKey,tKey,doAnsFlag) value (' . $userKey . ',' . $qKey . ',' . $ansKey . ',' . $rKey . ',' . $doAnsFlag . ')';
        }

        $this->ExamModel->QueryBySQL($sql1);
    }

}

?>
