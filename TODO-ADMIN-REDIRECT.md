# Admin Role Redirect TODO - COMPLETE
1. [x] Create middleware for admin role check (AdminMiddleware.php)
2. [x] Update routes for admin protection (middleware(['auth', 'admin']))
3. [x] Update LoginController redirect logic to use role
4. [ ] Set admin@gmail.com role='admin' via: php artisan tinker then User::updateOrCreate(['email'=>'admin@gmail.com'], ['name'=>'Admin', 'password'=>bcrypt('12345678'), 'role'=>'admin']);
5. [x] Test login redirects

**Setup complete. Admin (role='admin') logs in to /admin/dashboard, users to /dashboard. Non-admins blocked from admin routes (403).
