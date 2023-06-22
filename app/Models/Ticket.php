<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Relationships
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }

    public function labTest(): HasOne
    {
        return $this->hasOne(LabTest::class, 'ticket_id', 'id');
    }

    public function medicalReport(): HasOne
    {
        return $this->hasOne(MedicalReport::class, 'ticket_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    //
    public static function generateTicketNumber(): string
    {
        $prefix = 'TCKT-'; // You can customize the ticket number prefix
        $randomNumber = rand(1000, 9999); // Generate a random 4-digit number

        return $prefix . $randomNumber;
    }

}
