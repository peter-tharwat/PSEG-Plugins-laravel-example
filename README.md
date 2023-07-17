
# Paysky Payment Light Box & Pay Button

## Installation
Require via composer

```bash
$ composer require paysky/payment
```

In `config/app.php` file

```php
'providers' => [
    ...
    PaySky\Payment\Providers\PaySkyPaymentServiceProvider::class,
    ...
];


'aliases' => [
    ...
    'PaySky' => PaySky\Payment\Facades\PaySky::class,
    ...
];

```

First of all, make an account on paysky -  run this command to generate the PaySky configuration file and choose the package
```bash
$ php artisan vendor:publish  
```
add configurations to your .env file and 
```bash
PaySky_MerchantSecretKey= XXXXX
PaySky_MerchantId= XXXXX
PaySky_TerminalId= XXXXX
PaySky_Enviroment= sandbox-production   
```


In Controller init new payment class add amount - oderId - merchRef - payment method type
```bash
$payment = PaySky::makePayment(100 , 32322332 , 323223 , 2);
    return view('welcome' ,  ['payment' => $payment ]  );
```
add payment view in your checkout page

```bash
@include('paysky::index')
```

# all amount by small curruncy ()