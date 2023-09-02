<div >
    <label for="{{$labelName}}" class="block mb-2 text-sm font-medium text-gray-900">{{$labelName}}</label>
    <input type="text" id="{{$labelName}}"
    {{ $attributes }}
    name="{{$labelName}}"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm 
        rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full 
        p-2.5 dark:placeholder-gray-400
         dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        
        placeholder="{{$placeHolder}}">
</div>