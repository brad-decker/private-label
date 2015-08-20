<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>
<?php foreach($this->items as $i => $item): ?>
    <tr class="row<?php echo $i % 2; ?>">
        <td>
            <?php echo JHtml::_('grid.id', $i, $item->id); ?>
        </td>
        <td>
            <?php echo $item->id; ?>
        </td>
        <td>
            <?php echo $item->label; ?>
        </td>
        <td>
            <?php echo $item->subdomain; ?>
        </td>
        <td>
            <?php echo $item->subdomain_url; ?>
        </td>
        <td>
            <?php echo $item->enabled ? 'Yes' : 'NO'; ?>
        </td>
    </tr>
<?php endforeach; ?>