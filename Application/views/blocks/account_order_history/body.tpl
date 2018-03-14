<div class="panel-body">
	<strong>[{oxmultilang ident="CART"}]</strong>
	<ol class="list-unstyled">
		[{foreach from=$order->getOrderArticles(true) item=orderitem name=testOrderItem}]
		[{assign var=sArticleId value=$orderitem->oxorderarticles__oxartid->value}]
		[{assign var=oArticle value=$oArticleList[$sArticleId]}]
		<li id="accOrderAmount_[{$order->oxorder__oxordernr->value}]_[{$smarty.foreach.testOrderItem.iteration}]">
			[{$orderitem->oxorderarticles__oxamount->value}] [{oxmultilang ident="QNT"}]
			[{if $oArticle->oxarticles__oxid->value && $oArticle->isVisible()}]
			<a id="accOrderLink_[{$order->oxorder__oxordernr->value}]_[{$smarty.foreach.testOrderItem.iteration}]" href="[{$oArticle->getLink()}]">
				[{/if}]
				[{$orderitem->oxorderarticles__oxtitle->value}] [{$orderitem->oxorderarticles__oxselvariant->value}] <span class="amount"></span>
				[{if $oArticle->oxarticles__oxid->value && $oArticle->isVisible()}]
			</a>
			[{/if}]
			[{foreach key=sVar from=$orderitem->getPersParams() item=aParam}]
			[{if $aParam}]
		<br />[{oxmultilang ident="DETAILS"}]: [{$aParam}]
			[{/if}]
			[{/foreach}]
			[{* Commented due to Trusted Shops precertification. Enable if needed *}]
			[{*
							[{oxhasrights ident="TOBASKET"}]
							[{if $oArticle->isBuyable()}]
							  [{if $oArticle->oxarticles__oxid->value}]
								<a id="accOrderToBasket_[{$order->oxorder__oxordernr->value}]_[{$smarty.foreach.testOrderItem.iteration}]" href="[{oxgetseourl ident=$oViewConf->getSelfLink()|cat:"cl=account_order" params="fnc=tobasket&amp;aid=`$oArticle->oxarticles__oxid->value`&amp;am=1"}]">[{oxmultilang ident="TO_CART"}]</a>
							  [{/if}]
							[{/if}]
							[{/oxhasrights}]
							*}]
		</li>
		[{/foreach}]
	</ol>
</div>