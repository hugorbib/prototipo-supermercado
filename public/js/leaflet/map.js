// let mymap = L.map('map').setView([-16.50587,-68.13266], 17)
// L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {
//     foo: 'bar', attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors'}).addTo(mymap);

// var maker = L.marker([-16.50587,-68.13266]).addTo(map);
// var marker;
// map.on('locationfound', function(ev){
//     if (!marker) {
//         marker = L.marker(ev.latlng);
//     } else {
//         marker.setLatLng(ev.latlng);
//     }
// })

// var popup = L.popup();

// function onMapClick(e) {
//     popup
//         .setLatLng(e.latlng)
//         .setContent("You clicked the map at " + e.latlng.toString())
//         .openOn(mymap);
// }

// mymap.on('click', onMapClick);

var mymap = L.map('map').setView([-16.50587,-68.13266], 17)

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {
    foo: 'bar',
    maxZoom: 18,
    id: 'mapbox.streets'
}).addTo(mymap);


L.marker([-16.50587,-68.13266]).addTo(mymap)
    .bindPopup("Ubicación Actual!").openPopup();

var popup = L.popup();

function onMapClick(e) {
    popup
        .setLatLng(e.latlng)
        .setContent("La posicion es: " + e.latlng.toString())
        .openOn(mymap);
        document.getElementById("latd").value = e.latlng.lat.toString();
        document.getElementById("longt").value = e.latlng.lng.toString();
}

mymap.on('click', onMapClick);

