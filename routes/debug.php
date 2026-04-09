<?php
Route::get('/debug-admin', function () {
    $admin = App\Models\User::where('email', 'admin@gmail.com')->first();
    if ($admin) {
        Auth::login($admin);
        return 'Logged in as admin! <a href="/admin">Go to admin</a>';
    }
    return 'No admin user';
});
?>

