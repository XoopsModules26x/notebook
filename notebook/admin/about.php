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
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         notebook
 * @since           2.6.0
 * @author          Cointin Maxime (AKA Kraven30)
 * @version         $Id: about.php 8470 2011-12-12 21:50:07Z kraven30 $
 */
include dirname(__FILE__) . '/header.php';
$xoops->header();
$aboutAdmin = new XoopsModuleAdmin();
$aboutAdmin->renderNavigation('about.php');
$aboutAdmin->renderabout('6KJ7RW5DR3VTJ', true);
$xoops->footer();