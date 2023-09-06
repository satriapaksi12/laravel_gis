<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Tambah Data Lokasi') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form id="locationForm" action="{{ route('lokasi.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama_siswa" class="block text-gray-700 ">Nama Siswa</label>
                    <input type="text" class="form-input mt-1 block w-full" id="nama_siswa" name="nama_siswa"
                        required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 ">Email</label>
                    <input type="email" class="form-input mt-1 block w-full" id="email" name="email" required>
                </div>
                <div class="mb-4">
                    <label for="sekolah" class="block text-gray-700 ">Sekolah</label>
                    <input type="text" class="form-input mt-1 block w-full" id="sekolah" name="sekolah" required>
                </div>
                <div class="mb-4">
                    <label for="umur" class="block text-gray-700 ">Umur</label>
                    <input type="number" class="form-input mt-1 block w-full" id="umur" name="umur" required>
                </div>
                <div class="mb-4">
                    <label for="latitude" class="block text-gray-700 ">Latitude</label>
                    <input type="text" class="form-input mt-1 block w-full" id="latitude" name="latitude" required
                        readonly>
                </div>
                <div class="mb-4">
                    <label for="longitude" class="block text-gray-700 ">Longitude</label>
                    <input type="text" class="form-input mt-1 block w-full" id="longitude" name="longitude" required
                        readonly>
                </div>
                <div class="mb-4 text-center">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-60 rounded-full inline-block">Simpan</button>
                </div>
            </form>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900 ">
                    {{ __('MAPS') }}
                </div>

                <div id="map" class="w-full h-80"></div>
            </div>
        </div>
    </div>

    <script>
        var map = L.map('map').setView([-7.5393355, 110.6839873], 13);
        var marker;
        var popup = L.popup();

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        map.on('click', function(e) {
            // Mengatur koordinat dari klik peta ke input latitude dan longitude
            document.getElementById('latitude').value = e.latlng.lat;
            document.getElementById('longitude').value = e.latlng.lng;

            // Menghapus marker sebelumnya (jika ada) dan menambahkan marker baru
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(e.latlng).addTo(map);
        });

        // Memastikan bahwa koordinat awal sudah ada di form jika pengguna tidak mengklik peta
        document.getElementById('latitude').value = -7.5393355;
        document.getElementById('longitude').value = 110.6839873;
    </script>
</x-app-layout>
