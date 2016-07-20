<?php

namespace AuthGrove\Undo;

/**
 * Trait offering an implementation for Undoable for default UndoStore
 * parameters.
 */
trait WithUndo {

    /**
     * Undoes a destructive operation.
     *
     * @param UndoStore $store
     * @param string $storeHash
     * @param mixed $restored The stored instance, to be able to further interact with it after undo
     * @return bool true if the operation is undone successfully; otherwise, false
     */
    public static function undo (UndoStore $store, $storeHash, &$restored) {
        // Ensures we undo the operation required by the user
        if (!$store->isSameControlHash($storeHash)) {
            return false;
        }

        if (!$store->checkIntegrity()) {
            return false;
        }

        $restored = $store->restoreState($return);

        return (bool)$return;
    }

    /**
     * Prepares an undo store, ie a glass coffin with a serialized copy of our
     * instance and instructions how to undo the destructive operation.
     *
     * @return UndoStore
     */
    public function prepareUndoStore () {
        return new UndoStore($this);
    }

}
