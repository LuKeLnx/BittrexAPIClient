<?php

namespace ErikBooij\Bittrex;

use ErikBooij\Bittrex\Exception\FetchException;
use ErikBooij\Bittrex\Model\APIResponse;
use ErikBooij\Bittrex\Model\Balance;
use ErikBooij\Bittrex\Model\Currency;
use ErikBooij\Bittrex\Model\Market;
use ErikBooij\Bittrex\Model\MarketSummary;
use ErikBooij\Bittrex\Model\OpenOrder;
use ErikBooij\Bittrex\Model\Order;
use ErikBooij\Bittrex\Model\Ticker;
use ErikBooij\Bittrex\Model\Transaction;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\ClientInterface as HttpClientInterface;
use GuzzleHttp\Exception\GuzzleException;

/**
 * Class Client
 * @package ErikBooij\Bittrex
 */
class Client
{
    /** @var string */
    const API_BASE_URL = 'https://bittrex.com/api/v1.1';

    /** @var string */
    private $apiKey = '';

    /** @var string */
    private $apiSecret = '';

    /** @var Callable */
    private $exceptionHandler = null;

    /** @var HttpClientInterface */
    private $httpClient;

    /**
     * @param string $apiKey
     * @param string $apiSecret
     * @param HttpClientInterface $httpClient
     */
    public function __construct(string $apiKey, string $apiSecret, HttpClientInterface $httpClient = null)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;

        if (is_null($httpClient)) {
            $httpClient = new HttpClient();
        }
        $this->httpClient = $httpClient;
    }

    /**
     * @param string $currency
     * @return Balance
     */
    public function getBalance(string $currency) : Balance
    {
        $balance = new Balance();

        try {
            $response = $this->fetchAPIData('/account/getbalance', ['currency' => $currency]);
            $data = $this->parseAPIResponse($response);

            if (!$data->isSuccessful()) {
                return $balance;
            }

            $data = $data->getData()[0];

            $balance->setCurrency($data->Currency);
            $balance->setAddress($data->CryptoAddress);
            $balance->setTotal($data->Balance);
            $balance->setPending($data->Pending);
            $balance->setAvailable($data->Available);
        } catch (FetchException $exception) {
            $this->handleException($exception);
        } catch (GuzzleException $exception) {
            $this->handleException($exception);
        }

        return $balance;
    }

    /**
     * @return Balance[]
     */
    public function getBalances() : array
    {
        $balances = [];

        try {
            $response = $this->fetchAPIData('/account/getbalances');
            $data = $this->parseAPIResponse($response);

            if (!$data->isSuccessful()) {
                return $balances;
            }

            foreach ($data->getData() as $balanceInfo) {
                $balance = new Balance();

                $balance->setCurrency($balanceInfo->Currency);
                $balance->setAddress($balanceInfo->CryptoAddress);
                $balance->setTotal($balanceInfo->Balance);
                $balance->setPending($balanceInfo->Pending);
                $balance->setAvailable($balanceInfo->Available);

                $balances[$balanceInfo->Currency] = $balance;
            }
        } catch (FetchException $exception) {
            $this->handleException($exception);
        } catch (GuzzleException $exception) {
            $this->handleException($exception);
        }

        return $balances;
    }

    /**
     * @return Currency[]
     */
    public function getCurrencies() : array
    {
        $currencies = [];

        try {
            $response = $this->fetchAPIData('/public/getcurrencies');
            $data = $this->parseAPIResponse($response);

            if (!$data->isSuccessful()) {
                return $currencies;
            }

            foreach ($data->getData() as $currencyInfo) {
                $currency = new Currency();

                $currency->setActive($currencyInfo->IsActive);
                $currency->setBaseAddress($currencyInfo->BaseAddress ?? '');
                $currency->setCoinType($currencyInfo->CoinType);
                $currency->setLongName($currencyInfo->CurrencyLong);
                $currency->setMinConfirmation($currencyInfo->MinConfirmation);
                $currency->setTxFee($currencyInfo->TxFee);
                $currency->setShortName($currencyInfo->Currency);

                $currencies[$currencyInfo->Currency] = $currency;
            }
        } catch (FetchException $exception) {
            $this->handleException($exception);
        } catch (GuzzleException $exception) {
            $this->handleException($exception);
        }

        return $currencies;
    }

    /**
     * @param string $currency
     * @return string
     */
    public function getDepositAddress(string $currency) : string
    {
        $address = '';

        try {
            $response = $this->fetchAPIData('/account/getdepositaddress', ['currency' => $currency]);
            $data = $this->parseAPIResponse($response);

            if (!$data->isSuccessful()) {
                return $address;
            }

            if ($data->getMessage() === 'ADDRESS_GENERATING') {
                return 'Address is being generated';
            }

            $address = $data->getData()[0]->Address;
        } catch (FetchException $exception) {
            $this->handleException($exception);
        } catch (GuzzleException $exception) {
            $this->handleException($exception);
        }

        return $address;
    }

    /**
     * NOTE: This method doesn't take a count parameter, since that doesn't seem to be respected
     * in the Bittrex API. If at some point in the future it is, send me a message or a pull request.
     *
     * @param string $market
     * @return Transaction[]
     */
    public function getMarketHistory(string $market) : array
    {
        $marketHistory = [];

        try {
            $response = $this->fetchAPIData('/public/getmarkethistory', ['market' => $market]);
            $data = $this->parseAPIResponse($response);

            if (!$data->isSuccessful()) {
                return [];
            }

            foreach ($data->getData() as $marketHistoryInfo) {
                $transaction = new Transaction();

                $transaction->setFilltype($marketHistoryInfo->FillType);
                $transaction->setId($marketHistoryInfo->Id);
                $transaction->setOrdertype($marketHistoryInfo->OrderType);
                $transaction->setPrice($marketHistoryInfo->Price);
                $transaction->setQuantity($marketHistoryInfo->Quantity);
                $transaction->setProcessedTime(new \DateTime($marketHistoryInfo->TimeStamp));
                $transaction->setTotal($marketHistoryInfo->Total);

                $marketHistory[] = $transaction;
            }
        } catch (FetchException $exception) {
            $this->handleException($exception);
        } catch (GuzzleException $exception) {
            $this->handleException($exception);
        }

        return $marketHistory;
    }

    /**
     * @return Market[]
     */
    public function getMarkets() : array
    {
        $markets = [];

        try {
            $response = $this->fetchAPIData('/public/getmarkets');
            $data = $this->parseAPIResponse($response);

            if (!$data->isSuccessful()) {
                return $markets;
            }

            foreach ($data->getData() as $marketInfo) {
                $market = new Market();

                $market->setBaseCurrency(new Currency($marketInfo->BaseCurrency, $marketInfo->BaseCurrencyLong));
                $market->setCreated(new \DateTime($marketInfo->Created));
                $market->setIsActive($marketInfo->IsActive);
                $market->setMarketCurrency(new Currency($marketInfo->MarketCurrency, $marketInfo->MarketCurrencyLong));
                $market->setMarketName($marketInfo->MarketName);
                $market->setMinTradeSize($marketInfo->MinTradeSize);

                $markets[$marketInfo->MarketName] = $market;
            }

            return $markets;
        } catch (FetchException $exception) {
            $this->handleException($exception);
        } catch (GuzzleException $exception) {
            $this->handleException($exception);
        }

        return $markets;
    }

    /**
     * @return MarketSummary[]
     */
    public function getMarketSummaries() : array
    {
        $marketSummaries = [];

        try {
            $response = $this->fetchAPIData('/public/getmarketsummaries');
            $data = $this->parseAPIResponse($response);

            if (!$data->isSuccessful()) {
                return $marketSummaries;
            }

            foreach ($data->getData() as $marketSummaryInfo) {
                $marketSummary = new MarketSummary();

                $marketSummary->setAsk($marketSummaryInfo->Ask);
                $marketSummary->setBaseVolume($marketSummaryInfo->BaseVolume);
                $marketSummary->setBid($marketSummaryInfo->Bid);
                $marketSummary->setCreated(new \DateTime($marketSummaryInfo->Created));
                $marketSummary->setHigh($marketSummaryInfo->High);
                $marketSummary->setLast($marketSummaryInfo->Last);
                $marketSummary->setLow($marketSummaryInfo->Low);
                $marketSummary->setMarketName($marketSummaryInfo->MarketName);
                $marketSummary->setOpenBuyOrders($marketSummaryInfo->OpenBuyOrders);
                $marketSummary->setOpenSellOrders($marketSummaryInfo->OpenSellOrders);
                $marketSummary->setPrevDay($marketSummaryInfo->PrevDay);
                $marketSummary->setTimeStamp(new \DateTime($marketSummaryInfo->TimeStamp));
                $marketSummary->setVolume($marketSummaryInfo->Volume);

                $marketSummaries[$marketSummaryInfo->MarketName] = $marketSummary;
            }
        } catch (FetchException $exception) {
            $this->handleException($exception);
        } catch (GuzzleException $exception) {
            $this->handleException($exception);
        }

        return $marketSummaries;
    }

    /**
     * @param string $market
     * @return MarketSummary
     */
    public function getMarketSummary(string $market) : MarketSummary
    {
        $marketSummary = new MarketSummary();

        try {
            $response = $this->fetchAPIData('/public/getmarketsummary', ['market' => $market]);
            $data = $this->parseAPIResponse($response);

            if (!$data->isSuccessful()) {
                return $marketSummary;
            }

            $marketSummaryInfo = $data->getData()[0];

            $marketSummary->setAsk($marketSummaryInfo->Ask);
            $marketSummary->setBaseVolume($marketSummaryInfo->BaseVolume);
            $marketSummary->setBid($marketSummaryInfo->Bid);
            $marketSummary->setCreated(new \DateTime($marketSummaryInfo->Created));
            $marketSummary->setHigh($marketSummaryInfo->High);
            $marketSummary->setLast($marketSummaryInfo->Last);
            $marketSummary->setLow($marketSummaryInfo->Low);
            $marketSummary->setMarketName($marketSummaryInfo->MarketName);
            $marketSummary->setOpenBuyOrders($marketSummaryInfo->OpenBuyOrders);
            $marketSummary->setOpenSellOrders($marketSummaryInfo->OpenSellOrders);
            $marketSummary->setPrevDay($marketSummaryInfo->PrevDay);
            $marketSummary->setTimeStamp(new \DateTime($marketSummaryInfo->TimeStamp));
            $marketSummary->setVolume($marketSummaryInfo->Volume);
        } catch (FetchException $exception) {
            $this->handleException($exception);
        } catch (GuzzleException $exception) {
            $this->handleException($exception);
        }

        return $marketSummary;
    }

    /**
     * @param string $market
     * @return OpenOrder[]
     */
    public function getOpenOrders(string $market = '') : array
    {
        $openOrders = [];

        try {
            $parameters = !empty($market) ? ['market' => $market] : [];
            $response = $this->fetchAPIData('/market/getopenorders', $parameters);
            $data = $this->parseAPIResponse($response);

            if (!$data->isSuccessful()) {
                return [];
            }

            foreach ($data->getData() as $openOrderInfo) {
                $openOrder = new OpenOrder();

                $openOrder->setLimit($openOrderInfo->Limit);
                $openOrder->setMarket($openOrderInfo->Exchange);
                $openOrder->setOpened(new \DateTime($openOrderInfo->Opened));
                $openOrder->setOrderType($openOrderInfo->OrderType);
                $openOrder->setOrderUuid($openOrderInfo->OrderUuid);
                $openOrder->setPrice($openOrderInfo->Price);
                $openOrder->setQuantity($openOrderInfo->Quantity);
                $openOrder->setQuantityRemaining($openOrderInfo->QuantityRemaining);

                $openOrders[$openOrderInfo->OrderUuid] = $openOrder;
            }
        } catch (FetchException $exception) {
            $this->handleException($exception);
        } catch (GuzzleException $exception) {
            $this->handleException($exception);
        }

        return $openOrders;
    }

    /**
     * NOTE: This method doesn't take a depth parameter, since that doesn't seem to be respected
     * in the Bittrex API. If at some point in the future it is, send me a message or a pull request.
     *
     * @param string $market
     * @param string $type
     * @return Order[]
     */
    public function getOrderBook(string $market, string $type = 'both') : array
    {
        $orderBook = ['buy' => [], 'sell' => []];
        $type = strtolower($type);

        try {
            $response = $this->fetchAPIData('/public/getorderbook', ['market' => $market, 'type' => $type]);
            $data = $this->parseAPIResponse($response);

            if (!$data->isSuccessful()) {
                return [];
            }

            $data = $data->getData();

            if ($type === 'buy' || $type === 'sell') {
                foreach ($data as $orderInfo) {
                    var_dump($orderInfo);
                    $order = new Order();
                    $order->setQuantity($orderInfo->Quantity);
                    $order->setRate($orderInfo->Rate);

                    $orderBook[$type][] = $order;
                }
            } else {
                $data = $data[0];
                foreach ($data->buy as $orderInfo) {
                    $order = new Order();
                    $order->setQuantity($orderInfo->Quantity);
                    $order->setRate($orderInfo->Rate);

                    $orderBook['buy'][] = $order;
                }
                foreach ($data->sell as $orderInfo) {
                    $order = new Order();
                    $order->setQuantity($orderInfo->Quantity);
                    $order->setRate($orderInfo->Rate);

                    $orderBook['sell'][] = $order;
                }
            }
        } catch (FetchException $exception) {
            $this->handleException($exception);
        } catch (GuzzleException $exception) {
            $this->handleException($exception);
        }

        return $orderBook;
    }

    /**
     * @param string $market
     * @return Ticker
     */
    public function getTicker(string $market) : Ticker
    {
        $ticker = new Ticker();

        try {
            $response = $this->fetchAPIData('/public/getticker', ['market' => $market]);
            $data = $this->parseAPIResponse($response);

            if (!$data->isSuccessful()) {
                return $ticker;
            }

            $ticker->setAsk($data->getData()[0]->Ask);
            $ticker->setBid($data->getData()[0]->Bid);
            $ticker->setLast($data->getData()[0]->Last);
        } catch (FetchException $exception) {
            $this->handleException($exception);
        } catch (GuzzleException $exception) {
            $this->handleException($exception);
        }

        return $ticker;
    }

    /**
     * @param string $type
     * @param string $market
     * @param float $quantity
     * @param float $rate
     * @return string
     */
    public function placeLimitOrder(string $type, string $market, float $quantity, float $rate) : string
    {
        $orderResult = '';

        switch ($type) {
            case Order::BUY:
                $endpoint = '/market/buylimit';
                break;
            case Order::SELL:
                $endpoint = '/market/selllimit';
                break;
            default:
                return 'No type specified';
        }

        try {
            $response = $this->fetchAPIData($endpoint, ['market' => $market, 'quantity' => $quantity, 'rate' => $rate]);
            $data = $this->parseAPIResponse($response);

            if (!$data->isSuccessful()) {
                return $data->getMessage();
            }

            $orderResult = $data->getData()[0]->uuid;
        } catch (FetchException $exception) {
            $this->handleException($exception);
        } catch (GuzzleException $exception) {
            $this->handleException($exception);
        }

        return $orderResult;
    }

    /**
     * @param string $type
     * @param string $market
     * @param float $quantity
     * @return string
     */
    public function placeMarketOrder(string $type, string $market, float $quantity) : string
    {
        $orderResult = '';

        switch ($type) {
            case Order::BUY:
                $endpoint = '/market/buymarket';
                break;
            case Order::SELL:
                $endpoint = '/market/sellmarket';
                break;
            default:
                return 'No type specified';
        }

        try {
            $response = $this->fetchAPIData($endpoint, ['market' => $market, 'quantity' => $quantity]);
            $data = $this->parseAPIResponse($response);

            if (!$data->isSuccessful()) {
                return $data->getMessage();
            }

            $orderResult = $data->getData()[0]->uuid;
        } catch (FetchException $exception) {
            $this->handleException($exception);
        } catch (GuzzleException $exception) {
            $this->handleException($exception);
        }

        return $orderResult;
    }

    /**
     * @param string $uuid
     * @return bool
     */
    public function cancelOrder(string $uuid) : bool
    {
        $success = false;

        try {
            $response = $this->fetchAPIData('/market/cancel', ['uuid' => $uuid]);
            $data = $this->parseAPIResponse($response);

            $success = ($data->isSuccessful() && empty($data->getMessage()));
        } catch (FetchException $exception) {
            $this->handleException($exception);
        } catch (GuzzleException $exception) {
            $this->handleException($exception);
        }

        return $success;
    }

    /**
     * @param callable $exceptionHandler
     */
    public function setExceptionHandler(Callable $exceptionHandler)
    {
        $this->exceptionHandler = $exceptionHandler;
    }

    /**
     * @param string $responseBody
     * @return APIResponse
     */
    private function parseAPIResponse(string $responseBody) : APIResponse
    {
        $apiResponse = new APIResponse();
        $decodedData = json_decode($responseBody);

        if (json_last_error() !== JSON_ERROR_NONE) {
            $apiResponse->setMessage('Invalid JSON received from Bittrex API');
            $apiResponse->setSuccessful(false);

            return $apiResponse;
        }

        if (!isset($decodedData->success) || $decodedData->success !== true) {
            $apiResponse->setSuccessful(false);
            $apiResponse->setMessage($decodedData->message ?? '');

            return $apiResponse;
        }

        $apiResponse->setSuccessful(true);
        $apiResponse->setData(is_array($decodedData->result) ? $decodedData->result : [$decodedData->result]);

        return $apiResponse;
    }

    /**
     * @param string $endpoint
     * @param array $parameters
     * @return string
     * @throws FetchException
     * @throws GuzzleException
     */
    private function fetchAPIData(string $endpoint, array $parameters = []) : string
    {
        // Make sure a forward slash is present between the base url and the resource identifier.
        $url = self::API_BASE_URL . ($endpoint[0] !== '/' ? '/' : '') . $endpoint;

        // Create add API key and nonce to parameters
        $nonce = time();
        $parameters['nonce'] = $nonce;
        $parameters['apikey'] = $this->apiKey;

        // Add parameters to URL
        $url .= '?' . http_build_query($parameters);

        // Determine request signing key
        $signingKey = hash_hmac('sha512', $url, $this->apiSecret);

        // Send the request
        $response = $this->httpClient->request('GET', $url, [
            'headers' => ['apisign' => $signingKey]
        ]);

        $statusCode = $response->getStatusCode();
        if ($statusCode >= 200 && $statusCode < 300) {
            // Return the response body if there was a 200 response code
            return $response->getBody()->getContents() ?? '';
        } else {
            // Throw an exception otherwise
            throw new FetchException('', $statusCode);
        }
    }

    /**
     * @param \Exception $exception
     */
    private function handleException(\Exception $exception)
    {
        if (is_callable($this->exceptionHandler)) {
            call_user_func($this->exceptionHandler, $exception);
        }
    }
}
