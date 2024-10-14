<?php
/**
 *
 * Simple logo changer for the phpBB Forum Software package.
 *
 * @copyright (c) 2023 - cabot
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

if (!defined('IN_PHPBB'))
{
	exit;
}

if (empty($lang) || !is_array($lang))
{
	$lang = [];
}
// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//
$lang = array_merge($lang, [
	'ACP_CHANGELOGO_HEADING'			=> 'Logo configuration',
	'ACP_CHANGELOGO_URL'				=> 'Logo location',
	'ACP_CHANGELOGO_URL_EXPLAIN'		=> 'You can use a remote image by entering its full URL (e.g., <code>https://domain.com/logo_name.jpg</code>) or a local image by entering the relative path to the board root (e.g. <code>images/logo_name.svg</code>).',
	'ACP_CHANGELOGO_WIDTH'				=> 'Logo width in pixels',
	'ACP_CHANGELOGO_HEIGHT'				=> 'Logo height in pixels',
	'ACP_CHANGELOGO_SAVE'				=> 'Logo configuration saved',
	'ACP_CHANGELOGO_UPLOAD'				=> 'Upload an image',
	'ACP_CHANGELOGO_UPLOAD_EXPLAIN'		=> 'Select an image (%s).<br>The fields below should be filled in automatically.<br>Note that the dimensions of svg images cannot always be retrieved, in which case you will have to fill them in manually.<br>The image preview is limited to 300px x 100px and does not reflect the actual size of your logo if it is larger.',

	'ACP_CHANGELOGO_DIR_NOT_EXISTS'		=> 'The <samp>%s</samp> directory doesn’t exist at the board root and can’t be created. Please create it manually.',
	'ACP_CHANGELOGO_NO_EXTENSION'		=> 'The “Logo location” field does not contain a valid file path.',
	'ACP_CHANGELOGO_NOT_UPLOADED'		=> 'No file has been uploaded.',
	'ACP_CHANGELOGO_UPLOAD_ERROR'		=> 'There was an error uploading your file. Please try again. Check server logs if problem persists.',
	'DISALLOWED_EXTENSION'				=> 'The extension <samp>%s</samp> is not allowed.',
]);
