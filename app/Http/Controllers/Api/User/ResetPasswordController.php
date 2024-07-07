<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Mail\TemporaryCodeEmail;
use App\Models\ResetPasswordKey;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class ResetPasswordController extends Controller
{
    public function getEmail(Request $request)
    {
        $email = $request->email;
        $user = User::where('email', $email)->first();
        if ($user && $user->statut)
        {
            $code = $this->generateKey($email);
            if ($code)
            {
                $sent = $this->sendTemporaryCode($email, $code);
                if ($sent)
                    return response()->json(['success' => true, 'code' => $code, 'message' => 'Email enviado']);
                else
                    return response()->json(['success' => false, 'message' => 'Error al enviar correo electrónico'], 500);
            }
            else
            {
                return response()->json(['success' => false, 'message' => 'Error al generar código'], 500);
            }
        }
        else
        {
            return response()->json(['success' => false, 'message' => 'Usuario no encontrado o inactivo'], 404);
        }
    }

    public function generateKey($email) {
        $key = str_pad(mt_rand(0, 9999), 5, '0', STR_PAD_LEFT);

        // Vérifier si la clé temporaire existe déjà pour l'email fourni
        while (ResetPasswordKey::where('email', $email)->where('key', $key)->exists()) {
            // Si la clé existe déjà, générer une nouvelle clé unique
            $key = str_pad(mt_rand(0, 9999), 5, '0', STR_PAD_LEFT);
        }
        // Enregistrer la clé temporaire dans la base de données
        ResetPasswordKey::create([
            'email' => $email,
            'key' => $key,
            'expires_at' => now()->addHours(24),
        ]);
        return $key;
    }

    public function sendTemporaryCode($email, $code)
    {
        try {
            Mail::to($email)->send(new TemporaryCodeEmail($code));
            return true;
        } catch (\Exception $e) {
            // Gérer l'erreur ou les exceptions spécifiques liées à l'envoi de l'e-mail
            return false;
        }
    }

    public function validateKey(Request $request) {
        $code = $request->code;
        $email = $request->email;
        $password = $request->new_password;
        if ($password)
        {
            $user = User::where('email', $email)->first();
            if ($user && $user->statut)
            {
                $temporary_code = ResetPasswordKey::where('is_used', false)
                    ->where('key', $code)
                    ->where('email', $email)
                    ->where('expires_at', '>', now())
                    ->first();
                if ($temporary_code)
                {
                    try {
                        $user->password = Hash::make($password);
                        $user->save();
                        $temporary_code->markAsUsed();
                        return response()->json(['success' => true, 'message' => 'Contraseña actualizada']);
                    }catch (Exception $exception)
                    {
                        return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
                    }
                }
                else
                {
                    return response()->json(['success' => false, 'message' => 'Codigo invalido']);
                }
            }
            else
            {
                return response()->json(['success' => false, 'message' => 'Usuario no encontrado o inactivo'], 404);
            }
        }
        else
        {
            return response()->json(['success' => false, 'message' => 'Campo de contraseña requerido'], 400);
        }
    }

}
