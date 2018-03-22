<?php
/**
 * Created by PhpStorm.
 * User: eimantas
 * Date: 18.3.17
 * Time: 19.52
 */
/** @var \Form\Field $formField */
    $formField = $field;
?>

<fieldset class="embed-form">
    <legend><?php echo $formField->getLabel(); ?></legend>

    <div class="childRowContainer">
        <?php if ($formField->getValue()) : ?>

            <?php foreach ($formField->getValue() as $form): ?>
                <div class="childRow">
                    <hr/>
                    <?php foreach ($form->getFields() as $field) : ?>
                        <?php $field->setName($formField->getName() . '[' . $field->getName() . '][]'); ?>
                        <p>
                            <?php require(sprintf('view/form/field/%s.php', $field->getType())); ?>

                            <?php if ($field->getMaxLength()) : ?>
                                <span class='max-len'>(iki <?php echo $field->getMaxLength(); ?> simb.)</span>
                            <?php endif; ?>
                        </p>
                    <?php endforeach; ?>
                    <a href="#" title="" class="removeChild">šalinti</a>
                </div>
            <?php endforeach; ?>

        <?php else : ?>

        <div class="childRow hidden">
            <hr/>
            <?php foreach ($formField->getFormType()->getFields() as $field) : ?>
                <?php $field->setName($formField->getName() . '[' . $field->getName() . '][]'); ?>
                <p>
                    <?php require(sprintf('view/form/field/%s.php', $field->getType())); ?>

                    <?php if ($field->getMaxLength()) : ?>
                        <span class='max-len'>(iki <?php echo $field->getMaxLength(); ?> simb.)</span>
                    <?php endif; ?>
                </p>
            <?php endforeach; ?>
            <a href="#" title="" class="removeChild">šalinti</a>
        </div>

        <?php endif; ?>
    </div>

    <p id="newItemButtonContainer">
        <a href="#" title="" class="addChild">Pridėti</a>
    </p>
</fieldset>
