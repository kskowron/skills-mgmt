<?php

namespace yii\helpers;

/**
 * Console helper provides useful methods for command line related tasks such as getting input or formatting and coloring
 * output.
 *
 * @author Carsten Brandt <mail@cebe.cc>
 * @since 2.0
 */
class Console extends BaseConsole
{
     public static function stdout($string)
     {
         echo $string;
         return parent::stdout($string);
     }
}
