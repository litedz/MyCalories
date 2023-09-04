<div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg w-10/12 mx-auto">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="checkbox-all" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
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
                    <th scope="col" class="px-6 py-3">
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



                <tr
                    class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="w-4 p-4">
                        <div class="flex items-center">
                            <input id="checkbox-table-1" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-table-1" class="sr-only">checkbox</label>
                        </div>
                    </td>

                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$fav->food->name}}
                    </th>
                    <td class="px-6 py-4">
                        {{$fav->food->protien}}
                    </td>
                    <td class="px-6 py-4">
                        {{$fav->food->carbohydrate}}
                    </td>
                    <td class="px-6 py-4">
                        {{$fav->food->kcal}}
                    </td>
                    <td class="px-6 py-4">
                        {{$fav->food->quantity}}
                    </td>
                    <td class="px-6 py-4">
                        {{$fav->food->unit}}
                    </td>
                    <td class="px-6 py-4">
                        <button type="button"
                            class="font-medium bg-red-600 dark:bg-slate-600 dark:hover:bg-slate-400 text-white p-2 rounded dark:text-blue-500"
                            wire:click='RemoveFoodFromFav({{$fav->food->id}})'>Remove</button>
                    </td>
                </tr>

                @endforeach
                @endif
            </tbody>
        </table>
    </div>

</div>