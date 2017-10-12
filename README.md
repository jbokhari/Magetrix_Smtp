# SMTP Settings Page for Magento 2

Creates configuration for SMTP in Magento 2.

Tested in Magento 2.1.9 with gmail account and with mailgun settings. Works with access control. Should work with multiple stores as well (not tested).

## Install

Create folder `app/code/Magetrix/Smtp/` and upload contents of this repo's `Magetrix_Smtp/` directory. Then: 

    php bin/magento module:enable Magetrix_Smtp
    php bin/magento setup:upgrade
    php bin/magento setup:di:compile

After activating email will be non-functional; settings should be added immediately. Navigate to admin `Stores` > `Configuration`. Find the `Magetrix` > `SMTP Settings` link and fill in your SMTP settings.

Thanks to WebKul for the tutorial that started this: https://webkul.com/blog/magento-2-send-mail-using-your-smtp-detail/