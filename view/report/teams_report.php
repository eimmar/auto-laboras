<?php
require(dirname(__FILE__) . '/../header_report.php');
use Utils\Routing;
?>

    <div id="header">
        <ul id="reportInfo">
            <li class="title">Komandų ir vairuotojų pravažiuotų ratų ataskaita</li>
            <li>Sudarymo data: <span><?php echo date("Y-m-d"); ?></span></li>
            <li>Ratų važiavimo laikotarpis:
                <span>
        <?php
        if(!empty($data['date_from'])) {
            if(!empty($data['date_to'])) {
                echo "nuo {$data['date_from']} iki {$data['date_to']}";
            } else {
                echo "nuo {$data['date_from']}";
            }
        } else {
            if(!empty($data['date_to'])) {
                echo "iki {$data['date_to']}";
            } else {
                echo "nenurodyta";
            }
        }
        ?>
      </span>
                <a href="<?php echo Routing::getURL($module, 'view', "id={$id}"); ?>" title="Nauja ataskaita" class="newReport">nauja ataskaita</a>
            </li>
        </ul>
    </div>

    <div id="content">
        <div id="contentMain">
            <?php
            if(sizeof($reportData) > 0) { ?>
                <table class="reportTable">
                    <tr>
                        <th>Trasos pavadinimas</th>
                        <th>Distancija</th>
                        <th>Vietovė</th>
                        <th style="border-right: 1px solid #6e6e6e;">Pravažiuota ratų</th>
                        <th style="border-right: 1px solid #6e6e6e;">Vidutinis važiavimo laikas</th>
                    </tr>

                    <tr><td class="separator" colspan="5"></td></tr>
                    <?php
                    // suformuojame lentelę
                    foreach($reportData as $key => $val) {
                        $min = $val['avgTime'] / 60000;
                        $sec = number_format(($min - floor($min)) * 60, 3);
                        $min = floor($min);
                        echo
                        "<tr>",
                        "<td>{$val['name']}</td>",
                        "<td>{$val['distance_meters']} m</td>",
                        "<td>{$val['location']}</td>",
                        "<td>{$val['lapCount']}</td>",
                        "<td>{$min} min {$sec} s</td>",
                        "</tr>\n";
                    } ?>

                </table>
            <?php } else { ?>
                <div class="warningBox">
                    Nurodytu laikotartpiu trasose nebuvo važiuojama
                </div>
            <?php } ?>
        </div>
    </div>

<?php require(dirname(__FILE__) . '/../footer_report.php');
