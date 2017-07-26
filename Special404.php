<?php
/**
 * Special404 - provides a special page based 404 destination.
 *
 * @file
 * @ingroup Extensions
 * @author Daniel Friesen
 * @license https://www.gnu.org/copyleft/gpl.html GNU General Public License 2.0 or later
 * @link https://www.mediawiki.org/wiki/Extension:Special404 Documentation
 */

// Ensure that the script cannot be executed outside of MediaWiki.
if ( !defined( 'MEDIAWIKI' ) ) {
    die( 'This is an extension to MediaWiki and cannot be run standalone.' );
}

// Display extension properties on MediaWiki.
$wgExtensionCredits['specialpage'][] = array(
	'path' => __FILE__,
	'author' => 'Daniel Friesen',
	'name' => 'Special404',
	'url' => 'https://www.mediawiki.org/wiki/Extension:Special404',
	'descriptionmsg' => 'special404-desc',
	'license-name' => 'GPL-2.0+',
);

// Register extension messages and other localisation.
$wgMessagesDirs['Special404'] = __DIR__ . '/i18n';
$wgExtensionMessagesFiles['Special404Alias'] = __DIR__ . '/Special404.alias.php';

// Register special page with MediaWiki.
$wgSpecialPages['Error404'] = 'Special404';

// Load extension's classes.
$wgAutoloadClasses['Special404'] = __DIR__ . '/Special404_body.php';

// Enable this to force an automatic 301 Moved Permanently redirect if a matching title exists
// This might be useful if you used to use root /Article urls and moved to something else
$egSpecial404RedirectExistingRoots = false;
