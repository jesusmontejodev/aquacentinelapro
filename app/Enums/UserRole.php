<?php

namespace App\Enums;

enum UserRole: string
{
    case USER = 'user';
    case ADMIN = 'admin';
    case MAINTENANCE = 'maintenance';

    /**
     * Obtener el nombre legible del rol
     */
    public function label(): string
    {
        return match($this) {
            self::USER => 'Usuario Normal',
            self::ADMIN => 'Administrador',
            self::MAINTENANCE => 'Mantenimiento',
        };
    }

    /**
     * Obtener todos los roles disponibles
     */
    public static function all(): array
    {
        return [
            self::USER->value => self::USER->label(),
            self::ADMIN->value => self::ADMIN->label(),
            self::MAINTENANCE->value => self::MAINTENANCE->label(),
        ];
    }
}
