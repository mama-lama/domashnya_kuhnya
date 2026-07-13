<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Вход в панель управления</title>
  <style>
    :root {
      --bg: #f7f2e8;
      --primary: #5d7f33;
      --primary-dark: #476225;
      --text: #2f2b24;
      --surface: #ffffff;
      --border: rgba(93, 127, 51, 0.16);
      --shadow: 0 16px 38px rgba(57, 50, 37, 0.08);
      --radius: 16px;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      background-color: var(--bg);
      color: var(--text);
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px;
    }

    .login-container {
      width: 100%;
      max-width: 420px;
      background: var(--surface);
      border-radius: var(--radius);
      border: 1px solid var(--border);
      box-shadow: var(--shadow);
      padding: 40px 30px;
    }

    .login-header {
      text-align: center;
      margin-bottom: 30px;
    }

    .login-title {
      font-size: 24px;
      font-weight: 700;
      color: #2c3a1e;
      margin-bottom: 8px;
    }

    .login-subtitle {
      font-size: 14px;
      color: #6d665c;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      display: block;
      font-size: 14px;
      font-weight: 600;
      margin-bottom: 8px;
    }

    .form-control {
      width: 100%;
      padding: 12px 16px;
      font-size: 14px;
      border: 1px solid var(--border);
      border-radius: 8px;
      outline: none;
      transition: border-color 0.2s;
    }

    .form-control:focus {
      border-color: var(--primary);
    }

    .btn {
      width: 100%;
      padding: 12px;
      background-color: var(--primary);
      color: #ffffff;
      font-weight: 700;
      font-size: 15px;
      border: none;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.2s;
      margin-top: 10px;
    }

    .btn:hover {
      background-color: var(--primary-dark);
    }

    .alert {
      padding: 12px 16px;
      background-color: #fef2f2;
      color: #b91c1c;
      border: 1px solid #fca5a5;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 500;
      margin-bottom: 20px;
      list-style: none;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="login-header">
      <h1 class="login-title">Вход в систему</h1>
      <p class="login-subtitle">Домашняя кухня у дороги</p>
    </div>

    @if($errors->any())
      <div class="alert">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
      @csrf

      <div class="form-group">
        <label for="email" class="form-label">Электронная почта</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required autofocus placeholder="admin@example.com" />
      </div>

      <div class="form-group">
        <label for="password" class="form-label">Пароль</label>
        <input type="password" name="password" id="password" class="form-control" required placeholder="••••••••" />
      </div>

      <button type="submit" class="btn">Войти</button>
    </form>
  </div>
</body>
</html>
