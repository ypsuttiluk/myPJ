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
                                <span><button class="bg-success" data-toggle="modal" data-target="#myModal" style="border: 0"><i class="glyphicon glyphicon-plus fa-fw"></i>เพิ่มบทเรียน</button></span>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">เพิ่มบทเรียน</h4>
                                        </div>
                                        <?php echo form_open("index.php/ChapterController/createChapter/" . $userKey); ?>
                                        <div class="modal-body">
                                            <input class="form-control" type="text" name="chapterName" id="chapterName" placeholder="ชื่อบทเรียน" autofocus>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                            <!--<a href="<?php //echo base_url();?>index.php/MainController/createChapter">-->
                                            <button type="submit" class="btn btn-primary" name="btnSave" value="btnSave">บันทึกบทเรียน</button><!--</a>-->
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                    <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                            </div>
                            <!-- /.modal -->
                            <i class="glyphicon glyphicon-th-list fa-fw"></i> บทเรียน (จำนวนบทเรียนทั้งหมด : <?php echo count($rs);?> บทเรียน)
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body"> 
                            <div class="list-group">
                                <?php $i=1;foreach ($rs as $r) { ?>
                                    <a href="<?php echo base_url(); ?>index.php/ChapterController/chapterDetail/<?php echo $r['chapterKey']; ?>" class="list-group-item">
                                       <?php echo $i;?> : <i class="glyphicon glyphicon-book fa-fw"></i> <?php echo $r['chapterName']; ?>
                                    </a>
                                <?php $i++;} ?>
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
<?php } ?>
</div>