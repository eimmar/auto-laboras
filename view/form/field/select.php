<?php
/** @var \Form\Field $field */
?>
<label class="field"
       for="<?php echo $field->getName(); ?>">
    <?php echo $field->getLabel(); ?>
    <?php echo $field->isRequired() ? '<span> *</span>' : ''; ?>
</label>

<select name="<?php echo $field->getName(); ?>"
        id="<?php echo $field->getName(); ?>"
        class="<?php echo $field->getClass(); ?>">
    <option value="">Pasirinkite</option>

        <?php foreach ($field->getOptions() as $option) : ?>
            <option value="<?php echo $option->getValue()?>"
                <?php echo ($option->getValue() == $field->getValue()) ? 'selected' : ''; ?>
            >
                <?php echo $option->getLabel(); ?>
            </option>
        <?php endforeach; ?>
</select>
