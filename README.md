SyliusAssortmentBundle [![Build status...](https://secure.travis-ci.org/Sylius/SyliusAssortmentBundle.png)](http://travis-ci.org/Sylius/SyliusAssortmentBundle)
======================

Products management system for Symfony2 applications.
It is heavily inspired by concepts behind the awesome [Spree products and variants engine](http://guides.spreecommerce.com/products_and_variants.html).
Suitable for small shops with simple product model and for stores that need fully featured product catalog.

**This bundle is compatible only with 2.1.x branch of Symfony2**.

Features
--------

* Base for supporting different persistence layers.
* Rich Doctrine2 ORM implementation.
* Product Variants/Options/Properties support, inspired by [Spree product system](http://guides.spreecommerce.com/products_and_variants.html).
* Product prototypes for fast creation of similar products.
* Sensible default controllers, events, manipulators and flexible forms.
* A lot of handy form types that are useful when integrating product system with carts, orders and more.
* Soft deletion of products and pretty slug generation thanks to [DoctrineExtensions](http://github.com/l3pp4rd/DoctrineExtensions).
* Cloning simple products.
* It uses [Pagerfanta](http://github.com/whiteoctober/Pagerfanta) for pagination.
* Thanks to awesome [Symfony2](http://symfony.com) everything is easily configurable and extensible.

Sylius
------

**Sylius** is simple but **end-user and developer friendly** webshop engine built on top of Symfony2.

Please visit [Sylius.org](http://sylius.org) for more details.

Testing and build status
------------------------

This bundle uses [travis-ci.org](http://travis-ci.org/Sylius/SyliusAssortmentBundle) for CI.
[![Build status...](https://secure.travis-ci.org/Sylius/SyliusAssortmentBundle.png)](http://travis-ci.org/Sylius/SyliusAssortmentBundle)

Before running tests, load the dependencies using [Composer](http://packagist.org).

``` bash
$ wget http://getcomposer.org/composer.phar
$ php composer.phar install --dev
```

Now you can run the tests by simply using this command.

``` bash
$ phpunit
```

Code examples
-------------

If you want to see working implementation, try out the [Sylius sandbox application](http://github.com/Sylius/Sylius-Sandbox).

Documentation
-------------

Documentation is available on [readthedocs.org](http://sylius.readthedocs.org/en/latest/bundles/SyliusAssortmentBundle.html).

Contributing
------------

All informations about contributing to Sylius can be found on [this page](http://sylius.readthedocs.org/en/latest/contributing/index.html).

Mailing lists
-------------

### Users

If you are using this bundle and have any questions, feel free to ask on users mailing list.
[Mail](mailto:sylius@googlegroups.com) or [view it](http://groups.google.com/group/sylius).

### Developers

If you want to contribute and develop this bundle, use the developers mailing list.
[Mail](mailto:sylius-dev@googlegroups.com) or [view it](http://groups.google.com/group/sylius-dev).

Sylius twitter account
----------------------

If you want to keep up with updates, [follow the official Sylius account on twitter](http://twitter.com/_Sylius)
or [follow me](http://twitter.com/pjedrzejewski).

Bug tracking
------------

This bundle uses [GitHub issues](https://github.com/Sylius/SyliusAssortmentBundle/issues).
If you have found bug, please create an issue.

Versioning
----------

Releases will be numbered with the format `major.minor.patch`.

And constructed with the following guidelines.

* Breaking backwards compatibility bumps the major.
* New additions without breaking backwards compatibility bumps the minor.
* Bug fixes and misc changes bump the patch.

For more information on SemVer, please visit [semver.org website](http://semver.org/).

This versioning method is same for all **Sylius** bundles and applications.

License
-------

License can be found [here](https://github.com/Sylius/SyliusAssortmentBundle/blob/master/Resources/meta/LICENSE).

Authors
-------

The bundle was originally created by [Paweł Jędrzejewski](http://pjedrzejewski.com).
See the list of [contributors](https://github.com/Sylius/SyliusAssortmentBundle/contributors).
