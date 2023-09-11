<div>
    <form action="" class="relative bg-none" x-data="formBM">
        
        <div class="w-1/4 sm:w-1/2 mx-auto bg-slate-200 p-4 rounded grid gap-10 capitalize">
            <div class="w-full border-b-[1px] border-gray-400 p-2">
                <h1 class="text-center text-3xl">Calcul Your BMI and MBR</h1>
            </div>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="list-disc relative px-5">
                        @foreach ($errors->all() as $error)
                            <li class="text-red-500 font-semibold">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="">
                <label for="Fgender" class="capitalize">Woman</label>
                <input type="radio" name="sex" class="rounded-full" value="woman" wire:key='{{ rand() }}'
                    wire:model="sex">
                <label for="Fgender" class="capitalize">men</label>
                <input type="radio" name="sex" class="rounded-full" value="men" wire:key='{{ rand() }}'
                    wire:model="sex">
            </div>
            <div class="flex gap-2 items-center">
                <label for="Fweight">weight:</label>
                <input class="rounded p-2 h-8 " type="text" value="" placeholder="your weight . . . kg"
                    wire:key='{{ rand() }}' wire:model.lazy="weight">
                <div class="flex gap-10  w-full items-center">
                    <div>
                        <label for="weight" class="capitalize">Kg</label>
                        <input type="radio" name="unitWeight" id="" class="rounded-full"
                            wire:key='{{ rand() }}' wire:model='unitWeight' value="kg">
                    </div>
                    <div>
                        <label for="weight" class="capitalize">Pound</label>
                        <input type="radio" name="unitWeight" id="" class="rounded-full"
                            wire:key='{{ rand() }}' wire:model='unitWeight' value="pound">
                    </div>


                </div>
            </div>

            <div class="flex gap-2 items-center">
                <label for="Fheight">Height:</label>
                <input class="rounded p-2 h-8 " type="text" value="" placeholder="your Height . . . cm "
                    wire:key='{{ rand() }}' wire:model.lazy="height">
                <div class="flex  gap-10 w-full items-center">
                    <div>
                        <label for="height" class="capitalize">cm</label>
                        <input type="radio" name="unitHeight" id="" class="rounded-full"
                            wire:key='{{ rand() }}' wire:model='unitHeight' value="cm">
                    </div>
                    <div>
                        <label for="height" class="capitalize">inch</label>
                        <input type="radio" name="unitHeight" id="" class="rounded-full"
                            wire:key='{{ rand() }}' wire:model='unitHeight' value="inch">

                    </div>


                </div>
            </div>
            <div class="flex gap-4 items-center">
                <label for="fage" class="">Age :</label>
                <input type="number" name="" id="" value="15" class="rounded p-2 h-8"
                    wire:key='{{ rand() }}' wire:model="age">
                <label for="">Years</label>
            </div>
            <div class="grid gap-2">

                <select name="" id="" class="w-full relative rounded" wire:key='{{ rand() }}'
                    wire:model="activity">
                    <option selected value="">Select activity</option>
                    <option value="1.2">If you don't do sports or exercise at all</option>
                    <option value="1.375">If you do vigorous physical activity for at least twenty minutes one to
                        three
                        times a week or nature of your work or life requires you to walk for long periods.</option>
                    <option value="1.55">Do vigorous physical activity for at least 30 to 60 minutes, three to four
                        times a week</option>
                    <option value="1.725">If you engage in vigorous physical activity for 60 minutes or more, five to
                        seven times a week</option>
                    <option value="1.9">If you are an athlete, follow a continuous movement schedule that includes
                        multiple rounds of exercise per day

                    </option>
                </select>
            </div>
            <div class="flex gap-4" x-data="{ BtnShow: @entangle('ResultShow') }">

                <button type="button" class="bg-indigo-700 text-white font-bold rounded w-40 p-3" name="calcul"
                    id="calcul" wire:click='Calculbmi'>Calcul</button>
                <button type="button" name="save" id="save" wire:click="SaveProfile"
                    wire:key='{{ rand() }}' class="bg-green-500 text-white font-bold rounded w-40 p-3"
                    x-show="$wire.ResultShow" x-transition>Save </button>
            </div>


            <div class="result">

                <div class="MBR flex flex-row  gap-2 items-center" x-show="$wire.ResultShow"
                    wire:key='{{ rand() }}'>
                    <span>Your MBR is</span>
                    <div class="font-bold">{{ $bmr }} Kcal</div>
                </div>
                <div class="BMI flex flex-row  gap-2 items-center" x-show="$wire.ResultShow"
                    wire:key='{{ rand() }}'>
                    <span>Your BMI is</span> <span class="font-bold" x-text="{{ $bmi }}"> </span>
                </div>
                <div class="indice w-full flex  flex-row-reverse relative capitalize ">
                    <div class="basis-2/6 grid">
                        <div class="flex">
                            <div class="bg-red-800 h-10 basis-2/4"></div>
                            <div class="bg-red-600 h-10 basis-2/4"></div>
                        </div>
                        <span class="relative text-center">Obesity</span>
                    </div>
                    <div class="basis-2/6 grid">
                        <div class="flex">
                            <div class="bg-yellow-500 h-10  basis-2/4"></div>
                            <div class="bg-yellow-400 h-10  basis-2/4"></div>

                        </div>
                        <span class="relative text-center">Overweight</span>
                    </div>
                    <div class="basis-2/6 grid">
                        <div class="flex">
                            <div class="bg-green-800 h-10  basis-2/4"></div>
                            <div class="bg-green-600 h-10  basis-2/4"></div>
                        </div>
                        <span class="relative text-center">Normal</span>

                    </div>
                    <div class="basis-2/6 grid">
                        <div class="flex">
                            <div class="bg-red-800 h-10  basis-2/4"></div>
                            <div class="bg-red-600 h-10  basis-2/4"></div>
                        </div>
                        <span class="relative text-center">Underweight</span>

                    </div>
                    <span class="w-1 bg-white h-10 absolute transition-all duration-300" id="indice-bar"
                        :style="{ left: $wire.indiceBar + '%' }"></span>
                </div>
                <div class="notes"></div>
            </div>
        </div>

    </form>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('formBM', () => ({

        }))
    })
</script>
