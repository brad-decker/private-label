<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.application.component.modellist' );

class PrivateLabelModelPrivateLabels extends JModelList
{

    /**
     * Get a list of all virtual domains not already mapped to a private label
     * @return mixed
     */
    public function getVirtualDomains() {
        $db = JFactory::getDBO();

        $query = $db->getQuery( true );
        $subQuery = $db->getQuery( true );

        $subQuery->select( $db->quoteName( 'virtual_domain_id' ) )
            ->from( $db->quoteName( '#__private_label' )  )
            ->where( $db->quoteName( 'subdomain' ) . ' = 1' );

        $query->select( '*' )
            ->from( $db->quoteName( '#__virtualdomain') )
            ->where( $db->quoteName( 'id' ) . ' IN (' . $subQuery . ')' );

        $db->setQuery( $query );

        $results = $db->loadObjectList();

        return $results;
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

        $plTable =  $db->quoteName('#__private_label', 'pl');
        $plVdId = $db->quoteName( 'pl.virtual_domain_id' );

        $vdTable = $db->quoteName('#__virtualdomain', 'vd');

        $vdId = $db->quoteName('vd.id');

        $fields =  array('pl.id', 'pl.label', 'pl.subdomain', 'pl.enabled', 'vd.domain' );

        $select = $db->quoteName( $fields );

        $join = "${vdTable} ON ${plVdId} = ${vdId}";

        // Select some fields
        $query->select( $select );
        // From the hello table
        $query->from( $plTable )->leftJoin($join );
        return $query;
    }
}