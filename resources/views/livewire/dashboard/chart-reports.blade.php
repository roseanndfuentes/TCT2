<div x-data="{}" x-init="const labels = ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'];
const data = {
    labels: labels,
    datasets: [{
        label: 'Submissions for the last 7 days',
        data: [65, 59, 80, 81, 56, 55, 40],
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(255, 159, 64, 0.2)',
            'rgba(255, 205, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(153, 102, 255, 0.2)',
            'rgba(201, 203, 207, 0.2)'
        ],
        borderColor: [
            'rgb(255, 99, 132)',
            'rgb(255, 159, 64)',
            'rgb(255, 205, 86)',
            'rgb(75, 192, 192)',
            'rgb(54, 162, 235)',
            'rgb(153, 102, 255)',
            'rgb(201, 203, 207)'
        ],
        borderWidth: 2
    }]
};

const config = {
    type: 'line',
    data: data,
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    },
};
const myChart = new Chart(document.getElementById('charts'), config);" class="flex">
    <div class="bg-white border rounded-lg p-3 border-gray-300"><canvas  id="charts"></canvas>
    </div>
    <div>
    </div>
</div>
