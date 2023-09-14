<div>
    <div class="list" x-data="{showFormEdit:false}">
        <div class="w-full h-full fixed top-0 left-0 edit-form z-30" x-show="showFormEdit" x-transition x-cloak>
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
                        <x-form.btn-primary class="mt-4 capitalize !text-white" wire:click='EditAndUpdateList'>Update
                        </x-form.btn-primary>
                        <x-form.btn-primary class="mt-4 capitalize !bg-red-400 !text-white !font-bold"
                            @click="showFormEdit = false">Cancel </x-form.btn-primary>
                    </div>
                </form>
            </div>
        </div>
        <div class="w-4/5 mx-auto sm:w-full sm:p-2">
            <div class="flex flex-col items gap-5 p-4 sm:p-2">
                @foreach ($lists as $list)
                <div class="date mb-4 border-b-2 font-semibold py-4 text-center bg-gradient-to-t from-emerald-400 to-emerald-600/80 text-gray-800 text-base tracking-wide w-full rounded-full">
                    {{-- <span class="bg-emerald-600 p-2  rounded text-white w-full"> --}}
                        @php
                        echo date_create($list->first()->created_at)->format('Y-m-d')."
                        (".date_create($list->first()->created_at)->format('l').')';
                        @endphp
                    {{-- </span> --}}
                </div>

                <div class="grid item">
                    <div class="item">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead class="text-xs text-gray-700 uppercase dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                            Food name
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            quantity
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                            Unit
                                        </th>
                                        <th scope="col" class="px-6 py-3 bg-gray-50 dark:bg-gray-800">
                                            kcal
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Actions
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-center">
                                            Total Kcal
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($list as $item)

                                    {{-- To avoid Null value --}}
                                    @if (!$loop->last)
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap bg-gray-50 dark:text-white dark:bg-gray-800">
                                            {{$item->food->name}}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{$item->food->quantity}}
                                        </td>
                                        <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                            {{$item->food->unit}}
                                        </td>
                                        <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                            {{$item->kcal}}
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <button type="button"
                                            wire:key='{{rand()}}'
                                                wire:click='DeleteFood({{ $item->food_id}} ,{{$item->id }})'
                                                class="text-white focus:border-[1px] bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                                <span class="fa fa-trash"></span>

                                            </button>
                                            <button type="button"
                                            wire:key='{{rand()}}'
                                                @click="showFormEdit = true;$wire.set('editFood_id','{{ $item->food_id}}');$wire.set('editName',' {{$item->food->name}}');$wire.set('list_id','{{$item->id}}')"
                                                class="text-white focus:border-[1px] bg-gradient-to-r from-gray-500 via-gray-600 to-gray-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                                <span class="fa fa-edit"></span>

                                            </button>
                                        </td>
                                        @if ($loop->index == 0)
                                        <th class="text-center bg-slate-200" colspan="2" rowspan="{{$list->count()}}">
                                            {{$list['TotalKcal']}} kcal</th>
                                        @endif

                                    </tr>
                                    @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>


                @endforeach
            </div>

        </div>
    </div>
</div>