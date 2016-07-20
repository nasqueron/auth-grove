<?php

namespace AuthGrove\Undo;

use App;

trait UndoesOperations {

    /*
    |--------------------------------------------------------------------------
    | Undoes operations
    |-------------------------------------------------------------------------
    |
    | This trait for a Laravel controller allows to maintain an UndoStack
    | instance stored at the 'undo' key in the user session.
    |
    */

    /**
     * @return UndoStack
     */
    public function getUndoStack() {
        return App::make('request')
            ->session()
            ->get('undo', new UndoStack);
    }

    /**
     * @return string The stored operation control hash
     */
    public function allowUndo (Undoable $undoable) {
        $store = $undoable->prepareUndoStore();
        $this->getUndoStack()->push($store);
        return $store->getControlHash();
    }

}
