<?php

use PHPUnit\Framework\TestCase;
use Moamalat\Payment\Moamalat;

class MoamalatTest extends TestCase
{
    protected $moamalat;

    protected function setUp(): void
    {
        $this->moamalat = new Moamalat();
    }

    public function testMakePayment()
    {
        $amount = 100; // Set the amount for the test
        $merchRef = 'ABC123'; // Set the merchant reference for the test

        $payment = $this->moamalat->makePayment($amount, $merchRef);

        // Assert that the payment method is 2
        $this->assertEquals(2, $payment['paymentMethodFromLightBox']);

        // Assert that the MID is retrieved from the environment variable
        $this->assertEquals(env("Moamalat_MerchantId"), $payment['MID']);

        // Assert that the TID is retrieved from the environment variable
        $this->assertEquals(env("Moamalat_TerminalId"), $payment['TID']);

        // Assert that the AmountTrxn matches the provided amount
        $this->assertEquals($amount, $payment['AmountTrxn']);

        // Assert that the MerchantReference matches the provided merchRef
        $this->assertEquals($merchRef, $payment['MerchantReference']);

        // Assert that the TrxDateTime is set correctly
        $this->assertRegExp('/\w{3}, \d{2} \w{3} \d{4} \d{2}:\d{2}:\d{2} \w{3}/', $payment['TrxDateTime']);

        // Assert that the SecureHash is generated correctly
        $expectedHash = $this->moamalat->generateSecureHash($payment['TrxDateTime'], $amount, $merchRef);
        $this->assertEquals($expectedHash, $payment['SecureHash']);
    }

    public function testGenerateSecureHash()
    {
        $time = 'Mon, 01 Jan 2023 12:00:00 GMT'; // Set a test time
        $amount = 100; // Set a test amount
        $merchRef = 'ABC123'; // Set a test merchant reference

        // Set the expected secure hash based on the provided inputs
        $expectedHash = 'EXPECTED_HASH';

        // Set the environment variables used in the secure hash generation
        putenv('Moamalat_MerchantId=YOUR_MERCHANT_ID');
        putenv('Moamalat_TerminalId=YOUR_TERMINAL_ID');
        putenv('Moamalat_MerchantSecretKey=YOUR_SECRET_KEY');

        $secureHash = $this->moamalat->generateSecureHash($time, $amount, $merchRef);

        // Assert that the generated secure hash matches the expected hash
        $this->assertEquals($expectedHash, $secureHash);
    }

    public function testHexToStr()
    {
        $hex = '48656c6c6f20576f726c64'; // Set a test hex string

        $expectedString = 'Hello World'; // Set the expected converted string

        $convertedString = $this->moamalat->hexToStr($hex);

        // Assert that the converted string matches the expected string
        $this->assertEquals($expectedString, $convertedString);
    }
}