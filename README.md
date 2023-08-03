
# Moamalat Payment Light Box & Pay Button

## Installation
Require via composer

```bash
$ composer require Moamalat/payment
```

In `config/app.php` file

```php
'providers' => [
    ...
    Moamalat\Payment\Providers\MoamalatPaymentServiceProvider::class,
    ...
];


'aliases' => [
    ...
    'Moamalat' => Moamalat\Payment\Facades\Moamalat::class,
    ...
];

```

First of all, make an account on Moamalat -  run this command to generate the Moamalat configuration file and choose the package
```bash
$ php artisan vendor:publish  
```
add configurations to your .env file and 
```bash
Moamalat_MerchantSecretKey= XXXXX
Moamalat_MerchantId= XXXXX
Moamalat_TerminalId= XXXXX
Moamalat_Enviroment= sandbox-production   
```


In Controller init new payment class add amount - merchRef
```bash
$payment = Moamalat::makePayment(100000 , rand() );

```
add payment button in your checkout page
```bash
@include('moamalat::index')
```
tanslation key for btn
```bash
moamalat.paybtn
```
pass payment variable to view have button link

```bash
return view('welcome' ,  ['payment' => $payment ]  );

```
create redirect routes to recived call backs

```bash
'moamalat.payment.completeCallback
 moamalat.payment.errorCallback

```
# all amount by small curruncy ()
