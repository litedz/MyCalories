<div>
    <form action="" class="relative rounded px-4 py-3" x-data="formBM" x-cloak>

        <div class="w-1/3 sm:w-1/2 mx-auto bg-gray-50 p-4 rounded grid gap-10 capitalize">
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
                    wire:key='{{ rand() }}' wire:model.debounce.500="height">
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
                    id="calcul" wire:click='Calculbmi'>Calcul
                    <div wire:loading wire:target="Calculbmi">
                        <svg aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-white animate-spin"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="#E5E7EB" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentColor" />
                        </svg>

                    </div>
                </button>
                <button type="button" name="save" id="save" wire:click="SaveProfile"
                    wire:key='{{ rand() }}' class="bg-green-500 text-white font-bold rounded w-40 p-3"
                    x-show="$wire.ResultShow" x-transition>Save

                </button>


            </div>


            <div class="result">


                <div class="bg-slate-100 rounded px-3 my-3 w-1/3 shadow-lg py-4" x-show="$wire.ResultShow"
                    wire:key='{{ rand() }}'>

                    <div class="MBR flex flex-row  gap-2 items-center">
                        <span>Your MBR is</span>
                        <div class="font-bold">{{ $bmr }} Kcal</div>
                    </div>
                    <div class="BMI flex flex-row  gap-2 items-center">
                        <span>Your BMI is</span> <span class="font-bold" x-text="{{ $bmi }}"> </span>
                    </div>
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
                            <div class="bg-yellow-300 h-10  basis-2/4"></div>
                            <div class="bg-yellow-400 h-10  basis-2/4"></div>

                        </div>
                        <span class="relative text-center">Overweight</span>
                    </div>
                    <div class="basis-2/6 grid">
                        <div class="flex">
                            <div class="bg-lime-500 h-10  basis-2/4"></div>
                            <div class=" bg-emerald-600 basis-2/4"></div>
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
