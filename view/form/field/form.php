<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.17
 * Time: 19.52
 */
/** @var \Form\Field $field */

?>

<fieldset class="embed-form">
    <legend><?php echo $field->getFormType()->getName(); ?></legend>

    <div class="childRowContainer">
        <div class="childRow hidden">
            <?php foreach ($field->getFormType()->getFields() as $field) : ?>
                <?php $field->setName($field->getName() . '[]'); ?>
                <p>
                    <?php require(sprintf('view/form/field/%s.php', $field->getType())); ?>

                    <?php if ($field->getMaxLength()) : ?>
                        <span class='max-len'>(iki <?php echo $field->getMaxLength(); ?> simb.)</span>
                    <?php endif; ?>
                </p>
            <?php endforeach; ?>
            <a href="#" title="" class="removeChild">šalinti</a>
        </div>
    </div>

    <p id="newItemButtonContainer">
        <a href="#" title="" class="addChild">Pridėti</a>
    </p>
</fieldset>
