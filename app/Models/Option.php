<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modelo para almacenar opciones clave–valor de configuración global.
 *
 * @property string      $key        Identificador único de la opción.
 * @property mixed       $value      Valor de la opción (string, JSON, etc.).
 * @property string|null $type       Tipo de dato.
 * @property string|null $group      Categoría lógica.
 * @property bool        $autoload   Si se carga automáticamente.
 * @property int|null    $created_by Usuario que creó la opción.
 * @property int|null    $updated_by Usuario que actualizó la opción.
 */
class Option extends Model
{
    use HasFactory;

    /**
     * Tabla asociada.
     *
     * @var string
     */
    protected $table = 'options';

    /**
     * Campos asignables.
     *
     * @var array
     */
    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'autoload',
        'created_by',
        'updated_by',
    ];

    /**
     * Casts de atributos.
     *
     * @var array
     */
    protected $casts = [
        'autoload' => 'boolean',
    ];

    /**
     * Obtiene el valor de la opción.
     *
     * @param string $key Nombre de la opción.
     * @param mixed  $default Valor por defecto si no existe.
     * @return mixed
     */
    public static function getValue(string $key, $default = null)
    {
        $option = static::where('key', $key)->first();

        return $option ? $option->value : $default;
    }

    /**
     * Crea o actualiza una opción.
     *
     * @param string      $key      Nombre de la opción.
     * @param mixed       $value    Valor a guardar.
     * @param string|null $type     Tipo de dato.
     * @param string|null $group    Categoría lógica.
     * @param bool        $autoload Si se carga automáticamente.
     * @param int|null    $userId   ID de usuario que realiza el cambio.
     * @return self
     */
    public static function setValue(
        string $key,
        $value,
        string $type = null,
        string $group = null,
        bool $autoload = false,
        int $userId = null
    ): self {
        $option = static::firstOrNew(['key' => $key]);

        if (! $option->exists) {
            $option->created_by = $userId;
        }

        $option->value      = $value;
        $option->type       = $type;
        $option->group      = $group;
        $option->autoload   = $autoload;
        $option->updated_by = $userId;
        $option->save();

        return $option;
    }
}
