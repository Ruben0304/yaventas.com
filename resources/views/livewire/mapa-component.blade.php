<head>
    <script src='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.js'></script>
    <link href='https://api.mapbox.com/mapbox-gl-js/v2.3.1/mapbox-gl.css' rel='stylesheet' />
</head>
<body>
    <div class="arriba_del_mapa" style="padding: 15px; background-color: #f5f5f5; display: flex; justify-content: space-between; align-items: center;">
        <div style="font-size: 18px;">
            📍 Por favor, selecciona tu destino en el mapa
        </div>
        <button id="continue-button" class="btn btn-primary" disabled>Continuar</button>
    </div>
    <div>
        <div id="map" style="width: 100%; height: 500px;">
        </div>
    </div>

    <script>
    mapboxgl.accessToken = 'pk.eyJ1IjoicnViZW4wMzA0IiwiYSI6ImNsa211c3U0djFqamwzdHFsNTAzN21wNTIifQ.0tEMuWVE7EOvwilogx6_eg';

    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [-82.46368666373967, 23.09134271600482],
        zoom: 14
    });

    const marker = new mapboxgl.Marker({
        draggable: true
    })
    .setLngLat([-82.46368666373967, 23.09134271600482])
    .addTo(map);

    function onDragEnd() {
        const location = marker.getLngLat();
        document.getElementById("continue-button").disabled = false;
        document.getElementById("continue-button").addEventListener("click", () => {
            window.location.href = `/checkout?location=${location.lng},${location.lat}`;
        });
    }

    marker.on('dragend', onDragEnd);
    </script>
</body>
