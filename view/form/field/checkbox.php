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
       class="textbox-150 <?php echo $field->getClass(); ?>"
       value="<?php echo $field->getValue(); ?>"
     <?php echo $field->getValue() ? 'checked' : ''; ?>

/>
