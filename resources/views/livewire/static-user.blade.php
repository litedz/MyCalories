<div id="window.{{ $chart->id }}">


    <div class="chart w-11/12 mx-auto grid grid-cols-1 ">
        <div>
            {!! $chart->container() !!}
        </div>
        <div>
            {!! $chart2->container() !!}
        </div>

    </div>


    {!! $chart->script() !!}
    {!! $chart2->script() !!}
</div>
