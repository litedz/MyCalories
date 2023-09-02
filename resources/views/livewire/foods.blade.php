<div>
    <div class="flex flex-col p-4" x-data="{showFormEdit:false}">
        <div class="w-full h-full fixed top-0 left-0 edit-form" x-show="showFormEdit" x-transition>
            <div class="overlay w-full h-full absolute bg-slate-600 opacity-50 z-10"></div>
            <div class="w-2/5 mx-auto relative z-20 top-1/4">
                <form action="" class="bg-white p-4 rounded grid gap-5">
                    <div>
                        <label for="name"></label>
                        <h1 class="text-lg  text-center font-semibold border-b-2 pb-2" x-text="$wire.editName"></h1>
                    </div>

                    <x-form.input labelName='quantity' placeHolder="150 . . ." wire:model.live='editQuantity' />

                    @error('editQuantity') <span class="error text-red-500 list-item p-2  mx-4">{{ $message }}</span>
                    @enderror

                    <div class="showCalorie grid">
                        <span class="font-bold">{{$editKcal}} kcal</span>
                        <div wire:loading wire:target="editQuantity">
                            Calculing ...
                        </div>
                    </div>
                    <div>
                        <x-form.btn-primary class="mt-4 capitalize !text-white" wire:click='EditAndAddToList'>Add to List
                        </x-form.btn-primary>
                        <x-form.btn-primary class="mt-4 capitalize !bg-red-400 !text-white !font-bold"
                            @click="showFormEdit = false">Cancel </x-form.btn-primary>
                    </div>
                </form>
            </div>
        </div>
        <div class="text-4xl text-center m-4">{{$foods->first()->cat->name}}</div>
        <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="min-w-full text-left text-sm font-light p-4  border-2 rounded-lg ">
                        <thead class="border-b bg-white font-medium capitalize">
                            <tr>
                                <th scope="col" class="px-6 py-4 ">#</th>
                                <th scope="col" class="px-6 py-4 ">Name</th>
                                <th scope="col" class="px-6 py-4 ">Code</th>
                                <th scope="col" class="px-6 py-4 ">protein</th>
                                <th scope="col" class="px-6 py-4 ">carbohydrate</th>
                                <th scope="col" class="px-6 py-4 ">quantity</th>
                                <th scope="col" class="px-6 py-4 ">unit</th>
                                <th scope="col" class="px-6 py-4 ">kcal</th>
                                <th scope="col" class="px-6 py-4 ">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($foods as $item)


                            <tr class="border-b bg-neutral-100 ">
                                <td class="whitespace-nowrap px-6 py-4 font-medium">{{$loop->index+1}}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{$item->name}}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{$item->code}}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{$item->protien}}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{$item->carbohydrate}}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{$item->quantity}}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{$item->unit}}</td>
                                <td class="whitespace-nowrap px-6 py-4">{{$item->kcal}}</td>
                                <td class="whitespace-nowrap px-6 py-4">
                                    <div>
                                        <button type="button" wire:click="AddFoodToList({{$item->id}})"
                                            class="text-white focus:border-[1px] bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"><span
                                                class="fa fa-plus"></span></button>
                                        {{-- <button type="button" wire:click=""
                                            class="text-white focus:border-[1px] bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2"><span
                                                class="fa fa-trash"></span></button> --}}
                                        <button type="button"
                                            @click="showFormEdit = true;$wire.set('editName','{{$item->name}}');$wire.set('editFood_id','{{$item->id}}')"
                                            class="text-white focus:border-[1px] bg-gradient-to-r from-gray-500 via-gray-600 to-gray-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                            <span class="fa fa-edit"></span>

                                        </button>

                                    </div>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>