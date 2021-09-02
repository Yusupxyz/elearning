<!--
@Project: Learnify
@Programmer: Syauqi Zaidan Khairan Khalaf
@Website: https://linktr.ee/syauqi
@nis : syaokay@gmail.com

@About-Learnify :
Web Edukasi Open Source yang dibuat oleh Syauqi Zaidan Khairan Khalaf.
Learnify adalah Web edukasi yang dilengkapi video, materi dan sistem ujian
yang tersedia secara gratis. Learnify dibuat ditujukan agar para siswa dan
guru dapat terus Mengerjakan dan mengajar dimana saja dan kapan saja.
-->

<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= base_url('assets/') ?>img/icon_smansa.png" type="image/png">
    <title>Selamat Mengerjakan - <?php
                                $data['user'] = $this->db->get_where('siswa', ['nis' =>
                                $this->session->userdata('nis')])->row_array();
                                echo $data['user']['nama'];
                                ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/linericon/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/owl-carousel/owl.carousel.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/lightbox/simpleLightbox.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/nice-select/css/nice-select.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/animate-css/animate.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>vendors/popup/magnific-popup.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/responsive.css">
    <link rel="stylesheet" href="<?= base_url('assets/') ?>css/materi_style.css">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Library -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.4/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/afterglowplayer@1.x"></script>

</head>

<body style="overflow-x:hidden;background-color:#fbf9fa">

    <!-- Start Navigation Bar -->
    <header class="header_area" style="background-color: white !important;">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href=""><img src="<?= base_url('assets/') ?>img/logo_smansa.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item "><a class="nav-link" href="javascript:void(0)">Hai, <?php
                                                                                                        $data['user'] = $this->db->get_where('siswa', ['nis' =>
                                                                                                        $this->session->userdata('nis')])->row_array();
                                                                                                        echo $data['user']['nama'];
                                                                                                        ?></a>
                            </li>
                            <li class="nav-item active"><a class="nav-link" href="<?= base_url('user') ?>">Beranda</a>
                            </li>
                            <li class="nav-item active"><a class="nav-link" href="<?= base_url('user/tugas') ?>">Tugas</a>
                            </li>
                            <li class=" nav-item "><a class=" nav-link text-danger" href="<?= base_url('welcome/logout') ?>">Log Out</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <!-- End Navigation Bar -->


    <!-- Start Greeting Cards -->
    <div class="container">
        <div class="bg-white mx-auto p-4 buat-text" data-aos="fade-down" data-aos-duration="1400" style="width: 100%; border-radius:10px;">
            <div class="row" style="color: black; font-family: 'poppins';">
                <div class="col-md-6 mt-1 ">
                    <h1 class="display-4" style="color: black; font-family:'poppins';" data-aos="fade-down" data-aos-duration="1400">Selamat Mengerjakan !
                    </h1>
                    <h4 data-aos="fade-down" data-aos-duration="1700"><?php
                                                                        $data['user'] = $this->db->get_where('siswa', ['nis' =>
                                                                        $this->session->userdata('nis')])->row_array();
                                                                        echo $data['user']['nama'];
                                                                        ?> - Learnify Students</h3>
                        <p><?= $detail->mapel ?> - Kelas <?= $detail->kelas ?></p>
                        <hr align="left" width="600;">
                        <p style="line-height: 3px;">Judul Tugas</p>
                        <p class="font-weight-bold mt--5">
                            <?= $detail->judul ?>

                        </p>
                        <p class="font-weight-bold mt--5">
                            <?= $detail->info ?>

                        </p>
                        <hr align="left" width="600;">
                        <p style="line-height: 3px;">Waktu Pengerjaan</p>
                        <p class="font-weight-bold mt--5">
                            <?= $detail->durasi ?> menit

                        </p>
                </div>
                <div class="col-md-6 mt-1">
                <div id='timer'></div>

                </div>
            </div>
        </div>
    </div>
    <!-- End Greeting Cards -->

    <!-- Start Deskripsi Materi -->
    <div class="container bg-secondary">
        <div class="row mt-4">
            <div class="col-md-12 w-150 mb-4">
    <h3><b>Tugas Pilihan Ganda</b></h3>
   
        <div style='width:100%; border: 1px solid #EBEBEB; overflow:scroll;height:700px;'>
        <table width="100%" border="0">

     
            <form id="frmSoal"  method="post" action="../jawab/<?= $id ?>">
            <?php $i=1; echo $_SESSION['mulai'];
 foreach ($pertanyaan as $key => $value) { 
                $pertanyaan=str_replace("</p>","",str_replace("<p>","",$value->pertanyaan));
                ?>
            <tr>
                  <td width="17"><font color="#000000"><?php echo $i++.'.'; ?></font></td>
                  <td width="430"><font color="#000000"><?php echo $pertanyaan; ?></font></td>
            </tr>
            <?php foreach ($pilihan[$value->tugas_pertanyaan] as $key => $value2) { 
                $konten=str_replace("</p>","",str_replace("<p>","",$value2->konten));
                ?>
            <tr>
                <td height="21"><font color="#000000">&nbsp;</font></td>
                <td style="display:inline-block" ><font color="#000000">
                    <?= $value2->urutan ?>.  <input name="pilihan[<?= $value2->pertanyaan_id ?>]" type="radio" value="<?= $value2->urutan ?>"> 
                <?= $konten ?></font> </td>
            </tr>
           
            
            <?php } ?>
            <input name="pilihan[<?= $value2->pertanyaan_id ?>]" type="radio" value="" checked style="display:none"> 

        <?php }?>
                
            <tr>
                <td>&nbsp;</td>
                  <td><br>
                  <!-- <button type="submit" name="submit" id="submit">Submit</button> -->

                  <input class="btn btn-danger" type="submit" value="Simpan" onclick="return confirm('Apakah Anda yakin dengan jawaban Anda?')"></td>
            </tr>
            </from>
            </table>
</form>
        </p>
</div>
            </div>
        </div>
    </div>
    <!-- End Deskripsi Materi -->


    <br>


    <br>
    <br>
    <br>


    <!-- Start Animate On Scroll -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
        <script src="http://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>

     <!-- Script Timer -->
     <script type="text/javascript">
        $(document).ready(function() {

            /** Membuat Waktu Mulai Hitung Mundur Dengan 
                * var detik;
                * var menit;
                * var jam;
            */
            var detik   = <?= $detik; ?>;
            var menit   = <?= $menit; ?>;
            var jam     = <?= $jam; ?>;
                  
            /**
               * Membuat function hitung() sebagai Penghitungan Waktu
            */
            function hitung() {
                /** setTimout(hitung, 1000) digunakan untuk 
                     * mengulang atau merefresh halaman selama 1000 (1 detik) 
                */
                setTimeout(hitung,1000);
  
                /** Jika waktu kurang dari 10 menit maka Timer akan berubah menjadi warna merah */
                if(menit < 10 && jam == 0){
                    var peringatan = 'style="color:red"';
                };
  
                /** Menampilkan Waktu Timer pada Tag #Timer di HTML yang tersedia */
                $('#timer').html(
                    '<h1 align="center"'+peringatan+'>Sisa waktu anda <br />' + jam + ' jam : ' + menit + ' menit : ' + detik + ' detik</h1><hr>'
                );
  
                /** Melakukan Hitung Mundur dengan Mengurangi variabel detik - 1 */
                detik --;
  
                /** Jika var detik < 0
                    * var detik akan dikembalikan ke 59
                    * Menit akan Berkurang 1
                */
                if(detik < 0) {
                    detik = 59;
                    menit --;
  
                   /** Jika menit < 0
                        * Maka menit akan dikembali ke 59
                        * Jam akan Berkurang 1
                    */
                    if(menit < 0) {
                        menit = 59;
                        jam --;
  
                        /** Jika var jam < 0
                            * clearInterval() Memberhentikan Interval dan submit secara otomatis
                        */
                             
                        if(jam < 0) { 
                            clearInterval(hitung); 
                            /** Variable yang digunakan untuk submit secara otomatis di Form */
                            var frmSoal = document.getElementById("frmSoal"); 
                            alert('Waktu Anda telah habis! Jawaban Anda otomatis tersimpan.');
                            frmSoal.submit(); 
                        } 
                    } 
                } 
            }           
            /** Menjalankan Function Hitung Waktu Mundur */
            hitung();
        });
    </script>
    <!-- End Animate On Scroll -->