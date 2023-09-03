<div>
    <form action="" class="relative bg-none" x-data="formBM">
        <div class="w-1/4 sm:w-1/2 mx-auto bg-slate-200 p-4 rounded grid gap-10 capitalize">
            <div class="w-full border-b-[1px] border-gray-400 p-2">
                <h1 class="text-center text-3xl">Calcul Your BMI and MBR</h1>
            </div>
            <div class="">
                <label for="Fgender" class="capitalize">Woman</label>
                <input type="radio" name="woman" id="" class="rounded-full" value="woman" x-model="sex">
                <label for="Fgender" class="capitalize">men</label>
                <input type="radio" name="men" id="" class="rounded-full" value="men" x-model="sex">
            </div>
            <div class="flex gap-2 items-center" x-data="{ required: false }"
                x-on:error="required = !$json($event.detail).required">
                <label for="Fweight">weight:</label>
                <input class="rounded p-2 h-8 " type="text" value="" placeholder="your weight . . . kg" x-model="weight"
                    x-validation.required="weight">
                <div class="flex gap-10  w-full items-center">
                    <div>
                        <label for="weight" class="capitalize">Kg</label>
                        <input type="checkbox" name="kg" id="" class="rounded-full" wire:model.live='weightUnit' value="kg">
                    </div>
                    <div>
                        <label for="weight" class="capitalize">Pound</label>
                        <input type="checkbox" name="pound" id="" class="rounded-full" wire:model.live='weightUnit'
                            value="pound">
                    </div>


                </div>
            </div>
            <div class="flex gap-2 items-center">
                <label for="Fweight">Height:</label>
                <input class="rounded p-2 h-8 " type="text" value="" placeholder="your weight . . . cm "
                    x-model="height">
                <div class="flex  gap-10 w-full items-center">
                    <div>
                        <label for="weight" class="capitalize">cm</label>
                        <input type="checkbox" name="cm" id="" class="rounded-full" wire:model.live='heighttUnit' value="cm">
                    </div>
                    <div>
                        <label for="weight" class="capitalize">inch</label>
                        <input type="checkbox" name="inch" id="" class="rounded-full" wire:model.live='heighttUnit'
                            value="inch">

                    </div>


                </div>
            </div>
            <div class="flex gap-4 items-center">
                <label for="fage" class="">Age :</label>
                <input type="number" name="" id="" value="15" class="rounded p-2 h-8" x-model="age">
                <label for="">Years</label>
            </div>
            <div class="grid gap-2">
                <label for="activitys">Select activity</label>
                <select name="" id="" class="w-full relative rounded" x-model="activity">
                    <option value="1.2">If you don't do sports or exercise at all</option>
                    <option value="1.375">If you do vigorous physical activity for at least twenty minutes one to three
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
            <div>
                <button type="button" class="bg-indigo-700 text-white font-bold rounded w-40 p-3"
                    @click="Calcul">Calcul</button>
            </div>
            <div class="result">
                <div class="MBR" x-show="ResultShow">

                    Your MBR is <span class="font-bold" x-text="BMR">44444</span>
                </div>
                <div class="BMI" x-show="ResultShow">
                    Your BMI is <span class="font-bold" x-text="BMI">44444</span>
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
                    <span class="w-1 bg-white h-10 absolute transition-all duration-300" id="indice-bar"></span>
                </div>
                <div class="notes"></div>
            </div>
        </div>

    </form>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('formBM', () => ({
            weight: '',
            height: '',
            sex: 'men',
            age: '',
            activity: '1.2',
            BMR: 0,
            BMI: 0,
            ResultShow: false,
            Calcul() {
                this.BMI = Math.round(this.weight / ((this.height / 100) * (this.height / 100)));


                if (this.BMI >= 40) {
                    document.getElementById('indice-bar').style.left = '100%';
                }
                else {
                    document.getElementById('indice-bar').style.left = (this.BMI * 100) / 40 + '%';
                }

                if (this.sex == 'woman') {
                    this.BMR = Math.round((444.593 + (9.247 * this.weight) + (3.098 * this.height) - (4.33 * Math.abs(this.age))) * this.activity) + ' kcal';
                } else {
                    this.BMR = Math.round((88.362 + (13.397 * this.weight) + (4.799 * this.height) - (5.677 * Math.abs(this.age))) * this.activity) + ' kcal';
                }

                // Show result
                if (this.BMI > 0 && this.BMR.length > 0) {
                    this.ResultShow = true;
                }
            }
        }))
    })
</script>