<script setup>
import Layout from './Layout/Main.vue'
defineOptions({ layout: Layout })
</script>

<template>
    <v-container fluid>
        <v-card>  
            <v-container fluid>
                <v-card-title>Dashboard</v-card-title>
                <v-row no-gutters>

                    <v-col
                        cols="12"
                        sm="4"
                    >
                        <v-sheet class="ma-2 pa-2">
                            <v-card width="510" title="Expenses">
                                <apexchart width="500" :options="chartOptions" :series="seriesExpenses"></apexchart> 
                            </v-card>
                        </v-sheet>
                    </v-col>
                    <v-col
                        cols="12"
                        sm="4"
                    >
                        <v-sheet class="ma-2 pa-2">
                            <v-card width="510" title="Profits">
                                <apexchart width="500" :options="chartOptions" :series="seriesProfits"></apexchart> 
                            </v-card>
                        </v-sheet>
                    </v-col>
                    <v-col
                        cols="12"
                        sm="4"
                    >
                        <v-sheet class="ma-2 pa-2">
                            <v-card width="510" title="Sales">
                                <apexchart width="500" :options="chartOptions" :series="seriesSales"></apexchart> 
                            </v-card>
                        </v-sheet>
                    </v-col>

                </v-row>
                <v-row no-gutters>
            
                        <v-sheet class="ma-2 pa-2">
                            <v-card width="800">
                                <v-container>
                                    <v-card-title>Budget</v-card-title>
                                    <apexchart width="790" type="bar" :options="barChartOptions" :series="barSeries"></apexchart> 
                                </v-container>
                            </v-card>
                        </v-sheet>
               
                        <v-sheet class="ma-2 pa-2">
                            <v-card width="710" height="480">
                                <v-container>
                                    <v-card-title>Department Sales</v-card-title>
                                    <apexchart width="650" height="390" :options="donutChartOptions" :series="donutSeries"></apexchart>
                                </v-container> 
                            </v-card>
                        </v-sheet>
                  
                </v-row>
            </v-container>
        </v-card>
    </v-container>
</template>
<script>
    export default {
        data: function() {
            return {

                seriesExpenses: [{
                    name: "Expenses",
                    data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
                }],
                seriesProfits: [{
                    name: "Profits",
                    data: [10, 41, 35, 51, 49, 65, 40, 60, 50]
                }],
                seriesSales: [{
                    name: "Sales",
                    data: [10, 50, 45, 75, 80, 100, 60, 20, 100]
                }],
                chartOptions: {
                    chart: {
                    height: 350,
                    type: 'line',
                    zoom: {
                        enabled: false
                    }
                    },
                    dataLabels: {
                    enabled: false
                    },
                    stroke: {
                    curve: 'straight'
                    },
                    grid: {
                    row: {
                        colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                        opacity: 0.5
                    },
                    },
                    xaxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
                    }
                },
                

                barSeries: [
                    {
                    name: 'Q1 Budget',
                    group: 'budget',
                    data: [44000, 55000, 41000, 67000, 22000, 43000]
                    },
                    {
                    name: 'Q1 Actual',
                    group: 'actual',
                    data: [48000, 50000, 40000, 65000, 25000, 40000]
                    },
                    {
                    name: 'Q2 Budget',
                    group: 'budget',
                    data: [13000, 36000, 20000, 8000, 13000, 27000]
                    },
                    {
                    name: 'Q2 Actual',
                    group: 'actual',
                    data: [20000, 40000, 25000, 10000, 12000, 28000]
                    }
                ],
                barChartOptions: {
                    chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true,
                    },
                    stroke: {
                    width: 1,
                    colors: ['#fff']
                    },
                    dataLabels: {
                    formatter: (val) => {
                        return val / 1000 + 'K'
                    }
                    },
                    plotOptions: {
                    bar: {
                        horizontal: false
                    }
                    },
                    xaxis: {
                    categories: [
                        'Online advertising',
                        'Sales Training',
                        'Print advertising',
                        'Catalogs',
                        'Meetings',
                        'Public relations'
                    ]
                    },
                    fill: {
                    opacity: 1
                    },
                    colors: ['#80c7fd', '#008FFB', '#80f1cb', '#00E396'],
                    yaxis: {
                    labels: {
                        formatter: (val) => {
                        return val / 1000 + 'K'
                        }
                    }
                    },
                    legend: {
                    position: 'top',
                    horizontalAlign: 'left'
                    }
                },
            
                donutSeries: [
                    44, 55, 41, 17, 15
                ],
                donutChartOptions: {
                    chart: {
                    type: 'donut',
                    },
                    labels: [
                    'Clothing',
                    'Food Products',
                    'Kitchen Utility',
                    'Electronics',
                    'Gardening',
                    ],
                    responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                        width: 200
                        },
                        legend: {
                        position: 'bottom'
                        }
                    }
                    }]
                },
            }   
        },
    }
</script>
