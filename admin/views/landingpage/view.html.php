<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * HelloWorlds View
 */
class PrivateLabelViewLandingPage extends JView
{
    /**
     * LandingPage view display method
     * @return void
     */
    function display($tpl = null)
    {
        // Get data from the model
        $form = $this->get('Form');
        $item = $this->get('Item');

        // Check for errors.
        if (count($errors = $this->get('Errors')))
        {
            JError::raiseError(500, implode('<br />', $errors));
            return false;
        }
        // Assign data to the view
        $this->form = $form;
        $this->item = $item;

        $this->addToolBar();

        // Display the template
        parent::display($tpl);
    }

    /**
     * Setting the toolbar
     */
    protected function addToolBar()
    {
        $input = JFactory::getApplication()->input;
        $input->set('hidemainmenu', true);
        $isNew = ($this->item->id == 0);
        JToolBarHelper::title($isNew ? JText::_('New Private Label Landing Page')
            : JText::_('Edit Private Label Landing Page'));
        JToolBarHelper::save('landingpage.save');
        JToolBarHelper::cancel('landingpage.cancel', $isNew ? 'JTOOLBAR_CANCEL'
            : 'JTOOLBAR_CLOSE');
    }
}