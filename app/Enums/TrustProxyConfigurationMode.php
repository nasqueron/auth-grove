<?php

namespace AuthGrove\Enums;

use Artisaninweb\Enum\Enum;

/**
 * @method static TrustProxyConfigurationMode ENUM()
 */
class TrustProxyConfigurationMode extends Enum {
    const TRUST_NONE = 0;
    const TRUST_SOME = 1;
    const TRUST_ALL  = 2;
}
