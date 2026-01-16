$(function () {
    tornaFacilMap();
    setUniformHeight('contact-card');
});

function tornaFacilMap(){
    var map = L.map("map").setView([51.505, -0.09], 13);
    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "&copy; <a href='https://www.openstreetmap.org/'>OpenStreetMap</a>",
        subdomains: ["a", "b", "c"]
    }).addTo(map);
    var marker = L.marker([51.505, -0.09]).addTo(map);
    marker.bindPopup("Hello World!");
}
