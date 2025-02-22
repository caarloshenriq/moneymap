<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-900">

                <!-- Div Receita -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-white font-bold text-lg">

                    <!-- Receita -->
                    <div class="bg-green-400 hover:bg-green-500 cursor-pointer flex items-center justify-center flex-col p-4 rounded-lg shadow-md">
                        <p class="text-lg">Receita</p>
                        <p class="text-xl">R$ {{ $summary['revenue'] ?? 0}}</p>
                    </div>

                    <!-- Despesas -->
                    <div class="bg-red-400 hover:bg-red-500 cursor-pointer flex items-center justify-center flex-col p-4 rounded-lg shadow-md">
                        <p class="text-lg">Despesas</p>
                        <p class="text-xl">R$ {{ $summary['expense'] ?? 0}}</p>
                    </div>

                    <!-- Saldo -->
                    <div class="bg-blue-400 hover:bg-blue-500 cursor-pointer flex items-center justify-center flex-col p-4 rounded-lg shadow-md">
                        <p class="text-lg">Saldo</p>
                        <p class="text-xl">R$ {{ $summary['balance'] ?? 0}}</p>
                    </div>

                </div>

                <!-- Gráfico -->
                <div class="mt-8">
                    <h3 class="text-xl font-semibold text-gray-800">Resumo Mensal</h3>
                    <div id="chartdiv" class="mt-4" style="width: 100%; height: 500px;"></div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>

<!-- Importação de Scripts do Gráfico -->
<script src="https://cdn.amcharts.com/lib/5/index.js"></script>
<script src="https://cdn.amcharts.com/lib/5/xy.js"></script>
<script src="https://cdn.amcharts.com/lib/5/themes/Animated.js"></script>

<script>
    am5.ready(function() {
        // Criar elemento raiz
        var root = am5.Root.new("chartdiv");

        // Aplicar tema animado
        root.setThemes([am5themes_Animated.new(root)]);

        // Criar gráfico XY
        var chart = root.container.children.push(am5xy.XYChart.new(root, {
            panX: false,
            panY: false,
            paddingLeft: 0,
            wheelX: "panX",
            wheelY: "zoomX",
            layout: root.verticalLayout
        }));

        // Adicionar legenda
        var legend = chart.children.push(
            am5.Legend.new(root, {
                centerX: am5.p50,
                x: am5.p50
            })
        );

        // Dados do gráfico passados do Blade para JavaScript
        var data = @json($chartData);

        // Mapear números dos meses para nomes
        var monthNames = [
            "", "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho",
            "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro"
        ];

        // Ajustar os dados para exibir os nomes dos meses corretamente
        data = data.map(entry => ({
            month: monthNames[entry.month], 
            expense: entry.expense,
            revenue: entry.revenue
        }));

        // Criar eixo X (categorias para os meses)
        var xAxis = chart.xAxes.push(am5xy.CategoryAxis.new(root, {
            categoryField: "month",
            renderer: am5xy.AxisRendererX.new(root, { minorGridEnabled: true }),
            tooltip: am5.Tooltip.new(root, {})
        }));

        xAxis.data.setAll(data);

        // Criar eixo Y (valores numéricos)
        var yAxis = chart.yAxes.push(am5xy.ValueAxis.new(root, {
            renderer: am5xy.AxisRendererY.new(root, { strokeOpacity: 0.1 })
        }));

        // Função para criar séries (barras do gráfico)
        function makeSeries(name, fieldName, color) {
            var series = chart.series.push(am5xy.ColumnSeries.new(root, {
                name: name,
                xAxis: xAxis,
                yAxis: yAxis,
                valueYField: fieldName,
                categoryXField: "month"
            }));

            series.columns.template.setAll({
                tooltipText: "{name}, {categoryX}: R$ {valueY}",
                width: am5.percent(80),
                tooltipY: 0,
                fill: am5.color(color),
                strokeOpacity: 0
            });

            series.data.setAll(data);

            series.bullets.push(function() {
                return am5.Bullet.new(root, {
                    locationY: 0,
                    sprite: am5.Label.new(root, {
                        text: "R$ {valueY}",
                        fill: root.interfaceColors.get("alternativeText"),
                        centerY: 0,
                        centerX: am5.p50,
                        populateText: true
                    })
                });
            });

            legend.data.push(series);
        }

        // Criar série para Receita (cor azul)
        makeSeries("Receita", "revenue", 0x3b82f6);

        // Criar série para Despesas (cor vermelha)
        makeSeries("Despesas", "expense", 0xef4444);

        // Animação de carregamento
        chart.appear(1000, 100);
    });
</script>
