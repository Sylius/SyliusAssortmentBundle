SyliusAssortmentBundle documentation.
=====================================

It is a pretty simple bundle that provides basic mechanism to perform CRUD operations on product.

In this documentation you will learn how to install and work with it. Have a nice read.

**Note!** This documentation is inspired by [FOSUserBundle docs](https://github.com/FriendsOfSymfony/FOSUserBundle/blob/master/Resources/doc/index.md).

Installation.
-------------

+ Installing dependencies.
+ Downloading the bundle.
+ Autoloader configuration.
+ Adding bundle to kernel.
+ Creating your Product class.
+ DIC configuration.
+ Importing routing cfgs.
+ Updating database schema.

### Installing dependencies.

This bundle uses Pagerfanta library and PagerfantaBundle.
The installation guide can be found [here](https://github.com/whiteoctober/WhiteOctoberPagerfantaBundle).

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
    'Sylius\\Bundle' => __DIR__.'/../vendor/bundles',
));
```

### Adding bundle to kernel.

Finally, enable the bundle in the kernel.

``` php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new Sylius\Bundle\AssortmentBundle\SyliusAssortmentBundle(),
    );
}
```
### Creating your Product class.

Next step is creating your desired Product class. Its totally up to you how your product will look like so...
What are your waiting for?

``` php
<?php
// src/Application/Bundle/AssortmentBundle/Entity/Product.php

namespace Application\Bundle\AssortmentBundle\Entity;

use Sylius\Bundle\AssortmentBundle\Entity\Product as BaseProduct;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_assortment_product")
 */
class Product extends BaseProduct
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
}
```

### Container configuration.

Now you have to do the minimal configuration, no worries, it is not painful.

Open up your `config.yml` file and add this...

``` yaml
sylius_assortment:
    driver: ORM
    classes:
        model:
            product: Application\Bundle\AssortmentBundle\Entity\Product
```

`Please note, that the "ORM" is currently the only supported driver.`

### Import routing files.

Now is the time to import routing files. Open up your `routing.yml` file. Customize the prefixes or whatever you want.

``` yaml
sylius_assortment_product:
    resource: "@SyliusAssortmentBundle/Resources/config/routing/frontend/product.yml"
    prefix: /assortment/products

sylius_assortment_backend_product:
    resource: "@SyliusAssortmentBundle/Resources/config/routing/backend/product.yml"
    prefix: /administration/assortment/products
```

### Updating database schema.

The last thing you need to do is updating the database schema.

For "ORM" driver run the following command.

``` bash
$ php app/console doctrine:schema:update --force
```

### Finish.

That is all, I hope it was not so bad.
Now you can visit `/administration/products/list` to see the list of products.
It will be of course empty so use the "create product" link to change it!
Customize the your product class, the product form and whatever you want.
