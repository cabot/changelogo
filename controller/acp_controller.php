<?php
/**
 *
 * Simple logo changer for the phpBB Forum Software package.
 *
 * @copyright (c) 2023-2025 - cabot
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace cabot\changelogo\controller;

/**
 * Change Logo ACP controller.
 */
class acp_controller
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\language\language */
	protected $language;

	/** @var \phpbb\log\log */
	protected $log;

	/** @var \phpbb\request\request */
	protected $request;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var \cabot\changelogo\service\upload_service */
	protected $upload_service;

	/** @var \cabot\changelogo\helper\logo_path_helper */
	protected $logo_path_helper;

	/** @var string */
	protected $root_path;

	/** @var string Custom form action */
	protected $u_action;

	/**
	 * Constructor.
	 *
	 * @param \phpbb\config\config							$config				Config object
	 * @param \phpbb\language\language						$language			Language object
	 * @param \phpbb\log\log								$log				Log object
	 * @param \phpbb\request\request						$request			Request object
	 * @param \phpbb\template\template						$template			Template object
	 * @param \phpbb\user									$user				User object
	 * @param \cabot\changelogo\service\upload_service		$upload_service		Handles the file upload
	 * @param \cabot\changelogo\helper\logo_path_helper		$logo_path_helper	Path helper object
	 * @param string										$root_path			Path to phpBB root
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\language\language $language, \phpbb\log\log $log, \phpbb\request\request $request, \phpbb\template\template $template, \phpbb\user $user, \cabot\changelogo\service\upload_service $upload_service,  \cabot\changelogo\helper\logo_path_helper $logo_path_helper, string $root_path)
	{
		$this->config			= $config;
		$this->language			= $language;
		$this->log				= $log;
		$this->request			= $request;
		$this->template			= $template;
		$this->user				= $user;
		$this->upload_service	= $upload_service;
		$this->logo_path_helper = $logo_path_helper;
		$this->root_path		= $root_path;
	}

	/**
	 * Display the options a user can configure for this extension.
	 *
	 * @return void
	 */
	public function display_options()
	{
		$this->language->add_lang('acp_changelogo', 'cabot/changelogo');

		$form_key = 'changelogo_acp';

		$destination = 'images/changelogo';
		$logo_dir = $this->root_path . $destination;
		$allowed_extensions = ['apng', 'avif', 'gif', 'jpeg', 'jpg', 'png', 'svg', 'webp'];
		$upload_field_name = 'changelogo_upload';

		$extensions_accept = implode(', ', array_map(function ($ext) {
			return '.' . $ext;
		}, $allowed_extensions));

		add_form_key($form_key);

		$errors = [];

		if ($this->request->is_set_post('submit'))
		{
			if (!check_form_key($form_key))
			{
				$errors[] = $this->language->lang('FORM_INVALID');
			}

			$upload_logo = $this->request->file($upload_field_name);
			$changelogo_url = $this->request->variable('changelogo_url', '');

			if (!empty($upload_logo['name']))
			{
				$result = $this->upload_service->logo_upload($destination, $logo_dir, $allowed_extensions, $upload_field_name);

				if (!empty($result['errors']))
				{
					$errors = array_merge($errors, $result['errors']);
				}
				else
				{
					$changelogo_url = $result['file_url'];
				}
			}
			else
			{
				if (empty($changelogo_url))
				{
					$errors[] = $this->language->lang('ACP_CHANGELOGO_EMPTY_FIELD');
				}
				else
				{
					if (null === parse_url($changelogo_url, PHP_URL_SCHEME))
					{
						$real_path = realpath($this->logo_path_helper->get_logo_path($changelogo_url));
						if ($real_path === false || !is_file($real_path))
						{
							$errors[] = sprintf($this->language->lang('ACP_CHANGELOGO_INVALID_PATH'), $changelogo_url);
						}
					}
					else
					{
						$headers = get_headers($changelogo_url, 1);
						if (!isset($headers['Content-Type']) || !preg_match('/image\/*/', $headers['Content-Type']))
						{
							$errors[] = sprintf($this->language->lang('ACP_CHANGELOGO_INVALID_URL'), $changelogo_url);
						}
					}
				}
			}

			if (empty($errors))
			{
				$this->config->set('changelogo_url', $changelogo_url);
				$this->config->set('changelogo_width', $this->request->variable('changelogo_width', ''));
				$this->config->set('changelogo_height', $this->request->variable('changelogo_height', ''));

				$this->log->add('admin', $this->user->data['user_id'], $this->user->ip, 'LOG_ACP_CHANGELOGO_SETTINGS');
				trigger_error($this->language->lang('ACP_CHANGELOGO_SETTING_SAVED') . adm_back_link($this->u_action));
			}
			else
			{
				$this->config->set('changelogo_url', '');
			}
		}

		$has_errors = !empty($errors);

		$this->template->assign_vars([
			'S_ERROR'					=> $has_errors,
			'ERROR_MSG'					=> $has_errors ? implode('<br>', $errors) : '',
			'U_ACTION'					=> $this->u_action,
			'FORM_NAME'					=> $form_key,
			'INPUT_FILE_NAME'			=> $upload_field_name,
			'CHANGELOGO_URL'			=> $this->config['changelogo_url'],
			'CHANGELOGO_SRC'			=> $this->logo_path_helper->get_logo_path($this->config['changelogo_url']),
			'CHANGELOGO_WIDTH'			=> $this->config['changelogo_width'],
			'CHANGELOGO_HEIGHT'			=> $this->config['changelogo_height'],
			'CHANGELOGO_DEST'			=> $destination,
			'CHANGELOGO_ACCEPT_EXT'		=> sprintf($this->language->lang('ACP_CHANGELOGO_UPLOAD_EXPLAIN'), $extensions_accept),
			'CHANGELOGO_ACCEPT_ATTR'	=> $extensions_accept,
		]);
	}

	/**
	 * Set custom form action.
	 *
	 * @param string	$u_action	Custom form action
	 * @return void
	 */
	public function set_page_url($u_action)
	{
		$this->u_action = $u_action;
	}
}
