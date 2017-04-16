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
    <?php //echo form_open("index.php/MainController/editTFQuestion/" . $chapterKey . '/' . $quesKey . '/' . $rs['0']['ansKey'] . '/' . $rs['1']['ansKey']);                    ?>
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
                            <i class="fa fa-check-circle"></i><i class="fa fa-times-circle fa-fw"></i> TRUE/FALSE
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <h5>คำถาม</h5>
                            <input class="form-control" value="<?php echo $quesText; ?>" readonly>
                            <h5>คำตอบ</h5>
                            <div class="form-group">
                                <div class="col-md-6 col-sm-6">
                                    <?php if ($rs['0']['ansFlag'] == 1) { ?>
                                        <button type="button" class="btn btn-block" disabled style="background:#98FB98; border:2px solid #7CC667">TRUE</button>
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-block" disabled style="background:#E4FDDD; border:2px solid #7CC667">TRUE</button>
                                    <?php } ?>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <?php if ($rs['0']['ansFlag'] == 1) { ?>
                                        <button type="button" class="btn btn-block" disabled style="background:#E4FDDD; border:2px solid #7CC667">FALSE</button>
                                    <?php } else { ?>
                                        <button type="button" class="btn btn-block" disabled style="background:#98FB98; border:2px solid #7CC667">FALSE</button>
                                    <?php } ?>
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
    <?php //echo form_close(); ?>
<?php } ?>
</div>