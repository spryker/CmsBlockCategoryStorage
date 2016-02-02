<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Payone\Communication\Plugin\Command;

use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject;
use Spryker\Zed\Oms\Communication\Plugin\Oms\Command\CommandByOrderInterface;
use Spryker\Zed\Payone\Business\PayoneFacade;
use Spryker\Zed\Payone\Communication\PayoneCommunicationFactory;
use Orm\Zed\Sales\Persistence\SpySalesOrder;

/**
 * @method PayoneCommunicationFactory getFactory()
 * @method PayoneFacade getFacade()
 */
class AuthorizePlugin extends AbstractPlugin implements CommandByOrderInterface
{

    /**
     * @param array $orderItems
     * @param \Orm\Zed\Sales\Persistence\SpySalesOrder $orderEntity
     * @param \Spryker\Zed\Oms\Business\Util\ReadOnlyArrayObject $data
     *
     * @return array $returnArray
     */
    public function run(array $orderItems, SpySalesOrder $orderEntity, ReadOnlyArrayObject $data)
    {
        /** @var \Orm\Zed\Payone\Persistence\SpyPaymentPayone $paymentEntity */
        $paymentEntity = $orderEntity->getSpyPaymentPayones()->getFirst();
        $this->getFacade()->authorizePayment($paymentEntity->getFkSalesOrder());

        return [];
    }

}
