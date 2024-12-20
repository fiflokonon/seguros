<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Mail\VerificationCodeMail;
use App\Models\Role;
use App\Models\User;
use App\Models\VerificationCode;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        if (Auth::attempt($credentials)) {
            $user = $request->user();
            if (!$user->verified_email)
            {
                $code = $this->generateCode($user->email);
                $emailSent = $this->sendVerificationCode($user->email, $code);
                if ($emailSent)
                {
                    return response()->json(['success' => false, 'activation' => true , 'message' => "Su cuenta no está activada. Acaba de recibir un código de activación por correo electrónico. Por favor ingrese el código para activar su cuenta."], 401);
                }
                else
                {
                    return response()->json(['success' => false, 'message' => "¡Error al enviar el correo electrónico! Por favor intenta la conexión nuevamente !"], 500);
                }
            }
            else
            {
                // Générer un nouveau jeton d'authentification pour l'utilisateur
                $token = $user->createToken('AuthToken')->plainTextToken;
                $token = explode('|', $token)[1];
                return response()->json([
                    'success' => true,
                    'response' => [
                        'token' => $token,
                        'user' => $user
                    ]
                ], 200);
            }

        }
        else
        {
            return response()->json(['success' => false, 'message' => 'Identificadores incorrectos'], 401);
        }
    }

    public function check_email(Request $request)
    {
        #Log::info('check_email called');
        // Validation de l'email
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            Log::info('Validation failed', $validator->errors()->toArray());
            $messages = $validator->errors();
            foreach ($messages->messages() as $key => $value) {
                if ($messages->has($key . '.required')) {
                    $response = $key;
                    return response()->json([
                        'success' => false,
                        'message' => $response
                    ], 400);
                } elseif ($messages->has($key . '.unique')) {
                    $response = $key;
                    return response()->json([
                        'success' => false,
                        'message' => $response
                    ], 400);
                } else {
                    $response = $value[0];
                    return response()->json([
                        'success' => false,
                        'message' => $response
                    ], 400);
                }
            }
        }
        try {
            $code = $this->generateCode($request->email);
            $email = $this->sendVerificationCode($request->email, $code);
            #Log::info('Email sent', ['email' => $request->email, 'code' => $code]);
            if ($email) {
                return response()->json([
                    'success' => true,
                    'response' => $code,
                    'message' => '¡Has recibido un código por correo electrónico! Por favor ingrésalo para validar tu cuenta.'
                ], 201);
            } else {
                return response()->json(['success' => false, 'message' => "Error al enviar correo electrónico."], 400);
            }
        } catch (\Exception $exception) {
            Log::error('Exception occurred', ['message' => $exception->getMessage()]);
            return response()->json(['success' => false, 'message' => $exception->getMessage()], 400);
        }
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('email', $request->email)->where('id', '<>', $request->id);
                })],
            'phone' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if ($validator->fails()) {
            $messages = $validator->errors();
            foreach ($messages->messages() as $key => $value) {
                if ($messages->has($key . '.required')) {
                    $response = $key;
                    return response()->json([
                        'success' => false,
                        'message' => $response
                    ], 400);
                } elseif ($messages->has($key . '.unique')) {
                    $response = $key;
                    return response()->json([
                        'success' => false,
                        'message' => $response
                    ], 400);
                } else {
                    $response = $value[0];
                    return response()->json([
                        'success' => false,
                        'message' => $response
                    ], 400);
                }
            }
        }
        else{
            try {
                $code = $this->generateCode($request->email);
                $email = $this->sendVerificationCode($request->email, $code);
                if ($email)
                {
                    $role = Role::where('code', 'client')->first();
                    User::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'role_id' => $role->id,
                    'password' => Hash::make($request->password),
                    'status' => true
                ]);
                return response()->json(['success' => true,
                    'response' => $code,
                    'message' => '¡Has recibido un código por correo electrónico! Por favor ingrésalo para validar tu cuenta.'], 201);
                }
                else
                {
                    return response()->json(['success' => false, 'message' => "Error al enviar correo electrónico."], 400);
                }

            }catch (\Exception $exception)
            {
                return response()->json(['success' => false, 'message' => $exception->getMessage()], 400);
            }
        }
    }

    public function getMe(Request $request)
    {
        $user = $request->user();
        if ($user)
        {
            return response()->json(['success' => true, 'reponse' => $user]);
        }
        else
        {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
    }

    public function generateCode($email) {

        $code = str_pad(mt_rand(0, 9999), 5, '0', STR_PAD_LEFT);
        // Vérifier si la clé temporaire existe déjà pour l'email fourni
        while (VerificationCode::where('email', $email)->where('code', $code)->exists()) {
            // Si la clé existe déjà, générer une nouvelle clé unique
            $code = str_pad(mt_rand(0, 9999), 5, '0', STR_PAD_LEFT);
        }
        // Enregistrer la clé temporaire dans la base de données
        VerificationCode::create([
            'id' => Str::uuid(),
            'email' => $email,
            'code' => $code,
            'expires_at' => now()->addHours(24),
        ]);
        return $code;
    }

    public function sendVerificationCode($email, $code)
    {
        try {
            Mail::to($email)->send(new VerificationCodeMail($code));
            return true; // Email sent successfully
        } catch (\Throwable $e) {
            die(var_dump($e->getMessage()));
            return false; // Error occurred during email sending
        }
    }

    public function validateCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255',
                Rule::unique('users')->where(function ($query) use ($request) {
                    return $query->where('email', $request->email)->where('id', '<>', $request->id);
                })],
            'phone' => ['required', 'string', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'code' => ['required', 'string', 'exists:verification_codes,code']
        ]);
        $code = $request->code;
        $email = $request->email;
        $verification_code = VerificationCode::where('is_used', false)
            ->where('code', $code)
            ->where('email', $email)
            ->where('expires_at', '>', now())
            ->first();
        if ($verification_code) {
            try {
                $role = Role::where('code', 'client')->first();
                $user = User::create([
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'role_id' => $role->id,
                    'password' => Hash::make($request->password),
                    'verified_email' => true,
                    'email_verified_at' => now(),
                    'status' => true
                ]);
                $token = $user->createToken('Token Name')->plainTextToken;
                $token = explode('|', $token)[1];
                return response()->json(
                    [
                        'success' => true,
                        'response' => [
                            'token' => $token,
                            'user' => $user
                        ]]
                    , 201);
            } catch (Exception $exception) {
                return response()->json(['success' => false, 'message' => $exception->getMessage()], 500);
            }
        }
        else
        {
            return response()->json(['success' => false, 'message' => 'Code Invalide']);
        }
    }

    public function addProfilePhoto(Request $request)
    {
        $user = $request->user();
        if($user && $user->statut)
        {
            $photo = $this->uploadPhoto($request);
            if ($photo)
            {
                $user->photo_profil = 'profil/'.$photo;
                try {
                    $user->save();
                    return response()->json(['success' => true, 'response' => $user], 200);
                }catch (\Exception $exception)
                {
                    return response()->json(['success' => false, 'message' => $exception->getMessage()], 400);
                }
            }
            else
            {
                response()->json(['success' => false, 'message' => 'Error al guardar la imagen' ], 500);
            }
        }
        else
        {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }
    }

    public function uploadPhoto(Request $request)
    {
        $file = $request->file('photo');
        if ($file)
        {
            $valid_extensions = ['jpeg', 'png', 'jpg'];
            if (!$file->isValid() || !in_array($file->getClientOriginalExtension(), $valid_extensions)) {
                return response()->json(['success' => false, 'message' => 'El archivo no es válido'], 400);
            }
            $filename = uniqid(). '.' .$file->getClientOriginalExtension();
            $file->move(public_path('images/profil/'), $filename);
            return $filename;
        }
        else
        {
            return response()->json(['success' => false, 'message' => 'El archivo esta vacio'], 400);
        }
    }
}
