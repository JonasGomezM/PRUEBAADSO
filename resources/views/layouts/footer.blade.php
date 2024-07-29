<!-- resources/views/layouts/footer.blade.php -->
<footer class="bg-dark text-light py-5">
    <div class="container">
        <div class="row">
            <!-- Sección de Información de Contacto -->
            <div class="col-md-4 mb-4">
                <h5 class="font-weight-bold mb-3">Contacto</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-map-marker-alt me-2"></i> Dirección: Calle Ejemplo 123, Ciudad</li>
                    <li><i class="fas fa-phone me-2"></i> Teléfono: (123) 456-7890</li>
                    <li><i class="fas fa-envelope me-2"></i> Email: info@ejemplo.com</li>
                </ul>
            </div>
            
            <!-- Sección de Enlaces Rápidos -->
            <div class="col-md-4 mb-4">
                <h5 class="font-weight-bold mb-3">Enlaces Rápidos</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('main') }}" class="text-light text-decoration-none">Inicio</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-light text-decoration-none">Productos</a></li>
                    <li><a href="{{ route('offers.index') }}" class="text-light text-decoration-none">Ofertas</a></li>
                    <li><a class="text-light text-decoration-none">Contactos</a></li>
                </ul>
            </div>
            
            <!-- Sección de Redes Sociales -->
            <div class="col-md-4 mb-4">
                <h5 class="font-weight-bold mb-3">Redes Sociales</h5>
                <a href="#" class="text-light me-3 fs-4"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-light me-3 fs-4"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-light me-3 fs-4"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-light me-3 fs-4"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center mt-4">
                <p class="mb-0">&copy; {{ date('Y') }} Tu Empresa. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Agrega este estilo en tu archivo CSS (app.css) */

    html, body {
        height: 130%;
        margin: 0;
    }

    body {
        display: flex;
        flex-direction: column;
    }

    main {
        flex: 1;
    }

    footer {
        background-color: #343a40; /* Fondo oscuro */
        color: #f8f9fa; /* Texto claro */
        margin-top: auto; /* Asegura que el footer se mantenga en el fondo */
        padding-top: 1rem; /* Espacio en la parte superior */
        padding-bottom: 1rem; /* Espacio en la parte inferior */
    }

    .footer .text-light {
        color: #f8f9fa !important;
    }

    .footer a {
        transition: color 0.3s ease;
    }

    .footer a:hover {
        color: #e9ecef; /* Color más claro al pasar el ratón */
    }

    .footer .fa {
        transition: color 0.3s ease;
    }

    .footer .fa:hover {
        color: #e9ecef; /* Color más claro para los iconos */
    }

    .footer .font-weight-bold {
        font-weight: 700;
    }
</style>
