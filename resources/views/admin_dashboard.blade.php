@section('page-vite')
    @vite(['resources/js/app.js','resources/js/userSummaryPieChart.js',
    'resources/js/categorySummaryBarChart.js']);
@endsection

<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-4 mb-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    問題別進捗率

                    <div id="canvasDiv" class="mx-auto w-3/5 overflow-hidden">

                        <canvas id="pie-chart">

                        </canvas>
                    </div>
                </div>
            </div>
            <div class="p-4 mb-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    中分類別問題数
                    <div id="canvasDiv" class="mx-auto w-3/5 overflow-hidden">

                        <canvas id="bar-chart-custom-options">

                        </canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="app">
        <example-component></example-component>
    </div>

</x-admin-layout>
