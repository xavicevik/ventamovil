<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Jetstream\HasTeams;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;
use OwenIt\Auditing\Contracts\Auditable;
use OwenIt\Auditing\Auditable as AuditableTrait;


class Vendedor extends Authenticatable implements Auditable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasTeams;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use AuditableTrait;

    protected $guard = 'vendedor';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nombre', 'correo', 'username','password', 'apellido', 'idtipos_documento', 'idrol', 'estado',
        'documento', 'direccion', 'indicativo', 'idpais', 'iddepartamento', 'idciudad', 'observaciones',
        'telefono', 'movil', 'isnatural', 'camaracomercio', 'rut', 'url', 'idempresa', 'changedpassword'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url', 'full_name'
    ];

    public function empresa(){
        return $this->belongsTo(Empresa::class, 'idempresa');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'idrol');
    }

    public function tipodocumento()
    {
        return $this->belongsTo(TiposDocumento::class, 'idtipos_documento');
    }

    public function pais(){
        return $this->belongsTo(Pais::class, 'idpais');
    }

    public function departamento(){
        return $this->belongsTo(Departamento::class, 'iddepartamento');
    }

    public function ciudad(){
        return $this->belongsTo(Ciudad::class, 'idciudad');
    }

    public function AllPermissions(): Attribute {
        $permissions = [];
        foreach ($this->getAllPermissions() as $permission) {
                $permissions[] = $permission->name;
        }
        return Attribute::make (
            get: fn () => $permissions,
        );
    }

    public function getFullNameAttribute()
    {
        return ucwords("{$this->nombre} {$this->apellido}");
    }
}
