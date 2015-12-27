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
 * @version         $Id: xoops_version.php 9798 2012-07-07 17:50:40Z Kraven30 $
 */

/*
 General settings
 */
$modversion                = array();
$modversion['name']        = _MI_NOTEBOOK_NAME;
$modversion['description'] = _MI_NOTEBOOK_DESC;
$modversion['version']     = 0.4;
$modversion['author']      = 'Cointin Maxime';
$modversion['nickname']    = 'Kraven30';
$modversion['credits']     = 'The XOOPS Project';
$modversion['license']     = 'GNU GPL 2.0';
$modversion['license_url'] = 'www.gnu.org/licenses/gpl-2.0.html/';
$modversion['official']    = 1;
$modversion['help']        = 'page=help';
$modversion['image']       = 'assets/images/logo.png';
$modversion['dirname']     = 'notebook';
//6KJ7RW5DR3VTJ
/*
 Settings for configs
*/
$modversion['release_date']        = '2013/01/06';
$modversion['module_website_url']  = 'http://www.xoops.org/';
$modversion['module_website_name'] = 'XOOPS';
$modversion['module_status']       = 'Beta 1';
$modversion['min_php']             = '5.4';
$modversion['min_xoops']           = '2.6.0';
$modversion['min_db']              = array('mysql' => '5.0.7', 'mysqli' => '5.0.7');

// paypal
$modversion['paypal']                  = array();
$modversion['paypal']['business']      = 'xoopsfoundation@gmail.com';
$modversion['paypal']['item_name']     = _MI_NOTEBOOK_DESC;
$modversion['paypal']['amount']        = 0;
$modversion['paypal']['currency_code'] = 'EUR';

// Admin menu
$modversion['system_menu'] = 1;
// Mysql file
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';

// Tables created by sql file (without prefix!)
$modversion['tables'][1] = 'notebook';

// Admin things
$modversion['hasAdmin']   = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu']  = 'admin/menu.php';

// Scripts to run upon installation or update
//$modversion['onInstall'] = 'include/install.php';

// JQuery
$modversion['jquery'] = 1;

// Menu
//$modversion['hasMain'] = 1;

/*
 Preferences
*/
$i                                       = 0;
$modversion['config'][$i]['name']        = 'notebook_pager';
$modversion['config'][$i]['title']       = '_MI_NOTEBOOK_PREFERENCE_PAGER';
$modversion['config'][$i]['description'] = '';
$modversion['config'][$i]['formtype']    = 'textbox';
$modversion['config'][$i]['valuetype']   = 'int';
$modversion['config'][$i]['default']     = 20;
++$i;
