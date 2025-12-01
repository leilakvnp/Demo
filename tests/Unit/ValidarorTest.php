<?php

use Core\Validator;

it('validates a string',function() {
    expect(Validator::string('foobar'))->toBeTrue();
    expect(Validator::string(''))->toBEFalse();
    expect(Validator::string(false))->toBEFalse();
});
it('validates a string with  minimum length ',function() {
    expect(Validator::string('foobar',20))->toBeFalse();
 
});
it('validates an email ',function() {
    expect(Validator::email('foobar.gmail.com'))->toBeFalse();
    expect(Validator::email('foobar@gmail.com'))->toBeTrue();// return flase because it return an object if the format is ok.(not bool)
 
});