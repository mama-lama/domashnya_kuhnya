<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Панель управления') — {{ config('app.name', 'Laravel') }}</title>
  
  <!-- Reusable Design System Stylesheet using CSS variables -->
  <style>
    :root {
      /* Easily customizable color palette */
      --admin-bg-app: #f4f6f9;
      --admin-bg-sidebar: #1e293b;
      --admin-sidebar-text: #94a3b8;
      --admin-sidebar-text-active: #ffffff;
      --admin-sidebar-hover: #334155;
      
      --admin-primary: #5d7f33; /* Matches landing primary */
      --admin-primary-hover: #476225;
      
      --admin-text-main: #334155;
      --admin-text-muted: #64748b;
      --admin-surface: #ffffff;
      --admin-border: #e2e8f0;
      
      --admin-radius: 12px;
      --admin-radius-sm: 8px;
      --admin-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
      
      --admin-font: "Segoe UI", system-ui, -apple-system, sans-serif;
    }

    /* Override variables locally if a specific project wants a different theme */
    @yield('custom_theme')

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: var(--admin-font);
      background-color: var(--admin-bg-app);
      color: var(--admin-text-main);
      display: flex;
      min-height: 100vh;
      line-height: 1.5;
    }

    a {
      color: inherit;
      text-decoration: none;
    }

    button, input, select, textarea {
      font: inherit;
    }

    /* Layout structure */
    .sidebar {
      width: 260px;
      background-color: var(--admin-bg-sidebar);
      color: var(--admin-sidebar-text);
      display: flex;
      flex-direction: column;
      flex-shrink: 0;
      transition: transform 0.3s ease;
      z-index: 50;
    }

    .sidebar-header {
      padding: 24px;
      border-bottom: 1px solid var(--admin-sidebar-hover);
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .sidebar-brand {
      color: var(--admin-sidebar-text-active);
      font-size: 18px;
      font-weight: 700;
      letter-spacing: 0.5px;
    }

    .sidebar-menu {
      list-style: none;
      padding: 20px 12px;
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      gap: 6px;
    }

    .menu-item a, .menu-item button {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 12px 16px;
      border-radius: var(--admin-radius-sm);
      font-size: 15px;
      font-weight: 500;
      color: var(--admin-sidebar-text);
      transition: all 0.2s ease;
      width: 100%;
      border: none;
      background: transparent;
      text-align: left;
      cursor: pointer;
    }

    .menu-item a:hover, .menu-item button:hover {
      background-color: var(--admin-sidebar-hover);
      color: var(--admin-sidebar-text-active);
    }

    .menu-item.is-active a {
      background-color: var(--admin-primary);
      color: var(--admin-sidebar-text-active);
    }

    .sidebar-footer {
      padding: 20px;
      border-top: 1px solid var(--admin-sidebar-hover);
    }

    .logout-btn {
      display: flex;
      align-items: center;
      gap: 8px;
      color: #ef4444;
      font-weight: 600;
      background: none;
      border: none;
      cursor: pointer;
      width: 100%;
      padding: 10px;
      border-radius: var(--admin-radius-sm);
      transition: background 0.2s;
    }

    .logout-btn:hover {
      background-color: rgba(239, 68, 68, 0.1);
    }

    /* Main Content Area */
    .wrapper {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      min-width: 0; /* Prevents flex items from overflowing */
    }

    .navbar {
      height: 70px;
      background-color: var(--admin-surface);
      border-bottom: 1px solid var(--admin-border);
      display: flex;
      align-items: center;
      padding: 0 30px;
      justify-content: space-between;
    }

    .nav-toggle {
      display: none;
      background: none;
      border: none;
      font-size: 20px;
      cursor: pointer;
      color: var(--admin-text-main);
    }

    .nav-user {
      font-weight: 600;
      color: var(--admin-text-main);
    }

    .content {
      padding: 30px;
      flex-grow: 1;
      overflow-y: auto;
    }

    /* Standard Admin Components */
    .card {
      background-color: var(--admin-surface);
      border-radius: var(--admin-radius);
      border: 1px solid var(--admin-border);
      box-shadow: var(--admin-shadow);
      padding: 24px;
      margin-bottom: 24px;
    }

    .card-title {
      font-size: 18px;
      font-weight: 700;
      color: var(--admin-text-main);
      margin-bottom: 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      padding: 10px 18px;
      font-size: 14px;
      font-weight: 600;
      border-radius: var(--admin-radius-sm);
      border: none;
      cursor: pointer;
      transition: all 0.2s ease;
    }

    .btn-primary {
      background-color: var(--admin-primary);
      color: #fff;
    }

    .btn-primary:hover {
      background-color: var(--admin-primary-hover);
    }

    .btn-danger {
      background-color: #ef4444;
      color: #fff;
    }

    .btn-danger:hover {
      background-color: #dc2626;
    }

    .btn-secondary {
      background-color: #e2e8f0;
      color: var(--admin-text-main);
    }

    .btn-secondary:hover {
      background-color: #cbd5e1;
    }

    .alert {
      padding: 14px 20px;
      border-radius: var(--admin-radius-sm);
      margin-bottom: 24px;
      font-weight: 500;
    }

    .alert-success {
      background-color: #f0fdf4;
      color: #15803d;
      border: 1px solid #bbf7d0;
    }

    .alert-danger {
      background-color: #fef2f2;
      color: #b91c1c;
      border: 1px solid #fca5a5;
    }

    /* Grid layout utils */
    .grid-3 {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 24px;
    }

    /* Table styles */
    .table-responsive {
      overflow-x: auto;
    }

    .table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
    }

    .table th, .table td {
      padding: 16px 20px;
      border-bottom: 1px solid var(--admin-border);
    }

    .table th {
      font-weight: 600;
      color: var(--admin-text-muted);
      background-color: #f8fafc;
      font-size: 13px;
      text-transform: uppercase;
      letter-spacing: 0.5px;
    }

    .table tbody tr:hover {
      background-color: #f8fafc;
    }

    /* Badge styles */
    .badge {
      display: inline-flex;
      padding: 4px 10px;
      border-radius: 9999px;
      font-size: 12px;
      font-weight: 600;
    }

    .badge-success {
      background-color: #dcfce7;
      color: #15803d;
    }

    .badge-secondary {
      background-color: #f1f5f9;
      color: #475569;
    }

    /* Form control styles */
    .form-group {
      margin-bottom: 20px;
    }

    .form-label {
      display: block;
      font-size: 14px;
      font-weight: 600;
      color: var(--admin-text-main);
      margin-bottom: 8px;
    }

    .form-control {
      width: 100%;
      padding: 10px 14px;
      font-size: 14px;
      border: 1px solid var(--admin-border);
      border-radius: var(--admin-radius-sm);
      outline: none;
      transition: border-color 0.2s;
    }

    .form-control:focus {
      border-color: var(--admin-primary);
    }

    /* Mobile toggle and responsive styles */
    @media (max-width: 860px) {
      .sidebar {
        position: fixed;
        top: 0;
        bottom: 0;
        left: 0;
        transform: translateX(-100%);
      }

      .sidebar.is-open {
        transform: translateX(0);
      }

      .nav-toggle {
        display: block;
      }
      
      .grid-3 {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <aside class="sidebar" id="adminSidebar">
    <div class="sidebar-header">
      <span class="sidebar-brand">Админ-панель</span>
    </div>
    
    <nav class="sidebar-menu">
      <li class="menu-item {{ Route::is('admin.dashboard') ? 'is-active' : '' }}">
        <a href="{{ route('admin.dashboard') }}">
          <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z"/>
          </svg>
          Главная
        </a>
      </li>
      <li class="menu-item {{ Route::is('admin.menu.*') ? 'is-active' : '' }}">
        <a href="{{ route('admin.menu.index') }}">
          <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
          </svg>
          Меню блюд
        </a>
      </li>
      <li class="menu-item {{ Route::is('admin.reviews.*') ? 'is-active' : '' }}">
        <a href="{{ route('admin.reviews.index') }}">
          <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
          </svg>
          Отзывы гостей
        </a>
      </li>
      <li class="menu-item {{ Route::is('admin.settings') ? 'is-active' : '' }}">
        <a href="{{ route('admin.settings') }}">
          <svg style="width: 18px; height: 18px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
          Настройки сайта
        </a>
      </li>
    </nav>
    
    <div class="sidebar-footer">
      <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="logout-btn">
          <svg style="width: 16px; height: 16px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
          </svg>
          Выйти
        </button>
      </form>
    </div>
  </aside>

  <!-- Content Wrapper -->
  <div class="wrapper">
    <header class="navbar">
      <button class="nav-toggle" id="sidebarToggle" aria-label="Toggle Sidebar">
        <svg style="width: 24px; height: 24px;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
      </button>
      <div class="nav-user">
        {{ auth()->user()->name }}
      </div>
    </header>

    <main class="content">
      @if(session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger">
          {{ session('error') }}
        </div>
      @endif

      @if($errors->any())
        <div class="alert alert-danger">
          <ul style="list-style: none;">
            @foreach($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @yield('content')
    </main>
  </div>

  <script>
    // Sidebar responsive toggle
    const toggleBtn = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('adminSidebar');

    if (toggleBtn && sidebar) {
      toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('is-open');
      });

      // Close sidebar when clicking outside on mobile
      document.addEventListener('click', (e) => {
        if (window.innerWidth <= 860) {
          if (!sidebar.contains(e.target) && !toggleBtn.contains(e.target)) {
            sidebar.classList.remove('is-open');
          }
        }
      });
    }
  </script>
</body>
</html>
