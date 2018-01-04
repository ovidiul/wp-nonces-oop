# wp-nonces-oop
Package that implements the WordPress Nonces functionality (wp_nonce_*()) in an object orientated way.

## Requirements

- PHP 5.6+
- Composer
- WordPress 4.8.3+

## Installation

Install with [Composer](https://getcomposer.org):

```sh
$ composer require ovidiul/wp-nonces-oop
```

Features
--------

* PSR-4 autoloading compliant structure
* Unit-Testing with PHPUnit
* Comprehensive Guides and tutorial
* Easy to use to any framework or even a plain php file


## Usage

Initialize the nonce object generator 

```$generator = new NonceGenerator( 'action_name', 'nonce_parameter_name' );```

Then, to generate the nonce use the generate_nonce() method:

```$nonce = $generator->generate_nonce();```
  
Generate a url with nonce parameter:

```$url = $generator->generate_nonce_url( 'http://www.thinkovi.com' );```

Generate nonce field:

``$field = $generator->generate_nonce_field();``  

Nonce validation:

``$is_valid = $generator->validate_nonce($nonce);``

To validate a nonce received in a page through request (GET or POST) use the validate_request() method:

```$is_valid = $generator->validate_request();```

## Credits
Liuta Ovidiu <info@thinkovi.com> , http://www.thinkovi.com