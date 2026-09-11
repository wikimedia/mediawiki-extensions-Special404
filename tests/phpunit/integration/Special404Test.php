<?php

use MediaWiki\Request\FauxRequest;

/**
 * @covers \Special404
 * @group Database
 */
class Special404Test extends SpecialPageTestBase {

	/** @inheritDoc */
	protected function newSpecialPage() {
		return new Special404();
	}

	public function testExecuteWithRequestUrl() {
		$request = new FauxRequest();
		$request->setRequestURL( '/Missing_Page' );

		[ $html, $response ] = $this->executeSpecialPage( '', $request, null, null, true );

		$this->assertSame( 404, $response->getStatusCode() );
		$this->assertStringContainsString( 'Missing_Page', $html );
	}

	public function testExecuteWithoutRequestUrl() {
		$this->setMwGlobals( 'egSpecial404RedirectExistingRoots', true );

		[ , $response ] = $this->executeSpecialPage( '', new FauxRequest(), null, null, true );

		$this->assertSame( 404, $response->getStatusCode() );
	}

}
