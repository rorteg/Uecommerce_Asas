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

namespace Uecommerce\Asaas\Request;

use Uecommerce\Asaas\Request\RequestAbstract;
use Uecommerce\Asaas\Contracts\Request;

/**
 * Asaas
 *
 * @category   Uecommerce
 * @package    Uecommerce_Asaas
 * @author     Uecommerce Dev Team
 */
class Payment extends RequestAbstract implements Request
{
    
    
    public $id;
    
    public $customer;
    
    public $subscription;
    
    public $billingType;
    
    public $value;
    
    public $netValue;
    
    public $originalValue;
    
    public $interestValue;
    
    public $grossValue;
    
    public $dueDate;
    
    public $status;
    
    public $nossoNumero;
    
    public $description;
    
    public $invoiceUrl;
    
    public $boletoUrl;
    
    public $creditCardHolderName;
    
    public $creditCardNumber;
    
    public $creditCardExpiryMonth;
    
    public $creditCardExpiryYear;
    
    public $creditCardCcv;
    
    public $creditCardHolderFullName;
    
    public $creditCardHolderEmail;
    
    public $creditCardHolderCpfCnpj;
    
    public $creditCardHolderAddress;
    
    public $creditCardHolderAddressNumber;
    
    public $creditCardHolderAddressComplement;
    
    public $creditCardHolderProvince;
    
    public $creditCardHolderCity;
    
    public $creditCardHolderUf;
    
    public $creditCardHolderPostalCode;
    
    public $creditCardHolderPhone;
    
    public $creditCardHolderPhoneDDD;
    
    public $creditCardHolderMobilePhone;
    
    public $creditCardHolderMobilePhoneDDD;
    
    
    /**
     * 
     * @return string
     */
    public function getUri()
    {
        return 'payments';
    }
    
    
}
