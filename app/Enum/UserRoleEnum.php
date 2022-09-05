<?php
namespace App\Enum;

enum UserRoleEnum: string
{
    case ADMIN = 'admin';
    case CLIENT = 'client';
    case LIVREUR = 'livreur';
}

?>