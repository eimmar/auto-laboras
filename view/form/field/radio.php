<?php
/** @var \Form\Field $field */
?>
<label class="field"
       for="<?php echo $field->getName(); ?>">
    <?php echo $field->getLabel(); ?>
    <?php echo $field->isRequired() ? '<span> *</span>' : ''; ?>
</label>

<?php foreach ($field->getOptions() as $option) : ?>
    <input type="<?php echo $field->getType(); ?>"
           name="<?php echo $field->getName(); ?>"
           id="<?php echo $field->getName()?>"
           value="<?php echo $option->getValue()?>"
        <?php echo ($option->getValue() == $field->getValue()) ? 'checked' : ''; ?>
    >
    <?php echo $option->getLabel(); ?><br/>
<?php endforeach; ?>
