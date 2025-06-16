@extends('layouts.app')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@section('title', 'Homepage')

@section('content')
<section id="text-intro-section" class="parallax" data-stellar-background-ratio="0.5" style="background-image: url(/assets/img/bg-healthycare.png);">
    <div class="container h-100">
      <div class="caption">
        <h1>Selamat Datang di HealthyCare</h1>
        <h2>Your Health, Our Priority</h2>
      </div>
    </div>
  </section>

  <section id="about">
    <div class="container h-100">
      <h2>Tentang Kami</h2>
      <div id="content-about">
        <p>Klinik HealthyCare adalah fasilitas kesehatan yang didedikasikan untuk memberikan layanan medis berkualitas bagi masyarakat. Dengan tim tenaga medis profesional dan peralatan modern, Klinik HealthyCare bertujuan untuk memenuhi kebutuhan kesehatan Anda dan keluarga secara komprehensif. Klinik ini memiliki beberapa layanan poliklinik unggulan, yaitu:</p>
        
        <b>1. Poli Umum</b>
        <p>Poli Umum di Klinik HealthyCare melayani pemeriksaan kesehatan umum, baik untuk keluhan ringan maupun untuk pemeriksaan rutin. Dokter umum yang berpengalaman akan membantu mendiagnosis, mengobati, dan memberikan saran kesehatan yang sesuai. Poli Umum juga menyediakan layanan seperti tes kesehatan, pemeriksaan tekanan darah, penanganan infeksi, dan pengobatan penyakit akut maupun kronis.</p>
    
        <b>2. Poli Gigi</b>
        <p>Poli Gigi kami dilengkapi dengan peralatan gigi yang canggih untuk memastikan setiap pasien mendapatkan perawatan gigi dan mulut terbaik. Layanan Poli Gigi meliputi pemeriksaan rutin, pembersihan gigi, perawatan gigi berlubang, pencabutan, pemasangan gigi palsu, hingga prosedur estetika seperti pemutihan gigi. Dengan dokter gigi yang terampil dan lingkungan yang nyaman, kami berkomitmen menjaga kesehatan gigi dan mulut Anda.</p>
    
        <b>3. Poli Ibu dan Anak</b>
        <p>Poli Ibu dan Anak di Klinik HealthyCare memberikan perhatian khusus pada kesehatan ibu hamil, ibu menyusui, serta anak-anak dari usia bayi hingga remaja. Layanan ini meliputi pemeriksaan kehamilan, konsultasi laktasi, imunisasi anak, dan pemantauan tumbuh kembang anak. Dengan tenaga medis yang ramah dan peduli, Poli Ibu dan Anak membantu memastikan kesehatan optimal bagi ibu dan anak dalam setiap tahap perkembangan.</p>
    
        <p>Klinik HealthyCare berkomitmen untuk memberikan pengalaman medis yang nyaman, aman, dan penuh perhatian bagi setiap pasien. Kami memahami betapa pentingnya kesehatan Anda dan keluarga, dan kami ada untuk mendukung Anda dengan layanan terbaik.</p>
      </div>
    </div>
  </section>
  

  <section id="service">
    <div class="container h-100">
      <h2>Fasilitas dan Layanan</h2>
      
      <!-- Layanan Section -->
      <div class="section" id="layanan">
        <h2>Layanan</h2>
        <div class="card-group">
          <div class="card">
            <img src="assets/img/foto1.jpg" class="card-img-top img-fluid" alt="Ekokardiografi">
            <div class="card-body">
              <h5 class="card-title">Ekokardiografi</h5>
              <p class="card-text">Ekokardiografi adalah pemeriksaan menggunakan gelombang ultrasound untuk melihat gambaran struktur.</p>
            </div>       
          </div>
  
          <div class="card">
            <img src="assets/img/foto2.jpeg" class="card-img-top img-fluid" alt="Elektromiografi (EMG)">
            <div class="card-body">
              <h5 class="card-title">Elektromiografi (EMG)</h5>
              <p class="card-text">Elektromiografi (EMG) adalah tes untuk memeriksa kondisi otot dan sel-sel saraf yang mengontrolnya (neuron motorik).</p>
            </div>          
          </div>
          
          <div class="card">
            <img src="assets/img/foto3.jpeg" class="card-img-top img-fluid" alt="EEG">
            <div class="card-body">
              <h5 class="card-title">EEG</h5>
              <p class="card-text">Electroencephalography (EEG) berfungsi untuk mempelajari gambar dari rekaman aktivitas listrik di otak.</p>
            </div>  
          </div>
        </div>
      </div>
  
      <!-- Fasilitas Section -->
      <div class="section" id="fasilitas">
        <h2>Fasilitas</h2>
        <div class="card-group">
          <div class="card">
            <img src="assets/img/fotofasilitas1.jpeg" class="card-img-top img-fluid" alt="Fasilitas Ekokardiografi">
            <div class="card-body">
              <h5 class="card-title">Ekokardiografi</h5>
              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nostrum maxime quia obcaecati, id facere maiores vero ea ratione magnam in non cupiditate ut ipsum unde voluptate nihil. Nisi, necessitatibus earum.</p>
            </div>
          </div>
  
          <div class="card">
            <img src="assets/img/fotofasilitas2.jpeg" class="card-img-top img-fluid" alt="Fasilitas Elektromiografi (EMG)">
            <div class="card-body">
              <h5 class="card-title">Elektromiografi (EMG)</h5>
              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque sed iusto, deserunt magni debitis excepturi impedit fuga, doloremque doloribus, sit cupiditate labore? Nemo nihil veritatis rem distinctio facilis explicabo labore?</p>
            </div>          
          </div>
          
          <div class="card">
            <img src="assets/img/fotofasilitas3.jpg" class="card-img-top img-fluid" alt="Fasilitas EEG">
            <div class="card-body">
              <h5 class="card-title">EEG</h5>
              <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolores quia, enim alias iste impedit porro earum itaque dolore. Facilis placeat quam reprehenderit praesentium libero quos alias odit aliquam voluptates dolore?</p>
            </div>   
          </div>
        </div>
      </div>
    </div>
  </section>
  

  <section id="contact">
    <div class="container h-100">
      <h2>Kontak Kami</h2><br>
      <div class="d-grid" style="grid-template-columns: 1fr 1fr; gap: 10px;">
        <div id="content">
          <h3>Hubungi Kami</h3>
          <p>Untuk mendapatkan info lebih lanjut anda bisa hubungi kami melalui</p>
          <ul>
            <li><b>Telepon:</b> +62 812 3456 7890</li>
            <li><b>Email:</b> info@healthycareclinic.com</li>
            <li><b>Alamat:</b> Jl. Sehat No. 123, Sukapura, Bandung, Jawa Barat, Indonesia</li>
          </ul>
          <h4>Kritik & Saran</h4>
          <form action="#" method="POST">
            <div>
              <label for="name">Nama:</label>
              <input type="text" id="name" name="name" required placeholder="Masukkan Nama Anda">
            </div>
            <div>
              <label for="email">Email:</label>
              <input type="email" id="email" name="email" required placeholder="Masukkan Email Anda">
            </div>
            <div>
              <label for="subject">Subjek:</label>
              <input type="text" id="subject" name="subject" required placeholder="Masukkan Subjek">
            </div>
            <div>
              <label for="message">Pesan:</label>
              <textarea id="message" name="message" required placeholder="Tulis pesan Anda"></textarea>
            </div>
            <button type="submit">Kirim</button>
          </form>
        </div>
        <div id="map">
          <iframe 
            src="https://maps.google.com/maps?q=-6.973064,107.630347&t=&z=13&ie=UTF8&iwloc=&output=embed" 
            allowfullscreen="" 
            loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </section>  
@endsection
