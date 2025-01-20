<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Scan Foto dan Konversi ke Dokumen</title>
  <style>
    video { width: 100%; height: auto; }
    canvas { display: none; }
  </style>
</head>
<body>
  <h1>Scan Foto dan Konversi ke Dokumen</h1>
  <video id="video" autoplay></video>
  <button id="capture">Ambil Foto</button>
  <canvas id="canvas"></canvas>
  <button id="generate-pdf">Generate PDF</button>

  <script src="https://cdn.jsdelivr.net/npm/tesseract.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>

  <script>
    // Akses kamera
    const video = document.getElementById('video');
    const canvas = document.getElementById('canvas');
    const captureButton = document.getElementById('capture');
    const generatePdfButton = document.getElementById('generate-pdf');

    // Meminta izin untuk menggunakan kamera
    navigator.mediaDevices.getUserMedia({ video: true })
      .then((stream) => {
        video.srcObject = stream;
      })
      .catch((err) => {
        console.error("Tidak bisa mengakses kamera: ", err);
      });

    // Ambil foto dari video dan simpan di canvas
    captureButton.addEventListener('click', () => {
      const ctx = canvas.getContext('2d');
      canvas.width = video.videoWidth;
      canvas.height = video.videoHeight;
      ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
      
      // Proses OCR pada gambar yang diambil
      Tesseract.recognize(
        canvas,
        'eng',
        {
          logger: (m) => console.log(m),
        }
      ).then(({ data: { text } }) => {
        console.log('Teks yang dikenali: ', text);
        generatePdfButton.disabled = false;
        generatePdfButton.addEventListener('click', () => {
          generatePdf(text);
        });
      });
    });

    // Fungsi untuk menghasilkan PDF dari teks
    function generatePdf(text) {
      const doc = new jsPDF();
      doc.text(text, 10, 10);
      doc.save('dokumen.pdf');
    }
  </script>
</body>
</html>
