@extends('layouts.backend')

@section('title', ' Jadwal')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Edit Jadwal
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
                        <form method="POST" action="{{ route('schedules.update', $schedule->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div>
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="courses_name"
                                                class="block mb-3 font-medium text-gray-700 text-md">Nama</label>

                                            <input placeholder="Input Nama Matakuliah" type="text" name="courses_name"
                                                id="courses_name" value="{{ $schedule->courses_name ?? '' }}"
                                                autocomplete="courses_name"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                required>

                                            @if ($errors->has('courses_name'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('courses_name') }}
                                                </p>
                                            @endif
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="id_lecturer"
                                                class="block mb-3 font-medium text-gray-700 text-md">Nama</label>

                                            <select id="id_lecturer"
                                                class="form-control select2 block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                name="id_lecturer" required>
                                                <option value="">Select Lecturer</option>
                                                @foreach ($lecturers as $lecturer)
                                                    <option value="{{ $lecturer->id }}"
                                                        {{ $lecturer->id == old('id_lecturer', $schedule->id_lecturer) ? 'selected' : '' }}>
                                                        {{ $lecturer->user->name }}</option>
                                                @endforeach
                                            </select>

                                            @if ($errors->has('courses_name'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('courses_name') }}
                                                </p>
                                            @endif
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="periode" class="block mb-3 font-medium text-gray-700 text-md">
                                                Periode
                                            </label>
                                            <select id="periode"
                                                class="form-control select2 block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                name="periode" required>
                                                <option value="{{ $schedule->periode }}">Select Periode</option>
                                                @foreach ($periods as $period)
                                                    @php
                                                        $selected = $schedule->periode == $period ? 'selected' : '';
                                                    @endphp
                                                    <option value="{{ $period }}" {{ $selected }}>
                                                        {{ $period }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="classroom"
                                                class="block mb-3 font-medium text-gray-700 text-md">Kelas</label>
                                            <input placeholder="Your Min Value" type="text" name="classroom"
                                                id="classroom" value="{{ $schedule->classroom ?? '' }}"
                                                autocomplete="classroom"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                required>
                                            @if ($errors->has('classroom'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('classroom') }}</p>
                                            @endif
                                        </div>

                                    </div>
                                </div>

                                <div class="px-4 py-3 text-right sm:px-6">
                                    <a href={{ route('schedules.index') }} type="button"
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
