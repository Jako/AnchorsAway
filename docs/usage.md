## How it works

This plugin searches for `href="#<whatever>"` strings in html attributes and
replaces the anchor link with relative link to the current resource followed by
the anchor. The original href attribute content can be added as data-anchor
attribute by option.

## System Settings

AnchorsAway uses the following system settings in the namespace `anchorsaway`:
   
Property | Description | Default
----- | ------------------------------------------------------------- | -------
add_data_anchor | Add data-anchor attribute to the link. | No
debug | Log debug information in the MODX error log. | No
