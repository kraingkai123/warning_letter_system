<?php
include("../include/include.php");
require_once '../mpdf/vendor/autoload.php';

$mpdf = new \Mpdf\Mpdf(['format' => 'A4', 'margin_left' => $margin_left, 'margin_right' => $margin_right, 'margin_top' => $margin_top, 'margin_bottom' => $margin_bottom, 'margin_header' => $margin_header, 'margin_footer' => $margin_footer]);
$dataLetter = Letter::getDataLetter($_GET['LETTER_ID']);

ob_start();
$base64Image = 'data:image/png;base64,' . $dataLetter['img_create'];
if ($dataLetter['img_hr'] == "") {
    $showHrImage = 0;
} else {
    $base64ImageHr = 'data:image/png;base64,' . $dataLetter['img_hr'];
    $showHrImage = 1;
}

?>
<style>
    table {
        font-size: 16pt !important;
    }
</style>
<table border="0" width="100%">
    <tr>
        <td width="30%">เลขที่ <?php echo $dataLetter['letter_number']; ?></td>
        <td width="35%" align="center"></td>
        <td width="35%"></td>
    </tr>
</table>
<table border="0" width="100%">

    <tr>
        <td colspan="3" align="center">หนังสือ</td>
    </tr>
</table>
<table border="0" width="100%">
    <tr>
        <td width="60%"></td>
        <td width="40%" colspan="2">เขียนที่ <?php echo $dataLetter['letter_write_address']; ?></td>
    </tr>
</table>
<table border="0" width="100%">
    <tr>
        <td colspan="3"><br></td>
    </tr>
</table>
<table border="0" width="100%">
    <tr>
        <td colspan="4"><br></td>
    </tr>
    <tr>
        <td align="center" colspan="4">วันที่ <?php echo convDateThai($dataLetter['letter_date']); ?></td>
    </tr>
    <tr>
        <td colspan="4">เรื่อง <?php echo $dataLetter['letter_name']; ?></td>
    </tr>
    <tr>
        <td colspan="4">ผู้กระทำความผิด <?php echo $dataLetter['letter_target']; ?></td>
    </tr>
    <tr>
        <td colspan="4"><?php echo $dataLetter['letter_detail']; ?></td>
    </tr>
    <tr>
        <td colspan="4">
            <?php $dataRule = Rule::getruleLetter($_GET['LETTER_ID']);
            foreach ($dataRule as $key => $value) {
                echo $value['rule_detail']." : " .$value['rule_name']."<br>";
            } ?>
        </td>
    </tr>
    <tr>
        <td colspan="4"><br></td>
    </tr>
    <tr>
        <td colspan="4"><br></td>
    </tr>
    <tr>
        <td colspan="2" width="50%" align="right">ลงชื่อ</td>
        <td width="30%" align="center">
            <img id="view_pic" src="<?php echo $dataLetter['img_create'];  ?>" style="width: 150px;" />
        </td>
        <td width="20%"></td>
    </tr>
    <tr>
        <td colspan="2" width="50%" align="right"></td>
        <td width="30%" align="center">
            (<?php
                $dataUser = User::getDataUser($dataLetter['usr_id']);
                echo $dataUser['fullname']; ?>)
        </td>
        <td width="20%"></td>
    </tr>
    <tr>
        <td colspan="2" width="50%" align="right"></td>
        <td width="30%" align="center">
            (<?php
                echo $dataUser['pos_name']; ?>)
        </td>
        <td width="20%"></td>
    </tr>
    <tr>
        <td colspan="4">ฝ่ายทรัพยากรบุคคล</td>
    </tr>
    <tr>
        <td colspan="2" width="50%" align="right">ลงชื่อ</td>
        <td width="30%" align="center">
            <?php
            if ($showHrImage == 1) {
            ?>
                <img id="view_pic" src="<?php echo $dataLetter['img_hr'];  ?>" style="width: 150px;" />
            <?php
            }
            ?>
        </td>
        <td width="20%"></td>
    </tr>
    <tr>
        <td colspan="2" width="50%" align="right"></td>
        <td width="30%" align="center">
            (<?php
                echo $dataLetter['hr_name'] == "" ? "ลงชื่อ" : $dataLetter['hr_name']; ?>)
        </td>
        <td width="20%"></td>
    </tr>
    <tr>
        <td colspan="2" width="50%" align="right"></td>
        <td width="30%" align="center">
            (<?php
                echo $dataLetter['hr_position'] == "" ? "ตำแหน่ง" : $dataLetter['hr_position']; ?>)
        </td>
        <td width="20%"></td>
    </tr>
    <tr>
        <td colspan="4">พนักงาน</td>
    </tr>

    <?php
    $listTarget = Letter::getDataTarget($_GET['LETTER_ID']);
    $arrayTarget = [];
    $index = 0;
    $mod = 1;
    $index2 = 0;
    foreach ($listTarget as $key => $value) {
        if ($index2 == 2) {
            $index2 = 0;
        }
        $arrayTarget[$index][0][$index2] = [
            'f_image' => $value['f_image']
        ];
        $arrayTarget[$index][1][$index2] = [
            "fullname" => $value['prefix_name'] . $value['usr_fname'] . ' ' . $value['usr_lname'],
            /*   'date_sign' => $value['date_sign'],
            'f_image' => $value['f_image'] */
        ];
        $arrayTarget[$index][2][$index2] = [
            'date_sign' => $value['date_sign'],
            /* 'f_image' => $value['f_image'] */
        ];

        if ($mod % 2 == 0) {
            $index++;
        }
        $index2++;
        $mod++;
    }

    ?>
    <?php

    for ($i = 0; $i <=  count($arrayTarget); $i++) {
        $checkTr = 0;
        /*     print_pre($arrayTarget[1]);
        exit; */
        foreach ($arrayTarget[$i] as $key => $value) {
            echo "<tr>";
            for ($x = 0; $x <= count($value); $x++) {

                foreach ($value[$x] as $key2 => $value2) {
    ?>
                    <?php
                    if ($key2 == 'f_image') {
                    ?>
                        <td colspan="2" align="center">ลงชื่อ
                            <?php if ($value2 != "") {
                            ?>
                                <img id="view_pic" src="<?php echo $value2 ;  ?>" style="width: 150px;" />

                            <?php
                            } else {
                            ?>

                            <?php
                            } ?>
                        </td>
                    <?php
                    } else  if ($key2 == 'fullname') {
                    ?>
                        <td colspan="2" align="center">(<?php echo $value2; ?>)</td>
                    <?php
                    } else  if ($key2 == 'date_sign') {
                    ?>
                        <td colspan="2" align="center"><?php echo $value2 == "" ? "<br>" : "(" . db2Date($value2) . ")"; ?></td>
                    <?php
                    }
                    ?>
    <?php
                }
            }
            echo "</tr>";
            $checkTr++;
        }
    }
    ?>
    <tr>
        <td colspan="4">พยาน</td>
    </tr>
    <?php
    $listTarget = Letter::getDataWiness($_GET['LETTER_ID']);
    $arrayTarget = [];
    $index = 0;
    $mod = 1;
    $index2 = 0;
    foreach ($listTarget as $key => $value) {
        if ($index2 == 2) {
            $index2 = 0;
        }
        $arrayTarget[$index][0][$index2] = [
            'f_image' => $value['f_image']
        ];
        $arrayTarget[$index][1][$index2] = [
            "fullname" => $value['prefix_name'] . $value['usr_fname'] . ' ' . $value['usr_lname'],
            /*   'date_sign' => $value['date_sign'],
            'f_image' => $value['f_image'] */
        ];
        $arrayTarget[$index][2][$index2] = [
            'date_sign' => $value['date_sign'],
            /* 'f_image' => $value['f_image'] */
        ];

        if ($mod % 2 == 0) {
            $index++;
        }
        $index2++;
        $mod++;
    }

    ?>
    <?php

    for ($i = 0; $i <=  count($arrayTarget); $i++) {
        $checkTr = 0;
        /*     print_pre($arrayTarget[1]);
        exit; */
        foreach ($arrayTarget[$i] as $key => $value) {
            echo "<tr>";
            for ($x = 0; $x <= count($value); $x++) {

                foreach ($value[$x] as $key2 => $value2) {
    ?>
                    <?php
                    if ($key2 == 'f_image') {
                    ?>
                        <td colspan="2" align="center">ลงชื่อ
                            <?php if ($value2 != "") {
                            ?>
                                <img id="view_pic" src="<?php echo  $value2;  ?>" style="width: 150px;" />

                            <?php
                            } else {
                            ?>

                            <?php
                            } ?>
                        </td>
                    <?php
                    } else  if ($key2 == 'fullname') {
                    ?>
                        <td colspan="2" align="center">(<?php echo $value2; ?>)</td>
                    <?php
                    } else  if ($key2 == 'date_sign') {
                    ?>
                        <td colspan="2" align="center"><?php echo $value2 == "" ? "<br>" : "(" . db2Date($value2) . ")"; ?></td>
                    <?php
                    }
                    ?>
    <?php
                }
            }
            echo "</tr>";
            $checkTr++;
        }
    }
    ?>
</table>
<?php
$htmlBody = ob_get_clean();

$mpdf->WriteHTML($htmlBody);
// Output to browser
$mpdf->Output();
