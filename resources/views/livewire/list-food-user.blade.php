<div>
    <div class="list" x-data="{ showFormEdit: false }">
        <div class="w-full h-full fixed top-0 left-0 edit-form z-30" x-show="showFormEdit" x-transition x-cloak>
            <div class="overlay w-full h-full absolute bg-slate-600 opacity-50 z-10"></div>
            <div class="w-2/5 mx-auto relative z-20 top-1/4">
                <form action="" class="bg-white p-4 rounded grid gap-5">
                    <div>
                        <label for="name"></label>
                        <h1 class="text-lg  text-center font-semibold border-b-2 pb-2" x-text="$wire.editName"></h1>
                    </div>

                    <x-form.input labelName='quantity' placeHolder="150 . . ." wire:model.live='editQuantity' />

                    @error('editQuantity')
                        <span class="error text-red-500 list-item p-2  mx-4">{{ $message }}</span>
                    @enderror

                    <div class="showCalorie grid">
                        <span class="font-bold">{{ $editKcal }} kcal</span>
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
                    <div
                        class="date mb-4 border-b-2 font-semibold py-4 text-center bg-gradient-to-t from-emerald-400 to-emerald-600/80 text-gray-800 text-base tracking-wide w-full rounded-full">
                        {{-- <span class="bg-emerald-600 p-2  rounded text-white w-full"> --}}
                        @php
                            echo date_create($list->first()->created_at)->format('Y-m-d') . '(' . date_create($list->first()->created_at)->format('l') . ')';
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
                                                        {{ $item->food->name }}
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        {{ $item->food->quantity }}
                                                    </td>
                                                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                                        {{ $item->food->unit }}
                                                    </td>
                                                    <td class="px-6 py-4 bg-gray-50 dark:bg-gray-800">
                                                        {{ $item->kcal }}
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <button type="button" wire:key='{{ rand() }}'
                                                            wire:click='DeleteFood({{ $item->food_id }} ,{{ $item->id }})'
                                                            class="text-white focus:border-[1px] bg-gradient-to-r from-red-500 via-red-600 to-red-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                                            <span class="fa fa-trash"></span>

                                                        </button>
                                                        <button type="button" wire:key='{{ rand() }}'
                                                            @click="showFormEdit = true;$wire.set('editFood_id','{{ $item->food_id }}');$wire.set('editName',' {{ $item->food->name }}');$wire.set('list_id','{{ $item->id }}')"
                                                            class="text-white focus:border-[1px] bg-gradient-to-r from-gray-500 via-gray-600 to-gray-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:gray-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                                                            <span class="fa fa-edit"></span>

                                                        </button>
                                                    </td>
                                                    @if ($loop->index == 0)
                                                        <th class="text-center bg-slate-200" colspan="2"
                                                            rowspan="{{ $list->count() }}">
                                                            {{ $list['TotalKcal'] }} kcal</th>
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

                <div class=" flex flex-col items-center justify-center align-middle" wire:key='{{ rand() }}'
                    wire:click="$set('loadeMoreNum', {{ $loadeMoreNum + 5 }})" x-show="$wire.loadmore">
                    <div class="flex justify-center w-full" role="status" wire:loading.flex>
                        <svg aria-hidden="true"
                            class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600 text-center"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>

                    <button class="text-blue-400 font-bold underline">
                        Load More
                    </button>



                </div>
            </div>
        </div>
    </div>
</div>
