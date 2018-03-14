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

/**
 * Metadata version
 */
$sMetadataVersion = '2.0';

/**
 * Module information
 */
$aModule = array(
    'id' => 'cwfrontendorderlist',
    'title' => array(
        'de' => 'Bestellübersicht Kunde',
        'en' => 'Customer Order History'
    ),
    'description' => array(
        'de' => 'Erlaubt das Einschränken der Anzeige von Bestellungen in der Kundenansicht aufgrund des Bestellstatus. Teilt zudem das die Bestellübersicht in 4 Smarty Blöcke ein, um die Darstellung einfacher anzupassen.',
        'en' => 'Allows the restriction of the display of orders in the customer view based on the order status. Also splits the order history into 4 smarty blocks to enable easy modifications.'
    ),
    'version' => '1.0.0',
    'author' => 'customweb GmbH',
    'url' => 'https://www.customweb.com',
    'email' => 'info@customweb.com',
    'extend' => array(
        \OxidEsales\Eshop\Application\Controller\Admin\ModuleConfiguration::class => Cw\FrontendOrderList\Extend\Application\Controller\Admin\ModuleConfiguration::class,
        \OxidEsales\Eshop\Application\Model\Order::class => Cw\FrontendOrderList\Extend\Application\Model\User::class
    ),
    'controllers' => array(),
    'templates' => array(),
    'blocks' => array(
        array(
            'template' => 'page/account/order.tpl',
            'block' => 'account_order_history',
            'file' => 'Application/views/blocks/account_order_history/list.tpl'
        ),
        array(
            'template' => 'page/account/order.tpl',
            'block' => 'account_order_history_item',
            'file' => 'Application/views/blocks/account_order_history/item.tpl'
        ),
        array(
            'template' => 'page/account/order.tpl',
            'block' => 'account_order_history_header',
            'file' => 'Application/views/blocks/account_order_history/header.tpl'
        ),
        array(
            'template' => 'page/account/order.tpl',
            'block' => 'account_order_history_body',
            'file' => 'Application/views/blocks/account_order_history/body.tpl'
        ),
        array(
            'template' => 'module_config.tpl',
            'block' => 'admin_module_config_var',
            'file' => 'Application/views/blocks/admin/module_config/var.tpl'
        )
    ),
    'settings' => array(
        array(
            'group' => 'cwfrontendorderlistSettings',
            'name' => 'cwfrontendorderlistDisplayedStates',
            'type' => 'select',
            'value' => 'OK|NOT_FINISHED|PROBLEMS'
        )
    ),
    'events' => array(
        'onActivate' => Cw\FrontendOrderList\Core\FrontendOrderListModule::class . '::onActivate',
        'onDeactivate' => Cw\FrontendOrderList\Core\FrontendOrderListModule::class . '::onDeactivate'
    ),
    'transaction_states' => array(
        'OK', 'NOT_FINISHED', 'PROBLEMS'
    )
);