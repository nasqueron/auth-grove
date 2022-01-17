<?php

namespace AuthGrove\Tests\Undo;

use AuthGrove\Undo\Undoable;
use AuthGrove\Undo\WithUndo;

class UndoableMock implements Undoable {

    use WithUndo;

    ///
    /// Some properties
    ///

    public $foo = 'bar';

    public $bar = [7, 21, 42];

    public $id;

    ///
    /// Constructor
    ///

    public function __construct ($id = 0) {
        $this->id = $id;
    }

    ///
    /// To mock restore process
    ///

    public $enabled = true; // never deleted or restored

    public function save () {
        $this->enabled = true;
    }

    public function delete () {
        $this->enabled = false;
    }

}
