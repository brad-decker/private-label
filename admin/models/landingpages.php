<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.modellist' );

class PrivateLabelModelLandingPages extends JModelList
{

    /**
     * Method to build an SQL query to load the list data.
     *
     * @return      string  An SQL query
     */
    protected function getListQuery()
    {
        // Create a new query object.
        $db = JFactory::getDBO();

        $query = $db->getQuery(true);

        $query->select( '*' )
            ->from( $db->quoteName( '#__private_label_pages' ) );

        return $query;
    }
}