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
                    <input type="text" size="5" id="d2" value="">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <div class="pull-right">
                                <span><i class="glyphicon glyphicon-book fa-fw"></i>ชุดข้อสอบที่ใช้ : <?php echo $rs2[0]['examText']; ?></span>&nbsp;&nbsp;&nbsp;
                                <span>
                                    <i class="glyphicon glyphicon-signal fa-fw"></i>สถานะของห้อง : 
                                    <?php if ($rs[0]['rStatus'] == 0) { ?>
                                        <a href="<?php echo base_url(); ?>index.php/RoomController/changeStatus/<?php echo $rs[0]['rKey']; ?>/0">OFFLINE</a>

                                    <?php } else { ?>
                                        <a href="<?php echo base_url(); ?>index.php/RoomController/changeStatus/<?php echo $rs[0]['rKey']; ?>/1">ONLINE</a>
                                    <?php } ?>

                                </span>
                                <span>
                                    <button class="bg-success" data-toggle="modal" data-target="#myModal2" style="border: 0;cursor: pointer"><i class="fa fa-gear fa-fw"></i></button>
                                    <button id='autoButton' data-toggle="modal" data-target="#myModal" hidden data-backdrop="static" data-keyboard="false"></button>
                                </span>
                            </div>
                            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">แก้ไขชื่อห้องเรียน</h4>
                                        </div>
                                        <?php echo form_open("index.php/RoomController/editRoom/" . $rs[0]['rKey'] . "/" . $userKey . "/" . $userType); ?>
                                        <div class="modal-body">
                                            <input class="form-control" type="text" name="rName" placeholder="ชื่อห้องเรียน" value="<?php echo $rs[0]['rName']; ?>">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
                                             <!--<a href="<?php //echo base_url();                                                                                          ?>index.php/MainController/createChapter">-->
                                            <button type="submit" class="btn btn-primary" name="btnSave" value="btnSave">แก้ไขชื่อห้องเรียน</button><!--</a>-->
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">

                                            <h4 class="modal-title" id="myModalLabel">ตั้งค่าห้องเรียน</h4>
                                        </div>
                                        <?php echo form_open("index.php/RoomController/createRoom/" . $rs[0]['rKey']); ?>
                                        <div class="modal-body">
                                            <input class="form-control" type="text" name="nameOfExam" placeholder="ชื่อการทดสอบ" required=""><hr>

                                            <input class="form-control" type="text" name="time" placeholder="เวลาในการทดสอบ" required="">
                                            <br>
                                            <div class="row">
                                                <div class="col-xs-12">
                                                    <select name="examInRoom" class="selectpicker form-control" data-width="100%" title="เลือกแบบทดสอบ..." data-size="5" required>
                                                        <?php foreach ($exam as $r) { ?>
                                                            <option data-icon="glyphicon-file" value="<?php echo $r['examKey']; ?>"><?php echo $r['examText']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <!--<a href="<?php //echo base_url();                                                                                          ?>index.php/MainController/createChapter">-->
                                            <button  type="submit" class="btn btn-primary" name="btnCreRoom" value="btnCreRoom">ตกลง</button><!--</a>-->
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
                                    <?php
                                    foreach ($rs3 as $row) {
                                        echo '<tr>';
                                        echo '<td>' . $row['sID'] . '</td>';
                                        echo '<td>' . $row['sName'] . '</td>';
                                        echo '<td>6</td>';
                                        echo '<td class="center">5</td>';
                                        echo '<td class="center">อยู่ระหว่างการทดสอบ</td>';
                                        echo '</tr>';
                                    }
                                    ?>

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


<!-- jQuery -->
<script src="<?php echo base_url(); ?>asset/vendor/jquery/jquery.min.js"></script>
<script>



    $('#changeStatus').click(function () {
        if ($('#changeStatus').text() == 'OFFLINE') {
            $('#changeStatus').html('ONLINE');
        } else {
            $('#changeStatus').html('OFFLINE');
        }
    });

    jQuery(function () {
<?php if ($rs[0]['rStatus'] == 0) { ?>
            alert('ห้องเรียนอยู่ในสถานะออฟไลน์ กรุณาตั้งค่าห้องเรียน');
            jQuery('#autoButton').click();
<?php } ?>
    });
</script>
<script>

    var sec = 0
    var min = 10
    document.getElementById('d2').value = min+"."+sec

    function display() {
        if (sec <= 0) {
            sec = 60
            min -= 1
        }
        if (min <= -1) {
            sec = 0
            min += 1
        } else
            sec -= 1
         document.getElementById('d2').value = min + "." + sec
        setTimeout("display()", 1000)
    }
    display()
</script>
<Script Language="JavaScript">
///ตัวเลข 10000 มีค่าเท่ากับ 10 วินาทีครับ
    function next()
    {
        window.location = "<?php echo base_url(); ?>index.php/MainController"
    }
    //self.setTimeout('next()', 5000) << แก้เองนะตรงนี้ให้ตรงกับเวลาข้างบน

</Script>