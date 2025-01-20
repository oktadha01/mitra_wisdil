<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi</title>
</head>
<body>
    <h1>Web Notification dengan CodeIgniter</h1>
    <button id="notifyBtn">Tampilkan Notifikasi</button>

    <script>
        // Cek apakah browser mendukung Notification API
        if (!("Notification" in window)) {
            alert("Browser Anda tidak mendukung notifikasi.");
        } else {
            document.getElementById('notifyBtn').addEventListener('click', function () {
                // Minta izin notifikasi jika belum diberikan
                if (Notification.permission === "default") {
                    Notification.requestPermission().then(permission => {
                        if (permission === "granted") {
                            fetchNotification();
                        } else {
                            alert("Izin notifikasi ditolak.");
                        }
                    });
                } else if (Notification.permission === "granted") {
                    fetchNotification();
                } else {
                    alert("Izin notifikasi telah ditolak. Aktifkan secara manual di pengaturan browser.");
                }
            });

            function fetchNotification() {
                // Panggil endpoint di CodeIgniter untuk mendapatkan data notifikasi
                fetch('http://localhost/your_project/notification/send_notification')
                    .then(response => response.json())
                    .then(data => {
                        // Tampilkan notifikasi
                        new Notification(data.title, {
                            body: data.body,
                            icon: data.icon
                        });
                    })
                    .catch(error => {
                        console.error("Gagal mendapatkan notifikasi:", error);
                    });
            }
        }
    </script>
</body>
</html>
