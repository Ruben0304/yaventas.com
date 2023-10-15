let deferredPrompt;
const instalarApp = document.getElementById('boton-instalar');
instalarApp.style.display = 'none';
window.addEventListener('beforeinstallprompt', (e) => {
  // Evita que la ventana emergente de instalación se muestre automáticamente
  e.preventDefault();
  // Almacena el evento para que se pueda activar más tarde
  deferredPrompt = e;
  // Muestra el botón de instalación
  instalarApp.style.display = 'block';

  instalarApp.addEventListener('click', (e) => {
    // Oculta el botón de instalación
    instalarApp.style.display = 'none';
    // Muestra la ventana emergente de instalación
    deferredPrompt.prompt();
    // Espera a que el usuario interactúe con la ventana emergente
    deferredPrompt.userChoice.then((choiceResult) => {
      if (choiceResult.outcome === 'accepted') {
        console.log('El usuario ha aceptado la instalación');
      } else {
        console.log('El usuario ha cancelado la instalación');
      }
      deferredPrompt = null;
    });
  });
});