
<footer class="footer seccion">
        <div class="contenedor contenedor-footer">
            <nav class="navegacion">
                <a href="nosotros.php">Nosotros</a>
                <a href="anuncios.php">Anuncios</a>
                <a href="blog.php">Blog</a>
                <a href="contacto.php">Contacto</a>
                <?php
                    if(!($_SESSION['login'])) : ?>
                        <a href="login.php">Iniciar Sesión</a>
                    <?php endif; ?>
            </nav>
        </div>

        

        <p class="copyright">Todos los derechos reservados <?php echo date('Y'); ?> &copy;</p>
</footer>
    <script src="/build/js/bundle.min.js"></script>
</body>
</html>