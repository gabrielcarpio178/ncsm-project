@include('partials.header', ['title'=> 'Manage Partners'])
<x-adminHeader></x-adminHeader>
<x-adminSidebar :user='auth()->user()->usertype'></x-adminSidebar>
<x-message></x-message>
<style>
    td{
        text-align: center;
        padding: 1% 0;
    }
</style>
<main class="w-[86.6%] absolute top-[14%] left-64 p-10">
    <h1 class="text-[#168753] text-5xl font-bold">Manage Partners</h1>
    <section class="flex flex-row w-[100%] h-[72vh] py-10">
        <div class="w-[100%] h-[70vh]">
            <table id="partners" class="w-[100%]">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <th scope="col" class="px-6 py-3 uppercase">#</th>
                    <th scope="col" class="px-6 py-3 capitalize">Logo</th>
                    <th scope="col" class="px-6 py-3 capitalize">Link</th>
                    <th scope="col" class="px-6 py-3 capitalize">Date Created</th>
                    <th scope="col" class="px-6 py-3 capitalize" colspan="2">Action</th>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><button class="w-[80%] bg-[#168753] rounded-md text-white hover:bg-green-900 px-3 py-2">Delete</button></td>
                        <td><button class="w-[80%] bg-red-500 rounded-md text-white hover:bg-red-900 px-3 py-2">Update</button></td>
                    </tr>
                </tbody>
            </table>
            <div class="w-full mt-10">
                {{-- {{ $students->links('vendor.pagination.tailwind') }} --}}
            </div>
            <div  class="w-[100%] flex flex-col items-center ">
                <form action="" method="post" class="w-[50%] flex flex-col items-center rounded-md shadow-md py-5 bg-slate-100">
                    <div class="w-[50%] h-[25vh] border border-slate-800 flex flex-row items-center justify-center ">
                        <h3 class="font-bold">Attach Image</h3>
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>
@include('partials.footer')
