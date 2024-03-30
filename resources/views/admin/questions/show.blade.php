@extends('layouts.backend')

@section('title', ' Jadwal')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Detail Pertanyaan
                    </h2>

                    <div class="px-4 py-3 text-right sm:px-6">
                        <a href={{ route('questions.index') }} type="button"
                            class="inline-flex justify-center px-4 py-2 mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                            Kembali
                        </a>
                        <a href={{ route('questions.edit', $question->id) }} type="button"
                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-serv-bg border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                            onclick="return confirm('Are you sure want to edit this question?')">
                            Edit Pertanyaan
                        </a>
                    </div>
                </div>

            </div>
            @if (session('success'))
                <div class="relative">
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                        role="alert">
                        <strong class="font-bold">Success!</strong>
                        <span class="block sm:inline">{{ session('success') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-green-500" role="button"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 5.652a.999.999 0 1 0-1.414 1.414L11 8.414l-1.934 1.934a.999.999 0 1 0 1.414 1.414L12.414 10l1.934 1.934a.999.999 0 1 0 1.414-1.414L13.828 10l1.52-1.52a.999.999 0 0 0 0-1.414z" />
                            </svg>
                        </span>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="relative">
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Error!</strong>
                        <span class="block sm:inline">{{ session('error') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 20 20">
                                <title>Close</title>
                                <path
                                    d="M14.348 5.652a.999.999 0 1 0-1.414 1.414L11 8.414l-1.934 1.934a.999.999 0 1 0 1.414 1.414L12.414 10l1.934 1.934a.999.999 0 1 0 1.414-1.414L13.828 10l1.52-1.52a.999.999 0 0 0 0-1.414z" />
                            </svg>
                        </span>
                    </div>
                </div>
            @endif
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
                                            {{ $question->questionDetails->where('id_question', $question->id)->count() }}
                                        </p>
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
                    </div>
                </main>
            </div>
        </section>

        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-2 py-2 mt-2 bg-white rounded-xl">
                        <form method="POST" action="{{ route('questions.generate') }}" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <div class="px-4 py-5 sm:p-6">
                                    <h2 class="mb-1 text-2xl font-semibold text-gray-700">
                                        Generate Pertanyaan
                                    </h2>
                                    <br>
                                    <div class="grid grid-cols-6 gap-6">
                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="name" class="block mb-3 font-medium text-gray-700 text-md">Judul
                                                LUB</label>
                                            <input placeholder="Input Judul LUB" type="text" name="name"
                                                id="name" value=" {{ $question->name }}" autocomplete="name"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                disabled>
                                            <input type="text" name="id_question" id="id_question"
                                                value=" {{ $question->id }}" autocomplete="name" hidden>
                                            @if ($errors->has('name'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('name') }}
                                                </p>
                                            @endif
                                        </div>
                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="periode" class="block mb-3 font-medium text-gray-700 text-md">
                                                Periode jadwal
                                            </label>
                                            <select name="periode" type="text"
                                                class="form-control select2 block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm
                                                {{ $errors->has('periode') ? 'is-invalid' : '' }}"
                                                value={{ old('periode') }} required>
                                                @if ($errors->has('periode'))
                                                    <p class="text-danger">{{ $errors->first('periode') }}</p>
                                                @endif
                                                @foreach ($periods as $period)
                                                    <option value="{{ $period->periode }}"
                                                        {{ old('periode') == $period->periode ? 'selected' : '' }}>
                                                        {{ $period->periode }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="px-4 py-3 text-right sm:px-6">
                                <button type="submit"
                                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                    onclick="return confirm('Are you sure want to Generate Question data ?')">
                                    Generate
                                </button>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </section>
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Preview Pertanyaan LUB : {{ $question->name }}
                    </h2>
                </div>
            </div>
        </div>
        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <form method="POST" action="{{ route('responses.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="px-6 py-2 mt-2 bg-white rounded-xl">
                            <p hidden>{{ $tmp = 1 }}</p>
                            <p hidden>{{ $cmt = 1 }}</p>
                            @foreach ($questionGroups as $group)
                                @foreach ($group as $item)
                                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                                        {{ $item->name }}
                                    </h2>
                                    <table id="schedulestable" class="w-full data-table" aria-label="Table">
                                        <tbody class="bg-white">
                                            @if ($item->question_details)
                                                @foreach ($item->question_details as $detail)
                                                    <tr class="text-gray-700 border-b">
                                                        <td class="px-1 py-5 text-sm w-2/8">
                                                            <div class="flex items-center text-sm">
                                                                <div>
                                                                    <p class="font-medium text-black">
                                                                        {{ $tmp++ }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="px-1 py-5 text-sm w-1/2">
                                                            <div class="flex items-center text-sm">
                                                                <div>
                                                                    <p class="font-medium text-black">
                                                                        {{ $detail->question ?? '' }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        @if ($detail->answer->type === 'selection')
                                                            @foreach ($detail->answer->answer_detail as $answer)
                                                                <td class="px-1 py-5 text-sm w-2/8">
                                                                    <div class="flex items-center text-sm">
                                                                        <label
                                                                            class="group relative flex items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase bg-white text-gray-900 shadow-sm">
                                                                            <span
                                                                                id="size-choice-0-label">{{ $answer->code }}</span>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            @endforeach
                                                        @elseif ($detail->answer->type === 'multi_selection')
                                                            @foreach ($detail->answer->answer_detail as $answer)
                                                                <td class="px-1 py-5 text-sm w-2/8">
                                                                    <div class="flex items-center text-sm">
                                                                        <label
                                                                            class="group relative flex items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase bg-white text-gray-900 shadow-sm">
                                                                            <span
                                                                                id="size-choice-0-label">{{ $answer->name }}</span>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            @endforeach
                                                        @else
                                                            <td colspan="6" class="px-1 py-5 text-sm w-2/8">
                                                                <div class="md:col-span-6 lg:col-span-3">
                                                                    <p hidden>{{ $squence = $cmt++ }}</p>
                                                                    <input placeholder="Input Komentar Singkat"
                                                                        type="text" name="comment{{ $squence }}"
                                                                        id="comment{{ $squence }}"
                                                                        value="{{ old('comment') }}"
                                                                        autocomplete="comment{{ $squence }}"
                                                                        class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                                        disabled>
                                                                </div>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                @endforeach
                            @endforeach
                            <br>
                        </div>
                    </form>
                </main>
            </div>
        </section>
    </main>
@endsection
