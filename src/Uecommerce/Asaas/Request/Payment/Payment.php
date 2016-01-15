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

namespace Uecommerce\Asaas\Request\Payment;

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
    const BILLING_TYPE_BOLETO = 'BOLETO';
    
    const BILLING_TYPE_CREDIT_CARD = 'CREDIT_CARD';
    
    const BILLING_TYPE_TRANSFER = 'TRANSFER';
    
    const BILLING_TYPE_DEPOSIT = 'DEPOSIT';
    
    //Aguardando pagamento
    const STATUS_PENDING = 'PENDING';
    
    //Cobrança confirmada, porém com o saldo ainda não disponível. Válido somente para cartão de crédito.
    const STATUS_CONFIRMED = 'CONFIRMED';
    
    //Cobrança paga
    const STATUS_RECEIVED = 'RECEIVED';
    
    //Cobrança atrasada
    const STATUS_OVERDUE = 'OVERDUE';
    
    
    public $object;
    
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
    
    public $paymentDate;

    public $invoiceNumber;
    
    public $deleted;
    
    
    /**
     * 
     * @return string
     */
    public function getUri()
    {
        return 'payments';
    }
    
    
}
