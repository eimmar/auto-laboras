<?php
require('view/header.php');

use Model\Track;
use Utils\Routing;

?>
    <ul id="pagePath">
        <li><a href="<?php echo Routing::getURL(); ?>">Pradžia</a></li>
        <li>Trasos</li>
    </ul>
    <div id="actions">
        <a href='<?php echo Routing::getURL($module, 'create'); ?>'>Naujas</a>
    </div>
    <div class="float-clear"></div>

<?php if (!empty($delete_error)) : ?>
    <div class="errorBox">
        Si trasa negali buti pasalintas.
    </div>
<?php endif; ?>

<?php if (!empty($id_error)) : ?>
    <div class="errorBox">
        Trasa nerasta!
    </div>
<?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Pavadinimas</th>
            <th>Atstumas</th>
            <th>Vietove</th>
            <th>Atidarimo data</th>
            <th></th>
        </tr>
        <?php
        /**
         * @var int $key
         * @var Track $val
         */
        foreach($data as $key => $val) : ?>

            <tr>
                <td><?php echo $val->getId(); ?></td>
                <td><?php echo $val->getName(); ?></td>
                <td><?php echo $val->getDistanceMeters() . ' m'; ?></td>
                <td><?php echo $val->getLocation(); ?></td>
                <td><?php echo $val->getOpeningDate()->format('Y-m-d'); ?></td>
                <td>
                    <a href="#"
                       onclick="showConfirmDialog('<?php echo $module; ?>', '<?php echo $val->getId(); ?>')"
                       title="Salinti">
                        Salinti
                    </a>

                    <a href="<?php echo Routing::getURL($module, 'edit', 'id=' . $val->getId()); ?>"
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

