<?php
require('view/header.php');

use Model\Car;
use Utils\Routing;

?>
    <ul id="pagePath">
        <li><a href="<?php echo Routing::getURL(); ?>">Pradžia</a></li>
        <li>Komandos</li>
    </ul>
    <div id="actions">
        <a href='<?php echo Routing::getURL($module, 'create'); ?>'>Naujas</a>
    </div>
    <div class="float-clear"></div>

<?php if (!empty($delete_error)) : ?>
    <div class="errorBox">
        Sis automobilis negali buti pasalinta.
    </div>
<?php endif; ?>

<?php if (!empty($id_error)) : ?>
    <div class="errorBox">
        Automobilis nerastas!
    </div>
<?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Modelis</th>
            <th>Kaina</th>
            <th>Leistina dalyvauti eisme</th>
            <th>Kebulo tipas</th>
            <th>Pavaru dezes tipas</th>
            <th>Variklis</th>
        </tr>
        <?php
        /**
         * @var int $key
         * @var Car $val
         */
        foreach($data as $key => $val) : ?>

            <tr>
                <td><?php echo $val['id']; ?></td>
                <td><?php echo $val['model_name'] . ' ' . $val['generation']; ?></td>
                <td><?php echo $val['price'] . ' EUR'; ?></td>
                <td><?php echo $val['is_road_legal'] ? 'Taip' : 'Ne'; ?></td>
                <td><?php echo $val['body_type']; ?></td>
                <td><?php echo $val['gearbox_type']; ?></td>
                <td>
                    <?php echo round($val['capacity_ml'] / 1000, 1); ?>l
                    <?php echo $val['power_kw']; ?> KW
                    <?php echo $val['torque']; ?> Nm
                </td>
                <td>
                    <a href="#"
                       onclick="showConfirmDialog('<?php echo $module; ?>', '<?php echo $val['id']; ?>')"
                       title="Salinti">
                        Salinti
                    </a>

                    <a href="<?php echo Routing::getURL($module, 'edit', 'id=' . $val['id']); ?>"
                       title="Redaguoti">
                        Redaguoti
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

<?php
// įtraukiame puslapių šabloną
require('view/paging.php');
require('view/footer.php');

