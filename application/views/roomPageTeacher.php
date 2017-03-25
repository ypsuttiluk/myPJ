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
    <br>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="pull-right">
                                <span><i class="glyphicon glyphicon-book fa-fw"></i>ชุดข้อสอบที่ใช้ : <?php echo $rs2[0]['examText']; ?></span>&nbsp;&nbsp;&nbsp;
                                <span>
                                    <i class="glyphicon glyphicon-signal fa-fw"></i>สถานะของห้อง : 
                                    <?php if ($rs[0]['rStatus'] == 0) { ?>
                                        <a href="<?php echo base_url(); ?>index.php/MainController/changeStatus/<?php echo $rs[0]['rKey']; ?>/0">OFFLINE</a>
                                    <?php } else { ?>
                                        <a href="<?php echo base_url(); ?>index.php/MainController/changeStatus/<?php echo $rs[0]['rKey']; ?>/1">ONLINE</a>
                                    <?php } ?>

                                </span>
                                <span>
                                    <button class="bg-success" data-toggle="modal" data-target="#myModal2" style="border: 0;cursor: pointer"><i class="fa fa-gear fa-fw"></i></button>
                                </span>
                            </div>
                            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">แก้ไขชื่อห้องเรียน</h4>
                                        </div>
                                        <?php echo form_open("index.php/MainController/editRoom/" . $rs[0]['rKey'] . "/" . $userKey . "/" . $userType); ?>
                                        <div class="modal-body">
                                            <input class="form-control" type="text" name="rName" placeholder="ชื่อห้องเรียน" value="<?php echo $rs[0]['rName']; ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                            <!--<a href="<?php //echo base_url();                               ?>index.php/MainController/createChapter">-->
                                            <button type="submit" class="btn btn-primary" name="btnSave" value="btnSave">แก้ไขห้องเรียน</button><!--</a>-->
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                            <i class="fa fa-file-text fa-fw"></i> ชื่อห้องเรียน : <?php echo $rs[0]['rName']; ?>

                        </div>

                        <div class="panel-body">

                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables">
                                <thead>
                                    <tr>
                                        <th>รหัสนักศึกษา</th>
                                        <th>ชื่อนักศึกษา</th>
                                        <th>ทำไปแล้ว</th>
                                        <th>ทำถูก</th>
                                        <th>สถานะ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rs3 as $row) { ?>
                                        <tr>
                                            <td><?php echo $row['sID']; ?></td>
                                            <td><?php echo $row['sName']; ?></td>
                                            <td>6</td>
                                            <td class="center">5</td>
                                            <td class="center">อยู่ระหว่างการทดสอบ</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel success -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#container-fluid -->
    </div>
<?php } ?>
</div>