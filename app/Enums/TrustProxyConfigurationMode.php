<?php

namespace AuthGrove\Enums;

use Artisaninweb\Enum\Enum;

/**
 * @method static TrustProxyConfigurationMode ENUM()
 */
class TrustProxyConfigurationMode extends Enum {
    const __default = self::TrustNone;

    const TrustNone = 0;
    const TrustSome = 1;
    const TrustAll  = 2;
}
