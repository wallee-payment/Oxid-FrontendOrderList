[{if $module_var=='cwfrontendorderlistDisplayedStates'}]
    <dl>
        <input name="confselects[[{$module_var}]][dummy]" value="dummy" type="hidden">
        <dt>
            <select multiple class="select" style="width:100%" name="confselects[[{$module_var}]][]" [{$readonly}]>
                [{foreach from=$var_constraints.$module_var item='_field'}]
                <option value="[{$_field|escape}]" [{if $_field|in_array:$confselects.$module_var}]selected[{/if}]>
                    [{$_field|escape}]
                </option>
                [{/foreach}]
            </select>
        </dt>
        <dd>
            [{oxmultilang ident="SHOP_MODULE_`$module_var`"}]
        </dd>
        <div class="spacer"></div>
    </dl>
[{else}]
[{$smarty.block.parent}]
[{/if}]