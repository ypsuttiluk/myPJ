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
<?php if (isset($this->session->userdata['logged_in']) && $userType == 't') { ?>

    <!-- Page Content -->
    <br>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="pull-right" style="cursor: pointer">
                                <!-- Button trigger modal -->
                                <span><button class="bg-success" data-toggle="modal" data-target="#myModal" style="border: 0"><i class="glyphicon glyphicon-plus fa-fw"></i>สร้างแบบทดสอบ</button></span>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">สร้างแบบทดสอบ</h4>
                                        </div>
                                        <?php echo form_open('index.php/ExamController/createExam/' . $userKey); ?>
                                        <div class="modal-body">
                                            <input type="text" class="form-control" name="examText" placeholder="ชื่อแบบทดสอบ" autofocus required="">
                                            <br>

                                            <h4>โปรดเลือกคำถามจากบทเรียน...</h4><hr>
                                            <?php
                                            for ($i = 0; $i < count($rs2); $i++) {
                                                $sql = 'select * from questiondim where chapterKey = ' . $rs2[$i]['chapterKey'];
                                                $ar = $this->ExamModel->getData($sql);
                                                ?>
                                                <div class='row'>
                                                    <div class="form-group col-xs-8">
                                                        <?php if (count($ar) > 0) { ?>
                                                            <input type="checkbox" value='<?php echo $rs2[$i]['chapterKey']; ?>' name="chapter[]" id="fancy-checkbox-primary<?php echo $i; ?>" autocomplete="off" onchange="allowText(<?php echo $i; ?>)">
                                                        <?php } else { ?>
                                                            <input type="checkbox" value='<?php echo $rs2[$i]['chapterKey']; ?>' name="chapter[]" id="fancy-checkbox-primary<?php echo $i; ?>" autocomplete="off" onchange="allowText(<?php echo $i; ?>)" disabled>
                                                        <?php } ?>
                                                        <div class="btn-group">
                                                            <label for="fancy-checkbox-primary<?php echo $i; ?>" class="btn btn-info">
                                                                <span class="glyphicon glyphicon-ok"></span>
                                                                <span></span>
                                                            </label>
                                                            <label class="btn btn-default active">
                                                                <?php echo $rs2[$i]['chapterName']; ?>
                                                            </label>
                                                        </div>
                                                    </div>

                                                    <?php if (count($ar) > 0) { ?>
                                                        <div class="form-group col-xs-1" style="padding-top:8px">
                                                            จำนวน
                                                        </div>
                                                        <div class="form-group col-xs-2">
                                                            <input id='inputText<?php echo $i; ?>' type="number" class="form-control" maxlength="2" min="1" max="<?php echo count($ar); ?>" oninput="maxLengthCheck(this)" disabled value="" name = 'numberOfQues[]'>
                                                        </div>
                                                        <div class="form-group col-xs-1" style="padding-top:8px">
                                                            ข้อ
                                                        </div>
                                                    <?php } else { ?>
                                                        <div class="form-group col-xs-4" style="padding-top:8px">
                                                            ไม่มีคำถามในบทเรียนนี้
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            <?php } ?>
                                        </div> 
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                            <!--<a href="<?php //echo base_url();                                                                                                              ?>index.php/MainController/createChapter">-->
                                            <button type="submit" class="btn btn-primary" name="btnSave" value="btnSave">สร้างแบบทดสอบ</button><!--</a>-->
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <i class="glyphicon glyphicon-th-list fa-fw"></i> คลังแบบทดสอบ
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body"> 

                            <div class="list-group">
                                <?php foreach ($rs as $r) { ?>
                                    <a href="<?php echo base_url(); ?>index.php/ExamController/examDetail/<?php echo $r['examKey']; ?>" class="list-group-item">
                                        <i class="fa fa-file-text fa-fw"></i> <?php echo $r['examText']; ?>
                                    </a>
                                <?php } ?>
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
    <?php //echo form_close();    ?>
<?php } ?>
</div>



