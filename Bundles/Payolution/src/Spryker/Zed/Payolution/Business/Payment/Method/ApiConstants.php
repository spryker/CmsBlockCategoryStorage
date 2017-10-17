<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\Payolution\Business\Payment\Method;

interface ApiConstants
{
    const ACCOUNT_BRAND = 'ACCOUNT.BRAND';
    const BRAND_INVOICE = 'PAYOLUTION_INVOICE';
    const BRAND_INSTALLMENT = 'PAYOLUTION_INS';

    const TRANSACTION_MODE = 'TRANSACTION.MODE';
    const TRANSACTION_MODE_TEST = 'CONNECTOR_TEST';
    const TRANSACTION_MODE_LIVE = 'LIVE';
    const TRANSACTION_CHANNEL = 'TRANSACTION.CHANNEL';

    const SECURITY_SENDER = 'SECURITY.SENDER';
    const USER_LOGIN = 'USER.LOGIN';
    const USER_PWD = 'USER.PWD';

    const PRESENTATION_AMOUNT = 'PRESENTATION.AMOUNT';
    const PRESENTATION_USAGE = 'PRESENTATION.USAGE';
    const PRESENTATION_CURRENCY = 'PRESENTATION.CURRENCY';

    const IDENTIFICATION_TRANSACTIONID = 'IDENTIFICATION.TRANSACTIONID';
    const IDENTIFICATION_SHOPPERID = 'IDENTIFICATION.SHOPPERID';
    const IDENTIFICATION_REFERENCEID = 'IDENTIFICATION.REFERENCEID';

    const NAME_GIVEN = 'NAME.GIVEN';
    const NAME_FAMILY = 'NAME.FAMILY';
    const NAME_TITLE = 'NAME.TITLE';
    const NAME_SEX = 'NAME.SEX';
    const NAME_BIRTHDATE = 'NAME.BIRTHDATE';

    const SEX_MALE = 'M';
    const SEX_FEMALE = 'F';

    const ADDRESS_STREET = 'ADDRESS.STREET';
    const ADDRESS_ZIP = 'ADDRESS.ZIP';
    const ADDRESS_CITY = 'ADDRESS.CITY';
    const ADDRESS_COUNTRY = 'ADDRESS.COUNTRY';

    const CONTACT_EMAIL = 'CONTACT.EMAIL';
    const CONTACT_PHONE = 'CONTACT.PHONE';
    const CONTACT_MOBILE = 'CONTACT.MOBILE';
    const CONTACT_IP = 'CONTACT.IP';

    const PAYMENT_CODE = 'PAYMENT.CODE';

    const PAYMENT_CODE_PRE_CHECK = 'VA.PA';
    const PAYMENT_CODE_PRE_AUTHORIZATION = 'VA.PA';
    const PAYMENT_CODE_RE_AUTHORIZATION = 'VA.PA';
    const PAYMENT_CODE_CAPTURE = 'VA.CP';
    const PAYMENT_CODE_REVERSAL = 'VA.RV';
    const PAYMENT_CODE_REFUND = 'VA.RF';

    const TRANSACTION_REQUEST_CONTENT_TYPE = 'FORM';
    const CALCULATION_REQUEST_CONTENT_TYPE = 'XML';

    const STATUS_CODE_SUCCESS = '90';
    const REASON_CODE_SUCCESS = '00';
    const STATUS_REASON_CODE_SUCCESS = self::STATUS_CODE_SUCCESS . '.' . self::REASON_CODE_SUCCESS;

    const CALCULATION_REQUEST_VERSION = '2.0';
    const CALCULATION_OPERATION_TYPE = 'CALCULATION';
    const CALCULATION_PAYMENT_TYPE = 'INSTALLMENT';
    const CALCULATION_TARGET_COUNTRY = 'PAYOLUTION_CALCULATION_TARGET_COUNTRY';

    /**
     * Calculation request XML
     */
    const CALCULATION_XML_ELEMENT_NAME = 'name';
    const CALCULATION_XML_ELEMENT_ATTRIBUTES = 'attributes';
    const CALCULATION_XML_ELEMENT_VALUE = 'value';
    const CALCULATION_XML_REQUEST_ELEMENT = 'Request';
    const CALCULATION_XML_REQUEST_VERSION_ATTRIBUTE = 'version';
    const CALCULATION_XML_SENDER_ELEMENT = 'Sender';
    const CALCULATION_XML_TRANSACTION_ELEMENT = 'Transaction';
    const CALCULATION_XML_TRANSACTION_MODE_ATTRIBUTE = 'mode';
    const CALCULATION_XML_TRANSACTION_CHANNEL_ATTRIBUTE = 'channel';
    const CALCULATION_XML_IDENTIFICATION_ELEMENT = 'Identification';
    const CALCULATION_XML_TRANSACTIONID_ELEMENT = 'TransactionID';
    const CALCULATION_XML_PAYMENT_ELEMENT = 'Payment';
    const CALCULATION_XML_OPERATION_TYPE_ELEMENT = 'OperationType';
    const CALCULATION_XML_PAYMENT_TYPE_ELEMENT = 'PaymentType';
    const CALCULATION_XML_PRESENTATION_ELEMENT = 'Presentation';
    const CALCULATION_XML_CURRENCY_ELEMENT = 'Currency';
    const CALCULATION_XML_USAGE_ELEMENT = 'Usage';
    const CALCULATION_XML_AMOUNT_ELEMENT = 'Amount';
    const CALCULATION_XML_VAT_ELEMENT = 'VAT';
    const CALCULATION_XML_ANALYSIS_ELEMENT = 'Analysis';
    const CALCULATION_XML_CRITERION_ELEMENT = 'Criterion';

    /**
     * Analysis Criteria keys
     */
    const CRITERION_CSS_PATH = 'CRITERION.PAYOLUTION_CSS_PATH';

    const CRITERION_REQUEST_SYSTEM_VENDOR = 'CRITERION.PAYOLUTION_REQUEST_SYSTEM_VENDOR';
    const CRITERION_REQUEST_SYSTEM_VERSION = 'CRITERION.PAYOLUTION_REQUEST_SYSTEM_VERSION';
    const CRITERION_REQUEST_SYSTEM_TYPE = 'CRITERION.PAYOLUTION_REQUEST_SYSTEM_TYPE';
    const CRITERION_REQUEST_SYSTEM_VENDOR_VALUE = 'Spryker';
    const CRITERION_REQUEST_SYSTEM_VERSION_VALUE = '1.0'; //@todo #360 ddmoshop
    const CRITERION_REQUEST_SYSTEM_TYPE_VALUE = 'Webshop';

    const CRITERION_MODULE_NAME = 'CRITERION.PAYOLUTION_MODULE_NAME';
    const CRITERION_MODULE_VERSION = 'CRITERION.PAYOLUTION_MODULE_VERSION';
    const CRITERION_MODULE_NAME_VALUE = 'Payolution';
    const CRITERION_MODULE_VERSION_VALUE = '2.0';

    const CRITERION_SHIPPING_STREET = 'CRITERION.PAYOLUTION_SHIPPING_STREET';
    const CRITERION_SHIPPING_ZIP = 'CRITERION.PAYOLUTION_SHIPPING_ZIP';
    const CRITERION_SHIPPING_CITY = 'CRITERION.PAYOLUTION_SHIPPING_CITY';
    const CRITERION_SHIPPING_STATE = 'CRITERION.PAYOLUTION_SHIPPING_STATE';
    const CRITERION_SHIPPING_COUNTRY = 'CRITERION.PAYOLUTION_SHIPPING_COUNTRY';
    const CRITERION_SHIPPING_GIVEN = 'CRITERION.PAYOLUTION_SHIPPING_GIVEN';
    const CRITERION_SHIPPING_FAMILY = 'CRITERION.PAYOLUTION_SHIPPING_FAMILY';
    const CRITERION_SHIPPING_COMPANY = 'CRITERION.PAYOLUTION_SHIPPING_COMPANY';
    const CRITERION_SHIPPING_ADDITIONAL = 'CRITERION.PAYOLUTION_SHIPPING_ADDITIONAL';
    const CRITERION_SHIPPING_TYPE = 'CRITERION.PAYOLUTION_SHIPPING_TYPE';
    const CRITERION_SHIPPING_TYPE_BRANCH_PICKUP = 'CRITERION.BRANCH_PICKUP';
    const CRITERION_SHIPPING_TYPE_POST_OFFICE_PICKUP = 'CRITERION.POST_OFFICE_PICKUP';
    const CRITERION_SHIPPING_TYPE_PACK_STATION = 'CRITERION.PACK_STATION';

    const CRITERION_TRANSPORTATION_COMPANY = 'CRITERION.PAYOLUTION_TRANSPORTATION_COMPANY';
    const CRITERION_TRANSPORTATION_TRACKING = 'CRITERION.PAYOLUTION_TRANSPORTATION_TRACKING';
    const CRITERION_TRANSPORTATION_RETURN_TRACKING = 'CRITERION.PAYOLUTION_TRANSPORTATION_RETURN_TRACKING';

    const CRITERION_ITEM_DESCR_XX = 'CRITERION.PAYOLUTION_DESCR_XX';
    const CRITERION_ITEM_PRICE_XX = 'CRITERION.PAYOLUTION_PRICE_XX';
    const CRITERION_ITEM_TAX_XX = 'CRITERION.PAYOLUTION_TAX_XX';
    const CRITERION_ITEM_CATEGORY_XX = 'CRITERION.PAYOLUTION_CATEGORY_XX';

    const CRITERION_TAX_AMOUNT = 'CRITERION.PAYOLUTION_TAX_AMOUNT';

    const CRITERION_PRE_CHECK = 'CRITERION.PAYOLUTION_PRE_CHECK';
    const CRITERION_PRE_CHECK_ID = 'CRITERION.PAYOLUTION_PRE_CHECK_ID';

    const CRITERION_TRX_TYPE = 'CRITERION.PAYOLUTION_TRX_TYPE';

    const CRITERION_COMPANY_NAME = 'CRITERION.PAYOLUTION_COMPANY_NAME';
    const CRITERION_COMPANY_UID = 'CRITERION.PAYOLUTION_COMPANY_UID';
    const CRITERION_COMPANY_TRADEREGISTRY_NUMBER = 'CRITERION.PAYOLUTION_COMPANY_TRADEREGISTRY_NUMBER';

    const CRITERION_CUSTOMER_LANGUAGE = 'CRITERION.PAYOLUTION_CUSTOMER_LANGUAGE';
    const CRITERION_CUSTOMER_NUMBER = 'CRITERION.PAYOLUTION_CUSTOMER_NUMBER';
    const CRITERION_CUSTOMER_GROUP = 'CRITERION.PAYOLUTION_CUSTOMER_GROUP';
    const CRITERION_CUSTOMER_CONFIRMED_ORDERS = 'CRITERION.PAYOLUTION_CUSTOMER_CONFIRMED_ORDERS';
    const CRITERION_CUSTOMER_CONFIRMED_AMOUNT = 'CRITERION.PAYOLUTION_CUSTOMER_CONFIRMED_AMOUNT';
    const CRITERION_CUSTOMER_INTERNAL_SCORE = 'CRITERION.PAYOLUTION_CUSTOMER_INTERNAL_SCORE';

    const CRITERION_WEBSHOP_URL = 'CRITERION.PAYOLUTION_WEBSHOP_URL';

    const CRITERION_CALCULATION_ID = 'CRITERION.PAYOLUTION_CALCULATION_ID';
    const CRITERION_INSTALLMENT_AMOUNT = 'CRITERION.PAYOLUTION_INSTALLMENT_AMOUNT';
    const CRITERION_DURATION = 'CRITERION.PAYOLUTION_DURATION';
    const CRITERION_ACCOUNT_HOLDER = 'CRITERION.PAYOLUTION_ACCOUNT_HOLDER';
    const CRITERION_ACCOUNT_COUNTRY = 'CRITERION.PAYOLUTION_ACCOUNT_COUNTRY';
    const CRITERION_ACCOUNT_BIC = 'CRITERION.PAYOLUTION_ACCOUNT_BIC';
    const CRITERION_ACCOUNT_IBAN = 'CRITERION.PAYOLUTION_ACCOUNT_IBAN';

    const CHECKOUT_ERROR_CODE_PAYMENT_FAILED = 'payment failed';
}
