<?php

namespace App\Enum\B24;

enum Category: string
{
    case DEAL = '0';
    case BASE = '3';
    case SECONDARY_MARKET = '5';
    case FINANCIAL_CONFIRMATION = '7';
    case HR = '9';
    case INTERNATIONAL_MARKET = '11';
    case INVESTMENT_MARKET = '13';
}
