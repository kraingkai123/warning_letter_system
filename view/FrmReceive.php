<div class="accordion" id="accordionExample">
    <div class="card" >
        <div class="card-header" id="headingOne" style="background-color: #91b9f7;">
            <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" >
                    ลายเซ็นพนักงาน
                </button>
            </h5>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample" >
            <div class="card-body">
                <?php
                $listTarget = Letter::getDataTarget($_GET['LETTER_ID']);
                $arrayTarget = [];
                $index = 0;
                $mod = 1;
                $index2 = 0;
                foreach ($listTarget as $key => $value) {
                    if ($index2 == 3) {
                        $index2 = 0;
                    }
                    $arrayTarget[$index][0][$index2] = [
                        'f_id' => $value['f_id'],
                    ];
                    $arrayTarget[$index][1][$index2] = [
                        "fullname" => $value['prefix_name'] . $value['usr_fname'] . ' ' . $value['usr_lname'],
                    ];
                    $arrayTarget[$index][2][$index2] = [
                        "posname" => $value['usr_pos_name'],
                    ];
                    if ($mod % 3 == 0) {
                        $index++;
                    }
                    $index2++;
                    $mod++;
                } ?>
                <table border="0" width="100%">
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
                                  
                                        <?php if ($key2 == 'f_id') {
                                        ?>
                                          <td width="30%">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <a href="#!" class="btn btn-primary"
                                                        onclick="window.open('../form/letter_receive_sign.php?ID=<?php echo $key2 == 'f_id' ? $value2 : 0; ?>&proc=traget','sign','width=1000,height=600');"> <i class="icofont icofont-edit-alt"></i> เซ็นชื่อ</a>
                                                </div>
                                                <div class="col-sm-4">
                                                 <center><img id="view_pic_traget<?php echo $value2; ?>" src="" style="width: 500px;" /></center>
                                                </div>
                                            </div>
                                            <textarea class="img_create_traget" id="img_create_traget<?php echo $value2; ?>" name="img_create_traget[<?php echo $value2; ?>]" rows="4" cols="50" readonly style="display: none;"></textarea>
                                            </td>
                                      <?php
                                        } else if ($key2 == 'fullname') {
                                           ?>
                                           <td width="30%"  align="center">(<?php echo $value2; ?>)</td>
                                           <?php
                                        }else if ($key2 == 'posname') {
                                            ?>
                                            <td width="30%"  align="center">(<?php echo $value2; ?>)</td>
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
        </div>
    </div>
    <div class="card">
        <div class="card-header" id="headingTwo" style="background-color: #91b9f7;">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    ลายเซ็นพยาน
                </button>
            </h5>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
            <div class="card-body">
            <?php
                $listTarget = Letter::getDataWiness($_GET['LETTER_ID']);
                $arrayTarget = [];
                $index = 0;
                $mod = 1;
                $index2 = 0;
                foreach ($listTarget as $key => $value) {
                    if ($index2 == 3) {
                        $index2 = 0;
                    }
                    $arrayTarget[$index][0][$index2] = [
                        'f_id' => $value['f_id'],
                    ];
                    $arrayTarget[$index][1][$index2] = [
                        "fullname" => $value['prefix_name'] . $value['usr_fname'] . ' ' . $value['usr_lname'],
                    ];
                    $arrayTarget[$index][2][$index2] = [
                        "posname" => $value['usr_pos_name'],
                    ];
                    if ($mod % 3 == 0) {
                        $index++;
                    }
                    $index2++;
                    $mod++;
                } ?>
                <table border="0" width="100%">
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
                                  
                                        <?php if ($key2 == 'f_id') {
                                        ?>
                                          <td width="30%">
                                            <div class="row">
                                                <div class="col-sm-3">
                                                    <a href="#!" class="btn btn-primary"
                                                        onclick="window.open('../form/letter_receive_sign.php?ID=<?php echo $key2 == 'f_id' ? $value2 : 0; ?>&proc=winess','sign','width=1000,height=600');"> <i class="icofont icofont-edit-alt"></i> เซ็นชื่อ</a>
                                                </div>
                                                <div class="col-sm-4">
                                                 <center><img id="view_pic_winess<?php echo $value2; ?>" src="" style="width: 500px;" /></center>
                                                </div>
                                            </div>
                                            <textarea class="img_create_winess"  id="img_create_winess<?php echo $value2; ?>" name="img_create_winess[<?php echo $value2; ?>]" rows="4" cols="50" readonly style="display: none;"></textarea>
                                            </td>
                                      <?php
                                        } else if ($key2 == 'fullname') {
                                           ?>
                                           <td width="30%"  align="center">(<?php echo $value2; ?>)</td>
                                           <?php
                                        }else if ($key2 == 'posname') {
                                            ?>
                                            <td width="30%"  align="center">(<?php echo $value2; ?>)</td>
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
        </div>
    </div>
</div>