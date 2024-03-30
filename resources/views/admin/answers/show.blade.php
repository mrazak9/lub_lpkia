@extends('layouts.backend')

@section('title', ' Answer')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Master Jawaban
                    </h2>
                    <p class="text-sm text-gray-400">
                        Enter your data Correctly & Properly
                    </p>
                </div>
            </div>
        </div>
        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-2 py-2 mt-2 bg-white rounded-xl">
                        <div class="px-4 py-5 sm:p-6">
                            <div class="grid grid-cols-6 gap-6">
                                <div class="md:col-span-6 lg:col-span-3">
                                    <label for="name" class="block mb-3 font-medium text-gray-700 text-md">Nama
                                        Jawaban</label>

                                    <input placeholder="Your Min Value" type="text" name="name" id="name"
                                        value="{{ $answer->name ?? '' }}" autocomplete="name"
                                        class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                                        disabled>
                                </div>

                                <div class="md:col-span-6 lg:col-span-3">
                                    <label for="type"
                                        class="block mb-3 font-medium text-gray-700 text-md">Keterangan</label>
                                    <input placeholder="Your Min Value" type="text" name="type" id="type"
                                        value="{{ $answer->type ?? '' }}" autocomplete="type"
                                        class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                                        disabled>
                                </div>

                                <div class="md:col-span-6 lg:col-span-3">
                                    <label for="type"
                                        class="block mb-3 font-medium text-gray-700 text-md">Keterangan</label>
                                    <input placeholder="Your Min Value" type="text" name="type" id="type"
                                        value="{{ $answer->type ?? '' }}" autocomplete="notes"
                                        class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm sm:text-sm"
                                        disabled>
                                </div>
                            </div>
                        </div>

                        <div class="px-4 py-3 text-right sm:px-6">
                            <a href={{ route('answers.index') }} type="button"
                                class="inline-flex justify-center px-4 py-2 mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 
                                rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 
                                focus:ring-gray-300">
                                Back
                            </a>
                            <a href={{ route('answers.edit', $answer->id) }} type="button"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg 
                                shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Edit Jawaban
                            </a>
                        </div>
                    </div>
                </main>
            </div>
        </section>
        @if ($answer->type != 'text')
            <section class="container px-6 mx-auto mt-5">
                <div class="grid gap-5 md:grid-cols-12">
                    <main class="col-span-12 p-4 md:pt-0">
                        <div class="px-2 py-2 mt-2 bg-white rounded-xl">
                            <div class="px-4 py-5 sm:p-6">
                                <h2 class="mb-4 text-2xl font-semibold text-gray-700">
                                    Master Detaial Jawaban
                                </h2>
                                <a href={{ route('answer_details.show', $answer->id) }} type="button"
                                    class="mb-4 inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-serv-email border border-transparent rounded-lg 
                                shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                    Add Detail Jawaban
                                </a>
                                <main class="col-span-12 p-4 md:pt-0">
                                    <div class="px-6 py-2 mt-2 bg-white rounded-xl">
                                        <p hidden>{{ $tmp = 1 }}</p>

                                        <table class="w-full" aria-label="Table">
                                            <thead>
                                                <tr
                                                    class="text-sm font-normal text-left text-gray-900 border-b border-b-gray-600">
                                                    <th class="py-4">No</th>
                                                    <th class="py-4">Name</th>
                                                    <th class="py-4">Kode</th>
                                                    <th class="py-4">Nilai</th>
                                                    <th class="py-4">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="bg-white">
                                                @forelse ($answerDetails as $answerDetail)
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
                                                                        {{ $answerDetail->name ?? '' }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="px-1 py-5 text-sm w-2/8">
                                                            <div class="flex items-center text-sm">
                                                                <div>
                                                                    <p class="font-medium text-black">
                                                                        {{ $answerDetail->code ?? '' }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="px-1 py-5 text-sm w-2/8">
                                                            <div class="flex items-center text-sm">
                                                                <div>
                                                                    <p class="font-medium text-black">
                                                                        {{ $answerDetail->value ?? '' }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="px-1 py-5 text-sm w-2/8">
                                                            <a href="{{ route('answer_details.edit', $answerDetail->id) }}"
                                                                class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-email"
                                                                style="margin-right: 10px;">
                                                                Edit
                                                            </a>
                                                            <form
                                                                action="{{ route('answer_details.destroy', $answerDetail->id) }}"
                                                                method="POST" style="display:inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit"
                                                                    class="px-4 py-2 mt-2 text-rightbtn text-white rounded-xl bg-red-400"
                                                                    onclick="return confirm('Are you sure you want to delete this mean?')">Delete</button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @empty
                                                    {{-- empty --}}
                                                @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </main>
                            </div>
                        </div>
                    </main>
                </div>
            </section>
        @endif

    </main>

@endsection
