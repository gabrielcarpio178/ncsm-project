@include('partials.header', ['title'=> 'Dashboard'])
@include('navbar.adminSidebar')
<x-message></x-message>

<section class="ml-[16rem]">
    <div class="flex flex-col p-20 items-center gap-20">
        <div class="flex flex-row gap-20 w-full">
            <div class="h-[20rem] w-full rounded overflow-hidden shadow-lg flex  bg-gray-50 dark:bg-gray-800">
                <div class="w-1/2 h-[20rem]">
                    <img class="w-full h-[20rem]" src="/images/vgd.png" alt="Sunset in the mountains">
                </div>
                <div class="px-6 py-4 font-black">
                    <h1 class="text-nolitcText text-3xl">
                        VISUAL GRAPHIC DESIGN
                    </h1>
                    <div class="mt-10">
                        <h3 class="text-2xl">
                            Number of Students
                        </h3>
                        <p class="text-5xl font-black mt-10">300</p>
                    </div>
                </div>
            </div>
            <div class="h-[20rem] w-full rounded overflow-hidden shadow-lg flex  bg-gray-50 dark:bg-gray-800">
                <div class="w-1/2 h-[20rem]">
                    <img class="w-full h-[20rem]" src="/images/ccs.png" alt="Sunset in the mountains">
                </div>
                <div class="px-6 py-4 font-black">
                    <h1 class="text-nolitcText text-3xl">
                        CONTACT CENTER SERVICES
                    </h1>
                    <div class="mt-10">
                        <h3 class="text-2xl">
                            Number of Students
                        </h3>
                        <p class="text-5xl font-black mt-10">300</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex flex-row gap-20 w-full">
            <div class="h-[20rem] w-full rounded overflow-hidden shadow-lg flex  bg-gray-50 dark:bg-gray-800">
                <div class="w-1/2 h-[20rem]">
                    <img class="w-full h-[20rem]" src="/images/ani.png" alt="Sunset in the mountains">
                </div>
                <div class="px-6 py-4 font-black text-3xl">
                    <h1 class="text-nolitcText text-3xl">
                        ANIMATION
                    </h1>
                    <div class="mt-10">
                        <h3 class="text-2xl">
                            Number of Students
                        </h3>
                        <p class="text-5xl font-black mt-10">300</p>
                    </div>
                </div>
            </div>
            <div class="h-[20rem] w-full rounded overflow-hidden shadow-lg flex  bg-gray-50 dark:bg-gray-800">
                <div class="w-1/2 h-[20rem]">
                    <img class="w-full h-[20rem]" src="/images/2d-ani.png" alt="Sunset in the mountains">
                </div>
                <div class="px-6 py-4 font-black">
                    <h1 class="text-nolitcText text-3xl">
                        2D ANIMATION
                    </h1>
                    <div class="mt-10">
                        <h3 class="text-2xl">
                            Number of Students
                        </h3>
                        <p class="text-5xl font-black mt-10">300</p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


@include('partials.footer')
