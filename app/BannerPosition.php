<?php

namespace App;

enum BannerPosition: string
{
    case TOP = 'top';
    case SIDEBAR = 'sidebar';
    case FOOTER = 'footer';
    case POPUP = 'popup';
}
