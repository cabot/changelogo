<?php
/**
 *
 * Change Logo. An extension for the phpBB Forum Software package.
 *
 * @copyright (c) 2024 - cabot
 * @license GNU General Public License, version 2 (GPL-2.0)
 *
 */

namespace cabot\changelogo\helper;


class logo_path_helper
{
	/** @var \phpbb\path_helper */
	protected $path_helper;

	/**
	 * Constructor
	 *
	 * @param \phpbb\path_helper	$path_helper	phpBB path helper object
	 */
	public function __construct(\phpbb\path_helper $path_helper)
	{
		$this->path_helper = $path_helper;
	}

	/**
	 * Get the full path to the logo.
	 *
	 * Resolves the given URL to an absolute URL or a path relative to the web root.
	 * If the URL is empty, returns `null`. Absolute URLs are returned as-is.
	 *
	 * @param string|null $url The logo URL or relative path. Can be null or empty.
	 * @return string|null The resolved full path or `null` if the URL is empty.
	 */
	public function get_logo_path($url)
	{
		if (empty($url))
		{
			return null;
		}

		if (null !== parse_url($url, PHP_URL_SCHEME))
		{
			return $url;
		}

		return $this->path_helper->get_web_root_path() . ltrim($url, '/');
	}
}
