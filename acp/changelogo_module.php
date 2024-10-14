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

class changelogo_module
{
	/** @var string */
	public $u_action;
	/** @var string */
	public $tpl_name;
	/** @var string */
	public $page_title;

	function main()
	{
		global $user, $template, $config, $phpbb_root_path, $phpbb_container, $request, $phpbb_log, $language;

		$language->add_lang('acp_changelogo', 'cabot/changelogo');
		$this->tpl_name = 'acp_changelogo';
		$this->page_title = 'ACP_CHANGELOGO';

		$changelogo_settings = 'acp_changelogo';
		$allowed_extensions = ['apng', 'avif', 'gif', 'jpeg', 'jpg', 'png', 'svg', 'webp'];
		$destination = 'images/changelogo';
		$logo_dir = $phpbb_root_path . $destination;
		$changelogo_url = $request->variable('changelogo_url', '');

		add_form_key($changelogo_settings);

		$submit = $request->is_set_post('submit');

		if ($submit && !check_form_key($changelogo_settings))
		{
			trigger_error($language->lang('FORM_INVALID') . adm_back_link($this->u_action), E_USER_WARNING);
		}

		// Check if directory exists, if not try to create it
		if (!file_exists($logo_dir))
		{
			@mkdir($logo_dir, 0777);

			if (!file_exists($logo_dir))
			{
				trigger_error(sprintf($language->lang('ACP_CHANGELOGO_DIR_NOT_EXISTS'), $destination), E_USER_WARNING);
			}
		}

		if ($submit)
		{
			$upload_logo = $request->file('changelogo_upload');

			// Check whether a file has been uploaded
			if (!empty($upload_logo['name']))
			{
				$upload = $phpbb_container->get('files.factory')->get('upload')
					->set_allowed_extensions($allowed_extensions);

				$file = $upload->handle_upload('files.types.form', 'changelogo_upload');

				// Adjust destination path (no trailing slash)
				if (substr($destination, -1, 1) == '/' || substr($destination, -1, 1) == '\\')
				{
					$destination = substr($destination, 0, -1);
				}

				// Move uploaded file to final directory and overwrite if necessary
				$file->move_file($destination, true, true);

				// Check for upload errors
				if (count($file->error))
				{
					$file->remove();
					trigger_error($file->error[0] . adm_back_link($this->u_action), E_USER_WARNING);
				}

				$destination_path = $file->get('destination_path');
				$destination_file = $file->get('destination_file');
				$new_destination_file = $destination_path . '/' . $upload_logo['name'];

				// Rename the uploaded file to the new path
				if (rename($destination_file, $new_destination_file))
				{
					/** @var $file_system \phpbb\filesystem\filesystem */
					$file_system = $phpbb_container->get('filesystem');
					$file_system->phpbb_chmod($new_destination_file, \phpbb\filesystem\filesystem_interface::CHMOD_READ | \phpbb\filesystem\filesystem_interface::CHMOD_WRITE);

					$config->set('changelogo_url', $changelogo_url);
					$config->set('changelogo_width', $request->variable('changelogo_width', ''));
					$config->set('changelogo_height', $request->variable('changelogo_height', ''));

					$phpbb_log->add('admin', $user->data['user_id'], $user->ip, 'LOG_CHANGELOGO_UPDATED');
					trigger_error($language->lang('ACP_CHANGELOGO_SAVE') . adm_back_link($this->u_action));
				}
				else
				{
					$file->remove();
					trigger_error($language->lang('ACP_CHANGELOGO_UPLOAD_ERROR') . adm_back_link($this->u_action), E_USER_WARNING);
				}
			}
			else
			{
				$file_extension = '';
				// Get path information
				$path_info = pathinfo($changelogo_url);
				// Check extension if available
				if (isset($path_info['extension'])) {
					$file_extension = strtolower($path_info['extension']);
				}

				if (empty($changelogo_url))
				{
					// URL field is empty, we empty the others and save them as such
					$config->set('changelogo_url', '');
					$config->set('changelogo_width', '');
					$config->set('changelogo_height', '');

					trigger_error($language->lang('ACP_CHANGELOGO_EMPTY_FIELD') . adm_back_link($this->u_action), E_USER_WARNING);
				}
				elseif (empty($file_extension) || !in_array($file_extension, $allowed_extensions))
				{
					// File extension is missing or invalid
					if (empty($file_extension))
					{
						$error_message = $language->lang('ACP_CHANGELOGO_NO_EXTENSION');
					}
					else
					{
						$error_message = sprintf($language->lang('DISALLOWED_EXTENSION', $file_extension));
					}

					trigger_error($error_message . adm_back_link($this->u_action), E_USER_WARNING);
				}
				else
				{
					// Everything looks good, save the data
					$config->set('changelogo_url', $changelogo_url);
					$config->set('changelogo_width', $request->variable('changelogo_width', ''));
					$config->set('changelogo_height', $request->variable('changelogo_height', ''));

					$phpbb_log->add('admin', $user->data['user_id'], $user->ip, 'LOG_CHANGELOGO_UPDATED');
					trigger_error($language->lang('ACP_CHANGELOGO_SAVE') . adm_back_link($this->u_action));
				}
			}
		}

		// Create the string for accepted extensions, add a dot in front of each
		$extensions_accept = implode(', ', array_map(function ($ext) {
			return '.' . $ext;
		}, $allowed_extensions));

		// Assign template variables
		$template->assign_vars([
			'CHANGELOGO_URL'			=> $config['changelogo_url'],
			'CHANGELOGO_WIDTH'			=> $config['changelogo_width'],
			'CHANGELOGO_HEIGHT'			=> $config['changelogo_height'],
			'CHANGELOGO_DEST'			=> $destination,
			'CHANGELOGO_ACCEPT_EXT'		=> sprintf($language->lang('ACP_CHANGELOGO_UPLOAD_EXPLAIN'), $extensions_accept),
			'CHANGELOGO_ACCEPT_ATTR'	=> $extensions_accept,
			'U_ACTION'					=> $this->u_action,
		]);
	}
}
