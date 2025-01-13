<?php
/**
 *
 * Simple logo changer for the phpBB Forum Software package.
 *
 * @copyright (c) 2023-2025 - cabot
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace cabot\changelogo\event;

/**
 * @ignore
 */
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

/**
 * Change Logo Event listener.
 */
class main_listener implements EventSubscriberInterface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \cabot\changelogo\helper\logo_path_helper */
	protected $logo_path_helper;

	/**
	 * Constructor
	 *
	 * @param \phpbb\config\config							$config				Config object
	 * @param \phpbb\template\template						$template			Template object
	 * @param \cabot\changelogo\helper\logo_path_helper		$logo_path_helper	Path helper object
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\template\template $template, \cabot\changelogo\helper\logo_path_helper $logo_path_helper)
	{
		$this->config = $config;
		$this->template = $template;
		$this->logo_path_helper = $logo_path_helper;
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
			'CHANGELOGO_URL'	=> $this->logo_path_helper->get_logo_path($this->config['changelogo_url']),
			'CHANGELOGO_WIDTH'	=> $this->config['changelogo_width'],
			'CHANGELOGO_HEIGHT'	=> $this->config['changelogo_height'],
		]);
	}
}
