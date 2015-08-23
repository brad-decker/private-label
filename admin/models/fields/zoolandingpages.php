<?php
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

jimport('joomla.form.formfield');

class JFormFieldZooLandingPages extends JFormField {

    protected $type = 'ZooLandingPages';

    // getLabel() left out

    public function getOptions () {
        $db = JFactory::getDBO();

        $query = $db->getQuery( true );

        $query->select( '*' )
            ->from( $db->quoteName( '#__zoo_item', 'zi' ) )
            ->where( 'zi.application_id = "7"' );

        $db->setQuery( $query );
        if ( !$db->query() ) {
            echo $db->getErrorMsg();
        }
        $results = $db->loadObjectList();
        return $results;
    }

    public function getInput() {
        $options = $this->getOptions();
        $optionsHtml = "<option value=''>Choose One</option>";
        foreach( $options as $option ) {
            $optionsHtml .= "<option value='{$option->id}'>{$option->name}</option>";
        }
        return "<select data-type='subdomain' id='{$this->id}' name='{$this->name}'>{$optionsHtml}</select>";
    }
}