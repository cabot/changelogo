<?php
/**
 *
 * Simple logo changer for the phpBB Forum Software package.
 *
 * @copyright (c) 2023-2025 - cabot
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
	'ACP_CHANGELOGO_HEADING'			=> 'Paramètres du logo',
	'ACP_CHANGELOGO_URL'				=> 'Emplacement du logo',
	'ACP_CHANGELOGO_URL_EXPLAIN'		=> 'Vous pouvez utiliser une image distante en saisissant son URL complète (par ex. : <code>https://domaine.com/nom_du_logo.jpg</code>) ou une image locale en saisissant le chemin relatif à la racine du forum (par ex. : <code>images/nom_du_logo.svg</code>).',
	'ACP_CHANGELOGO_WIDTH'				=> 'Largeur du logo en pixels',
	'ACP_CHANGELOGO_HEIGHT'				=> 'Hauteur du logo en pixels',
	'ACP_CHANGELOGO_UPLOAD'				=> 'Télécharger une image',
	'ACP_CHANGELOGO_UPLOAD_EXPLAIN'		=> 'Sélectionnez une image (%s).<br>Les champs ci-dessous devraient être remplis automatiquement.<br>Notez que les dimensions des fichiers SVG ne peuvent pas toujours être récupérées ; auquel cas vous devrez les renseigner manuellement.<br>L’aperçu de l’image est limité à 300x100 pixels et ne reflète pas la taille réelle de votre logo s’il est plus grand.',

	'ACP_CHANGELOGO_NOJS'				=> 'Veuillez activer JavaScript dans votre navigateur pour une meilleure expérience utilisateur.',

	'ACP_CHANGELOGO_SETTING_SAVED'		=> 'Les paramètres du logo ont été enregistrés avec succès !',

	// Erreurs de téléchargement
	'ACP_CHANGELOGO_DIR_NOT_EXISTS'		=> 'Le répertoire <samp>« %s »</samp> n’existe pas à la racine du forum et ne peut pas être créé. Veuillez le créer manuellement.',
	'DISALLOWED_CONTENT'				=> 'Le transfert a été interrompu car le contenu du fichier a été identifié comme étant un vecteur potentiel d’attaque.',
	'DISALLOWED_EXTENSION'				=> 'L’extension <samp>« %s »</samp> n’est pas autorisée.',

	// Erreurs de saisie manuelle
	'ACP_CHANGELOGO_EMPTY_FIELD'		=> 'Le champ « Emplacement du logo » est vide.',
	'ACP_CHANGELOGO_INVALID_PATH'		=> '« <samp>%s</samp> » n’est pas un chemin valide vers une image existante.',
	'ACP_CHANGELOGO_INVALID_URL'		=> '« <samp>%s</samp> » n’est pas une URL valide pointant vers une image existante.',
]);

