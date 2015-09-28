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
     * @var array
     */
    protected $filters = array();
    
    /**
     *
     * @var int
     */
    protected $limit = false;
    
    /**
     *
     * @var int
     */
    protected $offset = false;

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
        if (method_exists($this->request, 'getCustomUri')) {
            if ($this->request->getCustomUri()) {
                return parent::getApiUrl() . $this->request->getCustomUri();
            }
        }
        return parent::getApiUrl() . $this->request->getUri(). '/' . $id . $this->getFilters();
    }

    /**
     * 
     * @return Uecommerce\Asaas\Response\Response
     */
    public function create()
    {
        $this->method = 'POST';
        $this->sendRequest();
        return $this->getResponse();
    }

    /**
     * 
     * @return Uecommerce\Asaas\Response\Response
     * @throws Exception
     */
    public function get($id = false)
    {
        if (!$this->request->id && !$id) {
            throw new \Exception('Id not found');
        }
        if ($id) {
            $this->request->id = $id;
        }
        $this->method = 'GET';
        $this->sendRequest();
        return $this->getResponse();
    }

    /**
     * 
     * @return Uecommerce\Asaas\Response\Response
     * @throws Exception
     */
    public function update($id = false)
    {
        if (!$this->request->id && !$id) {
            throw new \Exception('Id not found');
        }
        if ($id) {
            $this->request->id = $id;
        }
        $this->method = 'POST';
        $this->sendRequest();
        return $this->getResponse();
    }

    /**
     * 
     * @return Uecommerce\Asaas\Response\Response
     * @throws Exception
     */
    public function delete($id = false)
    {
        if (!$this->request->id && !$id) {
            throw new \Exception('Id not found');
        }
        if ($id) {
            $this->request->id = $id;
        }
        $this->method = 'DELETE';
        $this->sendRequest();
        return $this->getResponse();
    }

    /**
     * 
     * @return Uecommerce\Asaas\Response\Response
     */
    public function all()
    {
        $this->method = 'GET';
        $this->sendRequest();
        return $this->getResponse();
    }

    /**
     * 
     * @throws \Exception
     */
    private function sendRequest()
    {
        if (!$this->request) {
            throw new \Exception('Object Request not set.');
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
     * @return Uecommerce\Asaas\Response\Response
     */
    public function getResponse()
    {
        $response = new Response($this->response);
        $dataResponse = $response->getData();
        if (!count($dataResponse)) {
            return false;
        }
        if (property_exists($dataResponse, 'id')) {
            $this->request->setData(get_object_vars($dataResponse));
        }
        if (property_exists($dataResponse, 'object')) {
            if ($dataResponse->object == 'list') {
                if (count($dataResponse->data) == 1) {
                    $array = get_object_vars($dataResponse->data[0]);
                    $object = reset($array);
                    $this->request->setData(get_object_vars($object));
                }
            }
        }
        return $response;
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
            CURLOPT_URL => $this->getApiUrlAndLimitOffset(),
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
        
//        print_r($options);

//        if ($this->method == 'GET')
//        {
//            $options[CURLOPT_URL] .= '?'.http_build_query($data);
//        }


        if (in_array($this->method, array('POST', 'PUT')) && $data != null) {
            $options[CURLOPT_POSTFIELDS] = json_encode($data);
        }

        return $options;
    }
    
    protected function getApiUrlAndLimitOffset()
    {
        $url = $this->getApiUrl();
        $queryString = '';
        if(strpos($url, '?') === false){
            $queryString .= '?';
        }
        if($this->getLimit()){
            $queryString .= 'limit='.$this->getLimit().'&';
        }
        if($this->getOffset())
        {
            $queryString .= 'offset='.$this->getOffset().'&';
        }
        
        return $url.$queryString;
    }

    /**
     * 
     * @param array $filters
     * @return \Uecommerce\Asaas\ApiClient
     */
    public function setFilters(array $filters)
    {
        $this->filters = $filters;
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getFilters()
    {
        $filters = '';
        if (count($this->filters)) {
            $filters .= '?';
            foreach ($this->filters as $filter => $value) {
                $filters .= $filter . '=' . urlencode($value) . '&';
            }
        }
        return $filters;
    }
    
    /**
     * 
     * @param int $limit
     * @return \Uecommerce\Asaas\ApiClient
     */
    public function setLimit($limit)
    {
        $this->limit = $limit;
        return $this;
    }
    
    /**
     * 
     * @return int
     */
    public function getLimit()
    {
        return $this->limit;
    }
    
    /**
     * 
     * @param int $offset
     * @return \Uecommerce\Asaas\ApiClient
     */
    public function setOffset($offset)
    {
        $this->offset = $offset;
        return $this;
    }
    
    /**
     * 
     * @return int
     */
    public function getOffset()
    {
        return $this->offset;
    }
    
    

}
