/**
 * DomContentLeaded --- valida que el documento este bien cargado
 */
document.addEventListener("DOMContentLoaded", function () {
  eventListener();
  darkMode();
});

/**
 * mobile-menu animacion
 */

function eventListener() {
  const mobileMenu = document.querySelector(".mobile-menu");
  mobileMenu.addEventListener("click", navegacionResponsive);
}

function navegacionResponsive() {
  const navegacion = document.querySelector(".navegacion");

  // primera forma de eliminar y quitar clases de un elemento

  navegacion.classList.toggle("mostrar");

  //segunda forma ---las 2 formas hacen exactamente lo mismo

  //   if (navegacion.classList.contains("mostrar")) {
  //     navegacion.classList.remove("mostrar");
  //   } else {
  //     navegacion.classList.add("mostrar");
  //   }
}

/**
 * mobile-menu animacion
 */

/**
 * Dark mode
 */
function darkMode() {
  const prefiereDarkMode = window.matchMedia("(prefers-color-scheme:dark)");
  console.log(prefiereDarkMode.matches);

  if (prefiereDarkMode.matches) {
    console.log("obscuro");
    document.body.classList.add("dark-mode");
  } else {
    console.log("claro");
    document.body.classList.remove("mostrar");
  }

  ///si hace un cambio de obscuro a claro lo realiza sin cargar la pagina
  prefiereDarkMode.addEventListener("change", function () {
    if (prefiereDarkMode.matches) {
      console.log("obscuro");
      document.body.classList.add("dark-mode");
    } else {
      console.log("claro");
      document.body.classList.remove("dark-mode ");
    }
  });

  botonDarkMode = document.querySelector(".dark-mode-boton");

  botonDarkMode.addEventListener("click", function () {
    document.body.classList.toggle("dark-mode");
  });
}
/**
 * Dark mode
 */
