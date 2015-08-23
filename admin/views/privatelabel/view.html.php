<?php
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

// import Joomla view library
jimport('joomla.application.component.view');

/**
 * HelloWorlds View
 */
class PrivateLabelViewPrivateLabel extends JView
{
    /**
     * HelloWorlds view display method
     * @return void
     */
    function display($tpl = null)
    {
        // Get data from the model
        $form = $this->get('Form');
        $item = $this->get('Item');

        error_log('test');

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
        JToolBarHelper::title($isNew ? JText::_('New Private Label')
            : JText::_('Edit Private Label'));
        JToolBarHelper::save('privatelabel.save');
        JToolBarHelper::cancel('privatelabel.cancel', $isNew ? 'JTOOLBAR_CANCEL'
            : 'JTOOLBAR_CLOSE');
    }
}