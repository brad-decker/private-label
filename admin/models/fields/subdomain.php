<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldSubdomain extends JFormField {

    protected $type = 'Subdomain';

    // getLabel() left out

    public function getOptions () {
        $db = JFactory::getDBO();

        $query = $db->getQuery( true );

        $query->select( '*' )
            ->from( $db->quoteName( '#__virtualdomain') );

        JFactory::getApplication()->setError('test');

        $db->setQuery( $query );
        $results = $db->loadObjectList();
        return $results;
    }

    public function getInput() {
        $options = $this->getOptions();
        $optionsHtml = "<option value=''>Choose One</option>";
        foreach( $options as $option ) {
            $optionsHtml .= "<option value='{$option->id}'>{$option->domain}</option>";
        }
        return "<select data-type='subdomain' id='{$this->id}' name='{$this->name}'>{$optionsHtml}</select>";
    }
}