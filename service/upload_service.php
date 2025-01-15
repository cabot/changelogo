<?php
/**
 *
 * Simple logo changer for the phpBB Forum Software package.
 *
 * @copyright (c) 2023-2025 - cabot
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace cabot\changelogo\service;

/**
 * Change Logo upload service.
 */
class upload_service
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\files\factory */
	protected $files_factory;

	/** @var \phpbb\language\language */
	protected $language;

	/**
	 * Constructor.
	 *
	 * @param \phpbb\config\config		$config			Config object
	 * @param \phpbb\files\factory		$files_factory	Files factory object
	 * @param \phpbb\language\language	$language		Language object
	 */
	public function __construct(\phpbb\config\config $config, \phpbb\files\factory $files_factory, \phpbb\language\language $language)
	{
		$this->config = $config;
		$this->files_factory = $files_factory;
		$this->language = $language;
	}

	/**
	 * Handles the logo upload process
	 *
	 * @param string	$destination			Relative destination directory (e.g., 'images/changelogo')
	 * @param string	$logo_dir				Absolute path to the destination directory
	 * @param array		$allowed_extensions		List of allowed file extensions
	 * @param string	$upload_field_name		Name of the upload field in the form (e.g., 'file_upload')
	 * @return array	Contains 'errors' (array) and 'file_url' (string|null)
	 */
	public function logo_upload(string $destination, string $logo_dir, array $allowed_extensions, string $upload_field_name)
	{
		$errors = [];
		$file_url = null;

		// Ensure the directory exists
		if (!file_exists($logo_dir))
		{
			@mkdir($logo_dir, 0755, true);

			if (!file_exists($logo_dir))
			{
				$errors[] = sprintf($this->language->lang('ACP_CHANGELOGO_DIR_NOT_EXISTS'), $destination);
				return ['errors' => $errors, 'file_url' => null];
			}
		}

		// Handle the upload
		$upload = $this->files_factory->get('files.upload')
			->set_allowed_extensions($allowed_extensions)
			->set_disallowed_content((isset($this->config['mime_triggers']) ? explode('|', $this->config['mime_triggers']) : false));

		$file = $upload->handle_upload('files.types.form', $upload_field_name);

		if (count($file->error))
		{
			$errors[] = is_array($file->error) ? implode('<br>', $file->error) : $file->error;
		}
		else
		{
			$file->move_file($destination, true);
			$file_url = $destination . '/' . $file->get('realname');
		}

		return ['errors' => $errors, 'file_url' => $file_url];
	}
}
