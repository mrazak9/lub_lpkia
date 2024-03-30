@extends('layouts.backend')

@section('title', ' Jadwal')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Add Detail Pertanyaan
                    </h2>
                    <p class="text-sm text-gray-400">
                        Grup LUB: {{ $questionGroup->name }}
                    </p>
                </div>
            </div>
        </div>

        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-6 py-2 mt-2 bg-white rounded-xl">
                        <div>
                            <div class="px-4 py-5 sm:p-6">
                                <div class="grid grid-cols-6 gap-6">
                                    <div class="md:col-span-6 lg:col-span-6">
                                        <label for="name" class="block mb-3 font-medium text-gray-700 text-md">Nama
                                            LUB</label>
                                        <p class="py-3 mt-1 shadow-sm sm:text-sm">
                                            {{ $questionGroup->question->name ?? '-' }}</p>

                                    </div>

                                    <div class="md:col-span-6 lg:col-span-3">
                                        <label for="name" class="block mb-3 font-medium text-gray-700 text-md">Grup
                                            LUB</label>
                                        <p class="py-3 mt-1 shadow-sm sm:text-sm">
                                            {{ $questionGroup->name ?? '-' }}</p>

                                    </div>

                                    <div class="md:col-span-6 lg:col-span-3">
                                        <label for="total" class="block mb-3 font-medium text-gray-700 text-md">
                                            Notes
                                        </label>
                                        <p class="py-3 mt-1 shadow-sm sm:text-sm">
                                            {{ $questionGroup->notes ?? '-' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 text-right sm:px-6">
                            <a href={{ route('questions.show',$questionGroup->question->id ) }} type="button"
                                class="inline-flex justify-center px-4 py-2 mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                                Kembali
                            </a>
                            <a href={{ route('question_groups.edit', $questionGroup->id) }} type="button"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                onclick="return confirm('Are you sure want to edit this question group?')">
                                Edit Grup
                            </a>
                        </div>
                    </div>
                </main>
            </div>
        </section>
        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-6 py-2 mt-2 bg-white rounded-xl">
                        <p class="mt-8 mb-4 text-xl font-semibold text-gray-700">
                            List Detail Pertanyaan
                        </p>
                        <a href="{{ route('question_details.show', $questionGroup->id) }}"
                            class="mb-4 inline-flex justify-center px-4 py-2 text-left text-white rounded-xl bg-serv-email">
                            Add Detail Pertanyaan
                        </a>
                        <p hidden>{{ $tmp = 1 }}</p>
                        <table id="questionstable" class="w-full data-table" aria-label="Table">
                            <thead>
                                <tr class="text-sm font-normal text-left text-gray-900 border-b border-b-gray-600">
                                    <th class="py-4">No</th>
                                    <th class="py-4">Pertanyaan</th>
                                    <th class="py-4">Urutan</th>
                                    <th class="py-4">Pilhan Jawaban</th>
                                    <th class="py-4">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">

                                @forelse ($questoinDetails as $detail)
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
                                                    <p class="font-medium text-black">{{ $detail->question ?? '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-medium text-black">{{ $detail->sequence ?? '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-medium text-black">
                                                        {{ $detail->answer->name ?? '-' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <a href="{{ route('question_details.edit', $detail->id) }}"
                                                class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-email"
                                                style="margin-right: 10px;">
                                                Edit
                                            </a>

                                            <form action="{{ route('question_details.destroy', $detail->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 mt-2 text-rightbtn text-white rounded-xl bg-red-400"
                                                    onclick="return confirm('Are you sure you want to delete this Detail Group?')">Delete</button>
                                            </form>
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
