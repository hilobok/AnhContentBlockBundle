<?php

namespace Anh\ContentBlockBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class AnhContentBlockBundle extends Bundle
{
    const VERSION = 'v0.1.6';
    const TITLE = 'AnhContentBlockBundle';
    const DESCRIPTION = 'Bundle for content blocks management';

    public static function getRequiredBundles()
    {
        return array(
            'Anh\DoctrineResourceBundle\AnhDoctrineResourceBundle',
            'Sp\BowerBundle\SpBowerBundle',
        );
    }
}
