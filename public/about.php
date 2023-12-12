<?php
include '../proses/header.php';
?>

<style>
    /* Add this CSS to enhance the style of the About Us section */
    #about {
        position: relative;
        z-index: 1;
        background-color: #f7f6f2;
        margin-bottom: 40px;
    }

    .hero-wrap {
        position: relative;
        background-size: cover;
        background-position: center center;
        height: 500px;
        /* Adjust the height as needed */
    }

    .hero-wrap h1.bread {
        font-size: 80px;
        font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        color: #618264;
        margin-top: 200px;
    }

    .wrap-about h2 {
        color: #333;
    }


    @media (max-width: 767px) {
        .hero-wrap {
            height: 300px;
        }

        .hero-wrap h1 {
            font-size: 100px;
            color: black;
        }

        .section-lg .row-50 {
            margin-bottom: 50px;
            margin-top: 100px;
        }

    }
</style>

<section id="about">
    <div class="hero-wrap hero-bread" style="background-image: url('../assets/image/bg_2.jpg');">
        <div class="row no-gutters slider-text align-items-center justify-content-center">
            <div class="col-md-9 ftco-animate text-center">
                <h1 class="mb-0 bread">About us</h1>
            </div>
        </div>
    </div>
    </div>
</section>

<section class="section section-lg ">
    <div class="container">
        <div class="row row-50 justify-content-center justify-content-lg-between flex-lg-row-reverse">
            <div class="col-lg-6 col-xl-5">
                <div class="inset-right-3">
                    <h3 spellcheck="false" data-ms-editor="true">Selamat Datang di TOMASS</h3>
                    <p spellcheck="false" data-ms-editor="true">Halo !! Kami dengan antusias menyambut kunjungan Anda
                        di TOMASS. Apa itu TOMASS? TOMASSS adalah singkatan dari Toko Bahan Kue Management and Sales
                        System&nbsp;yang merupakan sebuah e-Commerce untuk memenuhi segala kebutuhan Anda dalam dunia
                        penciptaan kue dan kreasi lainnya.</p>
                    <p spellcheck="false" data-ms-editor="true">Sejak tahun 2015, kami telah berkomitmen untuk
                        menyediakan produk yang berkualitas dan pelayanan yang memuaskan bagi konsumen. Kami memahami
                        bahwa keberhasilan setiap kreasi dimulai dari bahan-bahan berkualitas. Oleh karena itu, kami
                        menyedian beragam pilihan produk terbaik sehingga dapat membantu mewujudkan setiap kreasi Anda
                        dengan mudah. Terima kasih telah memberikan kepercayaan pada toko kami sebagai
                        pendamping&nbsp;Anda&nbsp;berkreasi.</p><a class="btn btn-success"
                        href="../public/index.php">Belanja Sekarang</a>

                </div>
            </div>
            <div class="col-lg-6"><img class="img-responsive" src="../assets/image/tokoDepan.jpg" alt="" width="570"
                    height="368"></div>
        </div>
    </div>
</section>
<br>

<section class="section section-sm" style="background-image: none; background-color: rgb(247, 246, 242);">
    <div class="container">
        <br>
        <div class="row d-flex mb-5 contact-info">
            <div class="w-100"></div>
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                    <p><span>Address:</span> Jl.Raya Kesamben</p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                    <p><span>Wa :</span> <a href="https://wa.me/qr/BM3RGQWY2TUEE1">+ 085 781 937 953</a></p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                    <p><span>Email:</span> <a href="mailto:info@yoursite.com">Tomass@gmail.com</a></p>
                </div>
            </div>
            <div class="col-md-3 d-flex">
                <div class="info bg-white p-4">
                    <p><span>Instagram:</span> <a
                            href="https://instagram.com/berrusaha.team?igshid=MzMyNGUyNmU2YQ==">Berrusaha Team</a></p>
                </div>
            </div>
        </div>
        <br>
        <div class="col-md-12 d-flex">
            <iframe style="border:0; width: 100%; height: 600px;"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5758.618707327627!2d112.33794452080443!3d-7.4610997315360255!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7813f71230c46f%3A0xc4762918b7cfd121!2sPasar%20Desa%20Kesamben!5e0!3m2!1sid!2sid!4v1683894465861!5m2!1sid!2sid"
                frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
</section>
 <script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<?php
include '../proses/footer.php';
?>