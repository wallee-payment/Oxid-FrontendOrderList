<div class="panel-heading">
	<div class="row">
		<div class="col-xs-3">
			<strong>[{oxmultilang ident="DD_ORDER_ORDERDATE"}]</strong>
			<span id="accOrderDate_[{$order->oxorder__oxordernr->value}]">[{$order->oxorder__oxorderdate->value|date_format:"%d.%m.%Y"}]</span>
			<span>[{$order->oxorder__oxorderdate->value|date_format:"%H:%M:%S"}]</span>
		</div>
		<div class="col-xs-3">
			<strong>[{oxmultilang ident="STATUS"}]</strong>
			<span id="accOrderStatus_[{$order->oxorder__oxordernr->value}]">
							[{if $order->oxorder__oxstorno->value}]
								<span class="note">[{oxmultilang ident="ORDER_IS_CANCELED"}]</span>
							[{elseif $order->oxorder__oxsenddate->value !="-"}]
								<span>[{oxmultilang ident="SHIPPED"}]</span>
							[{else}]
								<span class="note">[{oxmultilang ident="NOT_SHIPPED_YET"}]</span>
							[{/if}]
						</span>
		</div>
		<div class="col-xs-3">
			<strong>[{oxmultilang ident="ORDER_NUMBER"}]</strong>
			<span id="accOrderNo_[{$order->oxorder__oxordernr->value}]">[{$order->oxorder__oxordernr->value}]</span>
		</div>
		<div class="col-xs-3">
			<strong>[{oxmultilang ident="SHIPMENT_TO"}]</strong>
			<span id="accOrderName_[{$order->oxorder__oxordernr->value}]">
							[{if $order->oxorder__oxdellname->value}]
								[{$order->oxorder__oxdelfname->value}]
								[{$order->oxorder__oxdellname->value}]
							[{else}]
								[{$order->oxorder__oxbillfname->value}]
								[{$order->oxorder__oxbilllname->value}]
							[{/if}]
						</span>
			[{if $order->getShipmentTrackingUrl()}]
			&nbsp;|&nbsp;<strong>[{oxmultilang ident="TRACKING_ID"}]</strong>
			<span id="accOrderTrack_[{$order->oxorder__oxordernr->value}]">
								<a href="[{$order->getShipmentTrackingUrl()}]">[{oxmultilang ident="TRACK_SHIPMENT"}]</a>
							</span>
			[{/if}]
		</div>
	</div>
</div>