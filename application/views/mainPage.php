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
                            echo "Your UserKey is " . $userKey;
                            echo "<br/>";
                            echo "Your ID is " . $userID;
                            echo "<br/>";
                            echo "Your Username is " . $userName;
                            echo "<br/>";
                            echo "Your Phone is " . $userPhone;
                            echo "<br/>";
                            echo "Your Room is " . $userRoom;
                            echo "<br/>";
                        }
                        if ($userType == 's') {
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