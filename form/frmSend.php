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
                            <a class="btn btn-primary" href="addLetter.php" role="button">เพิ่มข้อมูล</a>
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center" width="10%">ลำดับ</th>
                                        <th class="text-center" width="30%">ชื่อ-สกุล</th>
                                        <th class="text-center" width="20%">ฝ่าย/สังกัด</th>
                                        <th class="text-center" width="20%">ตำแหน่ง</th>
                                        <th class="text-center" width="10%">สถานะ</th>
                                        <th class="text-center" width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ressponse = User::getUserAll($_SESSION['dep_id'], $_SESSION['usr_type']);
                                    $i = 1;

                                    foreach ($ressponse as $key => $value) {
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $i; ?></td>
                                            <td><?php echo $value['prefix_name'].$value['usr_fname']." ".$value['usr_lname']; ?></td>
                                            <td><?php echo $value['dep_name'];?></td>
                                            <td><?php echo $value['pos_name'];?></td>

                                            <td align="center">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="usr_status<?php echo $value['usr_id']; ?>" <?php echo $value['usr_status'] == 'Y' ? "checked" : ""; ?> onclick="UpdateStatus('<?php echo $value['usr_id']; ?>','<?php echo $value['usr_status']; ?>')">
                                                    <label class="custom-control-label" for="usr_status<?php echo $value['usr_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" id="btnEdit<?php echo $value['usr_id']; ?>" onclick="EditData('edit','<?php echo $value['usr_id']; ?>')" data-name="<?php echo $value['pos_name']; ?>" data-is_manager="<?php echo $value['is_manager']; ?>"><i class="nc-icon nc-ruler-pencil"></i> แก้ไข</button>
                                                <button type="button" class="btn btn-danger" onclick="DeleteData('delete','<?php echo $value['usr_id']; ?>')"> <i class="nc-icon nc-simple-remove"></i> ลบ</button>
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

        function DeleteData(proc, pos_id) {
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
                        url: "../save/setup_position_proc.php",
                        data: {
                            proc: proc,
                            pos_id: pos_id
                        }, // serializes the form's elements.
                        dataType: "json",
                        success: function(response) {
                            if (response.Status == false) {
                                Swal.fire({
                                    title: response.Message,
                                    icon: "error"
                                });
                            } else {
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
