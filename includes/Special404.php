<?php

use MediaWiki\Request\FauxRequest;
use MediaWiki\Title\Title;

class Special404 extends UnlistedSpecialPage {

	public function __construct() {
		parent::__construct( 'Error404' );
	}

	/**
	 * @param string|null $par
	 */
	public function execute( $par ) {
		// phpcs:ignore MediaWiki.NamingConventions.ValidGlobalName.allowedPrefix
		global $egSpecial404RedirectExistingRoots;

		$output = $this->getOutput();
		$request = $this->getRequest();
		$requestUrl = $request instanceof FauxRequest && !$request->hasRequestURL()
			? ''
			: $request->getRequestURL();
		$trimmedRequestUrl = trim( $requestUrl, '/\\' );

		if ( $egSpecial404RedirectExistingRoots && $requestUrl !== '' ) {
			$titles = [
				$requestUrl,
				$trimmedRequestUrl,
				urldecode( $requestUrl ),
				urldecode( $trimmedRequestUrl ),
			];
			foreach ( $titles as $pageTitle ) {
				$t = Title::newFromText( $pageTitle );
				if ( $t && $t->exists() ) {
					$output->redirect( $t->getFullURL(), 301 );
					return;
				}
			}
		}

		$this->setHeaders();
		$output->setStatusCode( 404 );
		$output->addWikiMsg( 'special404-body', $trimmedRequestUrl );
	}

}
