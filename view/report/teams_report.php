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
            if (sizeof($reportData) > 0) { ?>
                <table class="reportTable">

                    <?php foreach ($reportData as $teamName => $drivers) : ?>
                        <tr>
                            <th colspan="3">Komandos pavadinimas</th>
                            <th>Metinis biudžetas (EUR)</th>
                            <th>Profesionali</th>
                        </tr>
                        <tr>
                            <td colspan="3"><?php echo $teamName; ?></td>
                            <td><?php echo $drivers[0]['yearly_budget']; ?></td>
                            <td><?php echo $drivers[0]['is_professional'] ? 'Taip' : 'Ne'; ?></td>
                        </tr>

                        <tr>
                            <th>Vairuotojas</th>
                            <th>Vidutinis laikas įveikiant trasą</th>
                            <th style="border-right: 1px solid #6e6e6e;">Vidutinis važiuotos trasos ilgis (km)</th>
                            <th style="border-right: 1px solid #6e6e6e;">Trasos, kuriose važiavo</th>
                            <th>Važiavo trasose kartų</th>
                        </tr>
                        <?php foreach ($drivers as $driver) : ?>
                            <?php
                            $min = $driver['avgTime'] / 60000;
                            $sec = number_format(($min - floor($min)) * 60, 3);
                            $min = floor($min);
                            ?>
                            <tr>
                                <td><?php echo $driver['first_name'] . ' ' . $driver['last_name']; ?></td>
                                <td><?php echo $min . ' min ' . $sec . ' s'; ?></td>
                                <td><?php echo number_format($driver['avgDistance'] / 1000, 2); ?></td>
                                <td><?php echo $driver['trackNames']; ?></td>
                                <td class="report-countable"><?php echo $driver['lapCount']; ?></td>
                            </tr>
                        <?php endforeach; ?>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="bold">Iš viso grupėje:</td>
                            <td class="bold report-countable">
                                <?php echo array_sum(array_map(function($driver) {
                                    return $driver['lapCount'];
                                }, $drivers)); ?>
                            </td>
                        </tr>
                        <tr><td class="separator" colspan="5"></td></tr>
                    <?php endforeach; ?>
                    <tr><td class="separator" colspan="5"></td></tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="bold">Iš viso:</td>
                        <td class="bold report-countable-all"><?php echo array_sum(array_map(function($team) {
                                return array_sum(array_map(function($driver) {
                                    return $driver['lapCount'];
                                }, $team));
                            }, $reportData));?>
                        </td>
                    </tr>
                </table>
            <?php } else { ?>
                <div class="warningBox">
                    Nurodytu laikotartpiu komandų aktyvumo trasose nebuvo
                </div>
            <?php } ?>
        </div>
    </div>

<?php require(dirname(__FILE__) . '/../footer_report.php');
