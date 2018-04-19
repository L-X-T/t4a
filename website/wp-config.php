<?php

/**
 * Grundeinstellungen für WordPress
 *
 * Zu diesen Einstellungen gehören:
 *
 * * MySQL-Zugangsdaten,
 * * Tabellenpräfix,
 * * Sicherheitsschlüssel
 * * und ABSPATH.
 *
 * Mehr Informationen zur wp-config.php gibt es auf der
 * {@link https://codex.wordpress.org/Editing_wp-config.php wp-config.php editieren}
 * Seite im Codex. Die Zugangsdaten für die MySQL-Datenbank
 * bekommst du von deinem Webhoster.
 *
 * Diese Datei wird zur Erstellung der wp-config.php verwendet.
 * Du musst aber dafür nicht das Installationsskript verwenden.
 * Stattdessen kannst du auch diese Datei als wp-config.php mit
 * deinen Zugangsdaten für die Datenbank abspeichern.
 *
 * @package WordPress
 */

if (strpos($_SERVER['HTTP_HOST'], 't4a.local:8888') !== false) {
	define('WP_HOME', 'http://t4a.local:8888'); //local, e.g. 'http://PROJECT_NAME.local:8888'
	define('WP_SITEURL', WP_HOME); //subdir example: '/cms'

	// define('WP_ALTERNATE_UPLOAD_URL', 'https://www.derkinderwald.at/cms/wp-content/uploads'); //local, e.g. 'http://PROJECT_NAME.dev.engarde-agency.com/cms/wp-content/uploads'

	define('WP_DEBUG', true);

	define('DB_NAME', 't4a');
	define('DB_USER', 'root');
	define('DB_PASSWORD', 'root');
	define('DB_HOST', 'localhost');
	define('DB_CHARSET', 'utf8mb4');
	define('DB_COLLATE', '');
} elseif (strpos($_SERVER['HTTP_HOST'], 't4a.ferzola.at') !== false) {
	//define('FORCE_SSL_ADMIN', true);

	define('WP_HOME', 'http://dev.t4a.ferzola.at'); //local, e.g. 'http://PROJECT_NAME.local:8888'
	define('WP_SITEURL', WP_HOME); //subdir example: '/cms'

	define('WP_DEBUG', false);

	define('DB_NAME', '2941471db43');
	define('DB_USER', 'sql2941471');
	define('DB_PASSWORD', 'q@++w5j');
	define('DB_HOST', 'mysqlsvr37.world4you.com');
	define('DB_CHARSET', 'utf8mb4');
	define('DB_COLLATE', '');
} else {
	//define('FORCE_SSL_ADMIN', true);

	define('WP_HOME', 'https://dev.time4africa.com'); //local, e.g. 'http://PROJECT_NAME.local:8888'
	define('WP_SITEURL', WP_HOME); //subdir example: '/cms'

	define('WP_DEBUG', false);

define('DB_NAME', 'wordpress_t4a');
define('DB_USER', 't4awp_01150078');
define('DB_PASSWORD', 'A6bqg35~');
define('DB_HOST', 'localhost:3306');
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');

}

/**#@+
 * Sicherheitsschlüssel
 *
 * Ändere jeden untenstehenden Platzhaltertext in eine beliebige,
 * möglichst einmalig genutzte Zeichenkette.
 * Auf der Seite {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * kannst du dir alle Schlüssel generieren lassen.
 * Du kannst die Schlüssel jederzeit wieder ändern, alle angemeldeten
 * Benutzer müssen sich danach erneut anmelden.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'e=BTWR0QWnbsP8beXkgIq14!iW4oOR4St9++D4Jd?p@oa2$YPc:6GREt!mHKHo');
define('SECURE_AUTH_KEY',  'sp4:wdI-w8SRa?yX!-4N_1K+*Ea7mUxE0e$jhiZiU@Zy?2@_RGCklQ5dZ5O_C_');
define('LOGGED_IN_KEY',    '+$ob_1-mCJvtufw6oc4q6Ws0PXVpWHpPDDu$hkinTik##GBgIia!Js53+iWtt_');
define('NONCE_KEY',        'IB0Q*GhO%Xxh8YJb%#L_5*x!cr2eBQk0!XDNhpfe-h_B6yDH+SaXKxwNscvUSF');
define('AUTH_SALT',        'Q=sbR#12@5m9vx=t9O!%YDtfKMNXD5m%GE=2@DG=lwKkxmD01cKDk5IU=@vBIm');
define('SECURE_AUTH_SALT', 'sD*kL2srwT_cwK04tcC=KVnwPMDV3liZsa042gY2DNIE3vl@yNYM#_0Gfqf9fo');
define('LOGGED_IN_SALT',   'xXM%to%Gb6#@6W+:9dlco=R?1Y#80_IkN=hK-6?#sLRb_o_Y!1E0DZIhBz*poA');
define('NONCE_SALT',       '?oKaLZvyv!9S5iKscI03633e#0Z0PqWnEl#UOmW08IjQuT9w7z3PgJT%waLP!l');

/**#@-*/

/**
 * WordPress Datenbanktabellen-Präfix
 *
 * Wenn du verschiedene Präfixe benutzt, kannst du innerhalb einer Datenbank
 * verschiedene WordPress-Installationen betreiben.
 * Bitte verwende nur Zahlen, Buchstaben und Unterstriche!
 */
$table_prefix  = 'wp_';

/**
 * Für Entwickler: Der WordPress-Debug-Modus.
 *
 * Setze den Wert auf „true“, um bei der Entwicklung Warnungen und Fehler-Meldungen angezeigt zu bekommen.
 * Plugin- und Theme-Entwicklern wird nachdrücklich empfohlen, WP_DEBUG
 * in ihrer Entwicklungsumgebung zu verwenden.
 *
 * Besuche den Codex, um mehr Informationen über andere Konstanten zu finden,
 * die zum Debuggen genutzt werden können.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Das war’s, Schluss mit dem Bearbeiten! Viel Spaß beim Bloggen. */
/* That's all, stop editing! Happy blogging. */

/** Der absolute Pfad zum WordPress-Verzeichnis. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Definiert WordPress-Variablen und fügt Dateien ein.  */
require_once(ABSPATH . 'wp-settings.php');

/* fixes safe_mode problems */
define('WP_TEMP_DIR', ABSPATH . 'wp-content/');
