<style>
    /* Estilos generales del footer */
.footer {
    background-color: #333; /* Color de fondo */
    color: #fff; /* Color de texto */
    padding: 40px 20px;
    font-family: Arial, sans-serif;
}

.footer-container {
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap; /* Asegura que los elementos se ajusten en pantallas pequeñas */
}

.footer-section {
    width: 22%;
    margin: 10px;
}

.footer-section h3 {
    margin-bottom: 10px;
    font-size: 1.2em;
    border-bottom: 2px solid #fff;
    padding-bottom: 5px;
}

.footer-section p {
    font-size: 0.9em;
    line-height: 1.5em;
}

.footer-section ul {
    list-style: none;
    padding: 0;
}

.footer-section ul li {
    margin-bottom: 10px;
}

.footer-section ul li a {
    text-decoration: none;
    color: #fff;
    font-size: 1em;
}

.footer-section ul li a:hover {
    text-decoration: underline;
}

.social-links {
    margin-top: 10px;
}

.social-icon {
    margin-right: 10px;
    color: #fff;
    text-decoration: none;
}

.social-icon:hover {
    color: #f0f0f0;
}

/* Estilo para el footer inferior */
.footer-bottom {
    text-align: center;
    padding-top: 20px;
    font-size: 0.9em;
    border-top: 1px solid #fff;
    margin-top: 20px;
}

.footer-bottom p {
    margin: 0;
}

</style>
<footer class="footer">
    <div class="footer-container">
        <div class="footer-section">
            <h3>Acerca de Nosotros</h3>
            <p>Somos una empresa dedicada a brindar los mejores servicios en el sector, con un enfoque en la calidad y satisfacción del cliente.</p>
        </div>
        <div class="footer-section">
            <h3>Enlaces Rápidos</h3>
            <ul>
                <li><a href="#">Inicio</a></li>
                <li><a href="#">Servicios</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Contacto</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Redes Sociales</h3>
            <div class="social-links">
                <a href="#" target="_blank" class="social-icon">Facebook</a>
                <a href="#" target="_blank" class="social-icon">Twitter</a>
                <a href="#" target="_blank" class="social-icon">LinkedIn</a>
            </div>
        </div>
        <div class="footer-section">
            <h3>Contacto</h3>
            <p>Dirección: Calle Ficticia 123, Ciudad, País</p>
            <p>Email: contacto@empresa.com</p>
            <p>Tel: +123 456 789</p>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2025 Empresa. Todos los derechos reservados.</p>
    </div>
</footer>
