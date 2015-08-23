<?php
// No direct access to this file
defined( '_JEXEC' ) or die( 'Restricted Access' );
?>
<tr>
    <th width="20">
        <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>);" />
    </th>
    <th width="5">
        ID
    </th>
    <th>
        Private Label
    </th>
    <th>
        Url
    </th>
    <th>
        Role
    </th>
</tr>