<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

use Xoops\Core\Database\Connection;
use Xoops\Core\Kernel\XoopsObject;
use Xoops\Core\Kernel\XoopsPersistableObjectHandler;

/**
 * notebook module
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GNU GPL 2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
 * @package         notebook
 * @since           2.6.0
 * @author          Cointin Maxime (AKA Kraven30)
 * @version         $Id: notebook.php 9676 2012-06-19 21:05:06Z Kraven30 $
 */

defined('XOOPS_ROOT_PATH') or die('Restricted access');

/**
 * Class NotebookNotebook
 */
class NotebookNotebook extends XoopsObject
{
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->initVar('id', XOBJ_DTYPE_INT, null, false, 5);
        $this->initVar('title', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('description', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('uid_creator', XOBJ_DTYPE_INT, null, false, 11);
        $this->initVar('uid_attributed', XOBJ_DTYPE_TXTBOX, null, false);
        $this->initVar('date_created', XOBJ_DTYPE_INT, null, false, 10);
        $this->initVar('date_finished', XOBJ_DTYPE_INT, null, false, 10);
        $this->initVar('status', XOBJ_DTYPE_INT, null, false, 1);
        $this->initVar('priority', XOBJ_DTYPE_INT, null, false, 1);
    }
}

/**
 * Class NotebookNotebookHandler
 */
class NotebookNotebookHandler extends XoopsPersistableObjectHandler
{
    /**
     * @param null|Connection|XoopsDatabase $db
     */
    public function __construct(Connection $db = null)
    {
        parent::__construct($db, 'notebook', 'notebooknotebook', 'id', 'title');
    }
}
