<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;

class Fournisseur extends Model implements CanResetPassword
{
    use HasFactory;
    use Notifiable;

    public function contactFournisseurs()
    {
        return $this->hasMany(ContactFournisseur::class);
    }

    protected $password = 'MotDePasse';
    public $timestamps = false;
    protected $fillable = ['id', 'NEQ', 'Courriel', 'Entreprise', 'MotDePasse', 'Details', 'No_TPS', 'No_TVQ', 'Conditions_Paiement', 'Devise', 'Mode_Communication', 'Etat_Demande'];

    public function getEmailForPasswordReset()
    {
        // Return the email field you want to use for password resets (Courriel in your case)
        return $this->Courriel;
    }

    // Method 2: sendPasswordResetNotification($token) - Send the password reset notification
    public function sendPasswordResetNotification($token)
    {
        // Log to confirm the function is being called
        \Log::info('Sending password reset notification to: ' . $this->Courriel);
        
        // Log to check token
        \Log::info('Token: ' . $token);

        // Send the reset password notification with the generated token
        $this->notify(new ResetPasswordNotification($token));
    }
}
