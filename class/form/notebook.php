<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * notebook module
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package         notebook
 * @since           2.6.0
 * @author          Cointin Maxime (AKA Kraven30)
 */

/**
 * Class NotebookNotebookForm
 */
class NotebookNotebookForm extends Xoops\Form\ThemeForm
{
    /**
     * NotebookNotebookForm constructor.
     * @param NotebookNotebook $obj
     */
    public function __construct(NotebookNotebook $obj)
    {
        $title = $obj->isNew() ? sprintf(_AM_NOTEBOOK_ADD) : sprintf(_AM_NOTEBOOK_EDIT);

        parent::__construct($title, 'form', 'notebook.php', 'post', true);

        $this->addElement(new XoopsFormText(_AM_NOTEBOOK_FORM_TITLE, 'title', 80, 255, $obj->getVar('title')), true);
        $this->addElement(new xoopsFormTextArea(_AM_NOTEBOOK_FORM_DESC, 'description', $obj->getVar('description'), 8, 50), false);
        if (!$obj->isNew()) {
            $uname   = new XoopsFormSelect(_AM_NOTEBOOK_FORM_STATUS, 'status', $obj->getVar('status'));
            $options = array(0 => _AM_NOTEBOOK_FORM_STATUS_MAKE, 1 => _AM_NOTEBOOK_FORM_STATUS_PENDING, 2 => _AM_NOTEBOOK_FORM_STATUS_FINISHED);
            $uname->addOptionArray($options);
            $this->addElement($uname, true);
        } else {
            $this->addElement(new XoopsFormHidden('date_created', time()));
        }

        $priority = new XoopsFormSelect(_AM_NOTEBOOK_PRIORITY, 'priority', $obj->getVar('priority'));
        $options  = array(2 => _AM_NOTEBOOK_PRIORITY_HIGH, 1 => _AM_NOTEBOOK_PRIORITY_NORMAL, 0 => _AM_NOTEBOOK_PRIORITY_LOW);
        $priority->addOptionArray($options);
        $this->addElement($priority, true);
        $this->addElement(new XoopsFormSelectUser(_AM_NOTEBOOK_UID_ATTRIBUTED, 'uid_attributed', false, null, 5, true));

        if (!$obj->isNew()) {
            $this->addElement(new XoopsFormHidden('notebook_id', $obj->getVar('id')));
        }
        $this->addElement(new XoopsFormHidden('op', 'save_notebook'));
        $this->addElement(new XoopsFormButton('', 'submit', XoopsLocale::A_SUBMIT, 'submit'));
    }
}
