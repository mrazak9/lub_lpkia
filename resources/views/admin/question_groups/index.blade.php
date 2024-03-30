@extends('layouts.backend')

@section('title', ' Jadwal')

@section('content')
    <main class="h-full overflow-y-auto">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        List Pertanyaan
                    </h2>
                    <br>
                    <a href="{{ route('question_groups.create') }}"
                        class="inline-flex justify-center px-4 py-2 text-left text-white rounded-xl bg-serv-email">
                        Add Pertanyaan
                    </a>
                </div>
            </div>
        </div>

        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <div class="px-6 py-2 mt-2 bg-white rounded-xl">

                        <p hidden>{{ $tmp = 1 }}</p>
                        <table id="questionstable" class="w-full data-table" aria-label="Table">
                            <thead>
                                <tr class="text-sm font-normal text-left text-gray-900 border-b border-b-gray-600">
                                    <th class="py-4">No</th>
                                    <th class="py-4">Nama Group</th>
                                    <th class="py-4">Judul LUB</th>
                                    <th class="py-4">Notes</th>
                                    <th class="py-4">Action</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">

                                @forelse ($questionGroups as $questionGroup)
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
                                                    <p class="font-medium text-black">{{ $questionGroup->name ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-medium text-black">
                                                        {{ $questionGroup->total ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-medium text-black">Mulai: {{ $questionGroup->start_date ?? '' }}
                                                    </p>
                                                    <p class="font-medium text-black">Sampai: {{ $questionGroup->end_date ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-medium text-black">
                                                        {{ $questionGroup->is_active ? 'Yes' : 'No' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <div class="flex items-center text-sm">
                                                <div>
                                                    <p class="font-medium text-black">
                                                        {{ $questionGroup->notes ?? '' }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm w-2/8">
                                            <a href="{{ route('question_groups.edit', $questionGroup->id) }}"
                                                class="px-4 py-2 mt-2 text-left text-white rounded-xl bg-serv-email"
                                                style="margin-right: 10px;">
                                                Edit
                                            </a>
                                            <form action="{{ route('question_groups.destroy', $questionGroup->id) }}" method="POST"
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
                        <br>
                    </div>
                </main>
            </div>
        </section>
    </main>
@endsection
