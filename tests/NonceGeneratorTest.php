<?php
namespace ThinkOvi\Nonce\test;

use ThinkOvi\Nonce\NonceGenerator;
use PHPUnit\Framework\TestCase;

class NonceGeneratorTest extends TestCase
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
        $this->test_ng1 = new NonceGenerator( $this->test_action );
        $this->test_ng2 = new NonceGenerator( $this->test_action, $this->test_name );

        // Building nonce value.
        $this->test_nonce = \ThinkOvi\Nonce\wp_create_nonce( $this->test_action );
    }

    /**
     * Test the object instance.
     */
    public function test_instance() {
        $this->assertInstanceOf( NonceGenerator::class, $this->test_ng2 );
        $this->assertInstanceOf( NonceGenerator::class, $this->test_ng1 );
    }
    /**
     * Test the getter and setter for the action property.
     */
    public function test_get_set_action() {
        $ng = $this->test_ng2;
        // Check the getter.
        $this->assertSame( $this->test_action, $ng->get_action() );
        // Check the setter.
        $action = $ng->set_action( 'new_action' );
        $this->assertSame( $ng->get_action(), $action );
    }
    /**
     * Test the getter and setter for the name property.
     */
    public function test_get_set_name() {
        $ng = $this->test_ng2;
        // Check the getter.
        $this->assertSame( $this->test_name, $ng->get_name() );
        // Check the setter.
        $name = $ng->set_name( 'new_name' );
        $this->assertSame( $ng->get_name(), $name );
    }
    /**
     * Test the getter and setter for the name property when default value in the constructor is used.
     */
    public function test_default_name() {
        $ng = new NonceGenerator( 'another_action' );

        // Check the action property getter.
        $this->assertSame( 'another_action', $ng->get_action() );

        // Check the name property getter: the name value now is the default one.
        $this->assertSame( '_wpnonce', $ng->get_name() );
    }
    /**
     * Test the generate_nonce method used for the straight generation of the nonce.
     */
    public function test_generate_nonce() {
        $ng = $this->test_ng1;
        // The constructor sets nonce property to null. Checking null value.
        $this->assertNull( $ng->get_nonce() );
        // Generating the nonce.
        $nonce_generated = $ng->generate_nonce();
        // Check the nonce.
        $this->assertSame( $nonce_generated, $this->test_nonce );
    }
    /**
     * Test the getter and setter for the nonce property.
     */
    public function test_get_set_nonce() {

        // Generating the nonce.
        $nonce_generated = $this->test_ng1->generate_nonce();

        // Setting new value for the nonce.
        $this->test_ng1->set_nonce( 'new_nonce' );
        // Getting and cheking the nonce value.
        $this->assertNotEquals( $nonce_generated, $this->test_ng1->get_nonce() );
        $this->assertSame( 'new_nonce', $this->test_ng1->get_nonce() );
    }

    public function test_generate_nonce_field(){

        $nfg = $this->test_ng1;
        // Generating the form field.
        $field_generated = $nfg->generate_nonce_field( false, false );
        // Building the expected form field.
        $field_expected = '<input type="hidden" id="_wpnonce" name="_wpnonce" value="' . $this->test_nonce . '" />';
        // Checking result.
        $this->assertSame( $field_generated, $field_expected);
    }

    public function test_generate_nonce_field_referer(){

        $nfg = $this->test_ng1;
        // Generating the form fields.
        $field_generated = $nfg->generate_nonce_field( true, false );
        // Building the expected form fields.
        $field_expected = '<input type="hidden" id="_wpnonce" name="_wpnonce" value="' . $this->test_nonce . '" /><input type="hidden" name="_wp_http_referer" value="my-url" />';
        // Checking result.
        $this->assertSame( $field_generated, $field_expected);
    }
    /**
     * Test the generate_nonce_field method to build form field with a nonce parameter to send via POST. Here the
     * parameter refer and echo are called with values:
     *
     *	referer: false ---> hidden field with refer url value is not added.
     *	echo: true ------> the field is printed.
     */
    public function test_generate_nonce_field_echo(){

        $nfg = $this->test_ng1;
        // Building the expected form field.
        $field_expected = '<input type="hidden" id="_wpnonce" name="_wpnonce" value="' . $this->test_nonce . '" />';
        // Check that the result is printed.
        $this->expectOutputString($field_expected);
        // Generating the form fields. The second parameter defaults to true.
        $field_generated = $nfg->generate_nonce_field( false );
        // Checking result.
        $this->assertSame( $field_generated, $field_expected);
    }
    /**
     * Test the generate_nonce_field method to build form field with a nonce parameter to send via POST. Here the
     * parameter refer and echo are called with values:
     *
     *	referer: true ---> hidden field with refer url value is added.
     *	echo: true ------> the fields are printed.
     */
    public function test_generate_nonce_field_referer_echo(){

        $nfg = $this->test_ng1;
        // Building the expected form fields.
        $field_expected = '<input type="hidden" id="_wpnonce" name="_wpnonce" value="' . $this->test_nonce . '" /><input type="hidden" name="_wp_http_referer" value="my-url" />';

        // Check that the result is printed.
        $this->expectOutputString($field_expected);

        // Generating the form fields. Both parameters defaults to true.
        $field_generated = $nfg->generate_nonce_field();
        // Checking result.
        $this->assertSame( $field_generated, $field_expected);
    }

    /**
     * Test the generate_nonce_url method to build an url with a nonce query parameter to send via GET.
     */
    public function test_generate_nonce_url(){
        // Generate the nonce and build the url.
        $url_generated = $this->test_ng1->generate_nonce_url( 'http://www.madaritech.com' );
        // Building the expected url.
        $url_expected = 'http://www.madaritech.com?_wpnonce='. $this->test_nonce;
        // Checking result.
        $this->assertSame( $url_generated, $url_expected);
    }

    /**
     * Test the validate_nonce method used for the straight validation of the nonce.
     */
    public function test_validate_nonce() {
        // Check validating method.
        $is_valid = $this->test_ng1->validate_nonce( $this->test_nonce );
        $this->assertTrue( $is_valid );
        // Injecting wrong value in the nonce.
        $is_valid = $this->test_ng1->validate_nonce( $this->test_nonce . 'failure' );

        // Check failure on validating.
        $this->assertFalse( $is_valid );
    }
    /**
     * Test the validate_nonce method used for the validation of the nonce through the $_REQUEST.
     */
    public function test_validate_request() {
        $test_name = '_wpnonce';
        // Build the $_REQUEST
        $_REQUEST[ $test_name ] = $this->test_nonce;
        // Checking validation method.
        $is_valid = $this->test_ng1->validate_request();
        $this->assertTrue( $is_valid );
        // Injecting wrong value in the nonce.
        $_REQUEST[ $test_name ] = $this->test_nonce . 'failure';
        // Check failure on validating.
        $is_valid = $this->test_ng1->validate_request();
        $this->assertFalse( $is_valid );
    }
}
