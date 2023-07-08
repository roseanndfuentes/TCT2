    <div class="w-full" wire:ignore x-data="{
        labels: $wire.entangle('labels'),
        submissions: $wire.entangle('chartValues'),
        init() {
            const data = {
                labels: this.labels,
                datasets: [{
                    lineTension: 0.8,
                    label: 'Submissions for the last 7 days',
                    data: this.submissions,
                    borderWidth: 2
                }]
            };
            const myChart = new Chart(
                this.$refs.canvas, {
                    type: 'line',
                    data: data,
                    options: {
                        scales: {
                            x: {
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                grid: {
                                    display: true
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            livewire.on('updateChart', () => {
                myChart.data.datasets[0].data = this.submissions;
                myChart.data.labels = this.labels;
                myChart.update();
            });
        }
    }">
        <div class="w-full" class="flex">
            <div class="bg-white border rounded-lg p-5 space-y-3 border-gray-300">
                <div class="flex items-center justify-between">
                    <span>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Submissions for the last 7 days
                        </h3>
                    </span>
                    <div class="flex space-x-1  items-center">
                        <input wire:model="startDate" type="date"
                            class="text-sm border-0 ring-0 focus:ring-0 focus:border-0" />
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-6 h-6 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15" />
                        </svg>
                        <input wire:model="endDate" type="date"
                            class="text-sm border-0 ring-0 focus:ring-0 focus:border-0" />
                    </div>
                </div>
                <div class="w-full">
                    <canvas class="w-full" x-ref="canvas" id="charts"></canvas>
                </div>
            </div>
        </div>
    </div>
