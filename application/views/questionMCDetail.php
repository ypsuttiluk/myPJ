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
<?php if (isset($this->session->userdata['logged_in']) && $userType == 't') { ?>
    <?php //echo form_open("index.php/MainController/editMCQuestion/" . $chapterKey . '/' . $quesKey . '/' . $rs['0']['ansKey'] . '/' . $rs['1']['ansKey'] . '/' . $rs['2']['ansKey'] . '/' . $rs['3']['ansKey']);         ?>
    <!-- Page Content -->
    <br>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="pull-right" style="cursor: pointer">
                                <span onclick="goBack()"><i class="glyphicon glyphicon-circle-arrow-left fa-fw"></i>กลับ</span>  
                            </div>
                            <i class="fa fa-list-ol fa-fw"></i> MULTIPLE CHOICE
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <h5>คำถาม</h5>
                            <input class="form-control" value="<?php echo $quesText; ?>" readonly>
                            <h5>คำตอบ</h5>
                            <div class="form-group">
                                <form role="form">
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">#1</span>
                                        <?php if ($rs['0']['ansFlag'] == 0) { ?>
                                            <input type="text" class="form-control" value="<?php echo $rs['0']['ansText']; ?>" readonly>
                                            <span class="input-group-addon fa-fw">ผิด</span>
                                        <?php } else { ?>
                                            <input type="text" class="form-control" value="<?php echo $rs['0']['ansText']; ?>" style="background-color: #98FB98" readonly>
                                            <span class="input-group-addon fa-fw">ถูก</span>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">#2</span>  
                                        <?php if ($rs['1']['ansFlag'] == 0) { ?>
                                            <input type="text" class="form-control" value="<?php echo $rs['1']['ansText']; ?>" readonly>
                                            <span class="input-group-addon fa-fw">ผิด</span>
                                        <?php } else { ?>
                                            <input type="text" class="form-control" value="<?php echo $rs['1']['ansText']; ?>" style="background-color: #98FB98" readonly>
                                            <span class="input-group-addon fa-fw">ถูก</span>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">#3</span>
                                        <?php if ($rs['2']['ansFlag'] == 0) { ?>
                                            <input type="text" class="form-control" value="<?php echo $rs['2']['ansText']; ?>" readonly>
                                            <span class="input-group-addon fa-fw">ผิด</span>
                                        <?php } else { ?>
                                            <input type="text" class="form-control" value="<?php echo $rs['2']['ansText']; ?>" style="background-color: #98FB98" readonly>
                                            <span class="input-group-addon fa-fw">ถูก</span>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">#4</span>
                                        <?php if ($rs['3']['ansFlag'] == 0) { ?>
                                            <input type="text" class="form-control" value="<?php echo $rs['3']['ansText']; ?>" readonly>
                                            <span class="input-group-addon fa-fw">ผิด</span>
                                        <?php } else { ?>
                                            <input type="text" class="form-control" value="<?php echo $rs['3']['ansText']; ?>" style="background-color: #98FB98" readonly>
                                            <span class="input-group-addon fa-fw">ถูก</span>
                                        <?php } ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- /#page-wrapper -->
            </div>
        </div>
    </div>
    <?php //echo form_close(); ?>
<?php } ?>
</div>