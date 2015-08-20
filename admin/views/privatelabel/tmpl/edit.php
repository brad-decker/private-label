<?php
// No direct access
defined('_JEXEC') or die('Restricted access');
JHtml::_('behavior.tooltip');
?>
<form action="<?php echo JRoute::_('index.php?option=com_privatelabel&layout=edit&id='.(int) $this->item->id); ?>"
      method="post" name="adminForm" id="adminForm">
    <fieldset class="adminform">
        <legend>Private Label Details</legend>
        <ul class="adminformlist">
            <?php foreach($this->form->getFieldset() as $field): ?>
                <li style="clear:both;"><?php echo $field->label;echo $field->input;?></li>
            <?php endforeach; ?>
        </ul>
    </fieldset>
    <div>
        <input type="hidden" name="task" value="privatelabel.edit" />
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>