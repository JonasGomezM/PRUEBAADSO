<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f7f9fc;
            margin: 0;
            padding: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }
        .sidebar {
            width: 250px;
            background-color: #343a40;
            color: #fff;
            padding: 15px;
            height: 100%;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            transition: all 0.3s ease-in-out;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow-y: auto;
        }
        .sidebar h2 {
            font-size: 1.5em;
            margin-bottom: 20px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            margin-bottom: 10px;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: #fff;
            font-size: 1.1em;
            display: flex;
            align-items: center;
            padding: 10px;
            transition: all 0.3s ease-in-out;
        }
        .sidebar ul li a:hover {
            background-color: #495057;
            border-radius: 5px;
        }
        .sidebar ul li a i {
            margin-right: 10px;
        }
        .content {
            flex: 1;
            padding: 20px;
            margin-left: 250px; /* Asegúrate de que el contenido no se superponga a la barra lateral */
            height: 100%;
            overflow-y: auto;
            transition: all 0.3s ease-in-out;
        }
        .content h1 {
            font-size: 2em;
            margin-bottom: 20px;
        }
        .sidebar-collapsed {
            width: 80px;
        }
        .sidebar-collapsed .sidebar ul li a span {
            display: none;
        }
        .sidebar-collapsed .sidebar ul li a {
            justify-content: center;
        }
        .sidebar-collapsed .sidebar h2 {
            display: none;
        }
        .toggle-btn {
            position: absolute;
            top: 15px;
            left: 15px;
            cursor: pointer;
            font-size: 1.5em;
            color: #343a40;
        }
        .sidebar .logout {
            margin-top: auto;
            padding-top: 15px;
            border-top: 1px solid #495057;
        }
        .toggle-btn i {
            transition: all 0.3s ease-in-out;
        }
        .sidebar-collapsed .toggle-btn i {
            transform: rotate(180deg);
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="{{ route('admin.inventario') }}"><i class="fas fa-boxes"></i> <span>Inventario</span></a></li>
            <li><a href="{{ route('admin.facturas') }}"><i class="fas fa-file-invoice"></i> <span>Facturas</span></a></li>
            <li><a href="{{ route('admin.citas') }}"><i class="fas fa-calendar-alt"></i> <span>Listado de Citas</span></a></li>
            <li><a href="{{ route('admin.registro_usuario') }}"><i class="fas fa-user-plus"></i> <span>Registro de Usuario</span></a></li>
        </ul>
        <div class="logout">
            <li><a href="{{ route('logout') }}"><i class="fas fa-sign-out-alt"></i> <span>Cerrar Sesión</span></a></li>
        </div>
    </div>
    <div class="content">
        <span class="toggle-btn" onclick="toggleSidebar()"><i class="fas fa-bars"></i></span>
        @yield('container') <!-- Esta línea incluirá el contenido dinámico de cada vista -->
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function toggleSidebar() {
            document.querySelector('.sidebar').classList.toggle('sidebar-collapsed');
            document.querySelector('.content').classList.toggle('content-expanded');
        }
    </script>
</body>
</html>
