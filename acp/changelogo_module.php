<?php
/**
 *
 * Simple logo changer for the phpBB Forum Software package.
 *
 * @copyright (c) 2023-2025 - cabot
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace cabot\changelogo\acp;

/**
 * @package acp
*/

class changelogo_module
{
	/** @var string */
	public $u_action;

	/** @var string */
	public $tpl_name;

	/** @var string */
	public $page_title;

	function main($id, $mode)
	{
		global $phpbb_container;

		/** @var \cabot\changelogo\controller\acp_controller $acp_controller */
		$acp_controller = $phpbb_container->get('cabot.changelogo.controller.acp');

		// Load a template from adm/style for our ACP page
		$this->tpl_name = 'acp_changelogo';

		// Set the page title for our ACP page
		$this->page_title = 'ACP_CHANGELOGO';

		// Make the $u_action url available in our ACP controller
		$acp_controller->set_page_url($this->u_action);

		// Load the display options handle in our ACP controller
		$acp_controller->display_options();
	}
}
