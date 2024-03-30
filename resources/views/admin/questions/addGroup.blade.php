@extends('layouts.backend')

@section('title', ' Jadwal')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Add Grup Pertanyaan
                    </h2>
                    <p class="text-sm text-gray-400">
                        LUB: {{ $question->name }}
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
                                    <div class="md:col-span-6 lg:col-span-3">
                                        <label for="name" class="block mb-3 font-medium text-gray-700 text-md">Judul
                                            LUB</label>
                                        <p class="py-3 mt-1 shadow-sm sm:text-sm">
                                            {{ $question->name }}</p>

                                    </div>
                                    <div class="md:col-span-6 lg:col-span-3">
                                        <label for="classroom" class="block mb-3 font-medium text-gray-700 text-md">Pilih
                                            Tanggal Mulai dan
                                            Tanggal Berakhir</label>
                                        <p class="py-3 mt-1 shadow-sm sm:text-sm">
                                            {{ $question->start_date }} s/d {{ $question->end_date }}</p>
                                    </div>

                                    <div class="md:col-span-6 lg:col-span-3">
                                        <label for="total" class="block mb-3 font-medium text-gray-700 text-md">Total
                                            Pertanyaan</label>
                                        <p class="py-3 mt-1 shadow-sm sm:text-sm">
                                            {{ $question->questionDetails->where('id_question', $question->id)->count() }}</p>
                                    </div>

                                    <div class="md:col-span-6 lg:col-span-3">
                                        <label for="status"
                                            class="block mb-3 font-medium text-gray-700 text-md">Status</label>

                                        <p class="py-3 mt-1 shadow-sm sm:text-sm">
                                            {{ $question->is_active ? 'Aktif' : 'Tidak Aktif' }}</p>
                                    </div>

                                    <div class="md:col-span-6 lg:col-span-3">
                                        <label for="notes"
                                            class="block mb-3 font-medium text-gray-700 text-md">Keterangan</label>

                                        <p class="py-3 mt-1 shadow-sm sm:text-sm">
                                            {{ $question->notes }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="px-4 py-3 text-right sm:px-6">
                            <a href={{ route('questions.index') }} type="button"
                                class="inline-flex justify-center px-4 py-2 mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                                Kembali
                            </a>
                            <a href={{ route('questions.edit', $question->id) }} type="button"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                onclick="return confirm('Are you sure want to edit this question?')">
                                Edit Pertanyaan
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
                            List Grup Pertanyaan
                        </p>
                        <a href="{{ route('question_groups.show', $question->id) }}"
                            class="mb-4 inline-flex justify-center px-4 py-2 text-left text-white rounded-xl bg-serv-email">
                            Add Grup Pertanyaan
                        </a>
                        <p hidden>{{ $tmp = 1 }}</p>
                        <table id="questionstable" class="w-full data-table" aria-label="Table">
                            <thead>
                                <tr class="text-sm font-normal text-left text-gray-900 border-b border-b-gray-600">
                                    <th class="py-4">No</th>
                                    <th class="py-4">Nama Group</th>
                                    <th class="py-4">Total Question</th>
                                    <th class="py-4">Notes</th>
                                    <th class="py-4">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">

                                @forelse ($questionGroups as $group)
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
                                                    <p class="font-medium text-black">{{ $group->name ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-medium text-black">
                                                        {{ $question->questionDetails->where('id_question_group', $group->id)->count() }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-medium text-black">
                                                        {{ $group->notes ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <a href="{{ route('question_groups.edit', $group->id) }}"
                                                class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-email"
                                                style="margin-right: 10px;">
                                                Edit
                                            </a>

                                            <a href="{{ route('question_groups.add_detail', $group->id) }}"
                                                class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-email"
                                                style="margin-right: 10px;">
                                                add Question Detail
                                            </a>

                                            <form action="{{ route('question_groups.destroy', $group->id) }}"
                                                method="POST" style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="px-4 py-2 mt-2 text-rightbtn text-white rounded-xl bg-red-400"
                                                    onclick="return confirm('Are you sure you want to delete this Question Group?')">Delete</button>
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
