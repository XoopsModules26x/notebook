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
 * @version         $Id: notebook.php 9443 2012-05-06 20:39:08Z kraven30 $
 */
include dirname(__FILE__) . '/header.php';
// Get main instance
$system = System::getInstance();
// Check users rights
if (!$xoops->isUser() || !$xoops->isModule() || !$xoops->user->isAdmin($xoops->module->mid())) {
    exit(_NOPERM);
}
// Parameters
$nb_notebook = $xoops->getModuleConfig('notebook_pager');
$mimetypes = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/x-png', 'image/png');
$upload_size = 500000;
$system = System::getInstance();
// Get Action type
$op = $system->cleanVars($_REQUEST, 'op', 'list', 'string');
// Get notebook handler
$notebook_Handler = $xoops->getModuleHandler('notebook');
// Call Header
$xoops->header('notebook_notebook.html');

$admin_page = new XoopsModuleAdmin();
$admin_page->renderNavigation('notebook.php');

switch ($op) {

    case 'list':
    default:
        // Add Scripts
        $xoops->theme()->addScript('media/xoops/xoops.js');

        $admin_page->addTips(_AM_NOTEBOOK_TIPS);
        $admin_page->addItemButton(_AM_NOTEBOOK_ADD, 'notebook.php?op=new_notebook', 'add');
        $admin_page->renderTips();
        $admin_page->renderButton();
        // Get start pager
        $start = $system->cleanVars($_REQUEST, 'start', 0, 'int');
        // Criteria
        $criteria = new CriteriaCompo();
        $criteria->setSort("priority");
        $criteria->setOrder("DESC");
        $criteria->setStart($start);
        $criteria->setLimit($nb_notebook);
        // Count notebook
        $notebook_count = $notebook_Handler->getCount($criteria);
        $notebook_arr = $notebook_Handler->getall($criteria);
        // Assign Template variables
        $xoops->tpl()->assign('notebook_count', $notebook_count);
        if ($notebook_count > 0) {
            foreach (array_keys($notebook_arr) as $i) {
				$notebook['notebook_id'] = $notebook_arr[$i]->getVar("id");
                $notebook['title'] = $notebook_arr[$i]->getVar("title");
                $notebook['desc'] = $notebook_arr[$i]->getVar("desc");
				$notebook['date_created'] = XoopsLocale::formatTimestamp($notebook_arr[$i]->getVar("date_created"), "m");
				$user = $member_handler->getUser($notebook_arr[$i]->getVar("uid_creator"));
				$notebook['uid_creator'] = $user->getVar("uname");

				if($notebook_arr[$i]->getVar("status") == 0) {
					$status_color = "#FF0000";//#FFE4E1
					$status_name = _AM_NOTEBOOK_FORM_STATUS_MAKE;
					$status_pourcentage = "1";
				} else if($notebook_arr[$i]->getVar("status") == 1){
					$status_color = "#FFFF00";//#FFFFE0
					$status_name = _AM_NOTEBOOK_FORM_STATUS_PENDING;
					$status_pourcentage = "50";
				} else if($notebook_arr[$i]->getVar("status") == 2){
					$status_color = "#00FF00";//#98FB98
					$status_name = _AM_NOTEBOOK_FORM_STATUS_FINISHED;
					$status_pourcentage = "100";
				}

				$status =  "<span align='center' style='border: 1px solid rgb(0, 0, 0); background: rgb(255, 255, 255) none repeat scroll 0%; margin: 0 auto; text-align:center; display: block; height: 8px; width: 100%; float: left; overflow: hidden;'>
								<span style='background:".$status_color." none repeat scroll 0%; text-align:left; display: block; height: 8px; width: ".$status_pourcentage."%; float: left; overflow: hidden;'></span>
							</span><br />".$status_name;

				$notebook['status'] = $status;

				if($notebook_arr[$i]->getVar("priority") == 0) {
					$priority = '<img src="'.XOOPS_URL.'/modules/notebook/images/flag_yellow.png" title="'._AM_NOTEBOOK_PRIORITY_LOW.'" alt="'._AM_NOTEBOOK_PRIORITY_LOW.'" />';
				} else if($notebook_arr[$i]->getVar("priority") == 1){
					$priority = '<img src="'.XOOPS_URL.'/modules/notebook/images/flag_green.png" title="'._AM_NOTEBOOK_PRIORITY_NORMAL.'" alt="'._AM_NOTEBOOK_PRIORITY_NORMAL.'" />';
				} else if($notebook_arr[$i]->getVar("priority") == 2){
					$priority = '<img src="'.XOOPS_URL.'/modules/notebook/images/flag_red.png" title="'._AM_NOTEBOOK_PRIORITY_HIGH.'" alt="'._AM_NOTEBOOK_PRIORITY_HIGH.'" />';
				}
				$notebook['priority'] = $priority;
				$criteria1 = new CriteriaCompo();
				$criteria1->add(new Criteria('uid', '('.$notebook_arr[$i]->getVar("uid_attributed").')', 'IN'));
				//$attributed_arr = $member_handler->getUserList($criteria1);
				$attributed = '';
				foreach ($member_handler->getUserList($criteria1) as $value) {
					$attributed .= '<img src="'.XOOPS_URL.'/modules/notebook/images/arrow.png" />'.$value.'<br />';
				}

				$notebook['attributed'] = $attributed;
				$xoops->tpl()->append_by_ref('notebook', $notebook);
                unset($notebook);
				unset($user);
            }
        }
        // Display Page Navigation
        if ($notebook_count > $nb_notebook) {
            $nav = new XoopsPageNav($notebook_count, $nb_notebook, $start, 'start', 'op=list');
            $xoops->tpl()->assign('nav_menu', $nav->renderNav(2));
        }
        break;

    // New notebook
    case "new_notebook":
        $admin_page->addItemButton(_AM_NOTEBOOK_LIST, 'notebook.php', 'application-view-detail');
        $admin_page->renderTips();
        $admin_page->renderButton();
        // Create form
        $obj = $notebook_Handler->create();
        $form = $xoops->getModuleForm($obj, 'notebook');
        $xoops->tpl()->assign('form', $form->render());
    break;

    // Edit notebook
    case "edit_notebook":
        $admin_page->addItemButton(_AM_NOTEBOOK_ADD, 'notebook.php?op=new_notebook', 'add');
        $admin_page->addItemButton(_AM_NOTEBOOK_LIST, 'notebook.php', 'application-view-detail');
        $admin_page->renderTips();
        $admin_page->renderButton();
        // Create form
        $obj = $notebook_Handler->get($system->cleanVars($_REQUEST, 'notebook_id', 0, 'int'));
        $form = $xoops->getModuleForm($obj, 'notebook');
        $xoops->tpl()->assign('form', $form->render());
    break;

    // Save notebook
    case "save_notebook":
        if (!$xoops->security()->check()) {
            $xoops->redirect('notebook.php', 3, implode('<br />', $xoops->security->getErrors()));
        }

        if (isset($_POST["notebook_id"])) {
            $obj = $notebook_Handler->get($system->cleanVars($_POST, 'notebook_id', 0, 'int'));
        } else {
            $obj = $notebook_Handler->create();
			$obj->setVar("uid_creator", $xoopsUser->getVar('uid'));
        }
        // erreur
        $obj->setVar("title", $_POST["title"]);
        $obj->setVar("desc", $_POST["desc"]);
        if(isset($_POST["status"])) {
            $obj->setVar("status", $_POST["status"]);
        }
		$obj->setVar("priority", $_POST["priority"]);
        if (isset($_POST["date_created"])) {
            $obj->setVar("date_created", $_POST["date_created"]);
        }

		if(isset($_POST["uid_attributed"])) {
			$uid_attributed = implode(',', $_POST["uid_attributed"]);
			$obj->setVar("uid_attributed", $uid_attributed);
		} else {
			$obj->setVar("uid_attributed", $xoopsUser->getVar('uid'));
		}

        if ($notebook_Handler->insert($obj)) {
			$xoops->redirect("notebook.php", 2, _AM_NOTEBOOK_SAVE);
        }
        $xoops->error($obj->getHtmlErrors());
        $form = $xoops->getModuleForm($obj, 'notebook');
        $form->render();
        $xoops->tpl()->assign('form', true);
        break;

    //Delete a notebook
    case "notebook_delete":
        $admin_page->addItemButton(_AM_NOTEBOOK_ADD, 'notebook.php?op=new_notebook', 'add');
        $admin_page->addItemButton(_AM_NOTEBOOK_LIST, 'notebook.php', 'application-view-detail');
        $admin_page->renderButton();
        $notebook_id = $system->cleanVars($_REQUEST, 'notebook_id', 0, 'int');
        $obj = $notebook_Handler->get($notebook_id);
        if (isset($_POST["ok"]) && $_POST["ok"] == 1) {
            if (!$xoops->security()->check()) {
                $xoops->redirect("notebook.php", 3, implode(",", $xoops->security->getErrors()));
            }
            if ($notebook_Handler->delete($obj)) {
                $urlfile = XOOPS_UPLOAD_PATH . '/' . $obj->getVar("smile_url");
                if (is_file($urlfile)) {
                    chmod($urlfile, 0777);
                    unlink($urlfile);
                }
                $xoops->redirect("notebook.php", 2, _AM_NOTEBOOK_DELETED);
            } else {
                $xoops->error($obj->getHtmlErrors());
            }
        } else {
            // Define Stylesheet
            $xoops->theme()->addStylesheet('modules/system/css/admin.css');
            $notebook_img = ($obj->getVar("smile_url")) ? $obj->getVar("smile_url") : 'blank.gif';
            $xoops->confirm(array(
                                 "ok" => 1, "notebook_id" => $_REQUEST["notebook_id"], "op" => "notebook_delete"
                            ), XOOPS_URL . '/modules/notebook/admin/notebook.php', sprintf(_AM_NOTEBOOK_SUREDEL) . '<br /><img src="' . XOOPS_UPLOAD_URL . '/' . $notebook_img . '" alt=""><br />');
        }
    break;

}
$xoops->footer();