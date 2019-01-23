
Helper library providing all necessary details to constructing properly tracked Orders in AdTredo service.

## Installation
Simply run
```bash
composer require intredo/order-connector@dev-master
```
in your project directory.

## Sample usage
```php
// Instantiate your connector service
$connector = new \Intredo\OrderConnector\OrderConnector('API-KEY', 'ENDPOINT');

// Instantiate your Order
$orderNo = 'xyz';
$order = new \Intredo\OrderConnector\Order();
$order->setOrderNo($orderNo);

// ... call setters to provide more information to Order. Check it's methods to see what information should be provided.
// Only filled up Orders will be valid to tracking service, others will be simply marked as invalid and passed over.
// NOTE: User data (browser, OS, resolution) are not necessary but helpful. Same goes for Address Data.
// Product codes should be registered and match in AdTredo. Invalid codes will cause the Order to be discarded as above.

// Second parameter allows you to perform the sending asynchronously by switching it to false. In this case, instead of
// ResponseInterface, a Promise will be returned.
// @see http://docs.guzzlephp.org/en/stable/quickstart.html#async-requests for details regarding handling those promises
$response = $connector->sendOrder($order);
// $promise = $connector->sendOrder($order, false);
// $promise->then(function() {...});
// $promise->wait();

// Prepare Order Update
$patch = new \Intredo\OrderConnector\PatchOrder()
$patch->setOrderNo();

// ... call setters with data you want to update.
$response = $connector->sendOrderUpdate($order);
```
