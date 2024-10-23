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
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="AddData('add')">
                                <i class="nc-icon nc-simple-add"></i> เพิ่มข้อมูล
                            </button>
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center" width="10%">ลำดับ</th>
                                        <th class="text-center" width="40%">ข้อบังคับ</th>
                                        <th class="text-center" width="30%">รายละเอียด</th>
                                        <th class="text-center" width="10%">สถานะ</th>
                                        <th class="text-center" width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ressponse = Rule::ListRule();
                                    $i = 1;

                                    foreach ($ressponse as $key => $value) {
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $i; ?></td>
                                            <td>
                                                <?php echo $value['rule_name']; ?>
                                            </td>
                                            <td><?php echo $value['rule_detail']; ?></td>
                                            <td align="center"><?php echo $value['rule_status'] == "Y" ? "ใช้งาน" : "ไม่ใช้งาน"; ?></td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" id="btnEdit<?php echo $value['rule_id']; ?>" onclick="EditData('edit','<?php echo $value['rule_id']; ?>')" data-name="<?php echo $value['rule_name']; ?>" data-rule_status="<?php echo $value['rule_status']; ?>" data-detail="<?php echo base64_encode($value['rule_detail']); ?>"><i class="nc-icon nc-ruler-pencil"></i> แก้ไข</button>
                                                <button type="button" class="btn btn-danger" onclick="DeleteData('delete','<?php echo $value['rule_id']; ?>')"> <i class="nc-icon nc-simple-remove"></i> ลบ</button>

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
            var pos_id = $("#rule_id").val()
            if (proc == 'add') {
                if ($("#rule_name").val() == "") {
                    Swal.fire({
                        title: "กรุณากรอกข้อบังคับ",
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
                            $.ajax({
                                type: "POST",
                                url: "../save/rule_proc.php",
                                data: {
                                    rule_name: $('#rule_name').val(),
                                    rule_detail: $('#rule_detail').val(),
                                    rule_status: $('#rule_status').val(),
                                    proc: proc
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
            } else if (proc == 'edit') {

                if ($("#rule_name").val() == "") {
                    Swal.fire({
                        title: "กรุณากรอกข้อบังคับ",
                        icon: "error"
                    });
                } else {
                    var rule_status="";
                    if ($('#rule_status').prop('checked')) {
                        rule_status='Y';
                    } else {
                        rule_status='N'
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
                            $.ajax({
                                type: "POST",
                                url: "../save/rule_proc.php",
                                data: {
                                    rule_name: $('#rule_name').val(),
                                    rule_detail: $('#rule_detail').val(),
                                    rule_status: rule_status,
                                    rule_id: $("#rule_id").val(),
                                    proc: proc
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
            }

        }


        function AddData(proc) {
            $("#proc").val(proc)
        }

        function EditData(proc, pos_id) {
            $("#proc").val(proc)
            $("#rule_id").val(pos_id)
            var pos_name = $("#btnEdit" + pos_id).data('name');
            $('#rule_name').val(pos_name);
            var rule_status = $('#btnEdit' + pos_id).data('rule_status');
            $('#rule_status').prop('checked', false)
            if (rule_status == 'Y') {
                $('#rule_status').prop('checked', true)
            }
            var base64String = $('#btnEdit' + pos_id).data('detail');
            var decodedString = decodeBase64ToUTF8(base64String);
            $("#rule_detail").text(decodedString);
        }

        function DeleteData(proc, rule_id) {
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
                        url: "../save/rule_proc.php",
                        data: {
                            proc: proc,
                            rule_id: rule_id
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

        function decodeBase64ToUTF8(base64String) {
            var binaryString = atob(base64String);
            var binaryArray = new Uint8Array(binaryString.length);
            for (var i = 0; i < binaryString.length; i++) {
                binaryArray[i] = binaryString.charCodeAt(i);
            }
            return new TextDecoder('utf-8').decode(binaryArray);
        }
    </script>
</body>

</html>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><?php
                                                                if (empty($_GET['menu_id'])) {
                                                                    $_GET['menu_id'] = 0;
                                                                }
                                                                echo $_SESSION['menu'][$_GET['menu_id']]['menu_name']; ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id='rule_id' name="rule_id">
                <input type="hidden" id='proc' name="proc">
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">ข้อบังคับ<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="rule_name" name="rule_name" rows="10"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">ข้อบังคับ<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <textarea class="form-control" id="rule_detail" name="rule_detail" rows="3"></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">สถานะ</label>
                    <div class="col-sm-10">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="rule_status" value="Y">
                            <label class="custom-control-label" for="rule_status"></label>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" onclick="SaveData()">บันทึก</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>