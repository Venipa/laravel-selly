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

``` php
// Creating a payment
$payment = new \McCaulay\Selly\Payment();
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

``` php
// Get all coupons
$coupons = \McCaulay\Selly\Coupon::all();
```

``` php
// Get an order from a webhook request
$order = \McCaulay\Selly\Facades\Selly::webhook($request);
$orderId = $order->getId(); // Get the webhook order id
```

``` php
// Convert a value from a currency to Satoshi
$satoshi = \McCaulay\Selly\Facades\Selly::toSatoshi('0.04710219');
// $satosi = 4710219;
```

``` php
// Convert a value from Satoshi to a currency
$satoshi = \McCaulay\Selly\Facades\Selly::fromSatoshi(4710219);
// $satosi = '0.04710219';
```

``` php
// Get an order by id
$order = \McCaulay\Selly\Facades\Selly::order('174e2e74-1939-351b-aa2b-6921f11a3d82');
```

``` php
// Another way to get order by id
$order = \McCaulay\Selly\Order::find('174e2e74-1939-351b-aa2b-6921f11a3d82');
```

## Credits

- [McCaulay Hudson](https://github.com/mccaulay)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
