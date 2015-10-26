# ZenstruckControllerUtilBundle

[![Build Status](http://img.shields.io/travis/kbond/ZenstruckControllerUtilBundle.svg?style=flat-square)](https://travis-ci.org/kbond/ZenstruckControllerUtilBundle)
[![Scrutinizer Code Quality](http://img.shields.io/scrutinizer/g/kbond/ZenstruckControllerUtilBundle.svg?style=flat-square)](https://scrutinizer-ci.com/g/kbond/ZenstruckControllerUtilBundle/)
[![Code Coverage](http://img.shields.io/scrutinizer/coverage/g/kbond/ZenstruckControllerUtilBundle.svg?style=flat-square)](https://scrutinizer-ci.com/g/kbond/ZenstruckControllerUtilBundle/)
[![SensioLabs Insight](https://img.shields.io/sensiolabs/i/026a7c2c-45e1-4adf-b86d-2ac8e5eeef5a.svg?style=flat-square)](https://insight.sensiolabs.com/projects/026a7c2c-45e1-4adf-b86d-2ac8e5eeef5a)
[![StyleCI](https://styleci.io/repos/18011090/shield)](https://styleci.io/repos/18011090)
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

## Full Default Configuration

```yaml
zenstruck_controller_util:

    # When true, only enabled if JMSSerializerBundle is registered.
    serializer_listener:  true
    forward_listener:     true
    redirect_listener:    true
    templating_view_listener:  true
    no_content_view_listener:
        enabled:              true

        # When true, controllers can return just null, otherwise an empty view is required.
        allow_null:           true
    has_flashes_listener:  true
    param_converter_listener:
        enabled:              true
        session:              true
        flash_bag:            true

        # When true, only enabled if security is enabled.
        security_context:     true

        # When true, only enabled if forms are enabled.
        form_factory:         true
    exception_map:

        # Prototype
        exception_class:      ~
```
