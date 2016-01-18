<script type="text/javascript">
    Xoops.setStatusImg('accept', '<{xoAdminIcons 'success.png'}>');
    Xoops.setStatusImg('cancel', '<{xoAdminIcons 'cancel.png'}>');
    Xoops.setStatusText('accept', '<{$smarty.const._AM_NOTEBOOK_OFF}>');
    Xoops.setStatusText('cancel', '<{$smarty.const._AM_NOTEBOOK_ON}>');
</script>
<{include file="admin:system/admin_navigation.tpl"}>
<{include file="admin:system/admin_tips.tpl"}>
<{include file="admin:system/admin_buttons.tpl"}>
<{if isset($notebook_count)}>
<table id="xo-notebook-sorter" class="outer tablesorter">
    <thead>
    <tr>
        <th class="txtcenter"><{$smarty.const._AM_NOTEBOOK_CREATE}></th>
        <th class="txtcenter"><{$smarty.const._AM_NOTEBOOK_PRIORITY}></th>
        <th class="txtleft"><{$smarty.const._AM_NOTEBOOK_INFOS}></th>
        <th class="txtcenter"><{$smarty.const._AM_NOTEBOOK_ATTRIBUTED}></th>
        <th class="txtcenter"><{$smarty.const._AM_NOTEBOOK_STATUS}></th>
        <th class="txtcenter"><{$smarty.const._AM_NOTEBOOK_ACTION}></th>
    </tr>
    </thead>
    <tbody>
    <{if isset($notebooks)}>
    <{foreach item=notebook from=$notebooks}>
    <tr class="<{cycle values='even,odd'}> alignmiddle">
        <td class="txtcenter width2"><{$notebook.date_created}><br /> <{$smarty.const._AM_NOTEBOOK_CREATEDBY}> <{$notebook.uid_creator}></td>
        <td class="txtcenter width1"><{$notebook.priority}></td>
        <td class="txtleft width10"><strong><{$notebook.title}></strong><br /><{$notebook.description}></td>
        <td class="txtleft width2"><{$notebook.attributed}></td>
        <td class="txtcenter width1"><{$notebook.status}></td>
        <td class="xo-actions txtcenter width2">
            <a href="notebook.php?op=edit_notebook&amp;notebook_id=<{$notebook.notebook_id}>" title="<{$smarty.const._AM_NOTEBOOK_EDIT}>">
                <img src="<{xoAdminIcons 'edit.png'}>" alt="<{$smarty.const._AM_NOTEBOOK_EDIT}>">
            </a>
            <a href="notebook.php?op=notebook_delete&amp;notebook_id=<{$notebook.notebook_id}>" title="<{$smarty.const._AM_NOTEBOOK_DELETE}>">
                <img src="<{xoAdminIcons 'delete.png'}>" alt="<{$smarty.const._AM_NOTEBOOK_DELETE}>">
            </a>
        </td>
    </tr>
    <{/foreach}>
    <{/if}>
    </tbody>
</table>
<div style="float:right;margin-right:10px;">
    <img src="<{$xoops_url}>/modules/notebook/assets/images/flag_yellow.png" />&nbsp;<{$smarty.const._AM_NOTEBOOK_PRIORITY_LOW}>&nbsp;&nbsp;
    <img src="<{$xoops_url}>/modules/notebook/assets/images/flag_green.png" />&nbsp;<{$smarty.const._AM_NOTEBOOK_PRIORITY_NORMAL}>&nbsp;&nbsp;
    <img src="<{$xoops_url}>/modules/notebook/assets/images/flag_red.png" />&nbsp;<{$smarty.const._AM_NOTEBOOK_PRIORITY_HIGH}>&nbsp;&nbsp;
</div>
<!-- Display notebook navigation -->
<div class="clear spacer"></div>
<{if isset($nav_menu)}>
<div class="xo-avatar-pagenav floatright"><{$nav_menu}></div>
<div class="clear spacer"></div>
<{/if}>
<{/if}>
<!-- Display notebook form (add,edit) -->
<{if isset($form)}>
<{$form}>
<{/if}>
