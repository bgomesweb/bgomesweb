<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

#[Signature('app:set-admin-password')]
#[Description('Cria ou atualiza a senha do usuário admin (e-mail definido em ADMIN_EMAIL)')]
class SetAdminPassword extends Command
{
    public function handle(): int
    {
        $email = config('admin.email');

        if (! $email) {
            $this->error('Defina ADMIN_EMAIL no .env antes de rodar este comando.');

            return self::FAILURE;
        }

        $password = $this->secret("Nova senha para {$email}");
        $confirmation = $this->secret('Confirme a senha');

        $validator = Validator::make(
            ['password' => $password, 'password_confirmation' => $confirmation],
            ['password' => ['required', 'string', 'min:8', 'confirmed']],
        );

        if ($validator->fails()) {
            $this->error($validator->errors()->first());

            return self::FAILURE;
        }

        User::query()->updateOrCreate(
            ['email' => $email],
            ['name' => 'Bruno Gomes', 'password' => Hash::make($password)],
        );

        $this->info("Senha atualizada para {$email}.");

        return self::SUCCESS;
    }
}
