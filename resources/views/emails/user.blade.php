<x-mail::message>
    Dear {{$name}},

    I wanted to share some healthy recipe ideas to support your weight loss journey:
    
    - Grilled Chicken Salad
    - Vegetable Stir-Fry
    - Greek Yogurt Parfait
    - Spaghetti Squash with Marinara Sauce
    - Feel free to reach out if you need more recipes or guidance. You're on the path to a healthier you!
    
    Best wishes,
    
    Support MyCalories

<x-mail::button :url="'https://www.google.com/'">
Show more recipes
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
