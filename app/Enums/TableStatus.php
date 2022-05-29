<?php

namespace App\Enums;

    enum tableStatus:string
    {
         case Bekliyor = 'pending';
         case Mevcut = 'available';
         case Rezerve = 'unavailable';
    };
