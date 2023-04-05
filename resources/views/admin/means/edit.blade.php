@extends('layouts.backend')

@section('title', ' Mean')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Edit Mean
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
                        <form method="POST" action="{{ route('means.update', $mean->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div>
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="min_value" class="block mb-3 font-medium text-gray-700 text-md">Min
                                                Value</label>

                                            <input placeholder="Your Min Value" type="text" name="min_value"
                                                id="min_value" value="{{ $mean->min_value ?? '' }}" autocomplete="min_value"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                required>

                                            @if ($errors->has('min_value'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('min_value') }}</p>
                                            @endif
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="max_value" class="block mb-3 font-medium text-gray-700 text-md">Max
                                                Value</label>
                                            <input placeholder="Your Min Value" type="text" name="max_value"
                                                id="max_value" value="{{ $mean->max_value ?? '' }}" autocomplete="max_value"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                required>

                                            @if ($errors->has('max_value'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('max_value') }}</p>
                                            @endif
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="statement" class="block mb-3 font-medium text-gray-700 text-md">
                                                Statement
                                            </label>
                                            <select name="statement" type="text"
                                                class="form-control select2 block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm
                                                {{ $errors->has('statement') ? 'is-invalid' : '' }}"
                                                value="{{ $mean->statement ?? '' }}" required>
                                                @if ($errors->has('statement'))
                                                    <p class="text-danger">{{ $errors->first('statement') }}</p>
                                                @endif
                                                <option value=''> -- Pilih Statement -- </option>
                                                <option value='Sangat Memuaskan'
                                                    {{ $mean->statement == 'Sangat Memuaskan' ? 'selected' : '' }}> Sangat
                                                    Memuaskan</option>
                                                <option value='Memuaskan'
                                                    {{ $mean->statement == 'Memuaskan' ? 'selected' : '' }}> Memuaskan
                                                </option>
                                                <option value='Cukup' {{ $mean->statement == 'Cukup' ? 'selected' : '' }}>
                                                    Cukup</option>
                                                <option value='Sedang'
                                                    {{ $mean->statement == 'Sedang' ? 'selected' : '' }}> Sedang</option>
                                                <option value='Kurang Memuaskan'
                                                    {{ $mean->statement == 'Kurang Memuaskan' ? 'selected' : '' }}>
                                                    Kurang Memuaskan</option>
                                                <option value='Tidak Memuaskan'
                                                    {{ $mean->statement == 'Tidak Memuaskan' ? 'selected' : '' }}> Tidak
                                                    Memuaskan</option>
                                            </select>

                                        </div>
                                    </div>
                                </div>

                                <div class="px-4 py-3 text-right sm:px-6">
                                    <a href={{ route('means.index') }} type="button"
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
