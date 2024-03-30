@extends('layouts.backend')

@section('title', ' Pertanyaan')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Edit Pertanyaan
                    </h2>
                    <p class="text-sm text-gray-400">
                        Enter your data Correctly & Properly
                    </p>
                </div>
            </div>
        </div>

        <section class="container px-6 mx-auto mt-5">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-2 py-2 mt-2 bg-white rounded-xl">
                        <form method="POST" action="{{ route('questions.update', $question->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div>
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="name"
                                                class="block mb-3 font-medium text-gray-700 text-md">Nama</label>

                                            <input placeholder="Input Nama Matakuliah" type="text" name="name"
                                                id="name" value="{{ $question->name ?? '' }}" autocomplete="name"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                required>

                                            @if ($errors->has('name'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('name') }}
                                                </p>
                                            @endif
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="classroom"
                                                class="block mb-3 font-medium text-gray-700 text-md">Pilih Tanggal Mulai dan
                                                Tanggal Berakhir</label>
                                            <input placeholder="Input Tanggal Mulai" type="text" name="start_date"
                                                id="start_date" value="{{ $question->start_date ?? '' }}"
                                                autocomplete="start_date"
                                                class="form-control block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                required readonly>
                                            @if ($errors->has('start_date'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('start_date') }}</p>
                                            @endif
                                            <input placeholder="Input Tanggal Akhir" type="text" name="end_date"
                                                id="end_date" value="{{ $question->end_date ?? '' }}"
                                                autocomplete="end_date"
                                                class="form-control block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                required readonly>
                                            @if ($errors->has('end_date'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('end_date') }}</p>
                                            @endif
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="total" class="block mb-3 font-medium text-gray-700 text-md">Total
                                                Pertanyaan</label>
                                            <input placeholder="Total Pertanyaan" type="text" name="total"
                                                id="total" value="{{ $question->total ?? '' }}" autocomplete="total"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                required>
                                            @if ($errors->has('total'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('total') }}</p>
                                            @endif
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="notes" class="block mb-3 font-medium text-gray-700 text-md">Keterangan</label>

                                            <input placeholder="Input Keterangan Tambahan" type="text" name="notes"
                                                id="notes" value="{{ $question->notes ?? '' }}" autocomplete="notes"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                >

                                            @if ($errors->has('notes'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('notes') }}
                                                </p>
                                            @endif
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-2">
                                            <input type="checkbox" name="is_active" id="is_active" value="1"
                                                class="form-checkbox border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                {{ $question->is_active ? 'checked' : '' }}>
                                            <label for="is_active"
                                                class="mb-3 font-medium text-gray-700 text-md">Active</label>
                                            @if ($errors->has('id_schedule '))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('id_schedule ') }}
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="px-4 py-3 text-right sm:px-6">
                                    <a href={{ route('questions.index') }} type="button"
                                        class="inline-flex justify-center px-4 py-2 mr-4 text-sm font-medium text-gray-700 bg-white border border-gray-600 rounded-lg shadow-sm hover:bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-300"
                                        onclick="return confirm('Are you sure want to cancel?, Any changes you make will not be saved.')">
                                        Cancel
                                    </a>

                                    <button type="submit"
                                        class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-lg shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                        onclick="return confirm('Are you sure want to submit this data ?')">
                                        Save Changes
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </main>
            </div>
        </section>
    </main>
@endsection
