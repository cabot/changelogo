<?php
/**
 *
 * Simple logo changer for the phpBB Forum Software package.
 *
 * @copyright (c) 2023 - cabot
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace cabot\changelogo\migrations;

class changelogo_install extends \phpbb\db\migration\migration
{

	public function update_data()
	{
		// Add config
		return [
			['config.add', ['changelogo_url', '']],
			['config.add', ['changelogo_width', '']],
			['config.add', ['changelogo_height', '']],

			// Add ACP modules
			['module.add', ['acp', 'ACP_CAT_DOT_MODS', 'ACP_CHANGELOGO']],
			['module.add', ['acp', 'ACP_CHANGELOGO', [
				'module_basename'		=> '\cabot\changelogo\acp\changelogo_module',
				'module_langname'		=> 'ACP_CHANGELOGO_CONF',
				'module_mode'			=> 'overview',
				'module_auth'			=> 'ext_cabot/changelogo && acl_a_board',
			]]],
		];
	}
}
