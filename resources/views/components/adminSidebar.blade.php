{{-- adminSideColor --}}
<section class="fixed mt-40 bg-[#2c7b1f] w-64 h-full py-20 px-1">
    <ul class="flex flex-col gap-y-8">
        {{-- headerColor #fff--}}
        <li class="px-10 text-md text-headerColor text-lg hover:bg-slate-600 py-1 rounded"><a href="{{route('admin')}}">Dashboard</a></li>
        <li class="px-10 text-md text-headerColor text-lg hover:bg-slate-600 py-1 rounded"><a href="{{route('register_admin')}}">Registered Student</a></li>
        <li class="px-10 text-md text-headerColor text-lg hover:bg-slate-600 py-1 rounded"><a href="#">Update Welcome</a></li>
        <li class="px-10 text-md text-headerColor text-lg hover:bg-slate-600 py-1 rounded"><a href="#">Program Managemant</a></li>
        <li class="px-10 text-md text-headerColor text-lg hover:bg-slate-600 py-1 rounded"><a href="#">Manage NOLITC Update</a></li>
        <li class="px-10 text-md text-headerColor text-lg hover:bg-slate-600 py-1 rounded"><a href="#">Update Score Cards</a></li>
        <li class="px-10 text-md text-headerColor text-lg hover:bg-slate-600 py-1 rounded"><a href="#">Manage Partners</a></li>
        <li class="px-10 text-md text-headerColor text-lg hover:bg-slate-600 py-1 rounded"><a href="{{route('settings')}}">Account Settings</a></li>
        <li class="px-10 text-md text-headerColor text-lg hover:bg-slate-600 py-1 rounded">
            <form action="{{route('signoutAction')}}" method="POST">
                @method("POST")
                @csrf
                <button type="submit">
                    Log out
                </button>
            </form>
        </li>
    </ul>
</section>
