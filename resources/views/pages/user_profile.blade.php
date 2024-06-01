@include('partials.header', ['title'=> $student->fname])
<x-adminHeader></x-adminHeader>
<x-adminSidebar></x-adminSidebar>
<main class="w-[86.6%] absolute top-40 left-64 p-10 flex flex-col gap-y-8">
    <div class="bg-white overflow-hidden shadow rounded-lg border mt-1 z-10">
        <div class="px-4 py-5 sm:px-6">
            <h3 class="leading-6 font-medium text-gray-900 text-2xl">
                Applicant Profiles
            </h3>
            <p class="mt-1 max-w-2xl text-sm text-gray-500">
                This is some information about the applicant.
            </p>
        </div>
        <div class="grid-col-3">
            <div class="px-4 py-10 leading-6 text-gray-900 font-black">
                <h3 class="text-2xl">Applicant</h3>
                
            </div>
        </div>
    </div>
</main>
@include('partials.footer')
