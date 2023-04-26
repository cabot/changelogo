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
	'ACP_CHANGELOGO_HEADING'			=> 'Configuration du logo',
	'ACP_CHANGELOGO_URL'				=> 'Emplacement du logo',
	'ACP_CHANGELOGO_URL_EXPLAIN'		=> 'Vous pouvez utiliser une image distante en saisissant sont URL complète (par ex : <code>https://adresse.com/nom_du_logo.jpg</code>) ou une image locale en saisissant le chemin relatif à la racine du forum (par ex. <code>images/nom_du_logo.svg</code>).',
	'ACP_CHANGELOGO_WIDTH'				=> 'Largeur du logo en pixels',
	'ACP_CHANGELOGO_HEIGHT'				=> 'Hauteur du logo en pixels',
	'ACP_CHANGELOGO_SAVE'				=> 'Configuration du logo sauvegardée.',
]);
