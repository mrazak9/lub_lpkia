@extends('layouts.backend')

@section('title', ' Jadwal')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        List Jadwal Kuliah
                    </h2>
                </div>
            </div>
        </div>

        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-6 py-2 mt-2 bg-white rounded-xl">

                        <p hidden>{{ $tmp = 1 }}</p>

                        <table id="schedulestable" class="w-full data-table" aria-label="Table">
                            <thead>
                                <tr class="text-sm font-normal text-left text-gray-900 border-b border-b-gray-600">
                                    <th class="py-4">No</th>
                                    <th class="py-4">Nama MK</th>
                                    <th class="py-4">Dosen</th>
                                    <th class="py-4">Periode</th>
                                    <th class="py-4">Kelas</th>
                                    <th class="py-4">Status Pengisian</th>
                                    <th class="py-4">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">

                                @forelse ($statusResponses as $status)
                                    <tr class="text-gray-700 border-b">
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-medium text-black">{{ $tmp++ }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-medium text-black">
                                                        {{ $status->schedule->courses_name ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-medium text-black">
                                                        {{ $status->schedule->lecturer->user->name ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-medium text-black">{{ $status->schedule->periode ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-medium text-black">
                                                        {{ $status->schedule->classroom ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    @if ($status->is_response)
                                                        <p class="font-medium text-black">Telah Mengisi</p>
                                                    @else
                                                        <p class="font-medium text-black">Belum Mengisi</p>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            @if ($status->is_response)
                                                <button
                                                    class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-gray-400 cursor-not-allowed"
                                                    style="margin-right: 10px;" disabled>Input LUB</button>
                                            @else
                                                <a href="{{ route('responses.showLub', ['id' => $status->id_question, 'student_id' => $status->id_student]) }}"
                                                    class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-email"
                                                    style="margin-right: 10px;">Input LUB</a>
                                            @endif
                                        </td>

                                    </tr>
                                @empty
                                    {{-- empty --}}
                                @endforelse
                            </tbody>
                        </table>
                        <br>
                    </div>
                </main>
            </div>
        </section>
    </main>
@endsection
