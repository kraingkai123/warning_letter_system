<?php
include("../include/include.php");
$dataLetter = Letter::getDataLetter($_GET['LETTER_ID']);
?>
<style>
    /* @font-face {
		font-family: 'TH SarabunIT';
		src: url('../../css/fontBook/THSarabunIT.eot');
		src: local('?'), url('../../css/fontBook/THSarabunIT.eot?#iefix') format('embedded-opentype'), url('../../css/fontBook/THSarabunIT.woff') format('woff'), url('../../css/fontBook/THSarabunIT.ttf') format('truetype'), url('../../css/fontBook/THSarabunIT.svg') format('svg');
		font-weight: normal;
		font-style: normal;
	} */

    @font-face {
        font-family: 'TH SarabunIT๙';
        src: url('../assets/fonts/THSarabunNew.ttf');
        font-weight: normal;
        font-style: normal;

    }

    @media print {
        @page {
            margin: 0;
        }

        div.Section1 {
            border: 0 !important;

        }

        body.gg {
            border: 0 !important;
            margin-top: 0 !important;
        }

        h3 {
            position: absolute;
            page-break-before: always;
            page-break-after: always;
            bottom: 0;
            right: 0;
        }

        h3::before {
            position: relative;
            bottom: -20px;
            counter-increment: section;
            content: counter(section);
        }

        /* .book_secret_H {
			display: show;
		}

		.book_secret_F {
			display: show;
		} */

        .showForPrint {
            display: show;
        }

        /* div.divFooter {
			position: fixed;
			font-size: 36pt;
			left: 43%;
			color: red;
			font-weight: bold;
		}

		div.divHeader {
			position: fixed;
			top: 50;
			font-size: 36pt;
			left: 43%;
			color: red;
			font-weight: bold;
		} */

        .footnote {
            width: 630px !important;
            position: fixed !important;
            bottom: 1.5cm;
            /* border-style: solid;
			border-color: coral; */
        }

        .tag_btn_print {
            display: none !important;
            height: 0;
        }

        .book_status_c {
            display: none !important;
            height: 0;
        }


    }

    @page: first {
        size: A4;
        /* margin-top: 3% !important; */
        margin-bottom: 0%;
    }

    @page {
        size: A4;
        margin: 0%;
    }

    @media screen {

        div.divFooter {
            display: none;
        }

        div.divHeader {
            display: none;
        }

        /* .book_secret_H {
			display: show;
		}

		.book_secret_F {
			display: show;
		} */

        .refer_book {
            display: none;
        }

        .showForPrint {
            border: red solid 1px;
        }




    }

    @page Section1 {
        mso-page-orientation: portrait;
        /* size: 21cm 29.7cm; */
        /* margin: 0.5cm 2cm 2cm 2.5cm; */
    }

    div.Section1 {
        page: Section1;
    }

    body {
        counter-reset: section;
        font-family: "TH SarabunIT๙" !important;
    }

    body.gg {
        width: 630px;
        height: auto;
        min-height: 21cm;
        padding: 0.1cm 1.8cm 2cm 2.8cm;
        margin: 0.5cm auto;
        border: 1px #D3D3D3 solid;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 0px rgba(0, 0, 0, 0);
        margin-top: 30px;
        margin-bottom: 30px;
        font-size: 16pt;
        /* line-height: 26px; */
        line-height: 6.5mm;

    }

    hr.style5 {
        /* background-color: #fff; */
        border-top: 1px dotted #8c8b8b;
        /**/
    }

    td.td_title {
        width: 25px;
        resize: both;
    }

    /* p {
		margin-bottom: -0.25cm;
		margin-top: 0cm;
		font-size: 16pt;
		font-family: "TH SarabunIT๙" !important;
	} */

    p {
        resize: none;
        margin-bottom: 0cm;
        margin-top: 0cm;
        display: block;
        margin-block-start: 9pt;
        margin-block-end: 2pt;
        margin-inline-start: 0px;
        margin-inline-end: 0px;
        font-family: "TH SarabunIT๙" !important;
    }

    p.title_tops {
        resize: none;
        margin-bottom: 0cm;
        margin-top: 0cm;
        font-size: 29pt !important;
        font-family: "TH SarabunIT๙" !important;
    }

    /* p {
		width: 100%;
		height: 8;
		margin-bottom: 0cm;
		margin-top: 0cm;
	} */

    span {
        margin-bottom: 0cm;
        margin-top: 0cm;
        font-family: "TH SarabunIT๙";
        font-size: 16pt !important;
    }

    table {
        font-size: 16pt !important;
    }


    .footnote {
        width: 100%;
        text-align: center;
    }
</style>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>

<body class="gg">




    <div class="Section1" style="margin: 1cm 0px 55px 0px;">
        <style media="print">
            .show_btn_print {
                display: none;
            }
        </style>
        <style>
            .show_btn_print {
                text-align: right;
                margin: -40px 0px 0px 0px;
            }

            .btn_print {
                display: inline-block;
                padding: 6px 12px;
                margin-bottom: -0.5cm;
                margin-top: 5px;
                font-size: 15pt;
                font-weight: normal;
                line-height: 1.428571429;
                text-align: center;
                white-space: nowrap;
                vertical-align: top;
                cursor: pointer;
                border: 1px solid transparent;
                border-radius: 4px;
                -webkit-user-select: none;
                color: #ffffff;
                background-color: #428bca;
            }
        </style>
        <div class="show_btn_print">
            <button type="button" class="btn_print" onclick="window.print()">พิมพ์</button>
        </div>
        <table border="0" width="100%">
            <tr>
                <td width="30%">เลขที่ <?php echo $dataLetter['letter_number']; ?></td>
                <td width="35%" align="center"></td>
                <td width="35%"></td>
            </tr>
        </table>
        <table border="0" width="100%">

            <tr>
                <td colspan="3" align="center"><strong><?php echo $dataLetter['letter_type_name']; ?></strong></td>
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
                <td colspan="4"><strong>เรื่อง <?php echo $dataLetter['letter_name']; ?></strong></td>
            </tr>
            <tr>
                <td colspan="4"><strong>ผู้กระทำความผิด</strong> <?php echo $dataLetter['letter_target']; ?></td>
            </tr>
            <tr>
                <td colspan="4"><?php echo $dataLetter['type_detail_1']; ?></td>
            </tr>
            <tr>
                <td colspan="4"><?php echo $dataLetter['type_detail_2']; ?></td>
            </tr>
            <tr>
                <td colspan="4"><?php echo $dataLetter['letter_detail']; ?></td>
            </tr>
            <tr>
                <td colspan="4">
                    <?php $dataRule = Rule::getruleLetter($_GET['LETTER_ID']);
                    foreach ($dataRule as $key => $value) {
                        echo $value['rule_detail'] . " : " . $value['rule_name'] . "<br>";
                    } ?>
                </td>
            </tr>
            <tr>
                <td colspan="4"><?php echo $dataLetter['type_detail_3']; ?></td>
            </tr>
            <tr>
                <td colspan="4"><br></td>
            </tr>
            <tr>
                <td colspan="4"><br></td>
            </tr>
            <?php
            $listTarget = Letter::getDataTarget($_GET['LETTER_ID']);
            $dataTarget = $listTarget[0];
            ?>
            <tr>
                <td colspan="2" width="50%" align="right">ลงชื่อ</td>
                <td width="30%" align="center">
                    <?php
                    if (!empty($dataTarget['f_image'])) {
                    ?>
                        <img id="view_pic" src="<?php echo $dataTarget['f_image'];  ?>" style="width: 150px;" />
                    <?php
                    }
                    ?>
                </td>
                <td width="20%">พนักงาน</td>
            </tr>
            <tr>
                <td colspan="2" width="50%" align="right"></td>
                <td width="30%" align="center">
                    (<?php echo $dataTarget['prefix_name'] . $dataTarget['usr_fname'] . " " . $dataTarget['usr_lname']; ?>)
                </td>
                <td width="20%"></td>
            </tr>
            <tr>
                <td colspan="2" width="50%" align="right"></td>
                <td width="35%" align="center">
                    <?php echo $dataTarget['date_sign'] == "" ? "" :"วันที่ ". convDateThai($dataTarget['date_sign']); ?>
                </td>
                <td width="20%"></td>
            </tr>
        </table>
        <table border="0" width="100%" style="text-align: center;">
            <tr>
                <td colspan="3" align="left"><strong>จัดทำโดย</strong></td>
            </tr>
            <tr>
                <td width="33%" align="right">
                    <img id="view_pic" src="<?php echo $dataLetter['img_create'];  ?>" style="width: 150px;" />
                </td>
                <td width="34%" align="center">
                    
                    <?php
                    if (!empty($dataLetter['manager_image'])) {
                    ?>
                        <img id="view_pic" src="<?php echo $dataLetter['manager_image'];  ?>" style="width: 150px;" />
                    <?php
                    }
                    ?>
                </td>
                <td width="33%">
                    
                     <?php
                    if (!empty($dataLetter['img_hr'])) {
                    ?>
                        <img id="view_pic" src="<?php echo $dataLetter['img_hr'];  ?>" style="width: 150px;" />
                    <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>(<?php
                        $perCreate = User::getDataUser($dataLetter['usr_id']);
                        echo $perCreate['fullname'];
                        ?>)</td>
                <td>(<?php

                        echo $dataLetter['manager_name'];
                        ?>)</td>
                <td>(<?php
                        echo $dataLetter['hr_name'] == "" ? "" : $dataLetter['hr_name']; ?>)</td>
            </tr>
            <tr>
                <td>ตำแหน่ง <?php echo $perCreate['pos_name']; ?></td>
                <td>ตำแหน่ง <?php echo $dataLetter['manager_pos']; ?></td>
                <td><?php
                    echo $dataLetter['hr_position'] == "" ? "ตำแหน่ง" : "ตำแหน่ง " . $dataLetter['hr_position']; ?></td>
            </tr>
            <tr>
                <td><small>* ผู้จัดการฝ่าย</small></td>
                <td><small>* ผู้บังคับบัญชาโดยตรงของพนักงาน</small></td>
                <td><small>* ฝ่ายบุคคล</small></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align:left;"><u><strong>หมายเหตุ</strong></u> ในกรณ๊พนักงานไม่ได้ลงนามรับทราบหนังสือฯฉบับนี้ ผู้บังคับบัญชาจึงได้อ่านให้พนักงานฟังต่อหน้าพยานและให้พยานทั้งสองลงลายมือชื่อ</td>
            </tr>
        </table>
        <table width="100%" border="0">
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
                                <td colspan="2" align="center" width="50%">ลงชื่อ
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
                                <td colspan="2" align="center" width="50%">(<?php echo $value2; ?>)</td>
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

    </div>

</body>




</html>