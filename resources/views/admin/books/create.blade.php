<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah Buku</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --bg: #f4f1eb;
            --card: #ffffff;
            --accent: #2d5016;
            --accent-light: #4a7c2f;
            --text: #1a1a1a;
            --muted: #8a8474;
            --border: #ddd8cc;
            --input-bg: #faf9f6;
            --error: #c0392b;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--bg);
            min-height: 100vh;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 60px 20px;
        }

        .page-wrapper {
            width: 100%;
            max-width: 680px;
        }

        .page-header {
            margin-bottom: 40px;
        }

        .breadcrumb {
            font-size: 13px;
            color: var(--muted);
            margin-bottom: 12px;
            letter-spacing: 0.03em;
        }

        .breadcrumb a {
            color: var(--accent);
            text-decoration: none;
        }

        .breadcrumb a:hover {
            text-decoration: underline;
        }

        .page-header h1 {
            font-family: 'Playfair Display', serif;
            font-size: 42px;
            color: var(--text);
            line-height: 1.1;
        }

        .page-header p {
            margin-top: 8px;
            color: var(--muted);
            font-size: 15px;
            font-weight: 300;
        }

        .error-box {
            background: #fdf0ef;
            border: 1.5px solid #e8b4b0;
            border-radius: 10px;
            padding: 14px 18px;
            margin-bottom: 24px;
        }

        .error-box ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .error-box li {
            font-size: 13px;
            color: var(--error);
        }

        .error-box li::before {
            content: "⚠ ";
        }

        .card {
            background: var(--card);
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 2px 20px rgba(0,0,0,0.06), 0 0 0 1px rgba(0,0,0,0.04);
        }

        .section-label {
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--muted);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border);
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        label {
            font-size: 13px;
            font-weight: 500;
            color: var(--text);
        }

        input, select, textarea {
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 300;
            background: var(--input-bg);
            border: 1.5px solid var(--border);
            border-radius: 10px;
            padding: 12px 16px;
            color: var(--text);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
            width: 100%;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(45, 80, 22, 0.1);
            background: #fff;
        }

        input::placeholder, textarea::placeholder {
            color: var(--muted);
        }

        input.is-invalid, select.is-invalid, textarea.is-invalid {
            border-color: var(--error);
        }

        select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%238a8474' stroke-width='2'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 14px center;
            background-size: 16px;
            padding-right: 40px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .input-hint {
            font-size: 12px;
            color: var(--muted);
            margin-top: -4px;
        }

        input[type="file"] {
            padding: 10px 16px;
            cursor: pointer;
            font-size: 13px;
        }

        input[type="file"]::file-selector-button {
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 500;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 6px 14px;
            margin-right: 12px;
            cursor: pointer;
            transition: background 0.2s;
        }

        input[type="file"]::file-selector-button:hover {
            background: var(--accent-light);
        }

        .divider {
            height: 1px;
            background: var(--border);
            margin: 28px 0;
        }

        .form-actions {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 32px;
        }

        .btn {
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            padding: 12px 28px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            letter-spacing: 0.01em;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .btn-secondary {
            background: transparent;
            color: var(--muted);
            border: 1.5px solid var(--border);
        }

        .btn-secondary:hover {
            background: var(--bg);
            color: var(--text);
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
        }

        .btn-primary:hover {
            background: var(--accent-light);
            transform: translateY(-1px);
            box-shadow: 0 4px 14px rgba(45, 80, 22, 0.3);
        }

        .btn-primary:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>

<div class="page-wrapper">
    <div class="page-header">
        <div class="breadcrumb">
            <a href="{{ route('admin.books.index') }}">← Daftar Buku</a>
        </div>
        <h1>Tambah Buku</h1>
        <p>Isi formulir berikut untuk menambahkan buku baru ke koleksi.</p>
    </div>

    @if ($errors->any())
        <div class="error-box">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="section-label">Informasi Buku</div>
            <div class="form-grid">

                <div class="form-group full">
                    <label for="title">Judul</label>
                    <input type="text" id="title" name="title"
                           placeholder="Masukkan judul buku"
                           value="{{ old('title') }}"
                           class="{{ $errors->has('title') ? 'is-invalid' : '' }}"
                           required>
                </div>

                <div class="form-group">
                    <label for="authors">Penulis</label>
                    <input type="text" id="authors" name="authors"
                           placeholder="Nama penulis"
                           value="{{ old('authors') }}"
                           class="{{ $errors->has('authors') ? 'is-invalid' : '' }}"
                           required>
                </div>

                <div class="form-group">
                    <label for="genre">Genre</label>
                    <input type="text" id="genre" name="genre[]"
                           placeholder="Contoh: Fiksi, Sains..."
                           value="{{ old('genre.0') }}">
                </div>

                <div class="form-group">
                    <label for="price">Harga (Rp)</label>
                    <input type="number" id="price" name="price"
                           placeholder="0"
                           value="{{ old('price') }}"
                           class="{{ $errors->has('price') ? 'is-invalid' : '' }}"
                           required>
                </div>

                <div class="form-group">
                    <label for="stock">Stok</label>
                    <input type="number" id="stock" name="stock"
                           placeholder="0"
                           value="{{ old('stock') }}"
                           class="{{ $errors->has('stock') ? 'is-invalid' : '' }}"
                           required>
                    <span class="input-hint">Jumlah unit tersedia</span>
                </div>

            </div>

            <div class="divider"></div>

            <div class="section-label">Klasifikasi & Detail</div>
            <div class="form-grid">

                <div class="form-group">
                    <label for="book_type">Tipe Buku</label>
                    <select id="book_type" name="book_type"
                            class="{{ $errors->has('book_type') ? 'is-invalid' : '' }}"
                            required>
                        <option value="physical" {{ old('book_type') == 'physical' ? 'selected' : '' }}>Buku Fisik</option>
                        <option value="digital" {{ old('book_type') == 'digital' ? 'selected' : '' }}>E-Book (PDF)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="cover">Upload Cover</label>
                    <input type="file" id="cover" name="cover"
                           accept="image/*"
                           class="{{ $errors->has('cover') ? 'is-invalid' : '' }}"
                           required>
                </div>

                <div class="form-group full">
                    <label for="synopsis">Sinopsis</label>
                    <textarea id="synopsis" name="synopsis"
                              placeholder="Ringkasan singkat tentang buku ini..."
                              class="{{ $errors->has('synopsis') ? 'is-invalid' : '' }}">{{ old('synopsis') }}</textarea>
                </div>

            </div>

            <div class="form-actions">
                <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan Buku</button>
            </div>

        </form>
    </div>
</div>

</body>
</html>