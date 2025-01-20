$(document).ready(function () {
	$('#upload-file').change(function () {
		const file = this.files[0];
		if (file) {
			const fileType = file.type;
			const validImageTypes = ["image/jpeg", "image/png", "image/gif"];
			if (validImageTypes.includes(fileType)) {
				$('#file-upload-name').html(file.name);
				setTimeout(function () {
					$('.upload-wrapper').addClass("uploaded");
				}, 600);
				setTimeout(function () {
					$('.upload-wrapper').removeClass("uploaded");
					$('.upload-wrapper').addClass("success");
				}, 1600);
			} else {
				alert("Hanya file gambar yang diperbolehkan (JPG, PNG, GIF).");
				this.value = ""; // Reset file input
				$('#file-upload-name').html("");
			}
		}
	});
});
