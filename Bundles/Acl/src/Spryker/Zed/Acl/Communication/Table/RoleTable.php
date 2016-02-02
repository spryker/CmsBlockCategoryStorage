<?php

/**
 * (c) Spryker Systems GmbH copyright protected
 */

namespace Spryker\Zed\Acl\Communication\Table;

use Spryker\Shared\Acl\AclConstants;
use Spryker\Zed\Acl\Persistence\AclQueryContainer;
use Orm\Zed\Acl\Persistence\Map\SpyAclRoleTableMap;
use Spryker\Zed\Application\Business\Url\Url;
use Spryker\Zed\Gui\Communication\Table\AbstractTable;
use Spryker\Zed\Gui\Communication\Table\TableConfiguration;

class RoleTable extends AbstractTable
{

    const ACTION = 'Action';
    const PARAM_ID_ROLE = 'id-role';
    const UPDATE_ROLE_URL = '/acl/role/update';
    const DELETE_ROLE_URL = '/acl/role/delete';

    /**
     * @var \Spryker\Zed\Acl\Persistence\AclQueryContainer
     */
    protected $aclQueryContainer;

    /**
     * @param \Spryker\Zed\Acl\Persistence\AclQueryContainer $aclQueryContainer
     */
    public function __construct(AclQueryContainer $aclQueryContainer)
    {
        $this->aclQueryContainer = $aclQueryContainer;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return \Spryker\Zed\Gui\Communication\Table\TableConfiguration
     */
    protected function configure(TableConfiguration $config)
    {
        $config->setHeader([
            SpyAclRoleTableMap::COL_CREATED_AT => 'Created at',
            SpyAclRoleTableMap::COL_NAME => 'Name',
            self::ACTION => self::ACTION,
        ]);

        $config->setSortable([
            SpyAclRoleTableMap::COL_CREATED_AT,
            SpyAclRoleTableMap::COL_NAME,
        ]);

        $config->setSearchable([
            SpyAclRoleTableMap::COL_NAME,
        ]);

        return $config;
    }

    /**
     * @param \Spryker\Zed\Gui\Communication\Table\TableConfiguration $config
     *
     * @return mixed
     */
    protected function prepareData(TableConfiguration $config)
    {
        $roleQuery = $this->aclQueryContainer->queryRole();
        $queryResults = $this->runQuery($roleQuery, $config);

        $results = [];
        foreach ($queryResults as $rule) {
            $results[] = [
                SpyAclRoleTableMap::COL_CREATED_AT => $rule[SpyAclRoleTableMap::COL_CREATED_AT],
                SpyAclRoleTableMap::COL_NAME => $rule[SpyAclRoleTableMap::COL_NAME],
                self::ACTION => implode(' ', $this->createTableActions($rule)),
            ];
        }

        return $results;
    }

    /**
     * @param array $rule
     *
     * @return array
     */
    protected function createTableActions(array $rule)
    {
        $buttons = [];

        $buttons[] = $this->generateEditButton(
            Url::generate(self::UPDATE_ROLE_URL, [self::PARAM_ID_ROLE => $rule[SpyAclRoleTableMap::COL_ID_ACL_ROLE]]),
            'Edit'
        );

        if ($rule[SpyAclRoleTableMap::COL_NAME] !== AclConstants::ROOT_ROLE) {
            $buttons[] = $this->generateRemoveButton(
                Url::generate(self::DELETE_ROLE_URL, [self::PARAM_ID_ROLE => $rule[SpyAclRoleTableMap::COL_ID_ACL_ROLE]]),
                'Delete'
            );
        }

        return $buttons;
    }

}
