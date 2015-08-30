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
            ->from( $db->quoteName( '#__virtualdomain', 'vd' ) )
            ->leftJoin( $db->quoteName( '#__private_label', 'pl' ) . ' ON (' . $db->quoteName( 'vd.id' ) . ' = ' . $db->quoteName( 'pl.virtual_domain_id' ) . ')' )
            ->where( $db->quoteName( 'pl.virtual_domain_id' ) . ' IS NULL') ;

        JFactory::getApplication()->setError('test');

        $db->setQuery( $query );

        $results = $db->loadObjectList();
        $options = array('' => 'Choose One');

        foreach ( $results as $result ) {
            $options[$result->id] = $result->domain;
        }
        return $options;
    }

    public function getInput() {
        $options = $this->getOptions();
        return JHtml::_('select.genericlist', $options, $this->name, null, 'value', 'text', $this->value, $this->id);
    }
}