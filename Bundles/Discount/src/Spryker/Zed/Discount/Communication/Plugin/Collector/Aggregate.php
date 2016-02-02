<?php
/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Discount\Communication\Plugin\Collector;

use Generated\Shared\Transfer\DiscountCollectorTransfer;
use Spryker\Zed\Calculation\Business\Model\CalculableInterface;
use Spryker\Zed\Discount\Business\DiscountFacade;
use Spryker\Zed\Discount\Communication\Plugin\AbstractDiscountPlugin;
use Spryker\Zed\Discount\Dependency\Plugin\DiscountCollectorPluginInterface;
use Generated\Shared\Transfer\DiscountTransfer;

/**
 * @method DiscountFacade getFacade()
 */
class Aggregate extends AbstractDiscountPlugin implements DiscountCollectorPluginInterface
{

    /**
     * @param \Generated\Shared\Transfer\DiscountTransfer $discount
     * @param \Spryker\Zed\Calculation\Business\Model\CalculableInterface $container
     * @param \Generated\Shared\Transfer\DiscountCollectorTransfer $discountCollectorTransfer
     *
     * @return \Spryker\Zed\Discount\Business\Model\DiscountableInterface[]
     */
    public function collect(
        DiscountTransfer $discount,
        CalculableInterface $container,
        DiscountCollectorTransfer $discountCollectorTransfer
    ) {
        return $this->getFacade()->getDiscountableItemsFromCollectorAggregate($container, $discountCollectorTransfer);
    }

}
