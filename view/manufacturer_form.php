<?php
require('header.php');

use Form\ManufacturerForm;
use Utils\Routing;

?>
    <ul id="pagePath">
        <li><a href="<?php echo Routing::getURL(); ?>">Pradžia</a></li>
        <li><a href="<?php echo Routing::getURL($module); ?>">Gamintojai</a></li>
        <li>
            <?php if (!empty($id)) : ?>
                Gamintojo redagavimas
            <?php else : ?>
                Naujas gamintojas
            <?php endif; ?>
        </li>
    </ul>
    <div class="float-clear"></div>
    <div id="formContainer">
        <?php require("formErrors.php"); ?>
        <form action="" method="post">
            <fieldset>
                <legend>Gamintojo informacija</legend>


                <?php
                /** @var ManufacturerForm $form */
                foreach ($form->getFields() as $field) : ?>
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
                               value="<?php echo $field->getDefaultValue(); ?>"
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
require('footer.php');

