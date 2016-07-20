<?php

namespace AuthGrove\Undo;

interface Undoable {

    /**
     * Undoes a destructive operation.
     *
     * @return bool
     */
    public static function undo (UndoStore $undoOperation, $operationControlHash, &$restored);

    /**
     * @return UndoStore
     */
    public function prepareUndoStore ();

}
