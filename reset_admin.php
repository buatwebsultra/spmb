<?php
use Illuminate\Support\Facades\Hash;
use App\Models\User;

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$email = 'admin@email.com';
$password = 'admin123';

$user = User::where('email', $email)->first();
if ($user) {
    $user->password = Hash::make($password);
    $user->save();
    echo "Password for $email has been reset to $password\n";
} else {
    echo "User $email not found\n";
}
