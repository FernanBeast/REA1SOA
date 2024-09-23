document.addEventListener('DOMContentLoaded', () => {
    // Registro de usuario
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('action', 'register');
            fetch('auth.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data); // Mostrar respuesta del servidor
            })
            .catch(error => console.error('Error:', error));
        });
    }

    // Reserva de vuelo
    const reservationForm = document.getElementById('reservationsForm');
    if (reservationForm) {
        reservationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('reserve_flight.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                alert(data); // Mostrar respuesta del servidor
            })
            .catch(error => console.error('Error:', error));
        });
    }

    // Búsqueda de vuelos
    const searchForm = document.getElementById('searchForm');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            fetch('search_flights.php', { // Asegúrate de que el archivo exista
                method: 'POST',
                body: formData
            })
            .then(response => response.json()) // Esperamos una respuesta JSON
            .then(data => {
                const resultsDiv = document.getElementById('results');
                resultsDiv.innerHTML = ''; // Limpiar resultados previos
                if (data.length > 0) {
                    data.forEach(flight => {
                        resultsDiv.innerHTML += `<div>
                            <p>Vuelo desde: ${flight.origin} a ${flight.destination}</p>
                            <p>ID: ${flight.flight_id}</p>
                        </div>`;
                    });
                } else {
                    resultsDiv.innerHTML = '<p>No se encontraron vuelos.</p>';
                }
            })
            .catch(error => console.error('Error:', error));
        });
    }
});
