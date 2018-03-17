<?php
require('view/header.php');

use Form\ManufacturerForm;
use Utils\Routing;

/** @var ManufacturerForm $form */
?>
    <ul id="pagePath">
        <li><a href="<?php echo Routing::getURL(); ?>">Pradžia</a></li>
        <li><a href="<?php echo Routing::getURL($module); ?>"><?php echo $form->getName(); ?></a></li>
        <li>
            <?php if (!empty($id)) : ?>
                Redaguoti
            <?php else : ?>
                Naujas
            <?php endif; ?>
        </li>
    </ul>
    <div class="float-clear"></div>
    <div id="formContainer">
        <?php require('view/formErrors.php'); ?>
        <form action="" method="post">
            <fieldset>
                <legend>Informacija</legend>


                <?php foreach ($form->getFields() as $field) : ?>
                    <?php if ($field->getType() !== \Form\BaseForm::FORM_TYPE) : ?>
                        <p>
                            <?php require(sprintf('view/form/field/%s.php', $field->getType())); ?>

                            <?php if ($field->getMaxLength()) : ?>
                                <span class='max-len'>(iki <?php echo $field->getMaxLength(); ?> simb.)</span>
                            <?php endif; ?>
                        </p>
                    <?php endif; ?>
                <?php endforeach; ?>

            </fieldset>

            <?php foreach ($form->getFields() as $field) : ?>
                <?php if ($field->getType() === \Form\BaseForm::FORM_TYPE) : ?>
                    <p>
                        <?php require(sprintf('view/form/field/%s.php', $field->getType())); ?>

                        <?php if ($field->getMaxLength()) : ?>
                            <span class='max-len'>(iki <?php echo $field->getMaxLength(); ?> simb.)</span>
                        <?php endif; ?>
                    </p>
                <?php endif; ?>
            <?php endforeach; ?>

            <p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
            <p>
                <input type="submit" class="submit" name="submit" value="Išsaugoti">
            </p>
        </form>
    </div>
<?php
require('view/footer.php');

