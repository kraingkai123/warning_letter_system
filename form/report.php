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
                            <form action="" method="post" id="frmMain">
                                <div class="text-center">
                                    <h4>รายงานการลงโทษทางวินัย</h4>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input id="startDate" name="startDate" class="form-control" type="date" value="<?php echo $_POST['startDate']; ?>" />
                                    </div>
                                    <div class="col-sm-6">
                                        <input id="endDate" name="endDate" class="form-control" type="date" value="<?php echo $_POST['endDate']; ?>" />
                                    </div>
                                </div>
                                <input type="hidden" id="typeExport" name="typeExport">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-success"><span class="nc-icon nc-zoom-split"></span> ค้นหา</button>
                                </div>
                            </form>
                            <?php
                            unset($req);
                            if (!empty($_POST['startDate'])) {
                                $req['startDate'] = $_POST['startDate'];
                            }
                            if (!empty($_POST['endDate'])) {
                                $req['endDate'] = $_POST['endDate'];
                            }

                            $req['dep_id'] = $_SESSION['dep_id'];
                            $respone = Report::ListRule($req);
                            ?>
                            <div class="text-right">
                                <button type="button" class="btn btn-success" onclick="exportData('excel')">ส่งออก Excal</button>
                                <button type="button" class="btn btn-danger" onclick="exportData('pdf')">ส่งออก PDF</button>
                            </div>
                            <div id='divExport'>
                                <table id="example" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr class="text-center">

                                            <th class="text-center" width="10%">สถานะ</th>
                                            <th class="text-center" width="10%">เลขที่เอกสาร</th>
                                            <th class="text-center" width="10%">โทษทางวินัย</th>
                                            <th class="text-center" width="10%">วันที่</th>
                                            <th class="text-center" width="10%">รหัสพนักงาน</th>
                                            <th class="text-center" width="20%">ชื่อ-นามสกุล</th>
                                            <th class="text-center" width="20%">ตำแหน่ง</th>
                                            <th class="text-center" width="10%">รายละเอียด</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $index = 1;
                                        if (count($respone) > 0) {
                                            foreach ($respone as $key => $value) {
                                                $color = "";
                                                $textStatus = "";
                                                if ($value['letter_status'] == 1) {
                                                    $color = "#F7CAAC";
                                                    $textStatus = "อนุมัติ";
                                                } else if ($value['letter_status'] == 5) {
                                                    $color = "#F7CAAC";
                                                    $textStatus = "ส่งกลับแก้ไข";
                                                } else if ($value['letter_status'] == 3) {
                                                    $color = "#FFAFAF";
                                                    $textStatus = "ไม่อนุมัติ";
                                                } else if ($value['letter_status'] == 2) {
                                                    $color = "#B3C6E7";
                                                    $textStatus = "อนุมัติ";
                                                } else if ($value['letter_status'] == 4) {
                                                    $color = "#C4E0B2";
                                                    $textStatus = "ดำเนินการเสร็จสิ้น";
                                                }else if ($value['letter_status'] == 6) {
                                                    $textStatus = "พนักงานไม่ยินยอมรับทราบ";
                                                }

                                        ?>
                                                <tr>
                                                   
                                                    <td align="center"><span style="color:<?php echo $color; ?>"><?php echo $textStatus; ?></span></td>
                                                    <td><?php echo $value['letter_number']; ?></td>
                                                    <td><?php echo db_getData("SELECT letter_type_name FROM m_letter_type WHERE lt_id ='" . $value['letter_type'] . "'", "letter_type_name"); ?></td>
                                                    <td><?php echo db2Date($value['letter_date']) . " " . $value['letter_time']; ?></td>
                                                    <td><?php echo db_getData("SELECT usr_username FROM view_user WHERE usr_id =" . $value['usr_id'] . "", 'usr_username'); ?></td>
                                                    <td><?php echo $value['fullname']; ?></td>
                                                    <td><?php echo $value['usr_pos_name']; ?></td>
                                                     <td><a class="btn btn-primary btn-mini" target="_blank" href="../view/LetterDetail.php?LETTER_ID=<?php echo $value['letter_id']; ?>&proc=view" role="button"><i class="nc-icon nc-email-85"></i> รายละเอียด</a></td>
                                                </tr>
                                            <?php
                                                $index++;
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="6" class="text-center text-danger">ไม่พบข้อมูล</td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            function exportData(type) {
                $("#typeExport").val(type)
                $("#frmMain").attr("action", '../save/export.php')
                $("#frmMain").attr("target", '_blank')
                $("#frmMain").submit();
                $("#frmMain").attr("action", '')
            }
        </script>
        <?php include("../include/footer.php"); ?>
    </div>


</body>

</html>