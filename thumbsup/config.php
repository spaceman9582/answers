<?php
/**
 * ThumbsUp
 *
 * @author     Geert De Deckere <//www.geertdedeckere.be/>
 * @copyright  (c) 2009 Geert De Deckere
 */

/**
 * The absolute path to the thumbsup folder. No need to change this normally.
 */
defined( 'THUMBSUP_DOCROOT' ) or define( 'THUMBSUP_DOCROOT', realpath( dirname( __FILE__ ) ) . '/' );

/**
 * Base path of the website, pointing to the thumbsup folder.
 * Must begin and end with a slash! Some examples:
 * //yoursite.com/thumbsup/      => /
 * //yoursite.com/blog/thumbsup/ => /blog/
 */
define( 'THUMBSUP_WEBROOT', '/' );

/**
 * The location of the SQLite database that will be automatically created.
 * The database folder and the file need to be writable by the webserver.
 * Chmod to 666.
 * See: //php.net/sqlite_open
 */
define( 'THUMBSUP_DATABASE', THUMBSUP_DOCROOT . 'database/thumbsup.db' );

/**
 * The default timezone used by all date/time functions.
 * List of supported timezones: //php.net/timezones
 * Note: this function requires PHP >= 5.1.0
 */
if ( version_compare( PHP_VERSION, '5.1.0', '>=' ) ) {
	date_default_timezone_set( 'Europe/London' );
}

return array(
	/**
	 * List of users who can login into the ThumbsUp admin area.
	 * Array keys are the usernames; array values are the passwords.
	 * Note: the passwords should be stored as SHA1 hashes, for security.
	 * Online SHA1 encoder: //webtool.ipower.vn/SHA1-Encode.html
	 */
	'admins' => array(
		// This is the default account (admin/p@ssw0rd), replace it asap!
		'admin' => '57b2ad99044d337197c0c39fd3823568ff81e48a',
	),

	/**
	 * The number of ThumbsUp items to show per page in the admin area.
	 */
	'admin_items_per_page' => 100,

	/**
	 * The default ThumbsUp template you want to use. This string must match
	 * the name of a subdirectory of thumbsup/templates/.
	 */
	'template' => 'thumbs-up-down',

	/**
	 * The name of the cookie in which the item IDs for which the user
	 * has already voted will be stored.
	 */
	'cookie_name' => 'thumbsup',

	/**
	 * The lifetime of the cookie in seconds. Default is one year.
	 * If set to 0, the cookie will expire at the end of the session
	 * (when the browser closes).
	 */
	'cookie_lifetime' => 3600 * 24 * 365,

	/**
	 * Disallow duplicate votes from the same IP address. This is
	 * additional to the standard cookie check.
	 * Note: IP checks may not be accurate. Different visitors can come
	 * from the same IP address, and the same user might come from
	 * a different IP every request.
	 */
	'ip_check' => false,
);
