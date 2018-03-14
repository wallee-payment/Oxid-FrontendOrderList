#

## About

Plugin | cworderliststatus
--- | ---
Version | 1.0.0
Vendor / Prefix | cw
Author | customweb GmbH
Email | [info@customweb.com](https://www.customweb.com)
Website | [https://www.customweb.com](https://www.customweb.com)


## Description
This module allows you to filter which orders are displayed in the customer order history, based on the OXTRANSSTATUS field on the order.
The block account_order_history is split into three parts: account_order_history_item, account_order_history_header, account_order_history_body.

#### Requirements
Oxid CE / PE 4.8+  
Oxid EE 5.1+  
The plugin does not support composer but works in Oxid 4.10+ and Oxid 6.0+

### Install
Copy the cw folder into your [shop_root]/modules folder. Activate the module in administration area.

### Uninstall
Disable the module in administration area and clear the tmp folder to ensure the smarty cache is cleared. Additionally, the folder cw/cworderliststatus may be deleted.

### Notes
Adds an index on the column OXTRANSSTATUS in the oxorder table. This index is removed upon uninstalling.

This module supports any default order states (OK, NOT_FINISHED, PROBLEMS), as well as any custom states which may be defined in a transaction_states array in the plugins metadata.