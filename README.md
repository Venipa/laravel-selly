# Laravel Selly PHP API

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mccaulay/laravel-selly.svg?style=flat-square)](https://packagist.org/packages/mccaulay/laravel-selly)
[![Build Status](https://img.shields.io/travis/mccaulay/laravel-selly/master.svg?style=flat-square)](https://travis-ci.org/mccaulay/laravel-selly)
[![Quality Score](https://img.shields.io/scrutinizer/g/mccaulay/laravel-selly.svg?style=flat-square)](https://scrutinizer-ci.com/g/mccaulay/laravel-selly)
[![Total Downloads](https://img.shields.io/packagist/dt/mccaulay/laravel-selly.svg?style=flat-square)](https://packagist.org/packages/mccaulay/laravel-selly)

## Installation

You can install the package via composer:

```bash
composer require mccaulay/laravel-selly
```

## Environment Variables
```
SELLY_EMAIL=your@email.com
SELLY_API_KEY=yourApiKey
SELLY_WEBHOOK_SECRET=yourWebhookSecret
```

## Usage

### Creating a payment
``` php
use McCaulay\Selly\Payment;

$payment = new Payment();
$order = $payment->setTitle('Test Product')
    ->setGateway('Bitcoin')
    ->setEmail('example@example.com')
    ->setValue(10)
    ->setCurrency('USD')
    ->setReturnUrl(secure_url('/'))
    ->setWebhookUrl(secure_url('/example/webhook'))
    ->setWhiteLabel(true)
    ->setIpAddress($request->ip())
    ->save();
$orderId = $order->getId(); // Get the created order id
```

### Get all coupons
``` php
use McCaulay\Selly\Coupon;
$coupons = Coupon::all();
```

### Get an order from a webhook request
``` php
use McCaulay\Selly\Facades\Selly;

$order = Selly::webhook($request);
$orderId = $order->getId(); // Get the webhook order id
```

### Convert a value from a currency to Satoshi
``` php
use McCaulay\Selly\Facades\Selly;

$satoshi = Selly::toSatoshi('0.04710219');
// $satosi = 4710219;
```

### Convert a value from Satoshi to a currency
``` php
use McCaulay\Selly\Facades\Selly;

$satoshi = Selly::fromSatoshi(4710219);
// $satosi = '0.04710219';
```

### Get an order by id
``` php
use McCaulay\Selly\Facades\Selly;

$order = Selly::order('174e2e74-1939-351b-aa2b-6921f11a3d82');
```

``` php
use McCaulay\Selly\Order;

// Another way to get order by id
$order = Order::find('174e2e74-1939-351b-aa2b-6921f11a3d82');
```

## Credits

- [McCaulay Hudson](https://github.com/mccaulay)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
