<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OCR Enhanced with Image Preprocessing</title>
</head>
<body>
    <h1>Extract Name from KTP (Enhanced OCR)</h1>
    <input type="file" id="fileInput" accept="image/*">
    <br><br>
    <label for="nameKeyword">Masukkan Nama (Kata Kunci):</label>
    <input type="text" id="nameKeyword" placeholder="Contoh: Oktadha Nurdiansyah">
    <br><br>
    <button id="extractButton">Extract Name</button>
    <p id="result"></p>

    <canvas id="canvas" style="display:none;"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/tesseract.js/dist/tesseract.min.js"></script>
    <script>
        document.getElementById('extractButton').addEventListener('click', () => {
            const fileInput = document.getElementById('fileInput').files[0];
            const nameKeyword = document.getElementById('nameKeyword').value.trim();

            if (!fileInput) {
                alert('Silakan unggah gambar KTP terlebih dahulu.');
                return;
            }
            if (!nameKeyword) {
                alert('Silakan masukkan nama sebagai kata kunci.');
                return;
            }

            const reader = new FileReader();
            reader.onload = function () {
                const img = new Image();
                img.src = reader.result;

                img.onload = function () {
                    // Preprocess the image
                    const canvas = document.getElementById('canvas');
                    const ctx = canvas.getContext('2d');

                    // Set canvas size to match the image
                    canvas.width = img.width;
                    canvas.height = img.height;

                    // Draw image onto canvas
                    ctx.drawImage(img, 0, 0);

                    // Convert to grayscale
                    const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                    const data = imageData.data;
                    for (let i = 0; i < data.length; i += 4) {
                        const avg = (data[i] + data[i + 1] + data[i + 2]) / 3; // Grayscale
                        data[i] = data[i + 1] = data[i + 2] = avg > 128 ? 255 : 0; // Threshold
                    }
                    ctx.putImageData(imageData, 0, 0);

                    // Extract text with Tesseract.js
                    Tesseract.recognize(canvas.toDataURL(), 'eng', {
                        logger: (info) => console.log(info), // Log for debugging
                    }).then(({ data: { text } }) => {
                        // Split hasil OCR menjadi baris-baris
                        const lines = text.split('\n');
                        console.log('Hasil OCR:', text); // Debugging hasil OCR

                        // Cari nama berdasarkan kata kunci
                        const matchedLine = lines.find(line => 
                            line.toLowerCase().includes(nameKeyword.toLowerCase())
                        );

                        if (matchedLine) {
                            document.getElementById('result').textContent = `Nama ditemukan: ${matchedLine}`;
                        } else {
                            document.getElementById('result').textContent = 'Nama tidak ditemukan di gambar.';
                        }
                    }).catch(err => {
                        console.error(err);
                        document.getElementById('result').textContent = 'Terjadi kesalahan saat memproses OCR.';
                    });
                };
            };
            reader.readAsDataURL(fileInput);
        });
    </script>
</body>
</html>
