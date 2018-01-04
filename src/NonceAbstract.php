<?php
namespace ThinkOvi\Nonce;

/**
 * The abstract class for the nonces functionality.
 */
abstract class NonceAbstract implements NonceInterface {
    /**
     * Action string.
     *
     * @var    string $action The nonce action value.
     */
    private $action;
    /**
     * Name of the nonce.
     *
     * @var    string $name The nonce request name.
     */
    private $name;
    /**
     * Nonce value.
     *
     * @var    string $nonce The nonce value.
     */
    private $nonce;


    /**
     * NonceAbstract constructor.
     *
     * @param $param_action
     * @param string $param_name
     */
    public function __construct($param_action, $param_name = '_wpnonce' ) {
        $this->set_action( $param_action );
        $this->set_name( $param_name );
        $this->set_nonce( null );
    }

    /**
     * Get action property.
     *
     * @return string $action
     */
    public function get_action() {
        return $this->action;
    }

    /**
     * Set action property.
     *
     * @param string $param_action
     * @return string $action
     */
    public function set_action( $param_action ) {
        $this->action = $param_action;
        return $this->get_action();
    }

    /**
     * Get request name property.
     *
     * @return string $name
     */
    public function get_name() {
        return $this->name;
    }

    /**
     * Set request name property.
     *
     * @param string $param_name
     * @return string $name
     */
    public function set_name( $param_name ) {
        $this->name = $param_name;
        return $this->get_name();
    }

    /**
     * Get nonce property.
     *
     * @return string $nonce.
     */
    public function get_nonce() {
        return $this->nonce;
    }

    /**
     * Set nonce property.
     *
     * @param string $param_nonce
     * @return string $nonce
     */
    public function set_nonce( $param_nonce ) {
        $this->nonce = $param_nonce;
        return $this->get_nonce();
    }
}