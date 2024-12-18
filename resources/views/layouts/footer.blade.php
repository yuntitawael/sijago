<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />

<div class="container">
    <footer id="footer" style="background-color: rgba(2, 131, 190, 0.418);">
        <div class="container py-4">
            <div class="copyright">
                &copy; Copyright <strong><span>{{ env('APP_NAME') . ' ' . env('DISTRICT_NAME') }}</span></strong>. All
                Rights Reserved
            </div>
            <div class="credits">
                Designed by {{ env('DEVELOPER_NAME') }}
            </div>
        </div>
    </footer>
</div>

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>


@livewireScripts
{{-- <script src="/vendor/turbolinks/turbolinks.js"></script>
<script src="/vendor/turbolinks/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script> --}}
{{-- scripts --}}
<script src="/vendor/aos/aos.js"></script>
<script>
    AOS.init();
</script>
<!-- bootstrap -->
{{-- <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script> --}}

<!-- Templates -->
<!-- Vendor JS Files -->
<script src="/vendor/frontend-ui/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/vendor/frontend-ui/vendor/glightbox/js/glightbox.min.js"></script>
<script src="/vendor/frontend-ui/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/vendor/frontend-ui/vendor/swiper/swiper-bundle.min.js"></script>
<script src="/vendor/frontend-ui/vendor/waypoints/noframework.waypoints.js"></script>
<script src="/vendor/frontend-ui/vendor/php-email-form/validate.js"></script>
<script src="/vendor/frontend-ui/js/main.js"></script>



<script src='/vendor/purecounter-vanilla/purecounter_vanilla.js'></script>

{{-- calendar --}}
<script src="/vendor/calendar/datepicker.min.js"></script>

{{-- fakeloader --}}
<script src="/vendor/fakeloader/js/fakeLoader.min.js"></script>
{{-- <div class="fakeLoader"></div> --}}

<script>
    $(document).ready(function() {
        $.fakeLoader({
            // bgColor: '#2ecc71',
            bgColor: 'rgba(0, 119, 255, 0.9',
            spinner: "spinner2"
        });
    });
</script>

<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script>
    $(document).ready(function() {
        var latitude = "-2.7943391500932244";
        var longitude = "129.49444594186716";
        var map = L.map('map2').setView([latitude, longitude], 17.5);

        googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
            maxZoom: 20,
            subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        }).addTo(map);

        var marker = L.marker([latitude, longitude]).addTo(map);

        var circle = L.circle([latitude, longitude], {
            color: 'red',
            fillColor: '#f03',
            fillOpacity: 0.5,
            radius: 20
        }).addTo(map);

        map.scrollWheelZoom.disable();

        var popup = L.popup();

        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("Koordinat  posisi. " + e.latlng)
                .openOn(map);
        }

        map.on('click', onMapClick);
    });
</script>

</body>

</html>
