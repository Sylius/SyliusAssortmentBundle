SyliusAssortmentBundle documentation.
=====================================

It is a pretty simple bundle that provides basic mechanism to perform CRUD operations on product. In this documentation you will learn how to install and work with it. Have a nice read.

**Note!** This documentation is inspired by [FOSUserBundle docs](https://github.com/FriendsOfSymfony/FOSUserBundle/blob/master/Resources/doc/index.md).

Installation.
-------------

+ Downloading the bundle.
+ Autoloader configuration.
+ Adding bundle to kernel.
+ Creating your Product class.
+ DIC configuration.
+ Importing routing cfgs.
+ Updating database schema.

### Downloading the bundle.

The good practice is to download the bundle to the `vendor/bundles/Sylius/Bundle/AssortmentBundle` directory.

This can be done in several ways, depending on your preference. The first
method is the standard Symfony2 method.

**Using the vendors script.**

Add the following lines in your `deps` file...

```
[SyliusAssortmentBundle]
    git=git://github.com/Sylius/AssortmentBundle.git
    target=bundles/Sylius/Bundle/AssortmentBundle
```

Now, run the vendors script to download the bundle.

``` bash
$ php bin/vendors install
```

**Using submodules.**

If you prefer instead to use git submodules, the run the following:

``` bash
$ git submodule add git://github.com/Sylius/AssortmentBundle.git vendor/bundles/Sylius/Bundle/AssortmentBundle
$ git submodule update --init
```

### Autoloader configuration.

Add the `Sylius\Bundle` namespace to your autoloader.

``` php
<?php
// app/autoload.php

$loader->registerNamespaces(array(
    // ...
    'FOS' => __DIR__.'/../vendor/bundles',
));
```