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
    <?php //echo form_open("index.php/MainController/editExam/" . $examKey);                                                                          ?>
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
                                <span>
                                    <button class="bg-success" data-toggle="modal" data-target="#myModal2" style="border: 0"><i class="fa fa-pencil-square fa-fw"></i>แก้ไขชื่อแบบทดสอบ</button>
                                </span>
                                <?php if ($rs[0]['flag'] == 0) { ?>
                                    <span>
                                        <a style="color: #DA3D0F" href="<?php echo base_url();?>index.php/ExamController/deleteExam/<?php echo $rs[0]['examKey'];?>/<?php echo $userKey;?>" onclick="return confirmRemove()"><button class="bg-success" style="border: 0"><i class="glyphicon glyphicon-remove fa-fw"></i>ลบแบบทดสอบ</button></a>
                                    </span>
                                <?php } ?>
                            </div>
                            <!-- Modal2 -->
                            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">แก้ไขชื่อแบบทดสอบ</h4>
                                        </div>
                                        <?php echo form_open("index.php/ExamController/editExam/" . $examKey); ?>
                                        <div class="modal-body">
                                            <input class="form-control" type="text" name="examText" placeholder="ชื่อแบบทดสอบ" value="<?php echo $examText; ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                            <!--<a href="<?php //echo base_url();                                       ?>index.php/MainController/createChapter">-->
                                            <button type="submit" class="btn btn-primary" name="btnSave" value="btnSave">แก้ไขแบบทดสอบ</button><!--</a>-->
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                    <!-- /.modal2-content -->
                                </div>
                                <!-- /.modal2-dialog -->
                            </div>
                            <!-- /.modal2 -->
                            <?php
                            foreach ($rs as $r) {
                                $question = explode(",", $r['questionKey']);
                            }
                            ?>
                            <i class="fa fa-file-text fa-fw"></i> ชื่อแบบทดสอบ :  <?php echo $examText; ?> (จำนวนทั้งหมด : <?php echo count($question); ?> ข้อ)
                        </div>


                        <!-- /.panel-heading -->
                        <div class="panel-body"> 
                            <div class="list-group">
                                <!-- <a href="<?php //echo base_url();                             ?>index.php/MainController/editQuestion/<?php //echo $chapterKey;                             ?>/<?php // echo $r['quesKey'];                             ?>" class="list-group-item">-->
                                <?php
                                $i = 1;
                                foreach ($question as $result) {
                                    $questionText = $this->ExamModel->questionInExam($result);
                                    $sql = 'select chapterName from chapterdim where chapterKey =' . $questionText[0]['chapterKey'];
                                    $chapterName = $this->ExamModel->getData($sql);
                                    ?>
                                    <a href="<?php echo base_url(); ?>index.php/QuesController/editQuestion/NULL/<?php echo $questionText[0]['quesKey']; ?>/1" class="list-group-item">
                                        <i class="glyphicon glyphicon-question-sign fa-fw"></i>ข้อที่ <?php echo $i; ?> : <?php echo $questionText[0]['quesText']; ?>
                                        <span class="pull-right text-muted small"><em><?php echo $chapterName[0]['chapterName']; ?></em></span>
                                    </a>                                   
        <?php $i++;
    } ?>
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
    <?php //echo form_close();         ?>
<?php } ?>
</div>
<script>
    function confirmRemove(){
        x = confirm('ต้องการลบ ?');
        if(x){
            return true;
        }else{
            return false;
        }
    }
</script>