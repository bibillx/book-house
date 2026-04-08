<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Users</title>
    <style>
        body {
            font-family: 'DM Sans', sans-serif;
            background: #f4f1eb;
            color: #1a1a1a;
            padding: 60px 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            margin-bottom: 30px;
        }
        .users-table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .users-table th, .users-table td {
            padding: 16px;
            text-align: left;
            border-bottom: 1px solid #e5e5e5;
        }
        .users-table th {
            background: #2d5016;
            color: white;
            font-weight: 500;
        }
        .role-badge {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }
        .role-admin {
            background: #2d5016;
            color: white;
        }
        .role-user {
            background: #f0f0f0;
            color: #666;
        }
        .pagination {
            margin-top: 30px;
            text-align: center;
        }
        .btn {
            padding: 8px 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            font-weight: 500;
        }
        .btn-primary {
            background: #2d5016;
            color: white;
        }
        .back-btn {
            background: #6c757d;
            color: white;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="{{ route('admin.dashboard') }}" class="btn back-btn">← Kembali ke Dashboard</a>
            <h1>Daftar Users ({{ $users->total() }})</h1>
        </div>
        <table class="users-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Terdaftar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>#{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <span class="role-badge role-{{ $user->role }}">{{ ucfirst($user->role) }}</span>
                        </td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Tidak ada users</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="pagination">
            {{ $users->links() }}
        </div>
    </div>
</body>
</html>

