
function updateDateTime() {
    var now = new Date();

    // Format tanggal
    var optionsDate = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    var formattedDate = now.toLocaleDateString('id-ID', optionsDate);

    // Format waktu
    var optionsTime = {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
    };
    var formattedTime = now.toLocaleTimeString('id-ID', optionsTime);

    // Update elemen HTML
    document.getElementById('date').innerText = formattedDate;
    document.getElementById('time').innerText = formattedTime;
}

setInterval(updateDateTime, 1000); // Update every second
updateDateTime();

document.addEventListener('DOMContentLoaded', function () {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(function (checkbox) {
        checkbox.addEventListener('change', function () {
            document.getElementById('statusForm').submit();
        });
    });
});


$(document).ready(function () {
    // Select input dengan class 'harga'
    $('.harga').on('input', function () {
        // Hilangkan semua karakter selain digit
        var nilai = $(this).val().replace(/\D/g, '');
        // Format nilai dengan menggunakan toLocaleString() untuk format IDR
        $(this).val((parseInt(nilai)).toLocaleString('id-ID'));
    });
});


document.addEventListener('DOMContentLoaded', function() {
    // Mengambil nilai $queryCount dari atribut data HTML
    var queryCount = document.getElementById('chartData').dataset.queryCount;

    // Konversi nilai queryCount ke tipe data yang sesuai jika diperlukan
    queryCount = parseInt(queryCount); // Misalnya, konversi ke integer

    // Mendapatkan elemen canvas untuk grafik
    var ctx = document.getElementById('myChart').getContext('2d');

    // Membuat grafik menggunakan Chart.js
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ["Queries"],
            datasets: [{
                label: 'Jumlah Query',
                data: [queryCount],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
});
