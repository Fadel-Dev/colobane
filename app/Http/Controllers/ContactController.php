<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Enregistrer le message dans la base de données
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'subject' => $request->subject,
            'message' => $request->message,
        ]);

        // Envoyer l'email
        try {
            // Email à l'administrateur
            $adminEmail = env('MAIL_ADMIN_EMAIL', env('MAIL_FROM_ADDRESS', 'contact@noflayhub.com'));
            Mail::to($adminEmail)->send(new ContactMail($contact));
            
            // Email de confirmation à l'utilisateur
            Mail::to($contact->email)->send(new ContactMail($contact, true));
        } catch (\Exception $e) {
            // Log l'erreur mais continue quand même
            \Log::error('Erreur envoi email contact: ' . $e->getMessage());
        }

        return back()->with('success', 'Votre message a été envoyé avec succès ! Nous vous répondrons dans les plus brefs délais.');
    }
}
