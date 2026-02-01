<?php
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$dirty = '<script>alert("XSS")</script><p>This is safe.</p>';
$clean = clean($dirty);

echo "Dirty: " . $dirty . "\n";
echo "Clean: " . $clean . "\n";

if ($clean === '<p>This is safe.</p>') {
    echo "Verification SUCCESS: XSS tag removed.\n";
} else {
    echo "Verification FAILED: Output unexpected.\n";
}
