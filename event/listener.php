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

use phpbb\config\config;
use phpbb\template\template;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Event listener
 *
 */
class listener implements EventSubscriberInterface
{
	protected $config;
	protected $template;

	/**
	 * Constructor
	 *
	 * @param config	$config		Config object
	 * @param template	$template	Template object
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

	public function changelogo()
	{
		$this->template->assign_vars([
			'CHANGELOGO_URL'			=> $this->config['changelogo_url'],
			'CHANGELOGO_WIDTH'			=> $this->config['changelogo_width'],
			'CHANGELOGO_HEIGHT'			=> $this->config['changelogo_height'],
		]);
	}
}
