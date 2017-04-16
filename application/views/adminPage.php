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
<?php ?>
<br>
<div class="container">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <div class="pull-right" style="cursor: pointer">
                            <!-- Button trigger modal -->
                            <span><button class="bg-success" data-toggle="modal" data-target="#createUserModal" style="border: 0"><i class="glyphicon glyphicon-plus fa-fw"></i>เพิ่มผู้ใช้งานระบบ</button></span>
                        </div>
                        <i class="glyphicon glyphicon-user fa-fw"></i> <?php echo "Hello <b id='welcome'><i>" . $userName . "</i> !</b>"; ?>
                    </div>
                    <div class="panel-body"> 
                        <?php echo form_open('index.php/AjaxController/getUser/0'); ?>
                        <select class="selectpicker show-tick" name='userType'>
                            <?php if ($typeUser == 't') { ?>
                                <option value="t" selected>อาจารย์</option>
                                <option value="s">นักศึกษา</option>
                            <?php } else { ?>
                                <option value="t">อาจารย์</option>
                                <option value="s" selected>นักศึกษา</option>
                            <?php } ?>
                        </select>

                        <button type="submit" class="btn btn-primary" name='btnGetUser' value="btnGetUser">ตกลง</button>
                        <?php echo form_close(); ?>
                        <hr>

                        <?php if ($typeUser == 't') { ?>
                            <table width="100%" class="table table-striped table-bordered table-hover" id='usersTDetail'>
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รหัส</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>ห้องพัก</th>
                                        <th>สิทธ์การใช้งานระบบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rs as $r) { ?>
                                        <tr>
                                            <th><?= $r['tKey'] ?></th>
                                            <th><?= $r['ID'] ?></th>
                                            <th><?= $r['tName'] ?></th>
                                            <th><?= $r['tPhone'] ?></th>
                                            <th><?= $r['tRoom'] ?></th>
                                            <?php if ($r['License'] == 'H') { ?>
                                                <th>มีสิทธ์</th>
                                            <?php } else { ?>
                                                <th>ไม่มีสิทธ์</th>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                                <div class="modal fade" id="tModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">EDIT</h4>
                                            </div>
                                            <?php echo form_open('index.php/MainController/editUser/t'); ?>
                                            <div class="modal-body">
                                                <input name="tKey" type="text" hidden id="col0">
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon">รหัสอาจารย์</span>
                                                    <input type="text" class="form-control" id="col1" readonly/>
                                                </div>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon">ชื่อ-นามสกุล</span>
                                                    <input name="tName" type="text" class="form-control" id="col2"/>
                                                </div>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon">เบอร์โทรศัพท์</span>
                                                    <input name="tPhone" type="text" class="form-control" id="col3"/>
                                                </div>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon">ห้องพัก</span>
                                                    <input name="tRoom" type="text" class="form-control" id="col4"/>
                                                </div>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon">สิทธ์การใช้งานระบบ</span>
                                                    <select class="form-control" name='License' id='License'>
                                                        <option value="H">มีสิทธ์</option>
                                                        <option value="NH">ไม่มีสิทธ์</option>
                                                    </select>
                                                </div>

                                                <p><input type="button" class="btn btn-info" data-toggle="modal" href="#modalChangePass" value="เปลี่ยนรหัสผ่าน" id="changePass"></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="btnEditUser" value="btnEditUser">Save changes</button>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </table>
                        <?php } else { ?>
                            <table width="100%" class="table table-striped table-bordered table-hover" id='usersSDetail'>
                                <thead>
                                    <tr>
                                        <th>ลำดับ</th>
                                        <th>รหัส</th>
                                        <th>ชื่อ-นามสกุล</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>ชั้นปี</th>
                                        <th>ระดับการศึกษา</th>
                                        <th>สิทธ์การใช้งานระบบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($rs as $r) { ?>
                                        <tr>
                                            <th><?= $r['sKey'] ?></th>
                                            <th><?= $r['sID'] ?></th>
                                            <th><?= $r['sName'] ?></th>
                                            <th><?= $r['sPhone'] ?></th>
                                            <th><?= $r['sYear'] ?></th>
                                            <th><?= $r['sDegree'] ?></th>
                                            <?php if ($r['License'] == 'H') { ?>
                                                <th>มีสิทธ์</th>
                                            <?php } else { ?>
                                                <th>ไม่มีสิทธ์</th>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>

                                <div class="modal fade" id="sModal" tabindex="-1" data-focus-on="input:first">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">EDIT</h4>
                                            </div>
                                            <?php echo form_open('index.php/MainController/editUser/s'); ?>
                                            <div class="modal-body">
                                                <input id="col0" name="sKey" type="text" hidden>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon">รหัสนักศึกษา</span>
                                                    <input type="text" class="form-control" id="col1" readonly/>
                                                </div>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon">ชื่อ-นามสกุล</span>
                                                    <input name='sName' type="text" class="form-control" id="col2"/>
                                                </div>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon">เบอร์โทรศัพท์</span>
                                                    <input name="sPhone" type="text" class="form-control" id="col3"/>
                                                </div>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon">ชั้นปี</span>
                                                    <input name="sYear" type="text" class="form-control" id="col4"/>
                                                </div>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon">ระดับการศึกษา</span>
                                                    <input name="sDegree" type="text" class="form-control" id="col5"/>
                                                </div>
                                                <div class="form-group input-group">
                                                    <span class="input-group-addon">สิทธ์การใช้งานระบบ</span>
                                                    <select class="form-control" name='License' id='License'>
                                                        <option value="H">มีสิทธ์</option>
                                                        <option value="NH">ไม่มีสิทธ์</option>
                                                    </select>
                                                </div>
                                                <p><input type="button" class="btn btn-info" data-toggle="modal" href="#modalChangePass" value="เปลี่ยนรหัสผ่าน" id="changePass"></p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary" name="btnEditUser" value="btnEditUser">Save changes</button>
                                            </div>
                                            <?php echo form_close(); ?>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </table>
                        <?php } ?>
                        <div id="modalChangePass" class="modal fade" tabindex="-1" data-focus-on="input:first">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h3>เปลี่ยนรหัสผ่าน</h3>
                                    </div>

                                    <div class="modal-body">

                                        <input type="text" id="colInModal1" />
                                        <p><label>รหัสผ่านใหม่</label><input name="newPass" type="password" class="form-control" id="colInModal2"/></p>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" data-dismiss="modal" class="btn">Close</button>
                                        <button class="btn btn-success btn-positive" type="button" onclick="return ajaxFunction('<?= $typeUser ?>');"><i class="glyphicon glyphicon-ok"></i> แก้ไข </button>
                                    </div>

                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <div id="createUserModal" class="modal fade" tabindex="-1" data-focus-on="input:first">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                        <h3>เพิ่มผู้ใช้งานระบบ : <?php echo $typeUser == 't' ? 'อาจารย์' : 'นักศึกษา'; ?></h3>
                                    </div>
                                    <?php echo form_open('index.php/MainController/createUser/' . $typeUser); ?>
                                    <div class="modal-body">
                                        <?php if ($typeUser == 't') { ?>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">รหัสอาจารย์</span>
                                                <input type="text" class="form-control" name="newTID"/>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">รหัสผ่าน</span>
                                                <input type="text" class="form-control" name="newTPassword"/>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">ชื่อ-นามสกุล</span>
                                                <input name="newTName" type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">เบอร์โทรศัพท์</span>
                                                <input name="newTPhone" type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">ห้องพัก</span>
                                                <input name="newTRoom" type="text" class="form-control" id="col4"/>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">สิทธ์การใช้งานระบบ</span>
                                                <select class="form-control" name='License'>
                                                    <option value="H">มีสิทธ์</option>
                                                    <option value="NH">ไม่มีสิทธ์</option>
                                                </select>
                                            </div>
                                        <?php } ?>
                                        <?php if ($typeUser == 's') { ?>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">รหัสนักศึกษา</span>
                                                <input type="text" class="form-control" name="newSID"/>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">รหัสผ่าน</span>
                                                <input type="text" class="form-control" name="newSPassword"/>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">ชื่อ-นามสกุล</span>
                                                <input name='newSName' type="text" class="form-control" />
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">เบอร์โทรศัพท์</span>
                                                <input name="newSPhone" type="text" class="form-control"/>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">ชั้นปี</span>
                                                <select class="form-control" name='newSYear'>
                                                    <option value="1">ปี 1</option>
                                                    <option value="2">ปี 2</option>
                                                    <option value="3">ปี 3</option>
                                                    <option value="4">ปี 4</option>
                                                    <option value="5">ปี 5</option>
                                                    <option value="6">ปี 6</option>
                                                    <option value="7">ปี 7</option>
                                                    <option value="8">ปี 8</option>
                                                </select>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">ระดับการศึกษา</span>
                                                <select class="form-control" name='newSDegree'>
                                                    <option value="ป.ตรี">ปริญญาตรี</option>
                                                    <option value="ป.โท">ปริญญาโท</option>
                                                    <option value="ป.เอก">ปริญญาเอก</option>
                                                </select>
                                            </div>
                                            <div class="form-group input-group">
                                                <span class="input-group-addon">สิทธ์การใช้งานระบบ</span>
                                                <select class="form-control" name='License'>
                                                    <option value="H">มีสิทธ์</option>
                                                    <option value="NH">ไม่มีสิทธ์</option>
                                                </select>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class = "modal-footer">
                                        <button type = "button" data-dismiss = "modal" class = "btn">Close</button>
                                        <button class = "btn btn-success btn-positive" type = "submit" name = "btnCreUser" value = "btnCreUser"><i class = "glyphicon glyphicon-plus"></i> เพิ่ม </button>
                                    </div>
                                    <?php echo form_close();
                                    ?>

                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->
                    </div>

                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>

</div>
</div>

