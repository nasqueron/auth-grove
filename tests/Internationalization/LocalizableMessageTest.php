<?php

namespace AuthGrove\Tests\Internationalization;

use AuthGrove\Internationalization\LocalizableMessage;
use AuthGrove\Tests\TestCase;

class LocalizableMessageTest extends TestCase {

    /**
     * @var AuthGrove\Internationalization\LocalizableMessage
     */
    protected $message;

    public function setUp () {
        $this->message = new LocalizableMessage('app.title');

        parent::setUp();
    }

    public function testDryGet () {
        $this->assertSame('app.title', $this->message->get());
    }

    public function testLocalize () {
        $message = $this->message->localize()->get();
        $this->assertSame('Auth Grove', $message);
    }

    public function testPad () {
        $message = $this->message
            ->pad(12)
            ->get();
        $this->assertSame('app.title   ', $message);
    }

    public function testReplaceSpacesByNonBreakableSpaces () {
        $message = $this->message
            ->localize()
            ->replaceSpacesByNonBreakableSpaces()
            ->get();
        $this->assertSame('Auth Grove', $message);
    }

    public function testGetNonBreakableSpace () {
        $this->assertSame(
            ' ',
            LocalizableMessage::getNonBreakableSpace()
        );
    }

}
