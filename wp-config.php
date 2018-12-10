<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'jobsmakeupartist.v1');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l’hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'A&(+0{M%S_9d>)ha$D7J: #Wrs2H0ASkhFdVu`8-7[<*%+#Hibp)w}` .bH6LOm(');
define('SECURE_AUTH_KEY',  '2K+^8`F`5[VH+=li@=f(SX$UD`kGA#N578UP[7ELB]ob71Yg/6z#xjku1}SX(33~');
define('LOGGED_IN_KEY',    'z_ZK)ZV!-8UUo62B]tJ2gwW]mb$fZnPmBurUv83Xir+>8s#6JN?=pqt9VHZb14S<');
define('NONCE_KEY',        '89::I#8+{8?;Aq)Z?/`P-;|y5AXRt%6K>dE9@,blw9~~06aAwZmr/Fum ,!?)37/');
define('AUTH_SALT',        'r`R}+x30/+w%X+.w&H,;v}Sz|+*<d X3i&56=N> S40OWQze;k|^y>M]`5=3hQ`A');
define('SECURE_AUTH_SALT', '  zk4jo%+kds0E{5TSvNj2OtBQCtB6F0DcO!mCOZfv$Kj?V@OJQNBAT2E%IA0eX8');
define('LOGGED_IN_SALT',   'a|6zMLj(]Ee_8`/ii7?{/#Vz@SLZ]6tQCK[6)(8~kxZNIzto[eR$QkQQKN@F[g} ');
define('NONCE_SALT',       '}4yW![1kSoBZb9c.?@9r)2uYdITk)KX}~{PR$k`uZ3A8AJri&:-{(z7c5JIrs(e+');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix  = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* C’est tout, ne touchez pas à ce qui suit ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');