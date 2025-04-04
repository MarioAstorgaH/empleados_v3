document.addEventListener("DOMContentLoaded", function () {
    const botones = document.querySelectorAll(".btn-borrar")

    botones.forEach(function (boton) {
        boton.addEventListener("click", function (evento) {
            const confirmado = confirm("¿Estás seguro de que quieres eliminar este registro?");
            if (!confirmado) {
                evento.preventDefault();
            }
        })
    })
})
