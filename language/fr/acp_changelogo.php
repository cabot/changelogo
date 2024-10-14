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
	'ACP_CHANGELOGO_URL_EXPLAIN'		=> 'Vous pouvez utiliser une image distante en saisissant sont URL complète (Exemple : <code>https://adresse.com/nom_du_logo.jpg</code>) ou une image locale en saisissant le chemin relatif à la racine du forum (Exemple : <code>images/nom_du_logo.svg</code>).',
	'ACP_CHANGELOGO_WIDTH'				=> 'Largeur du logo en pixels',
	'ACP_CHANGELOGO_HEIGHT'				=> 'Hauteur du logo en pixels',
	'ACP_CHANGELOGO_SAVE'				=> 'Configuration du logo sauvegardée.',
	'ACP_CHANGELOGO_UPLOAD'				=> 'Téléverser une image',
	'ACP_CHANGELOGO_UPLOAD_EXPLAIN'		=> 'Sélectionnez une image (%s).<br>Les champs ci-dessous devraient être automatiquement renseignés.<br>Notez que les dimensions des images svg ne peuvent pas systématiquement être récupérées, auquel cas vous devrez les renseigner manuellement.<br>L’aperçu de l’image est limité à 300px x 100px et et ne reflète pas la taille réelle de votre logo s’il est plus grand.',

	'ACP_CHANGELOGO_DIR_NOT_EXISTS'		=> 'Le répertoire <samp>%s</samp> n’existe pas à la racine du forum et ne peut pas être créé. Veuillez le créer manuellement.',
	'ACP_CHANGELOGO_EMPTY_FIELD'		=> 'Le champ « Emplacement du logo » est vide. Veuillez le renseigner manuellement ou vérifier que JavaScript est activé dans votre navigateur si vous avez utilisé la fonction d’envoi de fichier.',
	'ACP_CHANGELOGO_NO_EXTENSION'		=> 'Le champ « Emplacement du logo » ne contient pas de chemin d’accès valide à un fichier.',
	'ACP_CHANGELOGO_NOT_UPLOADED'		=> 'Aucun fichier n’a été envoyé.',
	'ACP_CHANGELOGO_UPLOAD_ERROR'		=> 'Une erreur s’est produite lors du téléversement de votre fichier. Veuillez réessayer. Vérifiez les journaux du serveur si le problème persiste.',
	'DISALLOWED_EXTENSION'				=> 'L’extension <samp>%s</samp> n’est pas autorisée.',
]);
