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
                            <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr class="text-center">
                                        <th class="text-center" width="10%">ลำดับ</th>
                                        <th class="text-center" width="10%">เลขคำร้อง</th>
                                        <th class="text-center" width="30%">เรื่อง</th>
                                        <th class="text-center" width="20%">ผู้กระทำความผิด</th>
                                        <th class="text-center" width="20%">วันที่</th>
                                        <th class="text-center" width="20%">สถานะ</th>
                                        <th class="text-center" width="10%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $ressponse = Letter::ListLetterHr();
                                    $i = 1;

                                    foreach ($ressponse as $key => $value) {
                                        $color="";
                                        if ($value['letter_status'] == 1) {
                                           $color="#F7CAAC";
                                        } else if ($value['letter_status'] == 5) {
                                            $color="#F7CAAC";
                                        } else if ($value['letter_status'] == 3) {
                                            $color="#FFAFAF";
                                        } else if ($value['letter_status'] == 2) {
                                            $color="#B3C6E7";
                                        } else if ($value['letter_status'] == 4) {
                                            $color="#C4E0B2";
                                        } else if ($value['letter_status'] == 6) {
                                            $color="#FFAFAF";
                                        }
                                    ?>
                                        <tr >
                                            <td align="center"><?php echo $i; ?></td>
                                            <td align="center">
                                                <?php echo $value['letter_number']; ?>
                                            </td>
                                            <td><?php echo $value['letter_name']; ?></td>
                                            <td><?php echo $value['letter_target']; ?></td>
                                            <td><?php echo db2Date($value['letter_date']); ?></td>
                                            <td style="background-color:<?php echo $color;?>"><?php
                                                if ($value['letter_status'] == 1) {
                                                    $textStatus = "รอตรวจสอบ";
                                                } else if ($value['letter_status'] == 5) {
                                                    $textStatus = "ส่งกลับแก้ไข";
                                                } else if ($value['letter_status'] == 3) {
                                                    $textStatus = "ยกเลิก";
                                                } else if ($value['letter_status'] == 2) {
                                                    $textStatus = "อนุมัติ";
                                                } else if ($value['letter_status'] == 4) {
                                                    $textStatus = "ดำเนินการเสร็จสิ้น";
                                                } else if ($value['letter_status'] == 6) {
                                                    $textStatus = "พนักงานไม่ยินยอมรับทราบ";
                                                }
                                                echo $textStatus;
                                                ?></td>
                                            <td>
                                                <?php
                                                $proc = "view";
                                                if ($value['letter_status'] == 1) {
                                                    $proc = "Approve";
                                                } ?>
                                                <a class="btn btn-primary" href="../view/LetterDetail.php?LETTER_ID=<?php echo $value['letter_id']; ?>&proc=<?php echo $proc; ?>&bp_id=<?php echo $value['bp_id'];?>" role="button"><i class="nc-icon nc-email-85"></i> รายละเอียด</a>
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

    </script>
</body>

</html>