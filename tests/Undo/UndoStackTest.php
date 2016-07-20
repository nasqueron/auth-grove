<?php

namespace AuthGrove\Tests\Undo;

use AuthGrove\Undo\UndoStack;
use AuthGrove\Undo\UndoStore;
use AuthGrove\Tests\TestCase;

/**
 * Tests for the UndoStack class
 */
class UndoStackTest extends TestCase {

    /**
     * The stack to test
     * @var AuthGrove\Undo\UndoStack
     */
    protected $stack;

    /**
     * An array of three operations to store
     * @var AuthGrove\Undo\UndoStore[]
     */
    protected $stores = [];

    ///
    /// Test preparation
    ///

    public function setUp  () {
        $this->stack = new UndoStack;

        parent::setUp();
    }

    /**
     * Mocks some undoable operations, stores them,
     * fills the stack with the stores.
     *
     * @param int $amount The amoutn of store to stack
     */
    public function fillStack ($amount = 3) {
        for ($i = 0 ; $i < $amount ; $i++) {
            $store = static::getUndoStore($i);
            $this->stack->push($store);
        }
    }

    /**
     * Mocks an undoable object and stores it.
     *
     * @param int $id The undoable object's value of the id property
     * @return \AuthGrove\Undo\UndoStore
     */
    protected static function getUndoStore ($id = 0) {
        return new UndoStore(new UndoableMock($id));
    }

    ///
    /// Tests
    ///

    public function testUndoLastEmptiesTheStack () {
        $this->fillStack();
        for ($i = 0 ; $i < 3 ; $i++) {
            $this->stack->undoLast();
        }
        $this->assertEquals(0, $this->stack->count());
    }

    /**
     * @expectedException \OutOfBoundsException
     */
    public function testUndoLastOnAnEmptyStackThrowsException () {
        $this->stack->undoLast();
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testCorruptedUndoStackThrowsException () {
        $this->stack->push(1); // uh oh, this is an integer, not an UndoStore item!
        $this->stack->undoLast();
    }

    public function testStackIsLIFO () {
        $this->fillStack(); // Stored instance id is 0, 1, 2

        $i = 2; // Should be 2, 1 0
        foreach ($this->stack as $store) {
            $this->assertEquals($i--, $store->getInstance()->id);
        }
    }

    public function testUndo () {
        $store = static::getUndoStore();
        $store->getInstance()->delete();
        $hash = $store->getControlHash();

        $this->stack->push($store);
        $this->stack->undo($hash);

        $this->assertEquals(true, $store->getInstance()->enabled);
    }

    /**
     * @expectedException \OutOfBoundsException
     */
    public function testUndoThrowsExceptionWhenHashIsInvalid () {
        $this->stack->undo("invalidhash");
    }

    /**
     * @expectedException \OutOfBoundsException
     */
    public function testUndoThrowsExceptionWhenHashIsNull () {
        $this->stack->undo(null);
    }

}
