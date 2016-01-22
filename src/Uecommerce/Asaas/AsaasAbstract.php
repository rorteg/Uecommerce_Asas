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


/**
 * Asaas
 *
 * @category   Uecommerce
 * @package    Uecommerce_Asaas
 * @author     Uecommerce Dev Team
 */

abstract class AsaasAbstract
{
    /**
     *
     * @var string
     */
    private $apikey;

    /**
     *
     * @var string
     */
    private $apiUrl;
    
    /**
     *
     * construct
     */
    public function __construct() 
    {
        $this->apiUrl = 'https://www.asaas.com/api/v2/';
    }
    
    /**
     * 
     * @param string $apikey
     */
    public function setApiKey($apikey)
    {
        $this->apikey = $apikey;
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getApiKey()
    {
        return $this->apikey;
    }
    
    /**
     * 
     * @return string
     */
    public function getApiUrl()
    {
        return $this->apiUrl;
    }

    /**
    *
    * @param string $url
    */
    public function setApiUrl($url) {
        $this->apiUrl = $url;
        return $this;
    }
    
    
}
