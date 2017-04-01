<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TempController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function whileDoExam($qKey, $userKey, $ansKey, $rKey) {

        $sql = 'select tempKey,ansKey from temp where sKey = ' . $userKey . ' and quesKey = ' . $qKey;
        $rs = $this->ExamModel->getData($sql);
        if (count($rs) != 0) {
            $sql1 = 'update temp set ansKey = ' . $ansKey . ' where sKey = ' . $userKey . ' and quesKey = ' . $qKey;
        } else {
            $sql1 = 'insert into temp(sKey,quesKey,ansKey) value (' . $userKey . ',' . $qKey . ',' . $ansKey . ')';
        }

        $this->ExamModel->QueryBySQL($sql1);

    }

}

?>
