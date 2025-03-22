<?php
include("../include/header.php");
?>

<body class="">
    <div class="wrapper ">
        <?php include("../include/sidebar.php");
        include("../include/navbar.php");
        ?>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-body ">
                            <a class="btn btn-primary" href="addLetter.php" role="button"><span class="nc-icon nc-simple-add"></span> เพิ่มข้อมูล</a>
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center" width="10%">ลำดับ</th>
                                        <th class="text-center" width="10%">เลขคำร้อง</th>
                                        <th class="text-center" width="30%">เรื่อง</th>
                                        <th class="text-center" width="20%">เรียน</th>
                                        <th class="text-center" width="20%">วันที่</th>
                                        <th class="text-center" width="20%">สถานะ</th>
                                        <th class="text-center" width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ressponse = Letter::ListLetter();
                                    $i = 1;

                                    foreach ($ressponse as $key => $value) {
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $i; ?></td>
                                            <td align="center">
                                                <?php echo $value['letter_number']; ?>
                                            </td>
                                            <td><?php echo $value['letter_name']; ?></td>
                                            <td><?php echo $value['letter_target']; ?></td>
                                            <td align="center"><?php echo db2Date($value['letter_date']); ?></td>
                                            <td><?php 
                                                if($value['letter_status']==1){
                                                    $textStatus = "รอ hr อนุมัติ";
                                                }else if($value['letter_status']==5){
                                                    $textStatus = "Hr ส่งกลับแก้ไข";
                                                }else if($value['letter_status']==3){
                                                    $textStatus = "Hr ไม่อนุมัติ";
                                                }else if($value['letter_status']==2){
                                                    $textStatus = "Hr อนุมัติ";
                                                }else if($value['letter_status']==4){
                                                    $textStatus = "ดำเนินการเสร็จสิ้น";
                                                }
                                                echo $textStatus;
                                            ?></td>
                                            <td>

                                                <?php

                                                if ($value['letter_status'] == 5) {
                                                ?>
                                                    <a class="btn btn-success" href="addLetter.php?LETTER_ID=<?php echo $value['letter_id']; ?>&menu_id=<?php echo $_GET['menu_id']; ?>" role="button"><i class="nc-icon nc-ruler-pencil"></i> แก้ไข</a>
                                                    <button type="button" class="btn btn-danger" onclick="DeleteData('delete','<?php echo $value['letter_id']; ?>')"> <i class="nc-icon nc-simple-remove"></i> ลบ</button>
                                                <?php
                                                } else if ($value['letter_status'] == 2) {
                                                ?>
                                                    <a class="btn btn-primary" href="../view/LetterDetail.php?LETTER_ID=<?php echo $value['letter_id']; ?>&menu_id=<?php echo $_GET['menu_id']; ?>&proc=Receive" role="button">รับทราบ</a>
                                                <?php
                                                } ?>
                                                <a class="btn btn-primary" href="../view/LetterDetail.php?LETTER_ID=<?php echo $value['letter_id']; ?>&proc=view" role="button"><i class="nc-icon nc-email-85"></i> รายละเอียด</a>
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>

                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <?php include("../include/footer.php"); ?>
    </div>
    <script>
        $(document).ready(function() {
            // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
            /*   $("#example").DataTable({}); */
            LoadDatatable('example');
        });

        function UpdateStatus(usr_id, status) {
            $.ajax({
                type: "POST",
                url: "../save/SaveUser.php",
                data: {
                    usr_id: usr_id,
                    status: status,
                    proc: 'updateStatus'
                }, // serializes the form's elements.
                dataType: "json",
                success: function(response) {
                    if (response.Status == false) {
                        Swal.fire({
                            title: response.Message,
                            icon: "error"
                        });
                    } else {
                        Swal.fire({
                            title: response.Message,
                            icon: "success"
                        });
                    }
                }
            });
        }


        function SaveData() {
            var proc = $("#proc").val();
            var pos_id = $("#usr_id").val()
            if (proc == 'add') {
                if ($("#pos_name").val() == "") {
                    Swal.fire({
                        title: "กรุณากรอกชื่อตำแหน่ง",
                        icon: "error"
                    });
                } else {
                    Swal.fire({
                        title: "คุณต้องการบันทึกข้อมูลใช่หรือไม่",
                        text: "",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "ยืนยัน",
                        cancelButtonText: "ปิด",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var form = $("#frmUser");
                            var actionUrl = form.attr('action');
                            const formData = new FormData($("#frmUser")[0]);
                            $.ajax({
                                type: "POST",
                                url: actionUrl,
                                // data: form.serialize(), // serializes the form's elements.
                                data: formData, // serializes the form's elements.
                                contentType: false,
                                processData: false,
                                beforeSend: function() {
                                    Swal.showLoading();
                                },
                                success: function(response) {
                                    swal.close();
                                    location.reload();
                                }
                            });
                        }
                    });
                }
            } else if (proc == 'edit') {

                if ($("#pos_name").val() == "") {
                    Swal.fire({
                        title: "กรุณากรอกชื่อตำแหน่ง",
                        icon: "error"
                    });
                } else {
                    var is_manager = $('#btnEdit' + pos_id).data('is_manager');

                    if (is_manager != 'Y') {
                        is_manager = 'Y';
                    } else {
                        is_manager = 'N';
                    }
                    Swal.fire({
                        title: "คุณต้องการบันทึกข้อมูลใช่หรือไม่",
                        text: "",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "ยืนยัน",
                        cancelButtonText: "ปิด",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            var form = $("#frmUser");
                            var actionUrl = form.attr('action');
                            const formData = new FormData($("#frmUser")[0]);
                            $.ajax({
                                type: "POST",
                                url: actionUrl,
                                // data: form.serialize(), // serializes the form's elements.
                                data: formData, // serializes the form's elements.
                                contentType: false,
                                processData: false,
                                beforeSend: function() {
                                    Swal.showLoading();
                                },
                                success: function(response) {
                                    swal.close();
                                    location.reload();
                                }
                            });
                        }
                    });
                }
            }

        }

        function AddData(proc) {
            $("#proc").val(proc)
            $.ajax({
                type: "POST",
                url: "../view/show_frm_user.php",
                data: {
                    proc: proc,
                }, // serializes the form's elements.
                dataType: "html",
                success: function(response) {
                    $('#modal_content').html(response)
                }
            });
        }

        function EditData(proc, usr_id) {
            $.ajax({
                type: "POST",
                url: "../view/show_frm_user.php",
                data: {
                    proc: proc,
                    usr_id: usr_id
                }, // serializes the form's elements.
                //dataType: "html",
                success: function(response) {
                    $('#modal_content').html(response)
                    $("#proc").val(proc)
                    $("#usr_id").val(usr_id)
                }
            });



        }

        function DeleteData(proc, letterId) {
            Swal.fire({
                title: "ต้องการลบใช่หรือไม่",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "ยืนยัน",
                cancelButtonText: "ปิด",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "../save/LetterProc.php",
                        data: {
                            PROC: proc,
                            LETTER_ID: letterId
                        }, // serializes the form's elements.
                        dataType: "json",
                        success: function(response) {
                            if (response.status == 200) {
                                location.reload();
                            }
                        }
                    });

                }
            });

        }
    </script>
</body>

</html>