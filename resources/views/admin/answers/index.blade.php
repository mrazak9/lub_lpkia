@extends('layouts.backend')

@section('title', ' Answer')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Daftar Master Jawaban
                    </h2>
                    <br>
                    <a href="{{ route('answers.create') }}"
                        class="inline-flex justify-center px-4 py-2 text-left text-white rounded-xl bg-serv-email">
                        Add Jawaban
                    </a>
                </div>
            </div>
        </div>

        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-6 py-2 mt-2 bg-white rounded-xl">
                        <p hidden>{{ $tmp = 1 }}</p>

                        <table class="w-full" aria-label="Table">
                            <thead>
                                <tr class="text-sm font-normal text-left text-gray-900 border-b border-b-gray-600">
                                    <th class="py-4">No</th>
                                    <th class="py-4">Name</th>
                                    <th class="py-4">Type</th>
                                    <th class="py-4">Notes</th>
                                    <th class="py-4">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">

                                @forelse ($answers as $answer)
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
                                                    <p class="font-medium text-black">{{ $answer->name ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-medium text-black">
                                                        {{ $answer->type == 'text' ? 'Text' : 'Multiple Choice' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-medium text-black">{{ $answer->notes ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">


                                            @if ($answer->type != 'text')
                                                <a href="{{ route('answers.show', $answer->id) }}"
                                                    class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-email"
                                                    style="margin-right: 10px;">
                                                    add Detail Jawaban
                                                </a>
                                            @else
                                                <a href="{{ route('answers.show', $answer->id) }}"
                                                    class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-email"
                                                    style="margin-right: 10px;">
                                                    View
                                                </a>
                                            @endif

                                            <form action="{{ route('answers.destroy', $answer->id) }}" method="POST"
                                                style="display:inline-block;">
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
        </section>
    </main>
@endsection
