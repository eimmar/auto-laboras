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
                    <p>
                        <label class="field"
                               for="<?php echo $field->getName(); ?>">
                            <?php echo $field->getLabel(); ?>
                            <?php echo $field->isRequired() ? '<span> *</span>' : ''; ?>
                        </label>

                        <input type="<?php echo $field->getType(); ?>"
                               id="<?php echo $field->getName(); ?>"
                               name="<?php echo $field->getName(); ?>"
                               class="textbox-150 <?php echo $field->getClass(); ?>"
                               value="<?php echo $field->getValue(); ?>"
                        />

                        <?php if ($field->getMaxLength()) : ?>
                            <span class='max-len'>(iki <?php echo $field->getMaxLength(); ?> simb.)</span>
                        <?php endif; ?>
                    </p>
                <?php endforeach; ?>

            </fieldset>
            <p class="required-note">* pažymėtus laukus užpildyti privaloma</p>
            <p>
                <input type="submit" class="submit" name="submit" value="Išsaugoti">
            </p>
        </form>
    </div>
<?php
require('view/footer.php');

