# ZenstruckControllerUtilBundle

[![Build Status](https://travis-ci.org/kbond/ZenstruckControllerUtilBundle.png?branch=master)](https://travis-ci.org/kbond/ZenstruckControllerUtilBundle)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kbond/ZenstruckControllerUtilBundle/badges/quality-score.png?s=1c229d4ecb6824b436cf5fd8e024ee0fd7a2a1f1)](https://scrutinizer-ci.com/g/kbond/ZenstruckControllerUtilBundle/)
[![Code Coverage](https://scrutinizer-ci.com/g/kbond/ZenstruckControllerUtilBundle/badges/coverage.png?s=5094ac6a8973914a3cbcb781a4c4133447cba089)](https://scrutinizer-ci.com/g/kbond/ZenstruckControllerUtilBundle/)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/026a7c2c-45e1-4adf-b86d-2ac8e5eeef5a/mini.png)](https://insight.sensiolabs.com/projects/026a7c2c-45e1-4adf-b86d-2ac8e5eeef5a)
[![Latest Stable Version](https://poser.pugx.org/zenstruck/controller-util-bundle/v/stable.png)](https://packagist.org/packages/zenstruck/controller-util-bundle)
[![Latest Unstable Version](https://poser.pugx.org/zenstruck/controller-util-bundle/v/unstable.png)](https://packagist.org/packages/zenstruck/controller-util-bundle)
[![License](https://poser.pugx.org/zenstruck/controller-util-bundle/license.png)](https://packagist.org/packages/zenstruck/controller-util-bundle)

This bundle integrates the [zenstruck/controller-util](https://github.com/kbond/ControllerUtil) library
into your Symfony2 project.  **For usage, see its documentation.**

## Installation

Require this bundle with composer:

    composer require zenstruck/controller-util-bundle:~0.1

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
