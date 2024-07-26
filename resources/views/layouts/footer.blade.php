<!-- resources/views/layouts/footer.blade.php -->
<footer class="bg-dark text-white py-4">
    <div class="container">
        <div class="row">
            <!-- Sección de Información de Contacto -->
            <div class="col-md-4 mb-3">
                <h5>Contacto</h5>
                <ul class="list-unstyled">
                    <li><i class="fas fa-map-marker-alt"></i> Dirección: Calle Ejemplo 123, Ciudad</li>
                    <li><i class="fas fa-phone"></i> Teléfono: (123) 456-7890</li>
                    <li><i class="fas fa-envelope"></i> Email: info@ejemplo.com</li>
                </ul>
            </div>
            
            <!-- Sección de Enlaces Rápidos -->
            <div class="col-md-4 mb-3">
                <h5>Enlaces Rápidos</h5>
                <ul class="list-unstyled">
                    <li><a href="{{ route('main') }}" class="text-white">Inicio</a></li>
                    <li><a href="{{ route('products.index') }}" class="text-white">Productos</a></li>
                    <li><a href="{{ route('offers.index') }}" class="text-white">Ofertas</a></li>
                    <li><a class="text-white">Contacto</a></li>
                </ul>
            </div>
            
            <!-- Sección de Redes Sociales -->
            <div class="col-md-4 mb-3">
                <h5>Redes Sociales</h5>
                <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-linkedin-in"></i></a>
            </div>
        </div>
        <div class="row">
            <div class="col-12 text-center">
                <p class="mb-0">&copy; {{ date('Y') }} Tu Empresa. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Agrega este estilo en tu archivo CSS (app.css) */

html, body {
    height: 140%;
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
    margin-top: auto; /* Asegura que el footer se empuje hacia abajo */
}

</style>