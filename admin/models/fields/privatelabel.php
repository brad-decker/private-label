<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldPrivateLabel extends JFormField {

    protected $type = 'PrivateLabel';

    // getLabel() left out

    public function getOptions () {
        $db = JFactory::getDBO();

        $query = $db->getQuery( true );

        $query->select( '*' )
            ->from( $db->quoteName( '#__private_label') );

        JFactory::getApplication()->setError('test');

        $db->setQuery( $query );
        $results = $db->loadObjectList();
        $options = array();
        foreach ( $results as $result ) {
            $options[$result->id] = $result->label;
        }
        return $options;
    }

    public function getInput() {
        $options = $this->getOptions();
        return JHtml::_('select.genericlist', $options, $this->name, null, 'value', 'text', $this->value, $this->id);
    }
}