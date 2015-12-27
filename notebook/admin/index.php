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
 * @version         $Id: index.php 8487 2011-12-14 18:13:51Z kraven30 $
 */
include __DIR__ . '/header.php';
// Get notebook handler
$notebook_Handler = $xoops->getModuleHandler('notebook');
$xoops            = Xoops::getInstance();
$xoops->header();
// notebook to do
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('status', 0));
$notebook_todo = $notebook_Handler->getCount($criteria);
// notebook in progress
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('status', 1));
$notebook_inprogress = $notebook_Handler->getCount($criteria);
// notebook completed
$criteria = new CriteriaCompo();
$criteria->add(new Criteria('status', 2));
$notebook_completed = $notebook_Handler->getCount($criteria);

$admin_page = new \Xoops\Module\Admin();
$admin_page->displayNavigation('index.php');

$admin_page->addInfoBox(_MI_NOTEBOOK_NOTEBOOK);
$admin_page->addInfoBoxLine(sprintf(_AM_NOTEBOOK_NB_TODO, '<span class="red">' . $notebook_todo . '</span>'));
$admin_page->addInfoBoxLine(sprintf(_AM_NOTEBOOK_NB_INPROGRESS, '<span style="color:#FF8C00;">' . $notebook_inprogress . '</span>'));
$admin_page->addInfoBoxLine(sprintf(_AM_NOTEBOOK_NB_COMPLETED, '<span class="green">' . $notebook_completed . '</span>'));

$admin_page->displayIndex();

$xoops->footer();
