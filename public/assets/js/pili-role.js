console.log("Script mulai"); // Untuk melihat apakah skrip dimulai

document.getElementById('chooseRole').addEventListener('click', function() {
    console.log("Tombol diklik"); // Untuk melihat apakah event listener terpanggil

    var value = document.getElementById('role').value;
    console.log('Role chosen: ' + value); // Log the selected role

    document.querySelector('.pegawai').style.display = 'none';
    document.querySelector('.santri').style.display = 'none';

    if (['admin', 'pembina', 'tahfidz', 'murobby'].includes(value)) {
        document.querySelector('.pegawai').style.display = 'block';
    } else if (value === 'walsan') {
        document.querySelector('.santri').style.display = 'block';
    }
});
