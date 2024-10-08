<?php

namespace App\Services\Dadata\Response;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Request;
use RuntimeException;

/**
 * Class ClientHint
 */
class ClientSuggest
{
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';

    /**
     * Организации
     */
    public const TYPE_PARTY = 'party';

    /**
     * Организации (алиас)
     */
    public const TYPE_ORG = 'party';

    /**
     * Адреса
     */
    public const TYPE_ADDRESS = 'address';

    /**
     * Банки
     */
    public const TYPE_BANK = 'bank';

    /**
     * ФИО
     */
    public const TYPE_FIO = 'fio';

    /**
     * email
     */
    public const TYPE_EMAIL = 'email';

    /**
     * кем выдан паспорт
     */
    public const TYPE_FMS_UNIT = 'fms_unit';

    /**
     * налоговые инспекции
     */
    public const TYPE_FNS_UNIT = 'fns_unit';

    /**
     * отделения Почты России
     */
    public const TYPE_POSTAL_OFFICE = 'postal_office';

    /**
     * мировые суды
     */
    public const TYPE_REGION_COURT = 'region_court';

    /**
     * страны
     */
    public const TYPE_COUNTRY = 'country';

    /**
     * валюты
     */
    public const TYPE_CURRENCY = 'currency';

    /**
     * виды деятельности (ОКВЭД 2)
     */
    public const TYPE_OKVED_2 = 'okved2';

    /**
     * виды продукции (ОКПД 2)
     */
    public const TYPE_OKPD_2 = 'okpd2';

    /**
     * API-ключ
     *
     * @var string
     */
    protected $token;

    /**
     * Настройки
     *
     * @var array
     */
    protected $config;

    /**
     * Версия API
     */
    protected string $version = '4_1';

    /**
     * Базовый адрес
     */
    protected string $base_url = 'https://suggestions.dadata.ru/suggestions/api';

    /**
     * URI подсказок
     */
    protected string $url_suggestions = 'rs/suggest';

    /**
     * URI поиска организации по ИНН, ОГРН, HID
     *
     * @var string
     */
    protected $urlFindById = 'rs/findById/party';

    /**
     * URI поиска кодов доставки
     *
     * @var string
     */
    protected $urlFindByIdDelivery = 'rs/findById/delivery';

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @var array
     */
    protected $httpOptions = [];

    /**
     * ClientHint constructor.
     */
    public function __construct()
    {
        $this->config = config('dadata');
        $this->token = $this->config['token'];
        $this->httpClient = new Client();
    }

    public function cityById($id, array $params = [])
    {
        $params['query'] = $id;

        return $this->query("{$this->base_url}/{$this->version}/{$this->urlFindByIdDelivery}", $params);
    }

    /**
     * Requests API.
     *
     * @param string $url
     * @param string $method
     */
    private function query($url, array $params = [], $method = self::METHOD_POST)
    {
        if (empty($params['query'])) {
            throw new RuntimeException('Empty request');
        }

        $request = new Request($method, $url, [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
            'Authorization' => 'Token ' . $this->token,
        ], 0 < count($params) ? json_encode($params) : null);

        try {
            $response = $this->httpClient->send($request, $this->httpOptions);
        } catch (GuzzleException $guzzleException) {
            throw new RuntimeException('Http exception: ' . $guzzleException->getMessage());
        } catch (Exception $exception) {
            throw new RuntimeException('Exception: ' . $exception->getMessage());
        }

        switch ($response->getStatusCode()) {
            case 200:
                // успешный запрос
                $result = json_decode($response->getBody(), true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new RuntimeException('Error parsing response: ' . json_last_error_msg());
                }

                if (empty($result['suggestions'][0])) {
                    throw new RuntimeException('Empty result');
                }

                return count($result['suggestions']) === 1 ? $result['suggestions'][0] : $result['suggestions'];

                break;
            case 400:
                // DaData Некорректный запрос
                throw new RuntimeException('Incorrect request');
                break;
            case 401:
                // В запросе отсутствует API-ключ
                throw new RuntimeException('Missing API key');
                break;
            case 403:
                // В запросе указан несуществующий API-ключ
                throw new RuntimeException('Incorrect API key');
                break;
            case 405:
                // Запрос сделан с методом, отличным от POST
                throw new RuntimeException('Request method must be POST');
                break;
            case 413:
                // Нарушены ограничения
                throw new RuntimeException('You push the limits of suggestions');
                break;
            case 500:
                // Произошла внутренняя ошибка сервиса во время обработки
                throw new RuntimeException('Server internal error');
                break;
            default:
                throw new RuntimeException('Unexpected error');
        }
    }

    /**
     * Подсказки
     *
     * @link https://dadata.ru/api/suggest/
     *
     * @param string $type
     * @param array $fields
     *
     * @return bool|mixed|string
     */
    public function suggest($type, $fields)
    {
        return $this->query("{$this->base_url}/{$this->version}/{$this->url_suggestions}/$type", $fields);
    }
}
