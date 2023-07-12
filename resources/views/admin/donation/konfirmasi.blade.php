@extends('layouts.app', ['title' => 'Konfirmasi - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
            <div class="inline-block min-w-full shadow-sm rounded-lg overflow-hidden">
                <table class="min-w-full table-auto">
                    <thead class="justify-between">
                        <tr class="bg-gray-600 w-full">
                            <th class="px-16 py-2 text-left">
                                <span class="text-white">NAMA DONATUR</span>
                            </th>
                            <th class="px-16 py-2 text-left">
                                <span class="text-white">DONASI</span>
                            </th>
                            <th class="px-16 py-2">
                                <span class="text-white">AKSI</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-200">
                        @forelse($konfirmasi as $konfirm)
                            <tr class="border bg-white">
                                <td class="px-16 py-2">
                                    {{ $konfirm->donatur->name }}
                                </td>
                                <td class="px-16 py-2">
                                    {{ moneyFormat($konfirm->amount) }}
                                </td>
                                <td class="px-10 py-2 text-center">
                                    <button onClick="konfirmasi(this.id)" id="{{ $konfirm->id }}" class="bg-indigo-600 px-4 py-2 rounded shadow-sm text-xs text-white focus:outline-none">KONFIRMASI</button>
                                </td>
                            </tr>
                        @empty
                            <div class="bg-red-500 text-white text-center p-3 rounded-sm shadow-md">
                                Data Belum Tersedia!
                            </div>
                        @endforelse
                    </tbody>
                </table>
                @if ($konfirmasi->hasPages())
                    <div class="bg-white p-3">
                        {{ $konfirmasi->links('vendor.pagination.tailwind') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</main>
<script>
    //ajax delete
    function konfirmasi(id) {
        var id = id;
        var token = $("meta[name='csrf-token']").attr("content");

        Swal.fire({
            title: 'APAKAH KAMU YAKIN ?',
            text: "INGIN KONFIRMASI DATA INI!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'BATAL',
            confirmButtonText: 'YA, KONFIRMASI!',
        }).then((result) => {
            if (result.isConfirmed) {
                //ajax delete
                jQuery.ajax({
                    url: '/admin/donation/konfirmasi',
                    data: {
                        "id": id,
                        "_token": token
                    },
                    type: 'POST',
                    success: function (response) {
                        // if (response.status == "success") {
                            Swal.fire({
                                icon: 'success',
                                title: 'BERHASIL!',
                                text: 'DATA BERHASIL DIUPDATE!',
                                showConfirmButton: false,
                                timer: 3000
                            }).then(function () {
                                location.reload();
                            });
                        // } else {
                        //     Swal.fire({
                        //         icon: 'error',
                        //         title: 'GAGAL!',
                        //         text: 'DATA GAGAL DIUPDATE!',
                        //         showConfirmButton: false,
                        //         timer: 3000
                        //     }).then(function () {
                        //         location.reload();
                        //     });
                        // }
                    }
                });
            }
        })
    }
</script>
@endsection