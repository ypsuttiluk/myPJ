<?php
if (isset($this->session->userdata['logged_in'])) {
    if ($this->session->userdata['logged_in']['userType'] == 't') {
        $userType = $this->session->userdata['logged_in']['userType'];
        $userKey = $this->session->userdata['logged_in']['userKey'];
        $userID = $this->session->userdata['logged_in']['userID'];
        $userName = $this->session->userdata['logged_in']['userName'];
        $userPhone = $this->session->userdata['logged_in']['userPhone'];
        $userRoom = $this->session->userdata['logged_in']['userRoom'];
        $userEmail = $this->session->userdata['logged_in']['userEmail'];
        $userPic = $this->session->userdata['logged_in']['userPic'];
    }
    if ($this->session->userdata['logged_in']['userType'] == 's') {
        $userType = $this->session->userdata['logged_in']['userType'];
        $userKey = $this->session->userdata['logged_in']['userKey'];
        $userID = $this->session->userdata['logged_in']['userID'];
        $studentID = $this->session->userdata['logged_in']['studentID'];
        $userName = $this->session->userdata['logged_in']['userName'];
        $userPhone = $this->session->userdata['logged_in']['userPhone'];
        $userYear = $this->session->userdata['logged_in']['userYear'];
        $userDegree = $this->session->userdata['logged_in']['userDegree'];
        $userEmail = $this->session->userdata['logged_in']['userEmail'];
        $userPic = $this->session->userdata['logged_in']['userPic'];
    }
    if ($this->session->userdata['logged_in']['userType'] == 'a') {
        $userType = $this->session->userdata['logged_in']['userType'];
        $userName = $this->session->userdata['logged_in']['userName'];
        $userPic = $this->session->userdata['logged_in']['userPic'];
    }
} else {

    redirect('index.php/MainController/login', 'refresh');
    exit();
}
?>
<br>
<div class="container">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-success">
                    <div class="panel-heading">

                        <i class="glyphicon glyphicon-user fa-fw"></i> <?php echo "Hello <b id='welcome'><i>" . $userName . "</i> !</b>"; ?>
                    </div>
                    <div class="panel-body"> 
                        <?php
                        if ($userType == 't') {
                            //echo '<h3><b>ผู้ใช้งาน : อาจารย์</b></h3>';
                            echo '<hr>';
                            echo "<table border='0' cellspacing='0' cellpadding='0'>";
                                echo "<tbody>";
                                    echo "<tr>";
                                        echo '<td rowspan="5"><img src="'.base_url().'asset/uploads/'.$userPic.'" style="width:155px;height:191px"></td>';
                                        echo '<td colspan="4">&nbsp&nbsp&nbsp&nbsp <b>'.$userName.'</b></td>';
                                    echo '</tr>';
                                    
                                    echo "<tr>";
                                        echo '<td>&nbsp&nbsp&nbsp&nbsp <b>เบอร์โทรศัพท์</b> '.$userPhone.'</td>';
                                    echo '</tr>';
                                    
                                    echo '<tr>';
                                        echo '<td>&nbsp&nbsp&nbsp&nbsp <b>ห้องพัก</b> '.$userRoom.'</td>';
                                    echo '</tr>';
                                    
                                    echo "<tr>";
                                        echo '<td>&nbsp&nbsp&nbsp&nbsp <b>Email</b> '.$userEmail.'</td>';
                                    echo '</tr>';
                                echo "</tbody>";
                            echo "</table>";
                        }
                        if ($userType == 's') {
                            //echo '<h3><b>ผู้ใช้งาน : นักศึกษา</b></h3>';
                            echo '<hr>';
                            echo "<table border='0' cellspacing='0' cellpadding='0'>";
                                echo "<tbody>";
                                if($userPic != NULL){
                                    echo "<tr>";
                                        echo '<td rowspan="5"><img src="'.base_url().'asset/uploads/'.$userPic.'" style="width:155px;height:191px"></td>';
                                        echo '<td colspan="4">&nbsp&nbsp&nbsp&nbsp <b>'.$userName.'</b></td>';
                                    echo '</tr>';
                                }else{
                                    echo "<tr>";
                                        echo '<td rowspan="5"><img src="'.base_url().'asset/uploads/user.png" style="width:155px;height:191px"></td>';
                                        echo '<td colspan="4">&nbsp&nbsp&nbsp&nbsp <b>'.$userName.'</b></td>';
                                    echo '</tr>'; 
                                }
                                    echo "<tr>";
                                        echo '<td>&nbsp&nbsp&nbsp&nbsp <b>เบอร์โทรศัพท์</b> '.$userPhone.'</td>';
                                    echo '</tr>';
                                    
                                    echo "<tr>";
                                        echo '<td>&nbsp&nbsp&nbsp&nbsp <b>ชั้นปีที่</b> '.$userYear.'</td>';
                                    echo '</tr>';
                                    
                                    echo '<tr>';
                                        echo '<td>&nbsp&nbsp&nbsp&nbsp <b>ระดับการศึกษา</b> '.$userDegree.'</td>';
                                    echo '</tr>';
                                    
                                    echo "<tr>";
                                        echo '<td>&nbsp&nbsp&nbsp&nbsp <b>Email</b> '.$userEmail.'</td>';
                                    echo '</tr>';
                                echo "</tbody>";
                            echo "</table>";
                        }
                        if ($userType == 'a') {
                            echo "<h3>ผู้ดูแลระบบ</h3>";
                            echo "<hr>";
                            echo "<b>ชื่อ</b> " . $userName;
                          
                        }
                        ?>

                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>

</div>
</div>