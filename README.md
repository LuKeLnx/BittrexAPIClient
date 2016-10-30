# Bittrex Client

## Installation
Installation is easily done via Composer, simply run:

```
$ composer require erikbooij/bittrex-client
```

## Usage
Instantiate an instance of the client with the following code:

```
$bittrexClient = new ErikBooij\Bittrex\Client('api-key', 'api-secret');
```

Alternatively, you can pass your own HTTPClient in, as long as it conforms to GuzzleHttp's `ClientInterface`.

## Exception handling
If you like, you can register your own exception handling, by passing a callable to the `->setExceptionHandler()` method.

```
$bittrexClient->setExceptionHandler(function (\Exception $exception) {
    // Log the exception, or do whatever you prefer
});
```

## Available methods

### Get balance for a given currency
This method will return details on your balance.

```
/** @return ErikBooij\Bittrex\Model\Balance */
$bittrexClient->getBalance('BTC');
```

### Get all balances
This method will return an array containing all balances available within your Bittrex account.

```
/** @return ErikBooij\Bittrex\Model\Balance[] */
$bittrexClient->getBalances();
```

### Get all currencies
This method will return an array containing the currencies available on Bittrex.

```
/** @return ErikBooij\Bittrex\Model\Currency[] */
$bittrexClient->getCurrencies();
```

### Get deposit address
This method will return the current deposit address for the given currency. If there is no address available yet, it will be generated at Bittrex and the call will return `'Address is being generated'`.

```
/** @return string */
$bittrexClient->getDepositAddress('BTC');
```

### Get market history
This method will return an array containing 200 of the most recent orders for the market you supply.

```
/** @return ErikBooij\Bittrex\Model\Transaction[] */
$bittrexClient->getMarketHistory('BTC-LTC');
```

### Get markets
This method will return an array containing all markets available on Bittrex.

```
/** @return ErikBooij\Bittrex\Model\Market[] */
$bittrexClient->getMarkets();
```

### Get market summaries
This method will return an array containing summaries for each market on Bittrex.

```
/** @return ErikBooij\Bittrex\Model\MarketSummary[] */
$bittrexClient->getMarketSummaries();
```

### Get market summary
This method will return a single market summary for the market you supply.

```
/** @return ErikBooij\Bittrex\Model\MarketSummary */
$bittrexClient->getMarketSummary('BTC-LTC');
```

### Get open orders
This method will return an array containing all your orders that are currently open.

```
/** @return ErikBooij\Bittrex\Model\OpenOrder[] */
$bittrexClient->getOpenOrders();
```

### Get order book
This method will return an array containing the open orders on the market.

```
/** @return ErikBooij\Bittrex\Model\Order[] */
$bittrexClient->getOrderBook('BTC-LTC');
```


### Get ticker
This method will return the latest tick for the market.

```
/** @return ErikBooij\Bittrex\Model\Ticker */
$bittrexClient->getTicker('BTC-LTC');
```

### Place limit order
This method allows you to place a **limit** _buy_ or _sell_ order. On success it returns the UUID for the order, otherwise it returns the error message.

```
/** @return string */
$bittrexClient->placeLimitOrder('buy', 'BTC-LTC', 50.0, 0.0055);
$bittrexClient->placeLimitOrder('sell', 'BTC-LTC', 50.0, 0.0055);
```

### Place market order
This method allows you to place a **market** _buy_ or _sell_ order. On success it returns the UUID for the order, otherwise it returns the error message.

```
/** @return string */
$bittrexClient->placeMarketOrder('buy', 'BTC-LTC', 50.0);
$bittrexClient->placeMarketOrder('sell', 'BTC-LTC', 50.0);
```

### Cancel order
This method allows you to cancel an order (market and limit). It returns true if the order was successfully cancelled.

```
/** @return bool */
$bittrexClient->cancelOrder('e606d53c-8d70-11e3-94b5-425861b86ab6');
```

## Data models

### `new Balance()`
```
$balance = $bittrexClient->getBalance('BTC');

$balance->getAddress();                 // <string>
$balance->getAvailable();               // <float>
$balance->getCurrency();                // <string>
$balance->getPending();                 // <float>
$balance->getTotal();                   // <float>
```


### `new Currency([string $shortName, string $longName])`
```
$currencies = $bittrexClient->getCurrencies();

$currencies[0]->getBaseAddress();       // <string>
$currencies[0]->getCoinType();          // <string>
$currencies[0]->getLongName();          // <string>
$currencies[0]->getMinConfirmation();   // <int>
$currencies[0]->getShortName();         // <string>
$currencies[0]->getTxFee();             // <float>
$currencies[0]->isActive();             // <bool>
```

### `new Market()`
```
$market = $bittrexClient->getMarket('BTC-LTC');

$market->getBaseCurrency();             // <string>
$market->getCreated();                  // <DateTime>
$market->getMarketCurrency();           // <string>
$market->getMarketName();               // <string>
$market->getMinTradeSize();             // <float>
$market->isActive();                    // <bool>

```

### `new MarketSummary()`
```
$marketSummary = $bittrexClient->getMarketSummary('BTC-LTC');


$marketSummary->getAsk();               // <float>
$marketSummary->getBaseVolume();        // <float>
$marketSummary->getBid();               // <float>
$marketSummary->getCreated();           // <DateTime>
$marketSummary->getHigh();              // <float>
$marketSummary->getLast();              // <float>
$marketSummary->getLow();               // <float>
$marketSummary->getMarketName();        // <string>
$marketSummary->getOpenBuyOrders();     // <int>
$marketSummary->getOpenSellOrders();    // <int>
$marketSummary->getPrevDay();           // <float>
$marketSummary->getTimeStamp();         // <DateTime>
$marketSummary->getVolume();            // <float>
```

### `new OpenOrder()`
```
$openOrders = $bittrexClient->getOpenOrders();

$openOrders[0]->getCommissionPaid();    // <float>
$openOrders[0]->getCondition();         // <string>
$openOrders[0]->getConditionTarget();   // <float>
$openOrders[0]->getLimit();             // <float>
$openOrders[0]->getMarket();            // <string>
$openOrders[0]->getOpened();            // <DateTime>
$openOrders[0]->getOrderType();         // <string>
$openOrders[0]->getOrderUuid();         // <string>
$openOrders[0]->getPrice();             // <float>
$openOrders[0]->getPricePerUnit();      // <float>
$openOrders[0]->getQuantity();          // <float>
$openOrders[0]->getQuantityRemaining(); // <float>
$openOrders[0]->getUuid();              // <string>
$openOrders[0]->isCancelInitiated();    // <bool>
$openOrders[0]->isConditional();        // <bool>
$openOrders[0]->isImmediateOrCancel();  // <bool>
```

### `new Order()`
```
$orders = $bittrexClient->getOrderBook('BTC-LTC');

$orders[0]->getRate();                  // <float>
$orders[0]->getQuantity();              // <float>
$orders[0]->getType();                  // <string>
```

### `new Ticker()`
```
$ticker = $bittrexClient->getTicker('BTC-LTC');

$ticker->getAsk();                      // <float>
$ticker->getBid();                      // <float>
$ticker->getLast();                     // <float>
```

### `new Transaction()`
```
$transactions = $bittrexApi->getMarketHistory('BTC-LTC');

$transactions[0]->getFillType();        // <string>
$transactions[0]->getId();              // <int>
$transactions[0]->getOrdertype()        // <string>
$transactions[0]->getPrice()            // <float>
$transactions[0]->getProcessedTime();   // <DateTime>
$transactions[0]->getQuantity();        // <float>
$transactions[0]->getTotal();           // <total>
```
