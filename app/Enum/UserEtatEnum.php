<?php
namespace App\Enum;

enum UserEtatEnum: string
{
    case ACTIF = 'actif';
    case INACTIF = 'inactif';
    case BLOQUER = 'bloquer';
}