<?php
require('view/header.php');

use Model\Team;
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
        Si komanda negali buti pasalinta.
    </div>
<?php endif; ?>

<?php if (!empty($id_error)) : ?>
    <div class="errorBox">
        Komanda nerasta!
    </div>
<?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Pavadinimas</th>
            <th>Metinis Biudzetas</th>
            <th></th>
        </tr>
        <?php
        /**
         * @var int $key
         * @var Team $val
         */
        foreach($data as $key => $val) : ?>

            <tr>
                <td><?php echo $val->getId(); ?></td>
                <td><?php echo $val->getName(); ?></td>
                <td><?php echo $val->getYearlyBudget() . ' EUR'; ?></td>
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

