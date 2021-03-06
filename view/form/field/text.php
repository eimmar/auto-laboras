<?php
/** @var \Form\Field $field */
?>
<label class="field"
       for="<?php echo $field->getName(); ?>">
    <?php echo $field->getLabel(); ?>
    <?php echo $field->isRequired() ? '<span> *</span>' : ''; ?>
</label>

<input type="<?php echo $field->getType(); ?>"
       id="<?php echo $field->getName(); ?>"
       name="<?php echo $field->getName(); ?>"
       class="textbox-150 <?php echo $field->getClass(); ?><?php if ($field->hasError()) :?> has-error <?php endif; ?>"
       value="<?php echo $field->getValue(); ?>"
/>
