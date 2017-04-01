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
        echo '<span><i class="glyphicon glyphicon-send fa-fw"></i>ส่งแบบทดสอบ</span>';
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
                echo '<button type="button" class="btn btn-block" id="btn2" name="btnF" style="background:#E4FDDD; border:2px solid #7CC667">TRUE</button>';
            }
            echo "</div>";
        }

        echo "</div>";
        echo "</div>";
    }

    public function selectStudent($rKey) {

        $sql = 'select * from studentdim where rKey = ' . $rKey;

        $rs = $this->ExamModel->getData($sql);
        echo '<table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
            <thead>
                <tr>
                <th>รหัสนักศึกษา</th>
                <th>ชื่อนักศึกษา</th>
                <th>ทำไปแล้ว</th>
                <th>ทำถูก</th>
                <th>สถานะ</th>
                </tr>
               </thead>
               <tbody>';

        foreach ($rs as $row) {
            echo '<tr>';
            echo '<td>' . $row['sID'] . '</td>';
            echo '<td>' . $row['sName'] . '</td>';
            echo '<td>6</td>';
            echo '<td class="center">5</td>';
            echo '<td class="center">อยู่ระหว่างการทดสอบ</td>';
            echo '</tr>';
        }
        echo '</tbody></table>';
    }

}

?>
