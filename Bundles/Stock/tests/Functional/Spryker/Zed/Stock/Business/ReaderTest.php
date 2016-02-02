<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Functional\Spryker\Zed\Stock;

use Codeception\TestCase\Test;
use Orm\Zed\Product\Persistence\SpyProductAbstract;
use Orm\Zed\Product\Persistence\SpyProductAbstractQuery;
use Orm\Zed\Product\Persistence\SpyProduct;
use Orm\Zed\Product\Persistence\SpyProductQuery;
use Spryker\Zed\Stock\Business\StockFacade;
use Orm\Zed\Stock\Persistence\SpyStockProductQuery;
use Orm\Zed\Stock\Persistence\SpyStockQuery;
use Spryker\Zed\Stock\Persistence\StockQueryContainer;

/**
 * @group StockTest
 */
class ReaderTest extends Test
{

    /**
     * @var \Spryker\Zed\Stock\Business\StockFacade
     */
    private $stockFacade;

    /**
     * @var \Spryker\Zed\Stock\Persistence\StockQueryContainer
     */
    private $stockQueryContainer;

    /**
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->stockFacade = new StockFacade();
        $this->stockQueryContainer = new StockQueryContainer();
    }

    /**
     * @return void
     */
    public function testIsNeverOutOfStock()
    {
        $this->setTestData();
        $stockProductEntity = $this->stockQueryContainer->queryAllStockProducts()->findOne();
        $stockProductEntity->setIsNeverOutOfStock(true)->save();
        $productSku = SpyProductQuery::create()->findOneByIdProduct($stockProductEntity->getFkProduct());
        $isNeverOutOfStock = $this->stockFacade->isNeverOutOfStock($productSku->getSku());

        $this->assertTrue($isNeverOutOfStock);
    }

    /**
     * @return void
     */
    protected function setTestData()
    {
        $productAbstract = SpyProductAbstractQuery::create()
            ->filterBySku('test')
            ->findOne();

        if ($productAbstract === null) {
            $productAbstract = new SpyProductAbstract();
            $productAbstract->setSku('test');
        }

        $productAbstract->setAttributes('{}')
            ->save();

        $product = SpyProductQuery::create()
            ->filterBySku('test2')
            ->findOne();

        if ($product === null) {
            $product = new SpyProduct();
            $product->setSku('test2');
        }

        $product->setFkProductAbstract($productAbstract->getIdProductAbstract())
            ->setAttributes('{}')
            ->save();

        $stockType1 = SpyStockQuery::create()
            ->filterByName('warehouse1')
            ->findOneOrCreate();
        $stockType1->setName('warehouse1')
            ->save();

        $stockType2 = SpyStockQuery::create()
            ->filterByName('warehouse2')
            ->findOneOrCreate();

        $stockType2->setName('warehouse2')
            ->save();

        $stockProduct1 = SpyStockProductQuery::create()
            ->filterByFkStock($stockType1->getIdStock())
            ->filterByFkProduct($product->getIdProduct())
            ->findOneOrCreate();

        $stockProduct1->setFkStock($stockType1->getIdStock())
            ->setQuantity(10)
            ->setFkProduct($product->getIdProduct())
            ->save();

        $stockProduct2 = SpyStockProductQuery::create()
            ->filterByFkStock($stockType2->getIdStock())
            ->filterByFkProduct($product->getIdProduct())
            ->findOneOrCreate();

        $stockProduct2->setFkStock($stockType2->getIdStock())
            ->setQuantity(20)
            ->setFkProduct($product->getIdProduct())
            ->save();
    }

}
