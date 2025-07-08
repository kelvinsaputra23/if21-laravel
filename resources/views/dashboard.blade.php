<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    {{-- Bagian untuk Menampilkan Grafik --}}
                    <div class="card mt-4"> {{-- Menggunakan kelas Bootstrap 'card' dan 'mt-4' untuk margin top --}}
                        <div class="card-header">
                            <h5 class="mb-0">Jumlah Kelas Dibuka per Prodi dan Tahun Akademik 📊</h5>
                        </div>
                        <div class="card-body">
                            {{-- Elemen CANVAS untuk Grafik --}}
                            <canvas id="classChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Script untuk Chart.js --}}
    {{-- Pastikan Anda sudah menyertakan CDN Chart.js di layout utama (app.blade.php) atau di sini --}}
    {{-- Contoh CDN: <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Data labels dan data nilai dikirim dari DashboardController
            // Pastikan variabel $labels dan $data sudah di-pass dari controller ke view ini.
            var labels = @json($labels ?? []); // Gunakan operator null coalescing untuk menghindari error jika variabel tidak ada
            var data = @json($data ?? []);

            if (labels.length > 0 && data.length > 0) {
                var ctx = document.getElementById('classChart').getContext('2d');
                var classChart = new Chart(ctx, {
                    type: 'bar', // Anda bisa mengubah jenis grafik: 'bar', 'line', 'pie', 'doughnut', dll.
                    data: {
                        labels: labels, // Label untuk setiap bar/data point (misal: "2024/2025 - SI")
                        datasets: [{
                            label: 'Jumlah Kelas',
                            data: data, // Nilai untuk setiap bar/data point (jumlah kelas)
                            backgroundColor: [ // Warna-warna untuk setiap bar
                                'rgba(255, 99, 132, 0.7)', // Merah
                                'rgba(54, 162, 235, 0.7)', // Biru
                                'rgba(255, 206, 86, 0.7)', // Kuning
                                'rgba(75, 192, 192, 0.7)', // Hijau Teal
                                'rgba(153, 102, 255, 0.7)',// Ungu
                                'rgba(255, 159, 64, 0.7)', // Oranye
                                'rgba(199, 199, 199, 0.7)',// Abu-abu
                                'rgba(83, 102, 255, 0.7)', // Biru terang
                                'rgba(40, 159, 64, 0.7)',  // Hijau tua
                                'rgba(210, 99, 132, 0.7)'  // Merah muda
                            ],
                            borderColor: [ // Warna border untuk setiap bar
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(199, 199, 199, 1)',
                                'rgba(83, 102, 255, 1)',
                                'rgba(40, 159, 64, 1)',
                                'rgba(210, 99, 132, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true, // Grafik akan menyesuaikan ukuran kontainernya
                        maintainAspectRatio: false, // Penting agar grafik bisa diatur tingginya (jika diperlukan)
                        scales: {
                            y: {
                                beginAtZero: true, // Sumbu Y dimulai dari nol
                                title: {
                                    display: true,
                                    text: 'Jumlah Kelas' // Label untuk sumbu Y
                                },
                                ticks: {
                                    precision: 0 // Pastikan label sumbu Y adalah bilangan bulat
                                }
                            },
                            x: {
                                title: {
                                    display: true,
                                    text: 'Tahun Akademik - Program Studi' // Label untuk sumbu X
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: true, // Menampilkan legenda
                                position: 'top', // Posisi legenda
                            },
                            tooltip: { // Kon