Custom VCL snippets
===================

There are two ways of providing custom VCL snippets

* Manual - using Magento Admin UI by clicking Create in the UI and supplying the required inputs
* Automated - deposit snippets that follow a naming convention in a special directory

# Automated custom VCL snippets deployment

Please add any
[VCL snippets](https://docs.fastly.com/guides/vcl-snippets/using-regular-vcl-snippets) 
to `$MAGENTO_HOME/var/vcl_snippets_custom`
that should be uploaded any time you click upload custom VCL in the Magento admin.

Snippets need to follow this naming convention

```
<vcl_snippet_type>_<priority>_<short_name_description>.vcl
```

* *vcl_snippet_type* is the type of snippet e.g. recv, fetch, miss, pass, init etc.
* *priority* defines the order of insertion of the snippet in the code. Lower number
  is higher priority. Default Fastly VCL inserted by Magento module carries priority of 50
* alphanumeric short description. Use underscores (_) instead of dashes (-)

For example

```
recv_10_block_except_allowlist.vcl
```

Will create a VCL snippet of type *recv*, priority *10* named *magentomodule_custom_block_except_allowlist*.
Magentomodule will be prepended to any snippet uploaded by the Magento admin.

Please note any time you reupload VCL from the Magento admin it will overwrite any changes.


