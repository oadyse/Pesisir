@include('layout-landing.header')

<!-- ======= Hero Section ======= -->
<section id="hero">
    <div class="hero-container" data-aos="fade-up">
        <h2>Selamat Datang di Sistem Informasi</h2>
        <h1>Indeks Kualitas Air Pesisir</h1>
        <a href="#about" class="btn-get-started scrollto"><i class="bx bx-chevrons-down"></i></a>
    </div>
</section><!-- End Hero -->

<main id="main">

    <!-- ======= Services Section ======= -->
    <section id="about" class="services">
        <div class="container">
            <div class="section-title" data-aos="fade-in" data-aos-delay="100">
                <h2>Tentang Sistem</h2>
                <p>
                    Sistem ini dirancang berbasis web yang dapat mempercepat serta mempermudah pihak
                    terkait untuk menentukan/menghitung indeks kualitas air pesisir dan laut.
                </p>
            </div>

            <div class="row text-center">
                <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up">
                        <h4 class="title"><a href="">Metode Coastal Water Quality Index (CWQI)</a></h4>
                        <p class="description">
                            penerapan metode ini untuk menentukan status kualitas air pesisir dan laut pada
                            setiap titik berdasarkan data pemantauan yang dimiliki masing-masing titik.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
                        <h4 class="title"><a href="">Media Informasi</a></h4>
                        <p class="description">
                            penyampaian informasi mengenai kualitas air pesisir dan laut ditampilkan secara
                            jelas, informatif, dan interaktif sehingga akan lebih mudah untuk diterima bagi
                            seluruh masyarakat.
                        </p>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 d-flex align-items-stretch mb-5 mb-lg-0">
                    <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
                        <h4 class="title"><a href="">Media Penyajian</a></h4>
                        <p class="description">
                            status kualitas air pesisir dan laut ini ditampilkan dalam bentuk tabel dan
                            peta titik pemantauan untuk meningkatkan informasi yang diterima dari data
                            pemantauan kualitas air pesisir dan laut.
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section><!-- End Services Section -->

    <!-- ======= Services Section ======= -->
    <section id="maps" class="services">
        <div class="container">
            <div class="section-title" data-aos="fade-in" data-aos-delay="100">
                <h2>Sampel Uji Air</h2>
                <p>
                    Sistem ini dirancang berbasis web yang dapat mempercepat serta mempermudah pihak
                    terkait untuk menentukan/menghitung indeks kualitas air pesisir dan laut.
                </p>
            </div>

            <div class="row text-center">
                <div class="col-md-12 align-items-stretch mb-5 mb-lg-0">
                    <div id='map'></div>
                </div>

            </div>
        </div>
    </section><!-- End Services Section -->

    <!-- ======= Services Section ======= -->
    <section id="kurva" class="services">
        <div class="container">
            <div class="section-title" data-aos="fade-in" data-aos-delay="100">
                <h2>Kurva Uji Air</h2>
                <p>
                    
                </p>
            </div>

            <div class="row text-center">
                <div class="col-md-12 align-items-stretch mb-5 mb-lg-0">
                    <div class='my-3 pt-3'>
                        <p class="text-center">Kurva PH</p>
                        <img src="{{asset('landing/kurva/kurva-ph.png')}}" class="w-50" alt="" srcset="">
                    </div>
                    <div class='my-3 pt-3'>
                        <p class="text-center">Kurva Salinitas</p>
                        <img src="{{asset('landing/kurva/kurva-salinitas.png')}}" class="w-50" alt="" srcset="">
                    </div>
                    <div class='my-3 pt-3'>
                        <p class="text-center">Kurva DO</p>
                        <img src="{{asset('landing/kurva/kurva-do.png')}}" class="w-50" alt="" srcset="">
                    </div>
                    <div class='my-3 pt-3'>
                        <p class="text-center">Kurva Amonia</p>
                        <img src="{{asset('landing/kurva/kurva-amonia.png')}}" class="w-50" alt="" srcset="">
                    </div>
                </div>

            </div>
        </div>
    </section><!-- End Services Section -->

</main><!-- End #main -->

@include('layout-landing.footer')

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

@include('layout-landing.script')
<script>
    let map, markers = [];
    function initMap() {
        map = L.map('map', {
            center: {
                lat: 28.626137,
                lng: 79.821603,
            },
            zoom: 15
        });

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap'
        }).addTo(map);

        map.on('click', mapClicked);
        initMarkers();
    }
    
    initMap();

    /* --------------------------- Initialize Markers --------------------------- */
    function initMarkers() {
        const initialMarkers = @php echo json_encode($initialMarkers) @endphp

        for (let index = 0; index < initialMarkers.length; index++) {

            const data = initialMarkers[index];
            const marker = generateMarker(data, index);
        
            marker.addTo(map).bindPopup(`<b>${data.title}<br>Status Air : ${data.status_air}</b>`).openPopup();
            map.panTo(data.position);
            // marker.push(marker)
        }
    }
    
    function generateMarker(data, index) {
        return L.marker(data.position, {
                draggable: data.draggable
            })
            .on('click', (event) => markerClicked(event, index))
            .on('dragend', (event) => markerDragEnd(event, index));
    }

    /* ------------------------- Handle Map Click Event ------------------------- */
    function mapClicked($event) {
        console.log(map);
        console.log($event.latlng.lat, $event.latlng.lng);
    }

    /* ------------------------ Handle Marker Click Event ----------------------- */
    function markerClicked($event, index) {
        console.log(map);
        console.log($event.latlng.lat, $event.latlng.lng);
    }

    /* ----------------------- Handle Marker DragEnd Event ---------------------- */
    function markerDragEnd($event, index) {
        console.log(map);
        console.log($event.target.getLatLng());
    }
</script>

</body>

</html>
