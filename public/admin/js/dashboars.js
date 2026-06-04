console.log("Dashboard Loaded");

/* CHART EXAMPLE */
if (document.getElementById('visitorChart')) {

    const ctx = document.getElementById('visitorChart').getContext('2d');

    new Chart(ctx, {
        type: 'line',

        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun'],

            datasets: [{
                label: 'Pengunjung',

                data: [1200,1500,1800,2200,2700,3200],

                borderColor: '#F5A623',

                backgroundColor: 'rgba(245,166,35,0.1)',

                borderWidth: 3,

                tension: 0.4,

                fill: true
            }]
        },

        options: {
            responsive: true,

            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
}