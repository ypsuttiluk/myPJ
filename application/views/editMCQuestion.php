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
    <?php echo form_open("index.php/QuesController/editMCQuestion/" . $chapterKey . '/' . $quesKey . '/' . $rs['0']['ansKey'] . '/' . $rs['1']['ansKey'] . '/' . $rs['2']['ansKey'] . '/' . $rs['3']['ansKey']); ?>
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
                                <button type="submit" name='btnMC' value="btnMC" style="background: #dff0d8;border: none"><i class="fa fa-pencil-square fa-fw"></i>แก้ไขคำถาม</button>
                            </div>
                            <i class="fa fa-list-ol fa-fw"></i> MULTIPLE CHOICE : EDIT
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body"> 
                            <input class="form-control" name='quesText' placeholder="คำถาม" value="<?php echo $quesText; ?>">
                            <br>
                            <h5>คำตอบ</h5>

                            <div class="form-group">
                                <form role="form">
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">#1</span>
                                        <?php if ($rs['0']['ansFlag'] == 0) { ?>
                                            <input type="text" class="form-control" id="ansT1" name="ansT1" value="<?php echo $rs['0']['ansText']; ?>">
                                            <input type="hidden" name="C1" value="ผิด" id='C1'>
                                            <span class="input-group-addon fa-fw" style="cursor: pointer" onclick="testMC(1)" id="ans1" name="ans1">ผิด</span>
                                        <?php } else { ?>
                                            <input type="text" class="form-control" id="ansT1" name="ansT1" value="<?php echo $rs['0']['ansText']; ?>" style="background-color: #98FB98">
                                            <input type="hidden" name="C1" value="ถูก" id='C1'>
                                            <span class="input-group-addon fa-fw" style="cursor: pointer" onclick="testMC(1)" id="ans1" name="ans1">ถูก</span>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">#2</span>  
                                        <?php if ($rs['1']['ansFlag'] == 0) { ?>
                                            <input type="text" class="form-control" id="ansT2" name="ansT2" value="<?php echo $rs['1']['ansText']; ?>">
                                            <input type="hidden" name="C2" value="ผิด" id='C2'>
                                            <span class="input-group-addon fa-fw" style="cursor: pointer" onclick="testMC(2)" id="ans2" name="ans2">ผิด</span>
                                        <?php } else { ?>
                                            <input type="text" class="form-control" id="ansT2" name="ansT2" value="<?php echo $rs['1']['ansText']; ?>" style="background-color: #98FB98">
                                            <input type="hidden" name="C2" value="ถูก" id='C2'>
                                            <span class="input-group-addon fa-fw" style="cursor: pointer" onclick="testMC(2)" id="ans2" name="ans2">ถูก</span>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">#3</span>
                                        <?php if ($rs['2']['ansFlag'] == 0) { ?>
                                            <input type="text" class="form-control" id="ansT3" name="ansT3" value="<?php echo $rs['2']['ansText']; ?>">
                                            <input type="hidden" name="C3" value="ผิด" id='C3'>
                                            <span class="input-group-addon fa-fw" style="cursor: pointer" onclick="testMC(3)" id="ans3" name="ans3">ผิด</span>
                                        <?php } else { ?>
                                            <input type="text" class="form-control" id="ansT3" name="ansT3" value="<?php echo $rs['2']['ansText']; ?>" style="background-color: #98FB98">
                                            <input type="hidden" name="C3" value="ถูก" id='C3'>
                                            <span class="input-group-addon fa-fw" style="cursor: pointer" onclick="testMC(3)" id="ans3" name="ans3">ถูก</span>
                                        <?php } ?>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">#4</span>
                                        <?php if ($rs['3']['ansFlag'] == 0) { ?>
                                            <input type="text" class="form-control" id="ansT4" name="ansT4" value="<?php echo $rs['3']['ansText']; ?>">
                                            <input type="hidden" name="C4" value="ผิด" id='C4'>
                                            <span class="input-group-addon fa-fw" style="cursor: pointer" onclick="testMC(4)" id="ans4" name="ans4">ผิด</span>
                                        <?php } else { ?>
                                            <input type="text" class="form-control" id="ansT4" name="ansT4" value="<?php echo $rs['3']['ansText']; ?>" style="background-color: #98FB98">
                                            <input type="hidden" name="C4" value="ถูก" id='C4'>
                                            <span class="input-group-addon fa-fw" style="cursor: pointer" onclick="testMC(4)" id="ans4" name="ans4">ถูก</span>
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
    <?php echo form_close(); ?>
<?php } ?>
</div>