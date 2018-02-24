<?php
require('header.php');

use Model\Driver;
use Utils\Routing;

?>
    <ul id="pagePath">
        <li><a href="<?php echo Routing::getURL(); ?>">Pradžia</a></li>
        <li>Vairuotojai</li>
    </ul>
    <div id="actions">
        <a href='<?php echo Routing::getURL($module, 'create'); ?>'>Naujas</a>
    </div>
    <div class="float-clear"></div>

<?php if (!empty($delete_error)) : ?>
    <div class="errorBox">
        Sis vairuotojas negali buti pasalintas.
    </div>
<?php endif; ?>

<?php if (!empty($id_error)) : ?>
    <div class="errorBox">
        Vairuotojas nerastas!
    </div>
<?php endif; ?>

    <table>
        <tr>
            <th>ID</th>
            <th>Vardas</th>
            <th>Pavarde</th>
            <th>Amzius</th>
            <th>Vairavimo stazas</th>
            <th>Lytis</th>
            <th>Komanda</th>
            <th></th>
        </tr>
        <?php
        /**
         * @var int $key
         * @var Driver $val
         */
        foreach($data as $key => $val) : ?>

            <tr>
                <td><?php echo $val->getId(); ?></td>
                <td><?php echo $val->getFirstName(); ?></td>
                <td><?php echo $val->getLastName(); ?></td>
                <td><?php echo $val->getAge(); ?></td>
                <td><?php echo $val->getDrivingExperienceYears() . ' m'; ?></td>
                <td><?php echo $val->getGender()->getName() ?></td>
                <td><?php echo $val->getTeam()->getName() ?></td>
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
require('paging.php');
require('footer.php');

