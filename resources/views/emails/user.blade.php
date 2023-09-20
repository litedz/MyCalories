<x-mail::message>
    Dear {{$name}},

    {{$message}}
    
    Best wishes,
    
    Support MyCalories

<x-mail::button :url="'https://www.google.com/'">
Show more recipes
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
