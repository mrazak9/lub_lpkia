@extends('layouts.backend')

@section('title', ' Student')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-12">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Edit Student
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
                        <form method="POST" action="{{ route('students.update', $student->id) }}"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div>
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="grid grid-cols-6 gap-6">

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="name" class="block mb-3 font-medium text-gray-700 text-md">Nama</label>

                                            <input placeholder="Your Min Value" type="text" name="name" id="name"
                                                value="{{ $student->user->name ?? '' }}" autocomplete="name"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                required>

                                            @if ($errors->has('name'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('name') }}</p>
                                            @endif
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="code"
                                                class="block mb-3 font-medium text-gray-700 text-md">NIM</label>
                                            <input placeholder="Your Min Value" type="text" name="code" id="code"
                                                value="{{ $student->code ?? '' }}" autocomplete="code"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                required>

                                            @if ($errors->has('code'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('code') }}</p>
                                            @endif
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="email"
                                                class="block mb-3 font-medium text-gray-700 text-md">Email</label>
                                            <input placeholder="Your Min Value" type="text" name="email" id="email"
                                                value="{{ $student->user->email ?? '' }}" autocomplete="email"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                required>

                                            @if ($errors->has('email'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('email') }}</p>
                                            @endif
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="classroom"
                                                class="block mb-3 font-medium text-gray-700 text-md">Kelas</label>
                                            <input placeholder="Your Min Value" type="text" name="classroom"
                                                id="classroom" value="{{ $student->classroom ?? '' }}"
                                                autocomplete="classroom"
                                                class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                required>
                                            @if ($errors->has('classroom'))
                                                <p class="text-red-500 mb-3 text-sm">{{ $errors->first('classroom') }}</p>
                                            @endif
                                        </div>

                                        <div class="md:col-span-6 lg:col-span-3">
                                            <label for="prodi" class="block mb-3 font-medium text-gray-700 text-md">
                                                prodi
                                            </label>
                                            <select name="prodi" type="text"
                                                class="form-control select2 block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm
                                                {{ $errors->has('prodi') ? 'is-invalid' : '' }}"
                                                value="{{ $student->prodi ?? '' }}" required>
                                                @if ($errors->has('prodi'))
                                                    <p class="text-danger">{{ $errors->first('prodi') }}</p>
                                                @endif
                                                <option value=''> -- Pilih Prodi -- </option>
                                                <option value='S1 Teknik Informatika'
                                                    {{ $student->prodi == 'S1 Teknik Informatika' ? 'selected' : '' }}>
                                                    S1 Teknik Informatika</option>
                                                <option value='S1 Sistem Informasi'
                                                    {{ $student->prodi == 'S1 Sistem Informasi' ? 'selected' : '' }}> S1
                                                    Sistem Informasi
                                                </option>
                                                <option value='S1 Akuntansi'
                                                    {{ $student->prodi == 'S1 Akuntansi' ? 'selected' : '' }}> S1 Akuntansi
                                                </option>
                                                <option value='S1 Administrasi Binis'
                                                    {{ $student->prodi == 'S1 Administrasi Binis' ? 'selected' : '' }}> S1
                                                    Administrasi Binis
                                                </option>
                                                <option value='D3 Komputerisasi Akuntansi'
                                                    {{ $student->prodi == 'D3 Komputerisasi Akuntansi' ? 'selected' : '' }}>
                                                    D3 Komputerisasi Akuntansi</option>
                                                <option value='D3 Administrasi Bisnis'
                                                    {{ $student->prodi == 'D3 Administrasi Bisnis' ? 'selected' : '' }}> D3
                                                    Administrasi Bisnis</option>
                                                <option value='D3 Manajemen Informatika'
                                                    {{ $student->prodi == 'D3 Manajemen Informatika' ? 'selected' : '' }}>
                                                    D3 Manajemen Informatika</option>
                                                <option value='D1 Modul Digitalisasi Adm Perkantoran'
                                                    {{ $student->prodi == 'D1 Modul Digitalisasi Adm Perkantoran' ? 'selected' : '' }}>
                                                    D1 Modul Digitalisasi Adm Perkantoran</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="px-4 py-3 text-right sm:px-6">
                                    <a href={{ route('students.index') }} type="button"
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
