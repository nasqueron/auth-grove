<?php

namespace AuthGrove\Undo;

use Hash;
use InvalidArgumentException;
use OutOfBoundsException;

class UndoStore {

    ///
    /// Private members
    ///

    /**
     * The serialized instance of the object stored.
     *
     * @var string
     */
    private $serializedInstance;

    /**
     * The operation control ID.
     *
     * @var string
     */
    private $controlHash = '';

    ///
    /// Public properties
    ///

    /**
     * The method to call to restore the state.
     * This method must belongs to the stored object.
     *
     * @var string
     */
    public $restoreMethod = 'save';

    /**
     * The parameters of the method to call to restore the state.
     *
     * @var array
     */
    public $restoreMethodParameters = [];

    /**
     * Gets the stored instance.
     *
     * @return mixed
     */
    public function getInstance() {
        return unserialize($this->serializedInstance);
    }

    /**
     * Sets a new instance of an object to store.
     *
     * @param mixed The instance to store
     */
    public function setInstance ($instance) {
        $this->serializedInstance = serialize($instance);
    }

    /**
     * Gets the control ID of the instance. This allows to ensure its integrity.
     *
     * @return string An hash of the instance properties
     */
    public function getControlHash () {
        if ($this->controlHash === '') {
            $this->computeControlHash();
        }
        return $this->controlHash;
    }

    ///
    /// Constructor
    ///

    /**
     * Initializes a new instance of the UndoStore object.
     *
     * @param mixed $instance The instance of the object to store
     */
    public function __construct ($instance) {
        $this->setInstance($instance);
    }

    ///
    /// Control ID
    ///

    /**
     * Determines if the operation control identifiant is the same than defined in the store.
     *
     * This allows for example to avoid to restore stale session data and ensure the user wants really to restore this instance.
     *
     * @param string $actualControlHash The operation control id to compare
     * @return bool
     */
    public function isSameControlHash ($actualControlHash) {
        return $this->controlHash !== '' && $this->controlHash === $actualControlHash;
    }

    /**
     * Determines the object integrity is intact, ie properties has not been modified since last control id computation
     */
    public function checkIntegrity () {
        $hash = $this->getControlHashForCurrentData();
        return hash_equals($hash, $this->controlHash);
    }

    /**
     * Computes a control id from the stored information
     */
    public function computeControlHash () {
        $this->controlHash = $this->getControlHashForCurrentData();
    }

    /**
     * @return string The control hash
     */
    protected function getControlHashForCurrentData () {
        $data = $this->getDataForControlHash();
        return hash("ripemd160", $data);
    }

    /**
     * Gets a unique string representation of the current store.
     *
     * @return string
     */
    protected function getDataForControlHash () {
        return $this->serializedInstance
             . $this->restoreMethod
             . serialize($this->restoreMethodParameters);
    }

    ///
    /// Restore
    ///

    /**
     * Restores previous state of the stored instance.
     *
     * @param out mixed $return The restore method's return value
     * @return mixed The restored instance
     */
    public function restoreState (&$return = null) {
        $instance = $this->getInstance();

        if ($instance === null) {
            throw new OutOfBoundsException;
        }

        if (!method_exists($instance, $this->restoreMethod)) {
            throw new InvalidArgumentException;
        }

        $return = call_user_func_array(
            [$instance, $this->restoreMethod],
            $this->restoreMethodParameters
        );
        return $instance;
    }

}
