$(function() {
	// Mendapatkan URL saat ini dari browser
	var currentUrl = window.location.href;
	// Periksa setiap <a> dalam sidebar
	$(".menu-side a").each(function() {
		// Jika URL href <a> cocok dengan URL saat ini
		if (currentUrl === this.href) {
			// Tambahkan kelas 'active' atau kelas lain ke elemen induk <li>
			$(this).closest(".round-button").addClass("active");
		}
	});
});