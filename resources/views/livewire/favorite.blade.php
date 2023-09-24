<div>
    
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-10/12 mx-auto dark:shadow-slate-400 dark:shadow m-4"
        x-data="FavoriteCompo" x-cloak>
        <!-- edit form  -->
        <div class="w-full h-full fixed top-0 left-0 edit-form" x-cloak x-show="showFormEdit" x-transition>
            <div class="overlay w-full h-full absolute bg-slate-600 opacity-50 z-10"></div>
            <div class="w-2/5 mx-auto relative z-20 top-1/4">
                <form action="" class="bg-white p-4 rounded grid gap-5">
                    <div>
                        <label for="name"></label>
                        <h1 class="text-lg  text-center font-semibold border-b-2 pb-2" x-text="$wire.editName"></h1>
                    </div>

                    <x-form.input labelName='quantity' placeHolder="150 . . ." wire:model.live='editQuantity' />

                    @error('editQuantity')
                        <span class="error text-red-500 list-food p-2  mx-4">{{ $message }}</span>
                    @enderror

                    <div class="showCalorie grid">
                        <span class="font-bold">{{ $editKcal }} kcal</span>
                        <div wire:loading wire:target="editQuantity">
                            Calculing ...
                        </div>
                    </div>
                    <div>
                        <x-form.btn-primary class="mt-4 capitalize !text-white"
                            wire:click='EditFavoriteAndAddToList'>Add toList
                        </x-form.btn-primary>
                        <x-form.btn-primary class="mt-4 capitalize !bg-red-400 !text-white !font-bold"
                            @click="showFormEdit = false">Cancel </x-form.btn-primary>
                    </div>
                </form>
            </div>
        </div>
        <!-- end edit form -->
        <div class="">
            <button type="button" class="btn-primary bg-red-600 my-4 w-28" x-show="BtnRemoveAll"
            wire:key='{{rand()}}'
                @click="RestorStateEvent;$wire.RemoveAllFav(ListId)">Remove all</button>
             
        </div>
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-800 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            {{-- check All Items --}}
                            <input id="checkbox-all" type="checkbox" @click="CheckallItems" x-ref="test"
                            wire:key='{{rand()}}' class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-all" class="sr-only">checkbox</label>
                        </div>
                    </th>

                    <th scope="col" class="px-6 py-3">
                        name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        protien
                    </th>
                    <th scope="col" class="px-6 py-3">
                        carbohydrate
                    </th>
                    <th scope="col" class="px-6 py-3">
                        kcal
                    </th>
                    <th scope="col" class="px-6 py-3">
                        quantity
                    </th>
                    <th scope="col" class="px-6 py-3">
                        unit
                    </th>
                    <th scope="col" class="px-6 py-3 text-center">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @if (!$favorite->count() > 0)
                    <th colspan="8" class="text-center">
                        <h1 class="text-lg capitalize  text-slate-400 p-6">your dont have any food</h1>
                    </th>
                @else
                    @foreach ($favorite as $fav)
                        <tr wire:key='{{ $fav->id }}'
                            class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 ">
                            <td class="w-4 p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-table-1" type="checkbox" x-bind:checked="checkAll"
                                        :id="('input-{{ $fav->id }}')"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-table-1" class="sr-only">checkbox</label>
                                </div>
                            </td>

                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $fav->food->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $fav->food->protien }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $fav->food->carbohydrate }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $fav->food->kcal }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $fav->food->quantity }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $fav->food->unit }}
                            </td>
                            {{-- actions --}}
                            <td class="px-6 py-4 gap-5 flex flex-row justify-center">
                                <button type="button"
                                    class="font-medium bg-red-600 hover:bg-red-700 dark:bg-slate-600 dark:hover:bg-slate-400 text-white p-2 rounded dark:text-blue-500"
                                    wire:click='RemoveFoodFromFav({{ $fav->food->id }})'>Remove</button>
                                <button type="button"
                                    class="font-medium w-14 sm:w-auto bg-slate-600 hover:bg-slate-700 dark:bg-slate-600 dark:hover:bg-slate-400 text-white p-2 rounded dark:text-blue-500"
                                    @click="showFormEdit = true;$wire.set('editName','{{ $fav->food->name }}');$wire.set('editFood_id','{{ $fav->food->id }}')">Edit</button>
                                <button type="button"
                                    class="font-medium rounded-full px-1 w-14  "
                                    wire:click="AddFoodToList({{ $fav->food->id }})">
                                    <span class="fa fa-plus bg-sky-600 hover:bg-sky-700 dark:bg-slate-600 dark:hover:bg-slate-400 text-white py-4 dark:text-blue-500  px-4 rounded-full"></span></button>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
        
        
    </div>
</div>


<script>
    document.addEventListener('alpine:init', () => {

        Alpine.data('FavoriteCompo', () => ({
            showFormEdit: false,
            checkAll: false,
            BtnRemoveAll: false,
            ListId: [],
            CheckallItems() {
                this.checkAll = !this.checkAll
                this.ListId = [];
                this.BtnRemoveAll = false;
                if (this.checkAll) {
                    this.BtnRemoveAll = true;
                    $allInput = document.querySelectorAll('input[type="checkbox"]');
                    $allInput.forEach((Element, index) => {
                        if (index !== 0) {
                            let item = Element.id.split('-')[1];
                            this.ListId.push(item);
                        }
                    });
                }
            },
            RestorStateEvent() {
                window.addEventListener('Favs-removed', () => {

                    this.checkAll = false;
                    this.BtnRemoveAll = false;
                });
            },

        }))
    })
</script>
