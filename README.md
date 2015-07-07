# ZenstruckControllerUtilBundle

[![Build Status](http://img.shields.io/travis/kbond/ZenstruckControllerUtilBundle.svg?style=flat-square)](https://travis-ci.org/kbond/ZenstruckControllerUtilBundle)
[![Scrutinizer Code Quality](http://img.shields.io/scrutinizer/g/kbond/ZenstruckControllerUtilBundle.svg?style=flat-square)](https://scrutinizer-ci.com/g/kbond/ZenstruckControllerUtilBundle/)
[![Code Coverage](http://img.shields.io/scrutinizer/coverage/g/kbond/ZenstruckControllerUtilBundle.svg?style=flat-square)](https://scrutinizer-ci.com/g/kbond/ZenstruckControllerUtilBundle/)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/026a7c2c-45e1-4adf-b86d-2ac8e5eeef5a.svg?style=flat-square)](https://insight.sensiolabs.com/projects/026a7c2c-45e1-4adf-b86d-2ac8e5eeef5a)
[![Latest Stable Version](http://img.shields.io/packagist/v/zenstruck/controller-util-bundle.svg?style=flat-square)](https://packagist.org/packages/zenstruck/controller-util-bundle)
[![License](http://img.shields.io/packagist/l/zenstruck/controller-util-bundle.svg?style=flat-square)](https://packagist.org/packages/zenstruck/controller-util-bundle)

This bundle integrates the [zenstruck/controller-util](https://github.com/kbond/ControllerUtil) library
into your Symfony2 project.  **For usage, see its documentation.**

## Installation

Require this bundle with composer:

    composer require zenstruck/controller-util-bundle

Then enable it in your kernel:

```php
// app/AppKernel.php
public function registerBundles()
{
    $bundles = array(
        //...
        new Zenstruck\ControllerUtilBundle\ZenstruckControllerUtilBundle(),
        //...
    );
}
```
