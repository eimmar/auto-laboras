<?php
require('view/header.php');

use Model\Manufacturer;
use Utils\Routing;

?>
    <ul id="pagePath">
        <li><a href="<?php echo Routing::getURL(); ?>">Pradžia</a></li>
        <li>Gamintojai</li>
    </ul>
    <div id="actions">
        <a href='<?php echo Routing::getURL($module, 'create'); ?>'>Naujas</a>
    </div>
    <div class="float-clear"></div>

<?php if (!empty($delete_error)) : ?>
    <div class="errorBox">
        Sis gamintojas negali buti pasalintas.
    </div>
<?php endif; ?>

<?php if (!empty($id_error)) : ?>
    <div class="errorBox">
        Gamintojas nerastas!
    </div>
<?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Pavadinimas</th>
            <th>Ikurejas(-ai)</th>
            <th>Bustine</th>
            <th>Darbuotoju skaicius</th>
            <th>Ikurimo data</th>
            <th></th>
        </tr>
        <?php
        /**
         * @var int $key
         * @var Manufacturer $val
         */
        foreach($data as $key => $val) : ?>

            <tr>
                <td><?php echo $val->getId(); ?></td>
                <td><?php echo $val->getName(); ?></td>
                <td><?php echo $val->getFounder(); ?></td>
                <td><?php echo $val->getHeadquarters(); ?></td>
                <td><?php echo $val->getWorkersCount(); ?></td>
                <td><?php echo $val->getDateFounded()->format('Y-m-d'); ?></td>
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
