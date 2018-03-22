<?php
use Utils\Routing;

$menuLeft = [
    'manufacturer' => 'Gamintojai',
    'track' => 'Trasos',
    'team' => 'Komandos',
    'driver' => 'Vairuotojai',
    'car' => 'Automobiliai',
];
$menuRight = [
    'report' => 'Ataskaitos'
];
?>

<div id="topMenu">
    <ul class="float-left">
        <?php foreach ($menuLeft as $key => $val) : ?>
            <li>
                <a href="<?php echo Routing::getURL($key); ?>"
                   title="<?php echo $val; ?>"
                    <?php if ($module == $key) : ?>
                        class="active"
                    <?php endif; ?>>
                    <?php echo $val; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>

    <ul class="float-right">
        <?php foreach ($menuRight as $key => $val) : ?>
            <li>
                <a href="<?php echo Routing::getURL($key); ?>"
                   title="<?php echo $val; ?>"
                    <?php if ($module == $key) : ?>
                        class="active"
                    <?php endif; ?>>
                    <?php echo $val; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
