<?php

namespace App\Enums;

    enum tableLocation:string
    {
         case Ön = 'ön taraf';
         case İçeri = 'iç taraf';
         case Dışarı = 'dış taraf';
    };
