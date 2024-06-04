@include('partials.header', ['title'=> 'Register Student'])
<x-adminHeader></x-adminHeader>
<x-adminSidebar></x-adminSidebar>
<main class="w-[86.6%] absolute top-40 left-64 p-10">
    <div class="text-2xl font-black text-[#168753]">
        Registered Student
    </div>

    <form action="{{route('search.registers')}}" method="POST" class="mt-2">
        @csrf
        <section class="w-full flex flex-row gap-x-2">
            {{-- nolitcText --}}
            <input type="text" class="border border-solid border-black-600 w-56 h-11 rounded-md focus:outline-none px-2" name="search">
            <button class="w-20 bg-[#168753] rounded-md text-white hover:bg-green-900" type="submit">Search</button>
        </section>
    </form>
    <section class="w-full mt-5 overflow-x-auto">
        @if ($students->count()!==0)
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <th scope="col" class="px-6 py-3 uppercase">id</th>
                    <th scope="col" class="px-6 py-3 capitalize">Name</th>
                    <th scope="col" class="px-6 py-3 capitalize">Course</th>
                    <th scope="col" class="px-6 py-3 capitalize">Contact Number</th>
                    <th scope="col" class="px-6 py-3 capitalize">Email</th>
                </thead>
                <tbody>
                    @php
                        $x=1;
                    @endphp
                    @foreach ($students as $student)
                        <tr class="bg-white border-b transition duration-300 ease-in-out hover:bg-gray-100 cursor-pointer" onclick="clickRow('{{route('student_profile', $student->id) }}')">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{$x++}}
                            </th>
                            <td class="px-6 py-4 capitalize">
                                {{$student->fname." ".$student->lname}}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                {{$student->course}}
                            </td>
                            <td class="px-6 py-4 capitalize">
                                0{{$student->contact_number}}
                            </td>
                            <td class="px-6 py-4 uppercase">
                                {{$student->email}}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        @else
            <h2>No record</h2>
        @endif
        <div class="w-full mt-10">
                {{ $students->links('vendor.pagination.tailwind') }}
        </div>

    </section>
</main>
<script>
    function clickRow(url){
        window.location.href=url;
    }
</script>
@include('partials.footer')
