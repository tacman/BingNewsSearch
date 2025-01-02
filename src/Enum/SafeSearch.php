<?php
namespace BingNewsSearch\Enum;

enum SafeSearch:string
{
    case OFF = 'Off';
    case MODERATE = 'Moderate';
    case STRICT = 'Strict';
}
