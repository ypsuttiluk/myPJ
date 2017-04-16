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
<?php if (isset($this->session->userdata['logged_in']) && $userType == 't') { ?>
    <?php echo form_open("index.php/QuesController/createTFQuestion/" . $chapterKey); ?>
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
                                <button type="submit" name='btnTF' value="btnTF" style="background: #dff0d8;border: none"><i class="glyphicon glyphicon-floppy-save fa-fw"></i>บันทึกคำถาม</button>
                            </div>
                            <i class="fa fa-check-circle"></i><i class="fa fa-times-circle fa-fw"></i> TRUE/FALSE : CREATE
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body"> 
                            <input class="form-control" name='quesText' id="examText" placeholder="คำถาม">
                            <br>
                            <h5>คำตอบ</h5>

                            <div class="form-group">
                                <div class="col-md-6 col-sm-6" onclick="testTF(1)">
                                    <input type="hidden" name="TF1" id='TF1' value="ถูก">
                                    <button type="button" class="btn btn-block" id="btn1" name="btnT" style="background:#98FB98; border:2px solid #7CC667">TRUE</button>
                                </div>
                                <div class="col-md-6 col-sm-6" onclick="testTF(2)">
                                    <input type="hidden" name="TF2" id='TF2' value="ผิด">
                                    <button type="button" class="btn btn-block" id="btn2" name="btnF" style="background:#E4FDDD; border:2px solid #7CC667">FALSE</button>
                                </div>
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
    <?php echo form_close(); ?>
<?php } ?>
</div>