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
<?php if (isset($this->session->userdata['logged_in']) && $userType == 't') { ?>
    <br>
    <div class="container">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-success">
                        <div class="panel-heading">


                            <i class="fa fa-file-text fa-fw"></i> ผลลัพธ์การทดสอบ 

                        </div>

                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="resultDetail">

                                <thead>
                                    <tr>
                                        <th>วัน/เดือน/ปี</th>
                                        <th>ชื่อการทดสอบ</th>
                                    </tr>
                                </thead>
                            </table>

                            <div id="example-container" style="display: none">
                                <table width="100%" class="table table-striped table-bordered table-hover">

                                    <thead>
                                        <tr>
                                            <th>รหัสนักศึกษา</th>
                                            <th>ชื่อ</th>
                                            <th>แบบทดสอบ</th>
                                            <th>คะแนนที่ได้</th>
                                            <th>วัน/เดือน/ปี</th>
<!--                                            <th>6</th>-->
                                        </tr>
                                    </thead>
                                </table>

                            </div>
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


<script src="//code.jquery.com/jquery-1.12.4.js"></script>
<script src="<?php echo base_url(); ?>asset/vendor/ajax/libs/bootbox.js/bootbox.min.js"></script>
<script src="<?php echo base_url(); ?>asset/vendor/bootstrap/js/bootstrap.min.js"></script>


<script>
    function testFunction(){
        alert('123');
    }
    function textToBin(text) {
        
      var length = text.length,output='';
      
      for (var i = 0;i < length; i++) {
        var bin = text[i].charCodeAt().toString(2);
        output += bin;
      } 
      
      return output;
    }
    $(document).ready(function () {
        var table = $('#resultDetail').DataTable({
            
            ajax: '<?php echo base_url(); ?>index.php/AjaxController/getResult/<?php echo $userKey; ?>'
        });
        $('#resultDetail tbody').on('click', 'tr', function () {
            var container = $('#example-container').clone();
            container.find('table').attr('id', 'example');
            var data = table.row(this).data();
           
            var box = bootbox.dialog({
                show: false,
                message: container.html(),
                title: "รายละเอียดการทดสอบ",
                buttons: {
                    excel:{
                        label: 'Export PDF',
                        callback: function () {
                            var table = $('#example').dataTable();
                  
                                window.open('data:application/vnd.ms-excel,' + 
                                        encodeURIComponent(table[0].outerHTML));
                
                        }
                    },
                    ok: {
                        label: "OK",
                        className: "btn-primary" 
                    }
                    
//                    cancel: {
//                        label: "Cancel",
//                        className: "btn-default"
//                    }
                }
            });

            box.on("shown.bs.modal", function () {
             
             var output = data[1].split("");
                //var output = textToBin(data[1]);
              
                
                $('#example').DataTable({
                  
                    ajax: {
                        data: { name : output },
                        url:'<?php echo base_url(); ?>index.php/AjaxController/getResultDetail/<?php echo $userKey; ?>/'+data[0],
                    }  
                });
            });

            box.modal('show');
        });
    });
  
  
  
</Script>