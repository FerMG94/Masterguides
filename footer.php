<!-- Fernando Morán González -->
<footer>
  <div class="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-12 col-sm-12">
          <div class="about">
            <h4>Sobre MasterGuides</h4><hr>
            <p>¡Bienvenido a MasterGuides!.<br>
            Tu página de guías de videojuegos.</p>                
          </div>
        </div>
        <div class="col-lg-4 col-md-12 col-sm-12">
          <div class="info">
            <h4>Mapa del sitio</h4><hr>
            <ul class="sitemap">
              <li><a href="usuario.php" class="enlaces">Inicio</a></li>
              <li><a href="shop.php" class="enlaces">Tienda</a>
                <ul><li><a class="enlaces" href="detalles.php"> Detalles</li></ul>
                </li>
                <li><a href="about.php" class="enlaces">Sobre mí</a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4 col-md-12 col-sm-12">
            <div class="social">
              <h4>Redes sociales</h4><hr>
              <p>¡Síguenos en nuestras redes sociales!</p>
              <ul class="list-inline">
                <li class="list-inline-item" title="Instagram"><a href="https://www.instagram.com" class="iconos"><iconify-icon data-icon="ion:logo-instagram"></iconify-icon></a></li>
                <li class="list-inline-item" title="Twitter"><a href="https://www.twitter.com" class="iconos"><iconify-icon data-icon="ion:logo-twitter"></iconify-icon></a></li>
                <li class="list-inline-item" title="Facebook"><a href="https://www.facebook.com" class="iconos"><iconify-icon data-icon="ant-design:facebook-filled"></iconify-icon></a></li>
              </ul>
            </div>
          </div>
          <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="contacto">
              <h4>Contáctanos</h4><hr>
              <ul class="contact">
                <li>
                  <p class="direccion">Dirección: C/: Marqués de Montemar Ed.Bahía 29 2ºA | 52006 | Melilla </p>
                </li>
                <li>
                  <p class="direccion">Teléfono de contacto: 629430321</p>
                </li>
                <li>
                  <p>Email: <a class="enlace" href="mailto:masterguides@gmail.com">masterguides@gmail.com</a></p>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <div class="footer-copy">
    <p class="copyright">Todos los derechos reservados. &copy; 2020 MasterGuides
    </div>
    

    <button onclick="topFunction()" id="back-to-top" title="Vuelve arriba"><iconify-icon data-icon="ant-design:to-top-outlined"></iconify-icon></button>

    <script type="text/javascript" src="js/jquery-3.4.1.js"></script>
    <script type="text/javascript" src="js/popper.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script src="https://code.iconify.design/1/1.0.7/iconify.min.js"></script>
    <!-- Optional JavaScript -->
    <script type="text/javascript" src="js/shop.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>

    <script>
      function detalles(cod){
        window.location = "http://localhost/proyecto/detalles.php?parametro="+cod;
      }

      function perfil(cod){
        window.location = "http://localhost/proyecto/modificar.php?parametro="+cod;}

      </script>
    </body>
    </html>