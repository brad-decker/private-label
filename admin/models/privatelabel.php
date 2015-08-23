<?php
// No direct access to this file
defined( '_JEXEC' ) or die( 'Restricted access' );

// import Joomla modelform library
jimport( 'joomla.application.component.modeladmin' );

/**
 * HelloWorld Model
 */
class PrivateLabelModelPrivateLabel extends JModelAdmin
{
    var $componentName = 'privatelabel';
    var $fullName = 'com_privatelabel.privatelabel';
    /**
     * Returns a reference to the a Table object, always creating it.
     *
     * @param       type    The table type to instantiate
     * @param       string  A prefix for the table class name. Optional.
     * @param       array   Configuration array for model. Optional.
     * @return      JTable  A database object
     * @since       2.5
     */
    public function getTable( $type = 'PrivateLabel', $prefix = 'PrivateLabelTable', $config = array() )
    {
        return JTable::getInstance( $type, $prefix, $config );
    }
    /**
     * Method to get the record form.
     *
     * @param       array   $data           Data for the form.
     * @param       boolean $loadData       True if the form is to load its own data (default case), false if not.
     * @return      mixed   A JForm object on success, false on failure
     * @since       2.5
     */
    public function getForm( $data = array(), $loadData = true )
    {

        $options = array(
            'control' => 'jform',
            'load_data' => $loadData
        );

        // Get the form.
        $form = $this->loadForm( $this->fullName, $this->componentName, $options );
        if (empty($form))
        {
            return false;
        }
        return $form;
    }
    /**
     * Method to get the data that should be injected in the form.
     *
     * @return      mixed   The data for the form.
     * @since       2.5
     */
    protected function loadFormData()
    {
        error_log('test');
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState('com_privatelabel.edit.privatelabel.data', array());
        if (empty($data)) {
            $data = $this->getItem();
        }
        return $data;
    }

    public function addVirtualDomain( $domain, $menuid ) {
        $db = JFactory::getDBO();

        $domain = $db->quoteName( $domain );

        $query = $db->getQuery( true );

        $query->insert( $db->quoteName( '#__virtualdomain' ) )
            ->columns(
                $db->quoteName(
                    'published', 'menuid', 'domain'
                )
            )
            ->values("1,${$menuid},{$domain}");

        $db->setQuery( $query );

        if ( !$db->query() ) {
            error_log( $db->getErrorMsg() );
            return null;
        }

        return $db->insertid();

    }

    public function save($data)
    {
        $table = $this->getTable();
        $key = $table->getKeyName();
        $pk = (!empty($data[$key])) ? $data[$key] : (int) $this->getState($this->getName() . '.id');
        $isNew = true;

        if ( $pk > 0 ) {
            $isNew = false;
        }

        if ( $isNew && $data['subdomain'] === 1) {
            // Do something.
        }

        $return = parent::save($data);
        return $return;
    }
}