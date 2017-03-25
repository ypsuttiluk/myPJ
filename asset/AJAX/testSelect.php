<?php

$quesKey = $_POST['id'];

mysql_connect('localhost', 'root', '');
mysql_select_db('websiteforexam');
mysql_set_charset('utf8');
$sql1 = 'select quesText from questiondim where quesKey = ' . $quesKey;
$quesText = mysql_query($sql1);
while ($rs = mysql_fetch_array($quesText)) {
    $Text = $rs['quesText'];
}

$sql = 'select * from answerdim where quesKey = ' . $quesKey;
if ($rs = mysql_query($sql)) {
    while ($row = mysql_fetch_array($rs)) {
        $ques[] = $row['ansText'];
    }
} else {
    echo mysql_error();
}

echo "<div class='panel-heading'>";
echo $Text;
echo "</div>";
echo "<div class='panel-body'>";
echo '<div class="form-group">';


if (count($ques) == 4) {
    echo '<form role="form">';
    for ($i = 1; $i <= count($ques); $i++) {
        echo '<div class="form-group input-group">';
        echo '<span class="input-group-addon">#' . $i . '</span>';
        echo '<input type="text" class="form-control" id="ansT' . $i . '" name="ansT' . $i . '" value="' . $ques[$i - 1] . '" readonly>';
        echo '<input type="hidden" name="C' . $i . '" value="ผิด" id="C' . $i . '">';
        echo '<span class="input-group-addon fa-fw" style="cursor: pointer" onclick="testMC(' . $i . ')" id="ans' . $i . '" name="ans' . $i . '">ผิด</span>';
        echo "</div>";
    }
    echo '</form>';
} else {

    echo '<div class="col-md-6 col-sm-6" onclick="testTF(1)">';
    echo '<input type="hidden" name="TF1" id="TF1" value="">';
    echo '<button type="button" class="btn btn-block" id="btn1" name="btnT" style="background:#E4FDDD; border:2px solid #7CC667">TRUE</button>';
    echo "</div>";
    echo '<div class="col-md-6 col-sm-6" onclick="testTF(2)">';
    echo '<input type="hidden" name="TF2" id="TF2" value="">';
    echo '<button type="button" class="btn btn-block" id="btn2" name="btnT" style="background:#E4FDDD; border:2px solid #7CC667">FALSE</button>';
    echo "</div>";
}

echo "</div>";
echo "</div>";

