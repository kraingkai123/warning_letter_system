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
                                        <th class="text-center" width="60%">ข้อบังคับ</th>
                                        <th class="text-center" width="10%">สถานะ</th>
                                        <th class="text-center" width="20%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ressponse = LetterType::listLetterType();
                                    $i = 1;
                                    foreach ($ressponse as $key => $value) {
                                    ?>
                                        <tr>
                                            <td align="center"><?php echo $i; ?></td>
                                            <td><?php echo $value['letter_type_name']; ?></td>
                                            <td align="center">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="letter_type_status<?php echo $value['lt_id']; ?>" <?php echo $value['letter_type_status'] == 1 ? "checked" : ""; ?> onclick="UpdateStatus('<?php echo $value['lt_id']; ?>','<?php echo $value['letter_type_status']; ?>')">
                                                    <label class="custom-control-label" for="letter_type_status<?php echo $value['lt_id']; ?>"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" id="btnEdit<?php echo $value['lt_id']; ?>" onclick="EditData('edit','<?php echo $value['lt_id']; ?>')" data-name="<?php echo $value['letter_type_name']; ?>"><i class="nc-icon nc-ruler-pencil"></i> แก้ไข</button>
                                                <button type="button" class="btn btn-danger" onclick="DeleteData('delete','<?php echo $value['lt_id']; ?>')"> <i class="nc-icon nc-simple-remove"></i> ลบ</button>
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

        function UpdateStatus(lt_id, status) {
            $.ajax({
                type: "POST",
                url: "../save/setup_letter_type_proc.php",
                data: {
                    lt_id: lt_id,
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
            var lt_id = $("#lt_id").val()
            if (proc == 'add') {
                if ($("#letter_type_name").val() == "") {
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
                                url: "../save/setup_letter_type_proc.php",
                                data: {
                                    letter_type_name: $('#letter_type_name').val(),
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

                if ($("#letter_type_name").val() == "") {
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
                                url: "../save/setup_letter_type_proc.php",
                                data: {
                                    letter_type_name: $('#letter_type_name').val(),
                                    proc: proc,
                                    lt_id: lt_id
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

        function EditData(proc, lt_id) {
            $("#proc").val(proc)
            $("#lt_id").val(lt_id)
            var letter_type_name = $("#btnEdit" + lt_id).data('name');
            $('#letter_type_name').val(letter_type_name);
        }

        function DeleteData(proc, lt_id) {
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
                        url: "../save/setup_letter_type_proc.php",
                        data: {
                            proc: proc,
                            lt_id: lt_id
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
                <input type="hidden" id='lt_id' name="lt_id">
                <input type="hidden" id='proc' name="proc">
                <div class="form-group row">
                    <label for="inputPassword" class="col-sm-2 col-form-label">ข้อบังคับ<span class="text-danger">*</span></label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="letter_type_name" name="letter_type_name">
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