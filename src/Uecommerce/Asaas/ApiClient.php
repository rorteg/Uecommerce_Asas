<?php

/**
 * Uecommerce
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Uecommerce EULA.
 * It is also available through the world-wide-web at this URL:
 * http://www.uecommerce.com.br/
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade the extension
 * to newer versions in the future. If you wish to customize the extension
 * for your needs please refer to http://www.uecommerce.com.br/ for more information
 *
 * @category   Uecommerce
 * @package    Uecommerce_Asaas
 * @copyright  Copyright (c) 2012 Uecommerce (http://www.uecommerce.com.br/)
 * @license    http://www.uecommerce.com.br/
 */

namespace Uecommerce\Asaas;

use Uecommerce\Asaas\AsaasAbstract;
use Uecommerce\Asaas\Contracts\Request;
use Uecommerce\Asaas\Response\Response;

/**
 * Asaas
 *
 * @category   Uecommerce
 * @package    Uecommerce_Asaas
 * @author     Uecommerce Dev Team
 */
class ApiClient extends AsaasAbstract
{

    /**
     *
     * @var Request
     */
    protected $request = false;

    /**
     *
     * @var Response
     */
    protected $response = false;

    /**
     *
     * @var string
     */
    protected $method = 'POST';

    /**
     * 
     * @param string $apikey
     */
    public function __construct($apikey = false)
    {
        if ($apikey) {
            $this->setApiKey($apikey);
        }
    }

    /**
     * 
     * @param Request $request
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * Get full API url
     * 
     * @return string
     */
    public function getApiUrl()
    {
        $id = ($this->request->id) ? $this->request->id : '';
        $urlAdditional = (method_exists($this->request, 'getAdditionalUri')) ? '/' . $this->request->getAdditionalUri() : '';
        return parent::getApiUrl() . $this->request->getUri() . '/' . $id . $urlAdditional;
    }

    public function create()
    {
        $this->method = 'POST';
        $this->sendRequest();
        return $this->getResponse();
    }

    public function get()
    {
        if (!$this->request->id) {
            throw new Exception('Id not found');
        }
        $this->method = 'GET';
        $this->sendRequest();
        return $this->getResponse();
    }

    public function update()
    {
        if (!$this->request->id) {
            throw new Exception('Id not found');
        }
        $this->method = 'POST';
        $this->sendRequest();
        return $this->getResponse();
    }

    public function delete()
    {
        if (!$this->request->id) {
            throw new Exception('Id not found');
        }
        $this->method = 'DELETE';
        $this->sendRequest();
        return $this->getResponse();
    }

    public function all()
    {
        $this->method = 'GET';
        $this->sendRequest();
        return $this->getResponse();
    }

    private function sendRequest()
    {
        if (!$this->request) {
            throw new Exception('Object Request not set.');
        }

        $curlSession = curl_init();

        curl_setopt_array($curlSession, $this->getOptions());

        $responseBody = curl_exec($curlSession);

        curl_close($curlSession);

        if (!$responseBody) {
            throw new \Exception("Error Processing Request", 1);
        }

        $this->response = $responseBody;
    }

    /**
     * 
     * @return Response
     */
    public function getResponse()
    {
        print_r(json_decode($this->response));exit;
        return new Response($this->response);
    }

    /**
     * @param $method
     * @param null $bodyData
     * @param null $queryStringData
     * @return array
     */
    private function getOptions()
    {

        $data = $this->request->getData();

        $options = array
            (
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_URL => $this->getApiUrl(),
            CURLOPT_HTTPHEADER => array
                (
                'Content-type: application/json',
                'Accept: application/json',
                'access_token: ' . $this->getApiKey()
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_CUSTOMREQUEST => $this->method,
        );

//        if ($this->method == 'GET')
//        {
//            $options[CURLOPT_URL] .= '?'.http_build_query($data);
//        }


        if (in_array($this->method, array('POST', 'PUT')) && $data != null) {
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
        }

        return $options;
    }

}
