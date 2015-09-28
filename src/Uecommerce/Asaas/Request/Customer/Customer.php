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

namespace Uecommerce\Asaas\Request\Customer;

use Uecommerce\Asaas\Request\RequestAbstract;
use Uecommerce\Asaas\Contracts\Request;

/**
 * Asaas
 *
 * @category   Uecommerce
 * @package    Uecommerce_Asaas
 * @author     Uecommerce Dev Team
 */
class Customer extends RequestAbstract implements Request
{

    public $object;

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $company;

    /**
     *
     * @var string
     */
    public $phone;

    /**
     *
     * @var string
     */
    public $mobilePhone;

    /**
     *
     * @var string
     */
    public $address;

    /**
     *
     * @var string
     */
    public $addressNumber;

    /**
     *
     * @var string
     */
    public $complement;

    /**
     *
     * @var string
     */
    public $province;

    /**
     *
     * @var boolean
     */
    public $foreignCustomer;

    /**
     *
     * @var boolean
     */
    public $notificationDisabled;

    /**
     *
     * @var string
     */
    public $city;

    /**
     *
     * @var string
     */
    public $state;

    /**
     *
     * @var string
     */
    public $country;

    /**
     *
     * @var string
     */
    public $postalCode;

    /**
     *
     * @var string
     */
    public $cpfCnpj;

    /**
     *
     * @var string
     */
    public $personType;

    /**
     *
     * @var array
     */
    public $subscriptions;

    /**
     *
     * @var array
     */
    public $payments;

    /**
     *
     * @var array
     */
    public $notifications;

    /**
     *
     * @var boolean
     */
    public $deleted;

    /**
     *
     * @var string
     */
    protected $customUri = false;

    /**
     * 
     * @return string
     */
    public function getUri()
    {
        return 'customers';
    }
    
    /**
     * 
     * @param string $id
     * @return \Uecommerce\Asaas\Request\Customer\Customer
     * @throws \Exception
     */
    public function getPaymentList($id = false)
    {
        if(!$id && !$this->id){
            throw new \Exception('Id not found');
        }
        if($id){
            $this->id = $id;
        }
        $this->customUri = $this->getUri().'/'.$this->id.'/payments';
        
        return $this;
    }

    /**
     * 
     * @return string
     */
    public function getCustomUri()
    {
        return $this->customUri;
    }

}
