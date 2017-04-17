<!-- end warper-->

<!-- jQuery -->
<!--<script src="//code.jquery.com/jquery-1.12.4.js"></script>-->

<script src="<?php echo base_url(); ?>asset/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo base_url(); ?>asset/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- DataTables JavaScript -->
<script src="<?php echo base_url(); ?>asset/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>asset/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>

<script src="<?php echo base_url(); ?>asset/vendor/datatables-responsive/dataTables.responsive.js"></script>
<!--Custom Theme JavaScript -->
<!--<script src="<?php //echo base_url();     ?>asset/dist/js/sb-admin-2.js"></script>-->
<!-- bootstrap js select-->
<script src="<?php echo base_url(); ?>asset/vendor/bootstrap-select/dist/js/bootstrap-select.min.js"></script>


<script>

    $(function () {

        // We can attach the `fileselect` event to all file inputs on the page
        $(document).on('change', ':file', function () {
            var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [numFiles, label]);
        });

        // We can watch for our custom `fileselect` event like this
        $(document).ready(function () {
            $(':file').on('fileselect', function (event, numFiles, label) {

                var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;

                if (input.length) {
                    input.val(log);
                } else {
                    if (log)
                        alert(log);
                }

            });
        });

    });



    function ajaxFunction(typeUser) {
        var keyUser = $("#colInModal1").val();
        var newPass = $('#colInModal2').val();

        $.ajax({
            url: '<?php echo base_url(); ?>index.php/MainController/editPass/' + typeUser + '/' + keyUser + '/' + newPass,
            type: 'POST',
            success: function () {
                alert('เปลี่ยนรหัสผ่านแล้ว');
                $('#modalChangePass').modal('hide');
                //the response variable will hold anything that is written in that php file(in html) and anything you echo in that file
            }
        });
        return false;
    }

    $(document).ready(function () {
        $("#form-password").submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: "<?php echo base_url(); ?>index.php/MainController/editPass",
                type: "POST"
            });
        });
    });

    $('#changePass').on('click', function () {
        $("#colInModal1").val($('#col0').val());
    });
    $('#usersTDetail tbody').on('click', 'tr', function () {
        $("#tModal").modal("show");
        $("#col0").val($(this).closest('tr').children()[0].textContent);
        $("#col1").val($(this).closest('tr').children()[1].textContent);
        $("#col2").val($(this).closest('tr').children()[2].textContent);
        $("#col3").val($(this).closest('tr').children()[3].textContent);
        $("#col4").val($(this).closest('tr').children()[4].textContent);
        $("#col6").val($(this).closest('tr').children()[5].textContent);
        if ($(this).closest('tr').children()[6].textContent == 'มีสิทธ์') {
            $("#License").val('H');
        } else {
            $("#License").val('NH');
        }

    });

    $('#usersSDetail tbody').on('click', 'tr', function () {
        $("#sModal").modal("show");
        $("#col0").val($(this).closest('tr').children()[0].textContent);
        $("#col1").val($(this).closest('tr').children()[1].textContent);
        $("#col2").val($(this).closest('tr').children()[2].textContent);
        $("#col3").val($(this).closest('tr').children()[3].textContent);
        $("#col4").val($(this).closest('tr').children()[4].textContent);
        $("#col5").val($(this).closest('tr').children()[5].textContent);
        $("#col6").val($(this).closest('tr').children()[6].textContent);
        if ($(this).closest('tr').children()[7].textContent == 'มีสิทธ์') {
            $("#License").val('H');
        } else {
            $("#License").val('NH');
        }
    });

    function allowText(index) {
        var checkbox = document.getElementById('fancy-checkbox-primary' + index);
        document.getElementById('inputText' + index).disabled = !checkbox.checked;
        if (checkbox.checked) {
            document.getElementById('inputText' + index).value = 1;
        } else {
            document.getElementById('inputText' + index).value = '';
        }
    }


    $(document).ready(function () {
        $('#dataTables').DataTable({
            responsive: true
        });
    });
    function maxLengthCheck(object)
    {
        if (object.value.length > object.maxLength)
            object.value = object.value.slice(0, object.maxLength)
    }
    function testMC(n) {
        var ansT1 = document.getElementById('ansT1');
        var ansT2 = document.getElementById('ansT2');
        var ansT3 = document.getElementById('ansT3');
        var ansT4 = document.getElementById('ansT4');
        var x1 = document.getElementById('C1');
        var x2 = document.getElementById('C2');
        var x3 = document.getElementById('C3');
        var x4 = document.getElementById('C4');

        if (n == 1) {
            document.getElementById('ans1').textContent = 'ถูก';
            document.getElementById('ans2').textContent = 'ผิด';
            document.getElementById('ans3').textContent = 'ผิด';
            document.getElementById('ans4').textContent = 'ผิด';

            ansT1.style.background = '#98FB98';
            ansT2.style.background = '#FFFFFF';
            ansT3.style.background = '#FFFFFF';
            ansT4.style.background = '#FFFFFF';

            x1.value = 'ถูก';
            x2.value = 'ผิด';
            x3.value = 'ผิด';
            x4.value = 'ผิด';
        } else if (n == 2) {
            document.getElementById('ans1').textContent = 'ผิด';
            document.getElementById('ans2').textContent = 'ถูก';
            document.getElementById('ans3').textContent = 'ผิด';
            document.getElementById('ans4').textContent = 'ผิด';

            ansT1.style.background = '#FFFFFF';
            ansT2.style.background = '#98FB98';
            ansT3.style.background = '#FFFFFF';
            ansT4.style.background = '#FFFFFF';

            x1.value = 'ผิด';
            x2.value = 'ถูก';
            x3.value = 'ผิด';
            x4.value = 'ผิด';
        } else if (n == 3) {
            document.getElementById('ans1').textContent = 'ผิด';
            document.getElementById('ans2').textContent = 'ผิด';
            document.getElementById('ans3').textContent = 'ถูก';
            document.getElementById('ans4').textContent = 'ผิด';

            ansT1.style.background = '#FFFFFF';
            ansT2.style.background = '#FFFFFF';
            ansT3.style.background = '#98FB98';
            ansT4.style.background = '#FFFFFF';

            x1.value = 'ผิด';
            x2.value = 'ผิด';
            x3.value = 'ถูก';
            x4.value = 'ผิด';
        } else {
            document.getElementById('ans1').textContent = 'ผิด';
            document.getElementById('ans2').textContent = 'ผิด';
            document.getElementById('ans3').textContent = 'ผิด';
            document.getElementById('ans4').textContent = 'ถูก';

            ansT1.style.background = '#FFFFFF';
            ansT2.style.background = '#FFFFFF';
            ansT3.style.background = '#FFFFFF';
            ansT4.style.background = '#98FB98';

            x1.value = 'ผิด';
            x2.value = 'ผิด';
            x3.value = 'ผิด';
            x4.value = 'ถูก';
        }
    }

    function goBack() {
        window.history.back();
    }

    function testTF(n) {
        var z = document.getElementById('btn1');
        var x = document.getElementById('btn2');
        var a = document.getElementById('TF1');
        var b = document.getElementById('TF2');
        if (n == 1) {
            z.style.background = '#98FB98';
            x.style.background = '#E4FDDD';
            a.value = 'ถูก';
            b.value = 'ผิด';
        } else {
            x.style.background = '#98FB98';
            z.style.background = '#E4FDDD';
            a.value = 'ผิด';
            b.value = 'ถูก';
        }

    }


//    function Counter(options) {
//        var timer;
//        var instance = this;
//        var seconds = options.seconds;
//        var min = options.min;
//        var onUpdateStatus = options.onUpdateStatus || function() {};
//        var onCounterEnd = options.onCounterEnd || function() {};
//        var onCounterStart = options.onCounterStart || function() {};
//
//        function decrementCounter() {
//                onUpdateStatus(min,seconds);
//                if (seconds === 0 & min === 0) {
//                    stopCounter();
//                    onCounterEnd();
//                    return;
//                }
//                if (seconds <= 0) {
//                    seconds = 60;
//                    min -= 1;
//                }
//                if (min <= -1) {
//                    seconds = 0;
//                    min += 1;
//                } else {
//                    seconds--;
//                }
//                
//        };
//
//        function startCounter() {
//            onCounterStart();
//            clearInterval(timer);
//            timer = 0;
//            decrementCounter();
//            timer = setInterval(decrementCounter, 1000);
//        };
//
//        function stopCounter() {
//            clearInterval(timer);
//        };
//
//        return {
//            start: function () {
//                startCounter();
//            },
//            stop: function () {
//                stopCounter();
//            }
//        };
//    };


// Page-Level Demo Scripts - Tables - Use for reference


</script>
<!--<script>
    var countdown = new Counter({
    // number of seconds to count down
    min: 5,
    seconds: 0,

    onCounterStart: function () { 
        //alert('begin'); 
    },

    // callback function for each second
    onUpdateStatus: function(min,second) {
         document.getElementById('d2').value = min+"."+second;
        // change the UI that displays the seconds remaining in the timeout 
    },

    // callback function for final action after countdown
    onCounterEnd: function() {
        //alert('end');
        //window.location = '<?php echo base_url(); ?>index.php/MainController';
    }
    });
countdown.start();
</script>-->


</body>
</html>
