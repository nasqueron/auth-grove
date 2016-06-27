<?php namespace AuthGrove\Http\Middleware;

use AuthGrove\Enums\TrustProxyConfigurationMode;
use Config;
use Closure;

/**
 * Allow the application to work behind a load balancer or a reverse proxy
 *
 * See http://symfony.com/doc/current/cookbook/request/load_balancer_reverse_proxy.html
 */
class TrustProxy {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
		$proxy = Config::get('app.proxy');

		switch ($mode = self::getConfigurationMode($proxy)) {
			case TrustProxyConfigurationMode::TrustNone:
				break;

			case TrustProxyConfigurationMode::TrustSome:
				$request->setTrustedProxies($proxy);
				break;

			case TrustProxyConfigurationMode::TrustAll:
				$remoteAddr = $request->server->get('REMOTE_ADDR');
				$request->setTrustedProxies([ '127.0.0.1', $remoteAddr ]);
				break;

			default:
				throw new \ArgumentException("Unhandled configuration mode: $mode");
		}

		return $next($request);
	}

	/**
	 * Gets trust proxies configuration mode
	 */
	public static function getConfigurationMode ($configValue) {
		if (!is_array($configValue) || !count($configValue)) {
			return TrustProxyConfigurationMode::TrustNone;
		}

		if (in_array('*', $configValue)) {
			return TrustProxyConfigurationMode::TrustAll;
		}

		return TrustProxyConfigurationMode::TrustSome;
	}
}
