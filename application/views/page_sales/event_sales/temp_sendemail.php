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
                                                                                <p>Cv Tricore Tech Trend</p>

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
                                                                        <p style="Margin:0;font-family:arial,'helvetica neue',helvetica,sans-serif;line-height:21px;color:#333333;font-size:14px">Email ini dibuat secara otomatis. Mohon untuk tidak mengirimkan balasan ke email ini.<br><br>Untuk pertanyaan dan informasi perbankan lainnya.</p>
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
                                    <td align="left" style="padding:0;Margin:0;padding-top:5px">
                                        <table cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0px;width:600px">
                                            <tbody>
                                                <tr style="border-collapse:collapse">
                                                    <td valign="top" style="padding:0;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse;border-spacing:0px;float:left">
                                                            <tbody>
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="left" style="padding:0;Margin:0;width:300px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr style="border-collapse:collapse">
                                                                                    <td align="right" style="padding:0;Margin:0;font-size:0px"><a href="https://www.bca.co.id/id/Individu/layanan/Customer-Service/HaloBCA#download" style="text-decoration:underline;color:#ffffff;font-size:12px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.bca.co.id/id/Individu/layanan/Customer-Service/HaloBCA%23download&amp;source=gmail&amp;ust=1735920333436000&amp;usg=AOvVaw1en4fJ-Q9Tij4gyIsbRxhk"><img src="https://ci3.googleusercontent.com/meips/ADKq_NYEwMIoZLBqdvKlWPx0M3prLnBfH7br0TxIo07BBjHVLXVkAGwojIhF450jBcGoxYQYuZ30SBpKJTNEpZSBNRiCa3Edtmu8dgbTmfoeVTXGKXthZy8_JSAYojKPiZeGZhgRas24q5lFZiBw3_PFsXBOELhwtfNpOgP_qguazgc-VQRW3AvYU-FeEOqdUw8lDrd-Ww=s0-d-e1-ft#https://ahxnz.stripocdn.email/content/guids/CABINET_87f201c65c904922f777b5e6ee3cb8b5/images/icon_informasi_bca_202209_szL.png" alt="" style="display:block;border:0;outline:none;text-decoration:none" height="40" width="145" class="CToWUd" data-bit="iit"></a></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td style="padding:0;Margin:0;width:20px"></td>
                                                    <td valign="top" style="padding:0;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" align="right" style="border-collapse:collapse;border-spacing:0px;float:right">
                                                            <tbody>
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="left" style="padding:0;Margin:0;width:280px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr style="border-collapse:collapse">
                                                                                    <td align="left" style="padding:0;Margin:0;padding-right:25px;font-size:0px"><a href="tel:1500888" style="text-decoration:underline;color:#ffffff;font-size:12px" target="_blank"><img src="https://ci3.googleusercontent.com/meips/ADKq_NavzW6lsKUGmvqgXgNKWM-1g16klPX4H_QQ-aP3wc2CDHCPmqusBq0fre7kIRdgVTCMnTunXx-g7qHrENn1mygyxLftOgEtrc59nuUEZn02AK3HXYxiIWLJ3ThCNp4i7Fm-IYTBiy8k7N5q6ivnuuPPtaIqEhDXwhXLoA8rM-D-ltPQ1Z1_807AinubKqTy=s0-d-e1-ft#https://ahxnz.stripocdn.email/content/guids/CABINET_87f201c65c904922f777b5e6ee3cb8b5/images/icon_informasi_bca_202210.png" alt="" style="display:block;border:0;outline:none;text-decoration:none" width="159" height="40" class="CToWUd" data-bit="iit"></a></td>
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
                                    <td align="left" style="padding:0;Margin:0;padding-top:5px">
                                        <table cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0px;width:600px">
                                            <tbody>
                                                <tr style="border-collapse:collapse">
                                                    <td valign="top" style="padding:0;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse;border-spacing:0px;float:left">
                                                            <tbody>
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="left" style="padding:0;Margin:0;width:300px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr style="border-collapse:collapse">
                                                                                    <td align="right" style="padding:0;Margin:0;font-size:0px"><a href="https://bca.id/2XvhKIV" style="text-decoration:underline;color:#ffffff;font-size:12px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://bca.id/2XvhKIV&amp;source=gmail&amp;ust=1735920333436000&amp;usg=AOvVaw2lmM60r015DwFUUycOiWQY"><img src="https://ci3.googleusercontent.com/meips/ADKq_NZBuHSn8Ht8Cb5-JmQkb0e3uXH1Ie7fEGbmvyWD9BjOVp6Fw_1qxHIKS5lhrAvQLBBflpg0riUvBtiyGTyOL0bDD2ich0FJWBiO73sSgav9-pxdiOwFMEux0kmoqYJlPbwv6yVlTWug6G-T_6g1fqXtywFza-woWm-DFuL6VlPcjU4IW4W5KAOUJ6veJava8gpy-w=s0-d-e1-ft#https://ahxnz.stripocdn.email/content/guids/CABINET_87f201c65c904922f777b5e6ee3cb8b5/images/icon_informasi_bca_202211_eiK.png" alt="" style="display:block;border:0;outline:none;text-decoration:none" height="40" width="145" class="CToWUd" data-bit="iit"></a></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td style="padding:0;Margin:0;width:20px"></td>
                                                    <td valign="top" style="padding:0;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" align="right" style="border-collapse:collapse;border-spacing:0px;float:right">
                                                            <tbody>
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="left" style="padding:0;Margin:0;width:280px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr style="border-collapse:collapse">
                                                                                    <td align="left" style="padding:0;Margin:0;font-size:0px"><a href="mailto:halobca@bca.co.id" style="text-decoration:underline;color:#ffffff;font-size:12px" target="_blank"><img src="https://ci3.googleusercontent.com/meips/ADKq_NZs02V3noOU2g49S-pOakLvtsmnNYFIwwFV6-LoGTzKdxw5Jlkynoq2tX7WIUdCk2z4GSbRtLvmjbTIXsW53YKsWkI--fiG2eUn3LgPWmqFPBRZHGYjNNLiusqLS0-txD-p6b59D8Wb0LEev1CBdpcsCbeCPDMTRpL6W9FThs3ilOxo6981S0HmP6QqWzqJ=s0-d-e1-ft#https://ahxnz.stripocdn.email/content/guids/CABINET_87f201c65c904922f777b5e6ee3cb8b5/images/icon_informasi_bca_202212.png" alt="" style="display:block;border:0;outline:none;text-decoration:none" width="159" height="40" class="CToWUd" data-bit="iit"></a></td>
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
                                <tr style="display:none;float:left;overflow:hidden;width:0;max-height:0;line-height:0;border-collapse:collapse">
                                    <td align="left" style="padding:0;Margin:0;padding-top:5px">
                                        <table cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0px;width:600px">
                                            <tbody>
                                                <tr style="border-collapse:collapse">
                                                    <td valign="top" style="padding:0;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse;border-spacing:0px;float:left">
                                                            <tbody>
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="left" style="padding:0;Margin:0;width:290px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr style="border-collapse:collapse">
                                                                                    <td align="right" style="padding:0;Margin:0;font-size:0px"><a href="https://www.bca.co.id/id/Individu/layanan/Customer-Service/HaloBCA#download" style="text-decoration:underline;color:#ffffff;font-size:12px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://www.bca.co.id/id/Individu/layanan/Customer-Service/HaloBCA%23download&amp;source=gmail&amp;ust=1735920333436000&amp;usg=AOvVaw1en4fJ-Q9Tij4gyIsbRxhk"><img src="https://ci3.googleusercontent.com/meips/ADKq_Nb5t0XrniN9ti4qG2j5EuTyfNu9tubyT3jbx1umQYkzTaZyQcDEXoL0iSbmI5uzsf0kXEPpwuWbjCrzz0vSoZG8d8Suq7R9L08H8gP42m5BGI7TcC-gcf3NRgZmgQd4jb4uP1ULdp4HgN4ctc05ryXV_FZqUXib3sy6AwHMlNQp19NzNHKW_4_0P-Km6s3gShwFrw=s0-d-e1-ft#https://ahxnz.stripocdn.email/content/guids/CABINET_87f201c65c904922f777b5e6ee3cb8b5/images/icon_informasi_bca_202209_jHL.png" alt="" style="display:block;border:0;outline:none;text-decoration:none" height="35" width="127" class="CToWUd" data-bit="iit"></a></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td style="padding:0;Margin:0;width:20px"></td>
                                                    <td valign="top" style="padding:0;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" align="right" style="border-collapse:collapse;border-spacing:0px;float:right">
                                                            <tbody>
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="left" style="padding:0;Margin:0;width:290px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr style="border-collapse:collapse">
                                                                                    <td align="left" style="padding:0;Margin:0;font-size:0px"><a href="tel:1500888" style="text-decoration:underline;color:#ffffff;font-size:12px" target="_blank"><img src="https://ci3.googleusercontent.com/meips/ADKq_NavzW6lsKUGmvqgXgNKWM-1g16klPX4H_QQ-aP3wc2CDHCPmqusBq0fre7kIRdgVTCMnTunXx-g7qHrENn1mygyxLftOgEtrc59nuUEZn02AK3HXYxiIWLJ3ThCNp4i7Fm-IYTBiy8k7N5q6ivnuuPPtaIqEhDXwhXLoA8rM-D-ltPQ1Z1_807AinubKqTy=s0-d-e1-ft#https://ahxnz.stripocdn.email/content/guids/CABINET_87f201c65c904922f777b5e6ee3cb8b5/images/icon_informasi_bca_202210.png" alt="" style="display:block;border:0;outline:none;text-decoration:none" height="35" width="139" class="CToWUd" data-bit="iit"></a></td>
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
                                <tr style="display:none;float:left;overflow:hidden;width:0;max-height:0;line-height:0;border-collapse:collapse">
                                    <td align="left" style="padding:0;Margin:0;padding-top:5px">
                                        <table cellpadding="0" cellspacing="0" style="border-collapse:collapse;border-spacing:0px;width:600px">
                                            <tbody>
                                                <tr style="border-collapse:collapse">
                                                    <td valign="top" style="padding:0;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" align="left" style="border-collapse:collapse;border-spacing:0px;float:left">
                                                            <tbody>
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="left" style="padding:0;Margin:0;width:290px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr style="border-collapse:collapse">
                                                                                    <td align="right" style="padding:0;Margin:0;font-size:0px"><a href="https://bca.id/2XvhKIV" style="text-decoration:underline;color:#ffffff;font-size:12px" target="_blank" data-saferedirecturl="https://www.google.com/url?q=https://bca.id/2XvhKIV&amp;source=gmail&amp;ust=1735920333436000&amp;usg=AOvVaw2lmM60r015DwFUUycOiWQY"><img src="https://ci3.googleusercontent.com/meips/ADKq_NZBuHSn8Ht8Cb5-JmQkb0e3uXH1Ie7fEGbmvyWD9BjOVp6Fw_1qxHIKS5lhrAvQLBBflpg0riUvBtiyGTyOL0bDD2ich0FJWBiO73sSgav9-pxdiOwFMEux0kmoqYJlPbwv6yVlTWug6G-T_6g1fqXtywFza-woWm-DFuL6VlPcjU4IW4W5KAOUJ6veJava8gpy-w=s0-d-e1-ft#https://ahxnz.stripocdn.email/content/guids/CABINET_87f201c65c904922f777b5e6ee3cb8b5/images/icon_informasi_bca_202211_eiK.png" alt="" style="display:block;border:0;outline:none;text-decoration:none" height="35" width="127" class="CToWUd" data-bit="iit"></a></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                    <td style="padding:0;Margin:0;width:20px"></td>
                                                    <td valign="top" style="padding:0;Margin:0">
                                                        <table cellpadding="0" cellspacing="0" align="right" style="border-collapse:collapse;border-spacing:0px;float:right">
                                                            <tbody>
                                                                <tr style="border-collapse:collapse">
                                                                    <td align="left" style="padding:0;Margin:0;width:290px">
                                                                        <table cellpadding="0" cellspacing="0" width="100%" style="border-collapse:collapse;border-spacing:0px">
                                                                            <tbody>
                                                                                <tr style="border-collapse:collapse">
                                                                                    <td align="left" style="padding:0;Margin:0;font-size:0px"><a href="mailto:halobca@bca.co.id" style="text-decoration:underline;color:#ffffff;font-size:12px" target="_blank"><img src="https://ci3.googleusercontent.com/meips/ADKq_NZs02V3noOU2g49S-pOakLvtsmnNYFIwwFV6-LoGTzKdxw5Jlkynoq2tX7WIUdCk2z4GSbRtLvmjbTIXsW53YKsWkI--fiG2eUn3LgPWmqFPBRZHGYjNNLiusqLS0-txD-p6b59D8Wb0LEev1CBdpcsCbeCPDMTRpL6W9FThs3ilOxo6981S0HmP6QqWzqJ=s0-d-e1-ft#https://ahxnz.stripocdn.email/content/guids/CABINET_87f201c65c904922f777b5e6ee3cb8b5/images/icon_informasi_bca_202212.png" alt="" style="display:block;border:0;outline:none;text-decoration:none" height="35" width="139" class="CToWUd" data-bit="iit"></a></td>
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
                                                                    Wisdil merupakan jasa penjualan dan pembelian tiket secara online</td>
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
        <div class="yj6qo"></div>
        <div class="adL">
        </div>
    </div>
    <div class="adL">
    </div>
</div>