<html>

<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>

<body>
    <div style="width:40em;">
        <canvas id="symptomsChart"></canvas>
    </div>
    <div style="width:40em;">
        <canvas id="planningFollowedChart"></canvas>
    </div>


</body>
<script>
    const ctx = document.getElementById('symptomsChart');
    axios.get("/psg-admin/admin-ajax.php?getSubscriptions&limit=300").then(res => {
        let count = {}
        res.data['subscriptions'].forEach(sub => {
            sub['symptoms'].forEach(symptom => {
                count[symptom] = ((count[symptom]) ? count[symptom] + 1 : 1);


            })
        })

        const myChart = new Chart(ctx, {

            data: {
                labels: Object.keys(count),

                datasets: [{
                    type: 'bar',
                    label: 'Sintomas',
                    data: Object.values(count),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            }

        });
    })

    const planningFollowedChart = document.getElementById('planningFollowedChart');
    if (planningFollowedChart) {
        axios.get("/psg-admin/admin-ajax.php?getUpdates&limit=300").then(res => {
            let count = {}
            res.data['updates'].forEach(sub => {

                count[sub['planning_followed']] = ((count[sub['planning_followed']]) ? count[sub['planning_followed']] + 1 : 1);



            })
            console.log(count)
            const myChart = new Chart(planningFollowedChart, {

                data: {
                    labels: Object.keys(count),

                    datasets: [{
                        type: 'bar',
                        label: 'Seguiu o planejamento?',
                        data: Object.values(count),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                }

            });
        })
    }
</script>

</html>