<?php

namespace AuthGrove\Tests\Undo;

use AuthGrove\Undo\UndoStore;
use AuthGrove\Tests\TestCase;

use stdClass;

class UndoStoreTest extends TestCase {

    protected $instance;

    protected $undoStore;

    ///
    /// Test preparation
    ///

    public function setUp  () {
        $this->instance = static::mockInstanceToStore();
        $this->undoStore = $this->getUndoStore();

        parent::setUp();
    }

    protected static function mockInstanceToStore () {
        return new UndoableMock();
    }

    protected function getUndoStore () {
        return new UndoStore($this->instance);
    }

    ///
    /// Tests
    ///

    public function testSetInstance () {
        $instance = clone $this->instance;
        $this->undoStore->setInstance($instance);

        $this->assertEquals(
            $instance,
            $this->undoStore->getInstance()
        );
    }

    public function testGetInstance () {
        $this->assertEquals(
            $this->instance,
            $this->undoStore->getInstance()
        );
    }

    public function testCheckIntegrityWhenNotYetComputed () {
        // If there is no integrity check, integrity can't be verified
        $this->assertFalse($this->undoStore->checkIntegrity());
    }

    public function testCheckIntegrity () {
        // Compute it. Check it.
        $controlHash = $this->undoStore->getControlHash();
        $this->assertInternalType("string", $controlHash);
        $this->assertTrue($this->undoStore->checkIntegrity());
    }

    public function testCheckIntegrityWhenDataIsTampered () {
        $controlHash = $this->undoStore->getControlHash();

        $tamperedInstance = clone $this->instance;
        $tamperedInstance->foo = 'quux';
        $this->undoStore->setInstance($tamperedInstance);

        $this->assertFalse($this->undoStore->checkIntegrity());

        $this->undoStore->computeControlHash();
        $afterTamperControlHash = $this->undoStore->getControlHash();
        $this->assertNotEquals($controlHash, $afterTamperControlHash);
    }

    public function testIsSameControlHash () {
        $controlHash = $this->undoStore->getControlHash();
        $this->assertTrue(
            $this->undoStore->isSameControlHash($controlHash)
        );
    }

    public function testIsSameControlHashWhenItIsNot () {
        $this->undoStore->computeControlHash();
        $this->assertFalse(
            $this->undoStore->isSameControlHash("somethingelse")
        );
    }

    public function testIsSameControlHashWhenEmpty () {
        $this->assertFalse(
            $this->undoStore->isSameControlHash("")
        );
    }

    public function testRestoreState () {
        $instance = clone $this->instance;

        $instance->enabled = false;
        $this->undoStore->setInstance($instance);

        $this->assertFalse(
            $this->undoStore->getInstance()->enabled
        );

        $this->assertTrue(
            $this->undoStore->restoreState()->enabled
        );
    }

    /**
     * @expectedException OutOfBoundsException
     */
    public function testRestoreStateWhenThereIsNoInstance () {
        $this->undoStore->setInstance(null);
        $this->undoStore->restoreState();
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testRestoreStateWhenTheRestoreMethodDoesNotExist () {
        $this->undoStore->setInstance(new stdClass);
        $this->undoStore->restoreState();
    }

}
