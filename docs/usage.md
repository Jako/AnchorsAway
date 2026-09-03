## How it works

This MODX extra fixes anchor links in a MODX Revolution installation that uses a
base attribute. The plugin searches for `href="#<whatever>"` strings in html
attributes and replaces the anchor link with relative link to the current
resource followed by the anchor. The original href attribute content can be
added as data-anchor attribute by option. 

The relative link to the current resource is typically created during MODX
resource generation using the existing request properties. This can be changed
on resource base to use the REQUEST value referenced by `request_param_alias`
then. This is useful for MODX installations using a URL routing plugin like
CustomRequest.

## System Settings

AnchorsAway uses the following system settings in the namespace `anchorsaway`:

| Key                         | Name            | Description                                  | Default |
|-----------------------------|-----------------|----------------------------------------------|---------|
| anchorsaway.add_data_anchor | Add data-anchor | Add data-anchor attribute to the link.       | No      |
| anchorsaway.debug           | Debug           | Log debug information in the MODX error log. | No      |
