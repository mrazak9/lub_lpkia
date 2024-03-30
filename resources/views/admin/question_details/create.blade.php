@extends('layouts.backend')

@section('title', 'Detail pertanyaan')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Input Detail Pertanyaan
                    </h2>
                    <p class="text-sm text-gray-400">
                        Enter your data Correctly & Properly
                    </p>
                </div>
            </div>
        </div>
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
        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-2 py-2 mt-2 bg-white rounded-xl">
                        <form method="POST" action="{{ route('question_details.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">

                                        <div class="md:col-span-6 lg:col-span-6">
                                            <label for="question" class="block mb-3 font-medium text-gray-700 text-md">Pertanyaan</label>
                                            <input placeholder="Your Detail question" type="text" name="question"
                                                id="question" value="{{ old('question') }}" autocomplete="question"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                required>

                                            @if ($errors->has('question'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('question') }}</p>
                                            @endif
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="sequence"
                                                class="block mb-3 font-medium text-gray-700 text-md">Urutan pertanyaan</label>
                                            <input placeholder="Your sequence Answer" type="number" name="sequence"
                                                id="sequence" value="{{ old('sequence') }}" autocomplete="sequence"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm">
                                            <input name="id_question" id="id_question"
                                                value={{ $questionGroup->question->id }} hidden>
                                            <input name="id_question_group" id="id_question_group"
                                                value={{ $questionGroup->id }} hidden>

                                            @if ($errors->has('sequence'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('sequence') }}</p>
                                            @endif
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="id_answer" class="block mb-3 font-medium text-gray-700 text-md">
                                                Pilhan Jawaban
                                            </label>
                                            <select name="id_answer" type="text"
                                                class="form-control select2 block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm
                                                {{ $errors->has('id_answer') ? 'is-invalid' : '' }}"
                                                value={{ old('id_answer') }} required>
                                                @if ($errors->has('id_answer'))
                                                    <p class="text-danger">{{ $errors->first('id_answer') }}</p>
                                                @endif
                                                <option value="">Pilih Jawaban</option>
                                                @foreach ($answers as $answer)
                                                    <option value="{{ $answer->id }}"
                                                        {{ old('id_answer') == $answer->id ? 'selected' : '' }}>
                                                        {{ $answer->name }} - {{ $answer->type }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-4 py-3 text-right sm:px-6">
                                    <a href={{ route('questions.show', $questionGroup->question->id) }} type="button"
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
