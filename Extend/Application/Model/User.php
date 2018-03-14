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

namespace Cw\FrontendOrderList\Extend\Application\Model;

use Cw\FrontendOrderList\Core\FrontendOrderListModule;
use OxidEsales\Eshop\Core\DatabaseProvider;

/**
 * Class User.
 * Extends \OxidEsales\Eshop\Application\Model\User.
 *
 * @mixin \OxidEsales\Eshop\Application\Model\User
 */
class User extends User_parent
{
    /**
     * @param string $query
     * @return string
     * @throws \OxidEsales\Eshop\Core\Exception\DatabaseConnectionException
     */
    protected function updateGetOrdersQuery($query)
    {
        if($this->isAdmin()){
            return $query;
        }
        $module = new FrontendOrderListModule();
        $active_states = $module->getActiveTransactionStates();
        if(!empty($active_states)) {
            $active_states = implode("', '", $active_states);
            $active_states = "('" . DatabaseProvider::getDb()->quote($active_states) . "')";
            $query .= ' AND `oxtransstatus` IN ' . $active_states;
        }
        return $query;
    }

}
