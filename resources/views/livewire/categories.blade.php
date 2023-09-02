<div>
    <div class="categorie">
        <div class="w-2/4 mx-auto grid gap-7 ">
            {{-- <a wire:navigate class="border-2 border-slate-300 p-3  rounded " href="{{route('welcome')}}">Back <span class="fa fa-circle-left text-red-300"></span></a> --}}
            <div class="grid grid-cols-4 gap-4">
                @foreach ($categories as $categorie)
                <a href="{{route('food',['id' => $categorie->id])}}" class="categorie flex flex-col items-center bg-slate-300 rounded p-2 hover:bg-slate-200 cursor-pointer group">
                    <img class="rounded" src='http://fakeimg.pl/200x200?font=lobster' alt='' />
                    <span class="font-bold text-sm group-hover:text-slate-700 ">{{$categorie->name}}</span>
                </a>
                @endforeach
            </div>

        </div>
    </div>
</div>