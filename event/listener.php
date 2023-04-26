<?php
/**
 *
 * Simple logo changer for the phpBB Forum Software package.
 *
 * @copyright (c) 2023 - cabot
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
*/

namespace cabot\changelogo\event;

use phpbb\template\template;
use phpbb\config\config;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
* Event listener
*
*/
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\config\config */
	protected $config;

	/**
	* Constructor
	*
	* @param \phpbb\config\config				$config
	* @param \phpbb\template\template			$template
	*/

	public function __construct(config $config, template $template)
	{
		$this->config = $config;
		$this->template = $template;
	}

	public static function getSubscribedEvents()
	{
		return [
			'core.page_header'	=> 'changelogo',
		];
	}

	public function changelogo($event)
	{
		$this->template->assign_vars([
			'CHANGELOGO_URL'			=> $this->config['changelogo_url'],
			'CHANGELOGO_WIDTH'			=> $this->config['changelogo_width'],
			'CHANGELOGO_HEIGHT'			=> $this->config['changelogo_height'],
		]);
	}
}
