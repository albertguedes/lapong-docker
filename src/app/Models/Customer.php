<?php declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'customer';

    protected $fillable = [
        'email',
        'password',
        'is_active'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Profile Methods
     */
    public function profile(): HasOne
    {
        return $this->hasOne(CustomerProfile::class);
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'customer_roles');
    }

    public function addresses(): MorphMany
    {
        return $this->morphMany(Address::class, 'addressable');
    }

    public function emails(): MorphMany
    {
        return $this->morphMany(Email::class, 'emailable');
    }

    public function telephones(): MorphMany
    {
        return $this->morphMany(Telephone::class, 'telephoned');
    }

    public function documents(): MorphMany
    {
        return $this->morphMany(Document::class, 'documentable');
    }

    /**
     * Company Methods
     */
    public function company(): HasOne
    {
        return $this->hasOne(Company::class);
    }

    public function companyEmployer(): BelongsTo
    {
        return $this->belongsTo(
            Company::class,            // <- modelo relacionado
            'company_employers',        // <- nome da tabela pivot
            'employer_id',              // <- chave estrangeira do empregado na pivot
            'company_id'               // <- chave estrangeira da empresa na pivot
        );
    }

    /**
     * Scheduler Methods
     */
    public function events(): BelongsToMany
    {
        return $this->belongsToMany(
            Event::class,
            'event_participants',
            'participant_id',
            'event_id'
        );
    }

    /**
     * Get the customers that are contact of this customer.
     *
     * @return BelongsToMany
     */
    public function contacts(): BelongsToMany
    {
        return $this->belongsToMany(
            Customer::class,            // modelo relacionado (ele mesmo)
            'contact_customers',        // nome da tabela pivot
            'customer_id',              // chave local
            'contact_id'                // chave do contato
        );
    }

    /**
     * Get the contacts that this customer is contact too.
     *
     * @return BelongsToMany
     */
    public function relatedTo(): BelongsToMany
    {
        return $this->belongsToMany(
            Customer::class,
            'contact_customers',
            'contact_id',              // agora inverte as chaves
            'customer_id'
        );
    }

    /**
     * Messages Methods
     */
    public function sentMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function trashedMessages(): HasMany
    {
        return $this->hasMany(Message::class, 'receiver_id')
                    ->orWhere('sender_id', $this->id)
                    ->where('is_deleted', true);
    }

    /**
     * Notifications Methods
     */
    public function notifications(): HasMany
    {
        return $this->hasMany(Notification::class);
    }

    /**
     * Medical Methods
     */

    /**
     * Get all medical cases of the customer.
     *
     * @return HasMany
     */
    public function medicalCasesAsPatient(): HasMany
    {
        return $this->hasMany(MedicalCase::class, 'patient_id');
    }

    /**
     * Get all medical cases of the customer.
     *
     * @return HasMany
     */
    public function medicalCasesAsResponsible(): HasMany
    {
        return $this->hasMany(MedicalCase::class, 'responsible_id');
    }

    /**
     * Post Methods
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function requests(): MorphMany
    {
        return $this->morphMany(Request::class, 'requested');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
