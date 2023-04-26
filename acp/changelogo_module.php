<?php
/**
 *
 * Simple logo changer for the phpBB Forum Software package.
 *
 * @copyright (c) 2023 - cabot
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
		global $template, $request, $config, $user, $phpbb_log, $language;

		$this->tpl_name = 'acp_changelogo';
		$language->add_lang('acp_changelogo', 'cabot/changelogo');
		$this->page_title = $language->lang('ACP_CHANGELOGO');

		add_form_key('changelogo/acp_changelogo');

		$submit = $request->is_set_post('submit');
		if ($submit)
		{
			if (!check_form_key('changelogo/acp_changelogo'))
			{
				trigger_error('FORM_INVALID');
			}

			$config->set('changelogo_url', $request->variable('changelogo_url', ''));
			$config->set('changelogo_width', $request->variable('changelogo_width', ''));
			$config->set('changelogo_height', $request->variable('changelogo_height', ''));

			$user_id = $user->data['user_id'];
			$user_ip = $user->ip;

			$phpbb_log->add('admin', $user_id, $user_ip, 'ACP_CHANGELOGO_SAVE');
			trigger_error($language->lang('ACP_CHANGELOGO_SAVE') . adm_back_link($this->u_action));
		}

		$template->assign_vars([
			'CHANGELOGO_URL'		=> $config['changelogo_url'],
			'CHANGELOGO_WIDTH'		=> $config['changelogo_width'],
			'CHANGELOGO_HEIGHT'		=> $config['changelogo_height'],
		]);
	}
}
