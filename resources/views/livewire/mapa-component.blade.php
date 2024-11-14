<div>
    <div class="arriba_del_mapa bg-gray-50 shadow-sm rounded-t-lg">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-lg font-medium flex items-center space-x-2">
                <span class="text-2xl">📍</span>
                <span>Por favor, selecciona tu destino en el mapa</span>
            </div>
            <button
                id="continueButton"
                onclick="redirectToCheckout()"
                class="px-6 py-2 bg-blue-600 text-white rounded-lg transition-all duration-200 hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed"
                disabled>
                Continuar
            </button>
        </div>
    </div>

    <div class="map-container relative rounded-b-lg overflow-hidden">
        <div id="map" style="width: 100%; height: 600px;"></div>
    </div>

    <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />

    <script>
        let currentLocation = '';

        document.addEventListener('livewire:load', function () {
            mapboxgl.accessToken = 'pk.eyJ1IjoicnViZW4wMzA0IiwiYSI6ImNsa211c3U0djFqamwzdHFsNTAzN21wNTIifQ.0tEMuWVE7EOvwilogx6_eg';

            const map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11',
                center: [-82.46368666373967, 23.09134271600482],
                zoom: 14
            });

            // Agregar controles de navegación
            map.addControl(new mapboxgl.NavigationControl(), 'top-right');

            const marker = new mapboxgl.Marker({
                draggable: true,
                color: '#FF0000'
            })
                .setLngLat([-82.46368666373967, 23.09134271600482])
                .addTo(map);

            marker.on('dragend', function() {
                const lngLat = marker.getLngLat();
                currentLocation = `${lngLat.lng},${lngLat.lat}`;
                document.getElementById('continueButton').disabled = false;
            });
        });

        function redirectToCheckout() {
            if (currentLocation) {
                window.location.href = `/checkout/${encodeURIComponent(currentLocation)}`;
            }
        }
    </script>

    <style>
        .map-container {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .mapboxgl-marker {
            cursor: move;
            filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
        }

        .mapboxgl-marker {
            transition: transform 0.2s ease-out;
        }

        .mapboxgl-marker:active {
            transform: scale(1.1);
        }
    </style>
</div>
