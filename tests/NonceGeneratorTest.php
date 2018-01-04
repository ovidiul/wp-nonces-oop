<?php
namespace ThinkOvi\Nonce\test;

use ThinkOvi\Nonce\NonceGenerator;
use PHPUnit\Framework\TestCase;

class NonceGeneratorTest extends PHPUnit_Framework_TestCase
{
    /**
     * Test action.
     *
     * @var    string $test_action The default test action value.
     */
    private $test_action;

    /**
     * Test nonce.
     *
     * @var    string $test_action The default test nonce value.
     */
    private $test_nonce;

    /**
     * Test validator.
     *
     * @var    object $test_ng The default test generator object.
     */
    private $test_ng;

    /**
     * Setting up the test environment.
     */
    protected function setUp() {
        $this->test_action = 'my_action';
        $this->test_name = 'my_name';
        $this->test_ng1 = new Nonce_Generator( $this->test_action );
        $this->test_ng2 = new Nonce_Generator( $this->test_action, $this->test_name );

        // Building nonce value.
        $this->test_nonce1 = $this->test_ng1->generate_nonce();
        $this->test_nonce1 = $this->test_ng2->generate_nonce();
    }

    /**
     *
     */
    public function test__construct()
    {

    }

    public function testGenerate_nonce()
    {

    }

    public function testGenerate_nonce_url()
    {

    }

    public function testValidate_request()
    {

    }

    public function testValidate_nonce()
    {

    }

    public function testGenerate_nonce_field()
    {

    }
}
