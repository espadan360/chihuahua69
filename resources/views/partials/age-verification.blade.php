<!-- Popup modal -->
<div class="modal" id="ageVerificationModal" tabindex="-1" role="dialog" aria-labelledby="ageVerificationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ageVerificationModalLabel">Esta web es para mayores de 18 años.</h5>

            </div>
            <div class="modal-body">
                <p>¿Tienes más de 18 años?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="declineButton">No, tengo menos de 18</button>
                <button type="button" class="btn crear" id="acceptButton">Sí, soy mayor de 18</button>
            </div>
        </div>
    </div>
</div>

<!-- Script de JavaScript para el popup -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    $(document).ready(function() {
        // Verificar si el usuario ha aceptado previamente
        if (document.cookie.indexOf('age_verified=true') === -1) {
            $('#ageVerificationModal').modal('show'); // Mostrar el popup si no se ha aceptado
        }

        // Función para aceptar el popup
        $('#acceptButton').click(function() {
            document.cookie = "age_verified=true; path=/"; // Guarda en la cookie que el usuario es mayor de 18 años
            $('#ageVerificationModal').modal('hide'); // Cierra el popup
        });

        // Función para no aceptar el popup (redirigir al usuario)
        $('#declineButton').click(function() {
            window.location.href = "https://www.google.com"; // Redirige a otra página, por ejemplo, Google
        });
    });
</script>
