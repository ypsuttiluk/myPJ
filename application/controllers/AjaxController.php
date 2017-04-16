<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class AjaxController extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function testSelect($quesKey, $rKey, $sKey) {

        $sql3 = 'select ansKey from temp where sKey = ' . $sKey . ' and quesKey = ' . $quesKey;
        $ansKey = $this->ExamModel->getData($sql3);

        $sql2 = 'select nameOfExam from roomdim where rKey = ' . $rKey;
        $nameExam = $this->ExamModel->getData($sql2);
        $sql1 = 'select quesText from questiondim where quesKey = ' . $quesKey;
        $quesText = $this->ExamModel->getData($sql1);
        $Text = $quesText[0]['quesText'];
        $sql = 'select * from answerdim where quesKey = ' . $quesKey;
        $rs = $this->ExamModel->getData($sql);
        foreach ($rs as $row) {
            $ans[] = $row['ansText'];
            $ansID[] = $row['ansKey'];
        }


        echo "<div class='panel-heading'>";
        echo '<div class="pull-right" style="cursor: pointer">';
        echo '<span onclick="btnFinish(0)"><i class="glyphicon glyphicon-send fa-fw"></i>ส่งแบบทดสอบ</span>';
        echo '</div>';
        echo $nameExam[0]['nameOfExam'];
        echo "</div>";
        echo "<div class='panel-body'>";
        echo '<div class="form-group">';


        if (count($ans) != 2) {
            echo '<h4>' . $Text . '</h4><hr>';
            echo '<div class="funkyradio">';
            for ($i = 1; $i <= count($ans); $i++) {
                echo '<div class = "funkyradio-success">';
                if (count($ansKey) != 0) {
                    if ($ansKey[0]['ansKey'] == $ansID[$i - 1]) {
                        echo '<input type = "radio" name = "radio" id = "radio' . $i . '" onclick="doMC(' . $ansID[$i - 1] . ',' . $quesKey . ')" checked> ';
                    } else {
                        echo '<input type = "radio" name = "radio" id = "radio' . $i . '" onclick="doMC(' . $ansID[$i - 1] . ',' . $quesKey . ')">';
                    }
                } else {
                    echo '<input type = "radio" name = "radio" id = "radio' . $i . '" onclick="doMC(' . $ansID[$i - 1] . ',' . $quesKey . ')">';
                }
                echo '<label for = "radio' . $i . '">' . $ans[$i - 1] . '</label>';
                echo "</div>";
            }
            echo '</div>';
//            echo '<form role="form">';
//            for ($i = 1; $i <= count($ans); $i++) {
//                echo '<div class="form-group input-group">';
//                echo '<span class="input-group-addon">#' . $i . '</span>';
//                echo '<input type="text" class="form-control" id="ansT' . $i . '" name="ansT' . $i . '" value="' . $ans[$i - 1] . '" readonly>';
//                echo '<input type="hidden" name="C' . $i . '" value="ผิด" id="C' . $i . '">';
//                echo '<span class="input-group-addon fa-fw" style="cursor: pointer" onclick="doMC(' . $i . ')" id="ans' . $i . '" name="ans' . $i . '"></span>';
//                echo "</div>";
//            }
//            echo '</form>';
        } else {
            echo '<h4>' . $Text . '</h4><hr>';
            echo '<div class="col-md-6 col-sm-6" onclick="doTF(1,' . $quesKey . ')">';
            echo '<input type="hidden" name="TF1" id="TF1" value="' . $ansID[0] . '">';
            if (count($ansKey) != 0) {
                if ($ansKey[0]['ansKey'] == $ansID[0]) {
                    echo '<button type="button" class="btn btn-block" id="btn1" name="btnT" style="background:#98FB98; border:2px solid #7CC667">TRUE</button>';
                } else {
                    echo '<button type="button" class="btn btn-block" id="btn1" name="btnT" style="background:#E4FDDD; border:2px solid #7CC667">TRUE</button>';
                }
            } else {
                echo '<button type="button" class="btn btn-block" id="btn1" name="btnT" style="background:#E4FDDD; border:2px solid #7CC667">TRUE</button>';
            }
            echo "</div>";
            echo '<div class="col-md-6 col-sm-6" onclick="doTF(2,' . $quesKey . ')">';
            echo '<input type="hidden" name="TF2" id="TF2" value="' . $ansID[1] . '">';
            if (count($ansKey) != 0) {
                if ($ansKey[0]['ansKey'] == $ansID[1]) {
                    echo '<button type="button" class="btn btn-block" id="btn2" name="btnF" style="background:#98FB98; border:2px solid #7CC667">FALSE</button>';
                } else {
                    echo '<button type="button" class="btn btn-block" id="btn2" name="btnF" style="background:#E4FDDD; border:2px solid #7CC667">FALSE</button>';
                }
            } else {
                echo '<button type="button" class="btn btn-block" id="btn2" name="btnF" style="background:#E4FDDD; border:2px solid #7CC667">FALSE</button>';
            }
            echo "</div>";
        }

        echo "</div>";

        echo "</div>";
    }

//    public function selectStudent($rKey) {
//
//        $sql = 'select * from studentdim where rKey = ' . $rKey;
//
//        $rs = $this->ExamModel->getData($sql);
//
//        echo '<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
//            <thead>
//                <tr>
//                <th>รหัสนักศึกษา</th>
//                <th>ชื่อนักศึกษา</th>
//                <th>ทำไปแล้ว</th>
//                <th>ทำถูก</th>
//                <th>สถานะ</th>
//                </tr>
//               </thead>
//               <tbody>';
//
//        foreach ($rs as $row) {
//            echo '<tr>';
//            echo '<td>' . $row['sID'] . '</td>';
//            echo '<td>' . $row['sName'] . '</td>';
//            echo '<td>6</td>';
//            echo '<td class="center">5</td>';
//            echo '<td class="center">อยู่ระหว่างการทดสอบ</td>';
//            echo '</tr>';
//        }
//        echo '</tbody></table>';
//    }

    public function testArray($rKey) {
        $sql = 'select * from studentdim where rKey = ' . $rKey;
        $rs = $this->ExamModel->getData($sql);
        $sql1 = 'select questionKey from examinationdim where examKey = (select examKey from roomdim where rKey = ' . $rKey . ')';
        $rs1 = $this->ExamModel->getData($sql1);
        $quesKey = explode(',', $rs1[0]['questionKey']);
        $text = '';
        $text.= '{"data": [';
        for ($i = 0; $i < count($rs); $i++) {
            $numOfDo = $this->ExamModel->getData('select * from temp where sKey = ' . $rs[$i]['sKey']);
            $rKeyinStudent = $this->ExamModel->getData('select inRoom from studentdim where sKey =' . $rs[$i]['sKey']);
            $text.= '[
            "' . $rs[$i]['sID'] . '",
            "' . $rs[$i]['sName'] . '",
            "' . count($quesKey) . '",';
            if ($rKeyinStudent[0]['inRoom'] == 0) {
                $text.= '"' . count($numOfDo) . '",
                "ทดสอบเสร็จสิ้น"';
            } else {
                $text.= '"' . count($numOfDo) . '",
                "อยู่ระหว่างการทดสอบ"';
            }
            $text .=']';
            if ($i != count($rs) - 1) {
                $text.=',';
            }
        }
        $text.= ']}';
        echo $text;
    }

    public function getResult($tKey) {
        $sql = 'select * from resultfact where tKey = ' . $tKey . ' group by nameOfExam';
        $rs = $this->ExamModel->getData($sql);

//        $sql1 = 'select questionKey from examinationdim where examKey = (select examKey from roomdim where rKey = ' . $rKey . ')';
//        $rs1 = $this->ExamModel->getData($sql1);
//        $quesKey = explode(',', $rs1[0]['questionKey']);
        $text = '';
        $text.= '{"data": [';
        for ($i = 0; $i < count($rs); $i++) {
            $date = $this->ExamModel->getData('select * from timedim where timeKey = ' . $rs[$i]['timeKey']);
//            $numOfDo = $this->ExamModel->getData('select * from temp where sKey = ' . $rs[$i]['sKey']);
//            $rKeyinStudent = $this->ExamModel->getData('select inRoom from studentdim where sKey =' . $rs[$i]['sKey']);
            $text.= '[
              "' . $date[0]['day'] . '-' . $date[0]['month'] . '-' . $date[0]['year'] . '",
              "' . $rs[$i]['nameOfExam'] . '"';

//            "' . $rs[$i]['sKey'] . '",
//            "' . $rs[$i]['examKey'] . '",
//            "' . $rs[$i]['tKey'] . '",
//            "' . $rs[$i]['sumOfScore'].'"';
            $text .=']';
            if ($i != count($rs) - 1) {
                $text.=',';
            }
        }
        $text.= ']}';
        echo $text;
    }

    public function getUser($flag) {
        if ($flag != '0') {
            if ($flag == 't') {
                $sql = 'select * from teacherdim';
                $data['rs'] = $this->ExamModel->getData($sql);
                $data['typeUser'] = 't';
            }
            if($flag == 's'){
                $sql = 'select * from studentdim';
                $data['rs'] = $this->ExamModel->getData($sql);
                $data['typeUser'] = 's';
            }
        } else {
            if ($this->input->post('btnGetUser')) {
                $userType = $this->input->post('userType');

                if ($userType == 't') {
                    $sql = 'select * from teacherdim';
                } else if ($userType == 's') {
                    $sql = 'select * from studentdim';
                }
                $data['rs'] = $this->ExamModel->getData($sql);

                $data['typeUser'] = $userType;
            }
        }
        $data['page'] = 'adminPage';
        $this->load->view('Template/template', $data);
    }

    public function getResultDetail($tKey, $date) {

        //$string = $this->examModel->splitAndParseToText($nameOfExam);
//        $sss = explode('%', $nameOfExam);
//        $str ='';
//        for($i=0;$i<count($sss);$i++){
//            $str.=$sss[$i];
//        }
//      
        # valid binary string, split, explode and other magic
        # prepare string for conversion
//        $chars = explode("\n", chunk_split(str_replace("\n", '', $nameOfExam), 8));
//        $char_count = count($chars);
//        $string = chr(bindec($chars[0]));
        # converting the characters one by one
//        for ($k = 0; $k < count($chars); $i++) {
//            $string .= chr(bindec($chars[1]));
//        }
        # let's return the result

        $myArray = $_REQUEST['name'];
        $nameOfExam = '';
        for ($j = 0; $j < count($myArray); $j++) {
            $nameOfExam = $nameOfExam . $myArray[$j];
        }

        $sql = "select * from resultfact where tKey = " . $tKey . " and nameOfExam = '" . $nameOfExam . "'";
        $rs = $this->ExamModel->getData($sql);
//        $sql1 = 'select questionKey from examinationdim where examKey = (select examKey from roomdim where rKey = ' . $rKey . ')';
//        $rs1 = $this->ExamModel->getData($sql1);
//        $quesKey = explode(',', $rs1[0]['questionKey']);
        $text = '';
        $text.= '{"data": [';
        for ($i = 0; $i < count($rs); $i++) {
            $sData = $this->ExamModel->getData('select sID,sName from studentdim where sKey = ' . $rs[$i]['sKey']);
//            $numOfDo = $this->ExamModel->getData('select * from temp where sKey = ' . $rs[$i]['sKey']);
//            $rKeyinStudent = $this->ExamModel->getData('select inRoom from studentdim where sKey =' . $rs[$i]['sKey']);
            $text.= '[
              "' . $sData[0]['sID'] . '",
              "' . $sData[0]['sName'] . '",
              "' . $nameOfExam . '",
              "' . $rs[$i]['sumOfScore'] . '",
              "' . $date . '"';
            $text .=']';
            if ($i != count($rs) - 1) {
                $text.=',';
            }
        }
        $text.= ']}';
        echo $text;
    }

}

?>
