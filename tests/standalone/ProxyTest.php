<?php

namespace AuthGrove\Tests;

use App;

/**
 * Tests the bug described in T492: when using a front-end server
 * with SSL termination, back-end should serve http:// links.
 */
class ProxyTest extends TestCase {

    public function testProxiesAndHttpsLinksInteraction () {
        // These cases should be in one test: if split in several tests,
        // the application configuration isn't reset correctly and we lost.

        // CASE I
        //
        // By default, we don't trust proxies, and we don't receive proxy
        // information, so links are HTTP.
        App::make('config')->set('app.proxy', []);

        $this->visit('/')
             ->see('http://localhost/');

        // This header, if trusted, means we serve HTTPS links.
        $server = [
            'X-Forwarded-Proto' => 'https'
        ];

        // CASE II
        // When we don't trust proxies
        // and reverse proxy tell us it's for HTTPS
        // we serve HTTP links, ignoring X-Forwarded-Proto.
        App::make('config')->set('app.proxy', []);
        $this->get('/', $server);
        $this->see('http://localhost');

        // CASE III
        // When we trust all proxies
        // and reverse proxy tell us it's for HTTPS
        // we serve HTTP links, according X-Forwarded-Proto.
        App::make('config')->set('app.proxy', ['*']);
        $this->get('/', $server);
        $this->see('https://localhost/');

        // CASE IV
        // When we don't trust the current proxy
        // and reverse proxy tell us it's for HTTPS
        // we serve HTTP links, ignoring X-Forwarded-Proto.
        App::make('config')->set('app.proxy', ['1.2.3.4']);
        $this->get('/', $server);
        $this->see('http://localhost');
    }


}
