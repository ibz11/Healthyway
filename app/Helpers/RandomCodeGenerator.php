<?php

namespace App\Helpers;

class RandomCodeGenerator
{

public static function generateRandomCode($length = 6)
{
        // Generate a random integer code with the specified length
        $min = pow(10, ($length - 1));
        $max = pow(10, $length) - 1;

        return mt_rand($min, $max);
}
}
