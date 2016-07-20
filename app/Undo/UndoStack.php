<?php

namespace AuthGrove\Undo;

use InvalidArgumentException;
use OutOfBoundsException;
use SplDoublyLinkedList;

/**
 * A stack of undo stores to maintain a LIFO collection of undoable operations.
 */
class UndoStack extends SplDoublyLinkedList {

    ///
    /// Constructor
    ///

    /**
     * Initializes a new instance of an UndoStack object.
     */
    public function __construct () {
        $this->setIteratorMode(self::IT_MODE_LIFO | self::IT_MODE_KEEP);
    }

    ///
    /// List helper methods
    ///

    /**
     * @return bool
     */
    protected function isLIFO () {
        $mode = $this->getIteratorMode();
        return ($mode & self::IT_MODE_LIFO) == self::IT_MODE_LIFO;
    }

    /**
     * Removes an element.
     * Behaves like offsetUnset, fixed for LIFO list, like a stack.
     *
     * @param mixed $index The offset, ascending for FILO, descending for LIFO
     */
    protected function offsetForeachIndexUnset ($index) {
        if ($index === -1) {
            // Lifo, element doesn't exist
            return;
        }

        if ($this->isLIFO()) {
            $fixedIndex = $this->count() - 1 - $index;
        } else {
            $fixedIndex = $index;
        }

        $this->offsetUnset($fixedIndex);
    }


    ///
    /// Stack helper methods
    ///

    /**
     * Gets a specified store.
     *
     * @param string $hash The hash of the store to get
     * @param out mixed $index The index of the found store [facultative]
     * @var mixed|null
     */
    public function getStore ($hash, &$index = null) {
        foreach ($this as $index => $store) {
            if ($store->getControlHash() === $hash) {
                return $store;
            }
        }

        $index = -1;
        return null;
    }

    /**
     * Gets a specified store, and discards it from the stack.
     *
     * @param string $hash The hash of the store to pull
     * @var mixed|null
     */
    public function pullStore ($hash) {
        $store = $this->getStore($hash, $index);
        $this->offsetForeachIndexUnset($index);

        return $store;
    }

    ///
    /// Undo helper methods
    ///

    /**
     * Undoes the last stacked operation.
     */
    public function undoLast () {
        if ($this->isEmpty()) {
            throw new OutOfBoundsException("UndoStack is empty.");
        }

        $store = $this->pop();
        if (!is_a($store, UndoStore::class)) {
            throw new InvalidArgumentException("UndoStack contained an item of unexpected type.");
        }

        $store->restoreState();
    }

    /**
     * Undoes a specified operation.
     *
     * @param string $hash The hash of the store to restore instance state
     * @param out mixed $return The value returned by the method called to undo the operation
     * @return Undoable The store's instance, after its state is restored
     */
    public function undo ($hash, &$return = null) {
        $store = $this->pullStore($hash);
        if ($store === null) {
            throw new OutOfBoundsException("Hash not found.");
        }

        return $store->restoreState($return);
    }

}
