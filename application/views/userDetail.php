<?php
if (isset($this->session->userdata['logged_in'])) {
    if ($this->session->userdata['logged_in']['userType'] == 't') {
        $userType = $this->session->userdata['logged_in']['userType'];
        $userKey = $this->session->userdata['logged_in']['userKey'];
        $userID = $this->session->userdata['logged_in']['userID'];
        $userName = $this->session->userdata['logged_in']['userName'];
        $userPhone = $this->session->userdata['logged_in']['userPhone'];
        $userRoom = $this->session->userdata['logged_in']['userRoom'];
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
    }
    if ($this->session->userdata['logged_in']['userType'] == 'a') {
        $userType = $this->session->userdata['logged_in']['userType'];
        $userName = $this->session->userdata['logged_in']['userName'];
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
                        <?php if ($userType == 't') { ?>
                            <div class="form-group">
                                <label>รูป</label><input type="file">
                            </div>
                            <div class="form-group">
                                <label>รหัสอาจารย์</label><input type="text" readonly class="form-control" value="<?php echo $userID; ?>">
                            </div>
                            <div class="form-group">
                                <label>ชื่อ-นามสกุล</label><input type="text" class="form-control" value="<?php echo $userName; ?>">
                            </div>
                            <div class="form-group">
                                <label>เบอร์โทรศัพท์</label><input type="text" class="form-control" value="<?php echo $userPhone; ?>">
                            </div>
                            <div class="form-group">
                                <label>ห้องพัก</label><input type="text" class="form-control" value="<?php echo $userRoom; ?>">
                            </div>
                            <?php
                        }
                        if ($userType == 's') {
                            echo "<h3>นักศึกษา</h3>";
                            echo "<hr>";
                            echo "Your UserKey is " . $userKey;
                            echo "<br/>";
                            echo "Your ID is " . $userID;
                            echo "<br/>";
                            echo "Your StudentID is " . $studentID;
                            echo "<br/>";
                            echo "Your Username is " . $userName;
                            echo "<br/>";
                            echo "Your Phone is " . $userPhone;
                            echo "<br/>";
                            echo "Your Year is " . $userYear;
                            echo "<br/>";
                            echo "Your Degree is " . $userDegree;
                            echo "<br/>";
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