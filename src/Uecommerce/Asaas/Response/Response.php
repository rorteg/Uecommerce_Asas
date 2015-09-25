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

namespace Uecommerce\Asaas\Response;

use Uecommerce\Asaas\Response\ResponseAbstract;

/**
 * Asaas
 *
 * @category   Uecommerce
 * @package    Uecommerce_Asaas
 * @author     Uecommerce Dev Team
 */
class Response extends ResponseAbstract
{
    /**
     *
     * @var boolean
     */
    private $isSuccess;
    
    /**
     *
     * @var object
     */
    private $data;
    
    public function __construct($data)
    {
        $this->data = json_decode($data);
        
    }
    
    /**
     * 
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->isSuccess;
    }
    
    /**
     * 
     * @return object
     */
    public function getData()
    {
        return $this->data;
    }
}
