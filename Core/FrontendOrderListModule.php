<?php

/**
 * /**
 * wallee
 *
 * This module allows you to interact with the wallee payment service using OXID eshop.
 * Using this module requires a wallee account (https://app-wallee.com)
 *
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @category module
 * @package Wallee
 * @author customweb GmbH
 * @link https://www.wallee.com
 * @copyright (C) customweb GmbH 2018
 */

namespace Cw\FrontendOrderList\Core;

use OxidEsales\Eshop\Core\DatabaseProvider;
use OxidEsales\Eshop\Core\Exception\DatabaseErrorException;
use \OxidEsales\Eshop\Core\Module\Module;
use OxidEsales\Eshop\Core\Module\ModuleList;
use \OxidEsales\Eshop\Core\Registry;

/**
 * Class WalleeModule
 * Handles module setup, provides additional tools and module related helpers.
 *
 * @codeCoverageIgnore
 */
class FrontendOrderListModule extends Module
{
    /**
     * Class constructor.
     * Sets current module main data and loads the rest module info.
     *
     */
    public function __construct()
    {
        $sModuleId = 'cwfrontendorderlist';

        $this->setModuleData(array(
            'id' => $sModuleId,
            'title' => 'CW Frontend OrderList',
            'description' => 'CW Frontend OrderList'
        ));

        $this->load($sModuleId);

        Registry::set(get_class(), $this);
    }

    /**
     * Scans all installed plugins metadata for transaction_states, and returns all found.
     * @return array
     */
    public function getSupportedTransactionStates()
    {
        $moduleList = oxNew(ModuleList::class);
        /* @var $moduleList ModuleList */
        $modules = $moduleList->getModulesFromDir(Registry::getConfig()->getModulesDir());
        $supported_states = array();
        foreach ($modules as $name => $module) {
            /* @var $module Module */
            if ($module->getInfo('transaction_states') && $module->isActive()) {
                $supported_states = array_merge($supported_states, $module->getInfo('transaction_states'));
            }
        }

        return $supported_states;
    }

    /**
     * Return list of active transaction states which should be displayed in frontend.
     *
     * @return array
     */
    public function getActiveTransactionStates()
    {
        $config = unserialize(html_entity_decode($this->getConfig()->getConfigParam('cwfrontendorderlistDisplayedStates')));
        if (!is_array($config)) {
            $config = array();
        }
        return $config;
    }

    /**
     * Module activation script.
     * @return bool
     * @throws \Exception
     */
    public static function onActivate()
    {
        try {
            if (!self::checkTransStatusIndexExists()) {
                self::addTransStatusIndex();
            }
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Check if an index exists on oxorder.OXTRANSSTATUS
     *
     * @return bool
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    protected static function checkTransStatusIndexExists()
    {
        $sql = 'SHOW INDEX FROM `oxorder`';
        $rows = DatabaseProvider::getDb()->getAll($sql);
        foreach ($rows as $row) {
            if ($row['Column_name'] === 'OXTRANSSTATUS') {
                return true;
            }
        }
        return false;
    }

    /**
     * Adds index idx_cwfrontendorderlist_oxtransstatus on oxorder.OXTRANSSTATUS
     *
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseErrorException
     */
    protected static function addTransStatusIndex()
    {
        $sql = "CREATE INDEX idx_cwfrontendorderlist_oxtransstatus ON `oxorder` (`OXTRANSSTATUS`)";
        DatabaseProvider::getDb()->execute($sql);
    }

    /**
     * Removes index idx_cwfrontendorderlist_oxtransstatus
     *
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    protected static function removeTransStatusIndex()
    {
        try {
            $sql = "DROP INDEX idx_cwfrontendorderlist_oxtransstatus ON `oxorder`";
            DatabaseProvider::getDb()->execute($sql);
        } catch (DatabaseErrorException $e) {
            // remove unexisting index, presumably wasn't added.
        }
    }

    /**
     * Module deactivation script.
     * @return bool
     * @throws \Exception
     */
    public static function onDeactivate()
    {
        try {
            self::removeTransStatusIndex();
        } catch (\Exception $e) {
        }
        return true;
    }
}