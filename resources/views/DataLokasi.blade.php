<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800  leading-tight">
            {{ __('Data Lokasi') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white  overflow-hidden shadow-sm sm:rounded-lg mt-6">
                <div class="p-6 text-gray-900 ">
                    {{ __('Data Lokasi') }}
                </div>
                <div class="container">
                    <table class="table table-bordered data-table">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Siswa</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Kampus</th>
                                <th class="text-center" width="400px">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(function() {

            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('lokasi.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'nama_siswa',
                        name: 'nama_siswa'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'sekolah',
                        name: 'sekolah'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });

            $('body').on('click', '.deleteLokasi', function(e) {
                e.preventDefault(); // Hindari navigasi ke "#" saat tombol di klik

                var id = $(this).data("id");
                if (confirm("Apakah Anda yakin ingin menghapus Lokasi ini?")) {
                    $.ajax({
                        type: "DELETE",
                        url: "{{ route('lokasi.delete', ':id') }}".replace(':id', id),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            if (data.success) {
                                alert(data.success);
                                table.draw();
                            } else {
                                alert("Terjadi kesalahan saat menghapus data.");
                            }
                        },
                        error: function(data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });

        });
    </script>

</x-app-layout>
