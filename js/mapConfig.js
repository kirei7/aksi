var map;

function initMap() {
    map = new google.maps.Map(document.getElementById('myMap'), {
        center: {lat: 49.2240459, lng: 28.4458697},
        zoom: 14
    });
    for(var i = 0; i < mapData.length; i++) {
        var point = mapData[i];
        var id = "map-marker-" + i;
        point.marker = new google.maps.Marker({
            position: point.coord,
            map: map,
            title: point.text,
            id: id
        });
        createTabItem(point);
        google.maps.event.addDomListener(document.getElementById(id), "click", function(ev) {
            var marker = getMarker($(ev.target).attr("id"));
            console.log(marker);
            map.setCenter(marker.getPosition());
        });
    }
    $("#receptionTab li:first-child a").trigger('click');
}
function createTabItem(point) {
    var item = $("li.cloneable").clone();
    item.removeClass("cloneable");
    var ref = item.children("a");
    ref.attr("id", point.marker.id);
    ref.html(point.text);
    $("#receptionTab").append(item);
}
function getMarker(id) {
    var res;
    mapData.forEach(function (item) {
        if (item.marker.id === id) res = item.marker;
    });
    return res;
}
