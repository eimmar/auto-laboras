<?php
/** @var \Form\BaseForm $form */
if ((!$form->isValid())) : ?>
    <div class="errorBox">
        <p>Neįvesti arba neteisingai įvesti šie laukai:</p>
        <?php foreach ($form->getFields() as $field) :?>
            <?php if ($field->hasError()) :?>
                <p><?php echo $field->getLabel(); ?></p>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

