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

class changelogo_info
{
	function module()
	{
		return [
			'filename'	=> '\cabot\changelogo\acp\changelogo_module',
			'title'		=> 'ACP_CHANGELOGO',
			'modes'		=> [
				'settings'	=> [
					'title' 	=> 'ACP_CHANGELOGO_CONFIG',
					'auth' 		=> 'cabot/changelogo && acl_a_board',
					'cat'		=> ['ACP_CHANGELOGO_CONFIG'],
				],
			],
		];
	}
}
