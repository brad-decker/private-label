<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla controller library
jimport('joomla.application.component.controller');

/**
 * General Controller of Subscription System component
 */
class PrivateLabelController extends JController
{
    /**
     * display task
     *
     * @return void
     */
    function display( $cachable = false, $urlparams = false )
    {
        $input = JFactory::getApplication()->input;
        $input->set( 'view', $input->getCmd( 'view', 'PrivateLabels' ) );

        parent::display( $cachable );
    }
}