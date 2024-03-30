@extends('layouts.backend')

@section('title', ' Student')

@section('content')
    <main class="h-full overflow-y-auto sm:p-4">
        <div class="container mx-auto">
            <div class="grid w-full gap-5 px-10 mx-auto md:grid-cols-12">
                <div class="col-span-8">
                    <h2 class="mt-8 mb-1 text-2xl font-semibold text-gray-700">
                        Nama Matakuliah
                    </h2>
                </div>
            </div>
        </div>

        <section class="container px-6 mx-auto mt-5 sm:px-4">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 md:col-span-12 lg:col-span-10 mx-auto">
                    <div class="px-6 py-2 mt-2 bg-white rounded-xl">
                        <div class="px-6 py-2">
                            <p class="mt-8 mb-4 text-xl font-semibold text-gray-700">
                                Pengisian LUB untuk Matakuliah:
                            </p>
                            <table class="w-full data-table mb-8" aria-label="Table">
                                <thead>
                                    <tr class="text-sm font-normal text-left text-gray-900 border-b border-b-gray-600">
                                        <th class="py-4">Matakuliah</th>
                                        <th class="py-4">Dosen</th>
                                        <th class="py-4">Kelas</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white">
                                    <tr class="text-gray-700">
                                        <td class="px-1 py-5 text-sm">
                                            <div class="flex items-center">
                                                <p class="font-medium">{{ ucwords($schedule->courses_name) }}</p>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm">
                                            <div class="flex items-center">
                                                <p class="font-medium">{{ $schedule->lecturer->user->name }}</p>
                                            </div>
                                        </td>
                                        <td class="px-1 py-5 text-sm">
                                            <div class="flex items-center">
                                                <p class="font-medium">{{ $schedule->classroom }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <p class="mt-4 mb-4 text-sm font-semibold text-gray-700">
                                {{ $question->notes }}, Saya menilai:
                            </p>
                            <table class="w-full data-table" aria-label="Table">
                                <tbody class="bg-white">
                                    <tr class="text-gray-700">
                                        @foreach ($answerDetails as $detail)
                                            <td class="px-1 py-5 text-sm">
                                                <div class="flex items-center">
                                                    <p class="font-medium">{{ $detail->code }} : {{ $detail->name }}</p>
                                                </div>
                                            </td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </main>
            </div>
        </section>


        <section class="container px-6 mx-auto mt-5">
            <div class="grid gap-5 md:grid-cols-12">
                <main class="col-span-12 p-4 md:pt-0">
                    <form method="POST" action="{{ route('responses.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="px-6 py-2 mt-2 bg-white rounded-xl">
                            <input type="text" value="{{ $student_id }}" id="id_student" name="id_student" hidden>
                            <input type="text" value="{{ $schedule->id }}" id="id_schedule" name="id_schedule" hidden>
                            <input type="text" value="{{ $question->id }}" id="id_question" name="id_question" hidden>
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
                                                                            class="group relative flex items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 cursor-pointer bg-white text-gray-900 shadow-sm">
                                                                            <input type="radio"
                                                                                name="question{{ $detail->sequence }}"
                                                                                value="{{ $answer->value }}"
                                                                                class="sr-only"
                                                                                aria-labelledby="size-choice-0-label">
                                                                            <span
                                                                                id="size-choice-0-label">{{ $answer->code }}</span>
                                                                            <span
                                                                                class="pointer-events-none absolute -inset-px rounded-md"
                                                                                aria-hidden="true"></span>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            @endforeach
                                                        @elseif ($detail->answer->type === 'multi_selection')
                                                            @foreach ($detail->answer->answer_detail as $answer)
                                                                <td class="px-1 py-5 text-sm w-2/8">
                                                                    <div class="flex items-center text-sm">
                                                                        <label
                                                                            class="flex items-center justify-center rounded-md border py-3 px-3 text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 cursor-pointer bg-white text-gray-900 shadow-sm">
                                                                            <input type="checkbox"
                                                                                name="question{{ $detail->sequence }}"
                                                                                value="{{ $answer->value }}"
                                                                                class="sr-only"
                                                                                aria-labelledby="size-choice-0-label">
                                                                            <span>{{ $answer->code }}</span>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            @endforeach
                                                        @else
                                                            <td colspan="6" class="px-1 py-5 text-sm w-2/8">
                                                                <div class="md:col-span-6 lg:col-span-3">
                                                                    <p hidden>{{ $squence = $cmt++ }}</p>
                                                                    <input placeholder="Berikan uraian ringkas dan padat"
                                                                        type="text" name="comment{{ $squence }}"
                                                                        id="comment{{ $squence }}"
                                                                        value="{{ old('comment') }}"
                                                                        autocomplete="comment{{ $squence }}"
                                                                        class="block w-full py-3 mt-1 border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500 sm:text-sm"
                                                                        required>
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
                </main>
            </div>
        </section>
    </main>
@endsection
