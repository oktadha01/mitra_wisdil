<div style="width:100%;font-family:arial,'helvetica neue',helvetica,sans-serif;padding:0;Margin:0">
    <div style="background-color:#f6f6f6">

        <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top">
            <tbody>
                <tr style="border-collapse:collapse">
                    <td valign="top" style="padding:0;Margin:0">
                        <table cellspacing="0" cellpadding="0" align="center" style="border-collapse:collapse;border-spacing:0px;table-layout:fixed!important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
                            <tbody>
                                <tr style="border-collapse:collapse">
                                    <td align="center" style="padding:0;Margin:0">
                                        <table cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="border-collapse:collapse;border-spacing:0px;background-color:#ffffff;width:600px">
                                            <tbody>
                                                <tr style="border-collapse:collapse">
                                                    <td align="left" bgcolor="#ffffff" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;background-color:#ffffff">
                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px">
                                                            <tbody>
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="center" valign="top" style="padding:0;Margin:0;width:560px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" role="presentation" style="border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr style="border-collapse:collapse">
                                                                                    <td align="left" style="padding:0;Margin:0;font-size:0px">
                                                                                        <a href="https://" style="font-family:arial,'helvetica neue',helvetica,sans-serif;font-size:14px;text-decoration:underline;color:#1376c8" target="_blank">
                                                                                            <img src="https://www.wisdil.com/assets/images/DD.png" alt="" style="display:block;border:0;outline:none;text-decoration:none" width="90" class="CToWUd" data-bit="iit">
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr style="border-collapse:collapse">
                    <td valign="top" style="padding:0;Margin:0">
                        <table cellspacing="0" cellpadding="0" align="center" style="border-collapse:collapse;border-spacing:0px;table-layout:fixed!important;width:100%;background-color:transparent;background-repeat:repeat;background-position:center top">
                            <tbody>
                                <tr style="border-collapse:collapse">
                                    <td align="center" style="padding:0;Margin:0">
                                        <table cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" style="border-collapse:collapse;border-spacing:0px;background-color:#ffffff;width:600px">
                                            <tbody>
                                                <tr style="border-collapse:collapse">
                                                    <td align="left" bgcolor="#ffffff" style="padding:0;Margin:0;padding-top:20px;padding-left:20px;padding-right:20px;background-color:#ffffff">
                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px">
                                                            <tbody>
                                                                <tr>
                                                                    <td>
                                                                        <div align="left" style="Margin:0;font-size:14px;line-height:18px">
                                                                            <div>
                                                                                Halo <?= $agency['agency'] ?? 'N/A' ?>,<br>Terima kasih atas pengajuan event Anda. Data yang Anda kirimkan telah berhasil kami terima dan akan segera kami proses. <br>Berikut detail pengajuan event Anda:
                                                                            </div>
                                                                            <div>
                                                                                <hr>
                                                                                <span>Data Agency:</span>
                                                                                <ul style="padding-left: 10px;">
                                                                                    <li style="display: flex;gap: 29px;margin-bottom: 6px;">
                                                                                        <span style="font-weight: bold;">Agency</span>
                                                                                        <span>: <?= $agency['agency'] ?? 'N/A' ?></span>
                                                                                    </li>
                                                                                    <li style="display: flex;gap: 42px;margin-bottom: 6px;">
                                                                                        <span style="font-weight: bold;">Email</span>
                                                                                        <span>: <?= $agency['email'] ?? 'N/A' ?></span>
                                                                                    </li>
                                                                                    <li style="display: flex;gap: 32px;margin-bottom: 6px;">
                                                                                        <span style="font-weight: bold;">Kontak</span>
                                                                                        <span>: <?= $agency['kontak'] ?? 'N/A' ?></span>
                                                                                    </li>
                                                                                    <li style="display: flex;gap: 33px;margin-bottom: 6px;">
                                                                                        <span style="font-weight: bold;">Alamat</span>
                                                                                        <span>: <?= $agency['alamat'] ?? 'N/A' ?></span>
                                                                                    </li>
                                                                                </ul>
                                                                                <hr>
                                                                                <span>Data Agency:</span>
                                                                                <ul style="padding-left: 10px;">
                                                                                    <li style="display: flex;gap: 43px;margin-bottom: 6px;">
                                                                                        <span style="font-weight: bold;">Event</span>
                                                                                        <span>: <?= $event['nm_event'] ?? 'N/A' ?></span>
                                                                                    </li>
                                                                                    <li style="display: flex;gap: 25px;margin-bottom: 6px;">
                                                                                        <span style="font-weight: bold;">Kategori</span>
                                                                                        <span>: <?= $event['kategori_event'] ?? 'N/A' ?></span>
                                                                                    </li>
                                                                                    <li style="display: flex;gap: 29px;margin-bottom: 6px;">
                                                                                        <span style="font-weight: bold;">Tanggal</span>
                                                                                        <span>: <?= $event['tgl_event'] ?? 'N/A' ?></span>
                                                                                    </li>
                                                                                    <li style="display: flex;gap: 54px;margin-bottom: 6px;">
                                                                                        <span style="font-weight: bold;">Jam</span>
                                                                                        <span>: <?= $event['jam_event'] ?? 'N/A' ?></span>
                                                                                    </li>
                                                                                    <li style="display: flex;gap: 63px;margin-bottom: 6px;">
                                                                                        <span style="font-weight: bold;">Mc</span>
                                                                                        <span>: <?= $event['mc_by'] ?? 'N/A' ?></span>
                                                                                    </li>
                                                                                    <li style="display: flex;gap: 51px;margin-bottom: 6px;">
                                                                                        <span style="font-weight: bold;">Kota</span>
                                                                                        <span>: <?= $event['kota'] ?? 'N/A' ?></span>
                                                                                    </li>
                                                                                    <li style="display: flex;gap: 35px;margin-bottom: 6px;">
                                                                                        <span style="font-weight: bold;">Alamat</span>
                                                                                        <span>: <?= $event['alamat'] ?? 'N/A' ?></span>
                                                                                    </li>
                                                                                </ul>
                                                                                <hr>
                                                                            </div>
                                                                            <div>
                                                                                Untuk pengajuan event ini, terdapat biaya sewa sistem sebesar Rp2.250.000 yang mencakup pengelolaan, koordinasi, dan layanan terkait event Anda. Kami akan menghubungi Anda untuk penjadwalan meeting terkait event Anda.
                                                                                <br>
                                                                                <br>
                                                                                Terima kasih atas kepercayaan Anda kepada kami!
                                                                            </div>
                                                                            <div>
                                                                                <p>Hormat Kami,</p>
                                                                                <p>Wisdil Indonesia</p>

                                                                            </div>
                                                                            <br>
                                                                            <hr style="border:0.5px solid black">
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
        <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;background-repeat:repeat;background-position:center top">
            <tbody>
                <tr style="border-collapse:collapse">
                    <td align="center" style="padding:0;Margin:0">
                        <table cellspacing="0" cellpadding="0" bgcolor="#ffffff" align="center" background="https://ci3.googleusercontent.com/meips/ADKq_NYNEJg6rRFxe18qSaP_ggMRGdncLP5SXdm5_-KDhG1SUfBfFYKNc2YKhrNrjcLC74US0Yv37gEq1Y50i8eglL1QNuYzzLTPvk4dkf49Ql1nAAMeb2RqW6dx6nrDvwRiN28eQP4D9rbcQ7Ro0Cde0ZrG5F0rgheEJuAywyit=s0-d-e1-ft#https://ahxnz.stripocdn.email/content/guids/CABINET_b15eb0a961c2691933d8a7513218d78d/images/bgputih.jpg" style="border-collapse:collapse;border-spacing:0px;background-color:#ffffff;background-repeat:no-repeat no-repeat;width:600px;background-image:url(https://ci3.googleusercontent.com/meips/ADKq_NYNEJg6rRFxe18qSaP_ggMRGdncLP5SXdm5_-KDhG1SUfBfFYKNc2YKhrNrjcLC74US0Yv37gEq1Y50i8eglL1QNuYzzLTPvk4dkf49Ql1nAAMeb2RqW6dx6nrDvwRiN28eQP4D9rbcQ7Ro0Cde0ZrG5F0rgheEJuAywyit=s0-d-e1-ft#https://ahxnz.stripocdn.email/content/guids/CABINET_b15eb0a961c2691933d8a7513218d78d/images/bgputih.jpg);background-position:left top">
                            <tbody>
                                <tr style="border-collapse:collapse">
                                    <td align="left" style="padding:0;Margin:0;padding-top:5px;padding-left:20px;padding-right:20px">
                                        <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;border-spacing:0px">
                                            <tbody>
                                                <tr style="border-collapse:collapse">
                                                    <td valign="top" align="center" style="padding:0;Margin:0;width:560px">
                                                        <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;border-spacing:0px">
                                                            <tbody>
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="center" style="padding:0;Margin:0">
                                                                        <p style="Margin:0;font-family:arial,'helvetica neue',helvetica,sans-serif;line-height:21px;color:#333333;font-size:14px">Email ini dibuat secara otomatis. Mohon untuk tidak mengirimkan balasan ke email ini.<br><br>Untuk pertanyaan dan informasi lainnya.</p>
                                                                        <!-- <p style="Margin:0;font-family:arial,'helvetica neue',helvetica,sans-serif;line-height:21px;color:#333333;font-size:14px">silakan menghubungi BCA</p> -->
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse">
                                    <td align="left" style="padding:0;Margin:0;padding-top:20px;padding-left: 36px;">
                                        <table cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0px;width:600px">
                                            <tbody>
                                                <tr style="border-collapse:collapse">
                                                    <td valign="top" style="padding:0;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0px;">
                                                            <tbody>
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="left" style="padding:0;Margin:0;width:300px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr style="border-collapse:collapse">
                                                                                    <td align="center" style="padding:0;Margin:0;font-size:0px">
                                                                                        <a href="https://wa.me/6285864900443?text=Hallo%20Wisdil%20..." style="color:black;font-size:12px;display:flex;text-decoration:unset;" target="_blank" data-saferedirecturl="https://wa.me/6285864900443?text=Hallo%20Wisdil%20...">
                                                                                            <img src="https://mitra.wisdil.com/assets/images/iconemail/wa.png" alt="" style="display:block;border:0;outline:none;text-decoration:none" height="40" width="40" class="CToWUd" data-bit="iit">
                                                                                            <div style="display: grid;margin-left: 10px;margin-top: 10px;text-align: left;">
                                                                                                <p style="margin: 0;">Whatsapp</p>
                                                                                                <p style="margin: 0;">+62 858-6490-0443</p>
                                                                                            </div>
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td valign="top" style="padding:0;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0px;">
                                                            <tbody>
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="left" style="padding:0;Margin:0;width:280px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr style="border-collapse:collapse">
                                                                                    <td align="center" style="padding:0;Margin:0;font-size:0px">
                                                                                        <a href="https://www.instagram.com/wisdil_com/" style="color:black;font-size:12px;display:flex;text-decoration:unset;" target="_blank" data-saferedirecturl="https://www.instagram.com/wisdil_com/">
                                                                                            <img src="https://mitra.wisdil.com/assets/images/iconemail/ig.png" alt="" style="display:block;border:0;outline:none;text-decoration:none" height="40" width="40" class="CToWUd" data-bit="iit">
                                                                                            <div style="display: grid;margin-left: 10px;margin-top: 10px;text-align: left;">
                                                                                                <p style="margin: 0;">Instagram</p>
                                                                                                <p style="margin: 0;">@wisdil_com</p>
                                                                                            </div>
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td valign="top" style="padding:0;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0px;">
                                                            <tbody>
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="left" style="padding:0;Margin:0;width:300px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr style="border-collapse:collapse">
                                                                                    <td align="center" style="padding:0;Margin:0;font-size:0px">
                                                                                        <a href="#" style="color:black;font-size:12px;display:flex;text-decoration:unset;" target="_blank" data-saferedirecturl="#">
                                                                                            <img src="https://mitra.wisdil.com/assets/images/iconemail/email.png" alt="" style="display:block;border:0;outline:none;text-decoration:none" height="40" width="40" class="CToWUd" data-bit="iit">
                                                                                            <div style="display: grid;margin-left: 10px;margin-top: 10px;text-align: left;">
                                                                                                <p style="margin: 0;">Email</p>
                                                                                                <p style="margin: 0;">cs@wisdil.com</p>
                                                                                            </div>
                                                                                        </a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr style="border-collapse:collapse">
                                    <td align="left" style="padding:0;Margin:0;padding-bottom:10px;padding-left:40px;padding-right:40px">
                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px">
                                            <tbody>
                                                <tr style="border-collapse:collapse">
                                                    <td align="center" valign="top" style="padding:0;Margin:0;width:520px">
                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px">
                                                            <tbody>
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:10px;font-size: 11px;color: black;font-weight: bold;">
                                                                        <br>
                                                                        <br>
                                                                        <br>
                                                                        Wisdil merupakan platform penjualan dan pembelian tiket secara online
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>