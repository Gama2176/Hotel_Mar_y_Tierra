// Corregido 'documen' a 'document'
const btnAbrirModal = document.querySelector("#btn-abrir-modal");
const modal = document.querySelector("#modal");
const btnCerrarModal = document.querySelector("#btn-cerrar-modal");

// Abre el modal al hacer clic en el botón
btnAbrirModal.addEventListener("click", () => {
    modal.showModal();
});

// Cierra el modal al hacer clic en el botón de cerrar
btnCerrarModal.addEventListener("click", () => {
    modal.close();
});
