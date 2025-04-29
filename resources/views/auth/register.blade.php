<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Tambahkan Icon Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <!-- Animate.css for animation -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        body {
            background: linear-gradient(135deg, #e3f2fd, #fff3e0);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .register-container {
            background-color: #ffffff;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 520px;
            width: 100%;
            animation: fadeInDown;
            animation-duration: 1s;
        }

        .form-title {
            font-weight: bold;
            color: #007bff;
            text-align: center;
            margin-bottom: 30px;
        }

        .btn-register {
            width: 100%;
            background: #007bff;
            color: #fff;
            transition: all 0.3s ease;
        }

        .btn-register:hover {
            background: #0056b3;
            transform: scale(1.02);
        }

        .login-link {
            text-align: center;
            margin-top: 20px;
        }

        label {
            font-weight: 500;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
    </style>
</head>
<body>
<div class="register-container animate__animated animate__fadeInDown">
    <h2 class="form-title">Buat Akun Baru ✍️</h2>

    @if ($errors->any())
        <div class="alert alert-danger animate__animated animate__shakeX">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/register') }}">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Nama Lengkap</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                   value="{{ old('name') }}" required autofocus>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Alamat Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                   value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="no_hp" class="form-label">Nomor HP</label>
            <input type="text" class="form-control @error('no_hp') is-invalid @enderror" id="no_hp" name="no_hp"
                   value="{{ old('no_hp') }}" required>
        </div>

        <div class="mb-3 position-relative">
            <label for="password" class="form-label">Kata Sandi</label>
            <div class="input-group">
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" required>
                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">
                    <i class="bi bi-eye-slash" id="toggle-password-icon-password"></i>
                </button>
            </div>
        </div>

        <div class="mb-3 position-relative">
            <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password_confirmation">
                    <i class="bi bi-eye-slash" id="toggle-password-icon-password_confirmation"></i>
                </button>
            </div>
        </div>


        <div class="mb-3">
            <label for="role" class="form-label">Daftar Sebagai</label>
            <select class="form-select @error('role') is-invalid @enderror" id="role" name="role">
                <option value="pasien" selected>Pasien</option>
                <option value="dokter">Dokter</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                   name="alamat" required>
        </div>

        <button type="submit" class="btn btn-register">Daftar Sekarang</button>
    </form>

    <div class="login-link">
        <p>Sudah punya akun? <a href="{{ url('/login') }}">Login di sini</a></p>
    </div>
</div>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = document.getElementById('toggle-password-icon-' + targetId);
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            }
        });
    });
</script>

</body>
</html>
