<?php

namespace Cw\FrontendOrderList\Extend\Application\Controller\Admin;

use Cw\FrontendOrderList\Core\FrontendOrderListModule;
use OxidEsales\Eshop\Core\Registry;
use OxidEsales\Eshop\Core\Request;

/**
 * Class ModuleConfiguration
 * @package Cw\FrontendOrderList\Extend\Application\Controller\Admin
 * @mixin \OxidEsales\Eshop\Application\Controller\Admin\ModuleConfiguration
 */
class ModuleConfiguration extends ModuleConfiguration_parent
{
    public function render()
    {
        $tpl = $this->_ModuleConfiguration_render_parent();

        if (array_key_exists('cwfrontendorderlistDisplayedStates', $this->_aViewData['var_constraints'])) {
            $module = new FrontendOrderListModule();
            $this->_aViewData['var_constraints']['cwfrontendorderlistDisplayedStates'] = $module->getSupportedTransactionStates();
        }
        if (array_key_exists('cwfrontendorderlistDisplayedStates', $this->_aViewData['confselects'])) {
            $active_states = unserialize($this->_aViewData['confselects']['cwfrontendorderlistDisplayedStates']);
            if($active_states == null) {
                $active_states = array();
            }
            $this->_aViewData['confselects']['cwfrontendorderlistDisplayedStates'] = $active_states;
        }

        return $tpl;
    }

    public function _serializeConfVar($sType, $sName, $mValue)
    {
        if ($sName === 'cwfrontendorderlistDisplayedStates') {
            $mValue = serialize($mValue);
        }
        return parent::_serializeConfVar($sType, $sName, $mValue);
    }


    protected function _ModuleConfiguration_render_parent()
    {
        return parent::render();
    }
}