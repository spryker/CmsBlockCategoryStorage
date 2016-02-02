<?php

/**
 * (c) Spryker Systems GmbH copyright protected.
 */

namespace Spryker\Zed\Cms\Communication\Table;

use Spryker\Zed\Application\Business\Url\Url;
use Spryker\Zed\Cms\Persistence\CmsQueryContainer;
use Orm\Zed\Cms\Persistence\Map\SpyCmsPageTableMap;
use Orm\Zed\Cms\Persistence\SpyCmsPageQuery;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class CmsPageTable extends AbstractTable
{

    const ACTIONS = 'Actions';
    const REQUEST_ID_PAGE = 'id-page';

    /**
     * @var \Orm\Zed\Cms\Persistence\SpyCmsPageQuery
     */
    protected $pageQuery;

    /**
     * @param \Orm\Zed\Cms\Persistence\SpyCmsPageQuery $pageQuery
     */
    public function __construct(SpyCmsPageQuery $pageQuery)
    {
        $this->pageQuery = $pageQuery;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    protected function configure(TableConfiguration $config)
    {
        $config->setHeader([
            SpyCmsPageTableMap::COL_ID_CMS_PAGE => 'Page Id',
            CmsQueryContainer::URL => 'url',
            CmsQueryContainer::TEMPLATE_NAME => 'Template',
            self::ACTIONS => self::ACTIONS,
        ]);
        $config->setSortable([
            SpyCmsPageTableMap::COL_ID_CMS_PAGE,
        ]);

        $config->setSearchable([
            SpyCmsPageTableMap::COL_ID_CMS_PAGE,
            CmsQueryContainer::TEMPLATE_NAME,
            CmsQueryContainer::URL,
        ]);

        return $config;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return array
     */
    protected function prepareData(TableConfiguration $config)
    {
        $query = $this->pageQuery;
        $queryResults = $this->runQuery($query, $config);
        $results = [];

        foreach ($queryResults as $item) {
            $results[] = [
                SpyCmsPageTableMap::COL_ID_CMS_PAGE => $item[SpyCmsPageTableMap::COL_ID_CMS_PAGE],
                CmsQueryContainer::TEMPLATE_NAME => $item[CmsQueryContainer::TEMPLATE_NAME],
                CmsQueryContainer::URL => $item[CmsQueryContainer::URL],
                self::ACTIONS => implode(' ', $this->buildLinks($item)),
            ];
        }
        unset($queryResults);

        return $results;
    }

    /**
     * @param array $item
     *
     * @return array
     */
    private function buildLinks($item)
    {
        $buttons = [];

        $buttons[] = $this->generateEditButton(
            Url::generate('/cms/glossary/', [
                self::REQUEST_ID_PAGE => $item[SpyCmsPageTableMap::COL_ID_CMS_PAGE],
            ]),
            'Edit Placeholders'
        );
        $buttons[] = $this->generateEditButton(
            Url::generate('/cms/page/edit/', [
                self::REQUEST_ID_PAGE => $item[SpyCmsPageTableMap::COL_ID_CMS_PAGE],
            ]),
            'Edit Page'
        );

        return $buttons;
    }

}
