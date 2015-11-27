<?php
/**
 * [PHPFOX_HEADER]
 */

defined('PHPFOX') or exit('NO DICE!');

/**
 * 
 * 
 * @copyright		[PHPFOX_COPYRIGHT]
 * @author  		Raymond Benc
 * @package  		Module_User
 * @version 		$Id: add.class.php 6891 2013-11-15 16:37:37Z Fern $
 */
class User_Component_Controller_Admincp_Group_Add extends Phpfox_Component 
{
	/**
	 * Controller
	 */
	public function process()
	{			
		$iGroupId = $this->request()->getInt('id');		
		$sModule = $this->request()->get('module');
		
		$this->template()
			->setSectionTitle(Phpfox::getPhrase('user.manage_user_groups'))
			->setHeader('cache', array(
				'jquery/plugin/jquery.scrollTo.js' => 'static_script'
			)
		);
		
		if ($iGroupId)
		{		
			if ($this->request()->get('setting'))
			{
				Phpfox::getUserParam('user.can_manage_user_group_settings', true);		
			}
			else 
			{
				Phpfox::getUserParam('user.can_edit_user_group', true);
			}
			
			if ($aVals = $this->request()->getArray('val'))
			{
				if (Phpfox::getService('user.group.process')->update($iGroupId, $aVals))
				{
					$this->url()->send('admincp.user.group', null, Phpfox::getPhrase('user.user_group_updated'));
				}
			}	
			
			$aGroup = Phpfox::getService('user.group')->getGroup($iGroupId);
			
			// http://www.phpfox.com/tracker/view/14644/
			if(Phpfox::getParam('core.allow_cdn'))
			{
				$aGroup['server_id'] = Phpfox::getLib('cdn')->getServerId();
			}
			else
			{
				$aGroup['server_id'] = 0;
			}
			
			if (!isset($aGroup['user_group_id']))
			{
				return Phpfox_Error::display(Phpfox::getPhrase('user.invalid_user_group'));
			}				
			
			$this->template()->assign(array(
					'aModules' => Phpfox::getService('user.group.setting')->getModules($iGroupId),
					'aForms' => $aGroup,
					'sModule' => $sModule,
					'iGroupId' => $iGroupId,
					'bEditSettings' => ($this->request()->get('setting') ? true : false)
				)
			)
			->setBreadcrumb(Phpfox::getPhrase('user.manage_settings') . ': ' . Phpfox_Locale::instance()->convert($aGroup['title']) . ' (ID#' . $aGroup['user_group_id'] . ')', $this->url()->makeUrl('current'), true)
			->setHeader('cache', array(
					'template.css' => 'style_css'
				)
			);
		}
		else 
		{
			if ($aVals = $this->request()->getArray('val'))
			{
				if ($iId = Phpfox::getService('user.group.process')->add($aVals))
				{
					$this->url()->send('admincp.user.group', null, Phpfox::getPhrase('user.user_group_successfully_added'));
				}
			}
			
			$this->template()
				->setBreadcrumb(Phpfox::getPhrase('user.create_new_user_group'), $this->url()->makeUrl('current'), true)
				->setTitle(Phpfox::getPhrase('user.create_new_user_group'))
				->assign(array(
						'aGroups' => Phpfox::getService('user.group')->get()
					)
				);
		}
	}
}

?>
