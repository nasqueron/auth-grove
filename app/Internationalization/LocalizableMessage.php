<?php

namespace AuthGrove\Internationalization;

class LocalizableMessage {

    ///
    /// Properties
    ///

    /**
     * The prefix to use to get l10n
     *
     * @var string
     */
    protected $prefix = '';

    /**
     * The message to localize
     *
     * @var string
     */
    protected $message;

    /**
     * The current representation of the message string
     *
     * @var string
     */
    protected $string;

    ///
    /// Constructor
    ///

    /**
     * Represents a new instance of the LocalizableMessage class
     */
    public function __construct ($message) {
        $this->message = $message;
        $this->string = $message; // By default, it contains unlocalized text.
    }

    ///
    /// L10n methods
    ///

    /**
     * @return LocalizableMessage
     */
    public function localize () {
        $this->string = trans($this->prefix . $this->message);
        return $this;
    }

    ///
    /// Transformation methods
    ///

    /**
     * Replaces spaces by no breaking spaces
     * @return LocalizableMessage
     */
    public function replaceSpacesByNonBreakableSpaces () {
        $nbsp = self::getNonBreakableSpace();
        $this->string = str_replace(' ', $nbsp, $this->string);
        return $this;
    }

    /**
     * Pads the message
     *
     * @param int $len The length of the taget string
     */
    public function pad ($len) {
        $this->string = \Keruald\mb_str_pad($this->string, $len);
        return $this;
    }

    ///
    /// Output methods
    ///

    /**
     * Gets a string representation of the message
     * @var string
     */
    public function get () {
        return $this->string;
    }

    ///
    /// Static helpers methods
    ///

    /**
     * Gets non breakable space
     */
    public static function getNonBreakableSpace() {
        return mb_convert_encoding('&nbsp;', 'UTF-8', 'HTML-ENTITIES');
    }

}
