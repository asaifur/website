  <section id="beranda" class="relative bg-darkGray text-white py-16 lg:py-24 overflow-hidden border-b-4 border-primary">
      <div class="absolute inset-0 bg-cover bg-center opacity-15" style="background-image: url('https://images.unsplash.com/photo-1556910103-1c02745aae4d?q=80&w=1920&auto=format&fit=crop');"></div>
      <div class="absolute inset-0 bg-gradient-to-r from-navy via-darkGray/90 to-transparent"></div>

      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">

          <!-- Left Info Copy -->
          <div class="lg:col-span-7 space-y-6 text-center lg:text-left animate__animated animate__fadeInLeft">
              <div class="inline-flex items-center gap-2 bg-primary/20 border border-primary/40 px-3 py-1.5 rounded-full text-red-400 font-semibold text-xs tracking-wide uppercase">
                  <i class="fa-solid fa-shield-halved"></i> Standar SNI & Food Grade SUS 304
              </div>
              <h1 class="text-3xl sm:text-4xl md:text-5xl font-black uppercase tracking-tight leading-tight">
                  Mitra Terpercaya <span class="text-red-500">Instalasi & Fabrikasi</span> Dapur Komersial
              </h1>
              <p class="text-gray-300 text-base sm:text-lg max-w-2xl leading-relaxed">
                  Spesialis Ducting Exhaust System, Fresh Air, Jaringan Gas Komersial, dan Fabrikasi Stainless Steel Kustom untuk Restoran, Hotel, Catering, dan Cloud Kitchen di seluruh Indonesia.
              </p>

              <!-- Quick Bullet Highlights -->
              <div class="grid grid-cols-2 sm:grid-cols-3 gap-4 pt-2 text-left">
                  <div class="flex items-center space-x-2 text-sm text-gray-200">
                      <i class="fa-solid fa-circle-check text-primary"></i>
                      <span>Desain CAD Layout</span>
                  </div>
                  <div class="flex items-center space-x-2 text-sm text-gray-200">
                      <i class="fa-solid fa-circle-check text-primary"></i>
                      <span>Ducting & Blower</span>
                  </div>
                  <div class="flex items-center space-x-2 text-sm text-gray-200">
                      <i class="fa-solid fa-circle-check text-primary"></i>
                      <span>Safety Gas Pipeline</span>
                  </div>
                  <div class="flex items-center space-x-2 text-sm text-gray-200">
                      <i class="fa-solid fa-circle-check text-primary"></i>
                      <span>Kustom Kwali Range</span>
                  </div>
                  <div class="flex items-center space-x-2 text-sm text-gray-200">
                      <i class="fa-solid fa-circle-check text-primary"></i>
                      <span>Garansi Operasional</span>
                  </div>
                  <div class="flex items-center space-x-2 text-sm text-gray-200">
                      <i class="fa-solid fa-circle-check text-primary"></i>
                      <span>Tim Bersertifikat</span>
                  </div>
              </div>

              <div class="pt-4 flex flex-wrap justify-center lg:justify-start gap-4">
                  <a href="#layanan" class="border-2 border-white/80 hover:bg-white hover:text-navy text-white px-6 py-3 rounded font-bold text-sm tracking-wider uppercase transition">
                      Eksplor Layanan
                  </a>
                  <a href="<?= $domain->wa_link ?>" target="_blank" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded font-bold text-sm tracking-wider uppercase transition flex items-center gap-2">
                      <i class="fa-brands fa-whatsapp text-lg"></i> Chat WhatsApp
                  </a>
              </div>
          </div>

          <!-- Right Hero Lead Form -->
          <div id="konsultasi" class="lg:col-span-5 animate__animated animate__fadeInRight animate__delay-1s">
              <div class="bg-white rounded-lg p-6 sm:p-8 text-slate-800 shadow-2xl border-t-4 border-primary">
                  <div class="mb-5">
                      <span class="text-xs font-bold uppercase tracking-wider text-primary">Mulai Proyek Anda</span>
                      <h3 class="text-2xl font-black text-navy uppercase">Konsultasi & Estimasi</h3>
                      <p class="text-xs text-gray-500 mt-1">Dapatkan layout awal dan estimasi kebutuhan dapur Anda.</p>
                  </div>

                  <form class="space-y-4">
                      <div>
                          <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nama Lengkap / PIC *</label>
                          <input type="text" placeholder="Contoh: Budi Santoso" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none transition" required>
                      </div>
                      <div>
                          <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Nomor WhatsApp *</label>
                          <input type="tel" placeholder="0812-xxxx-xxxx" class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none transition" required>
                      </div>
                      <div>
                          <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Jenis Layanan / Kebutuhan *</label>
                          <select class="w-full px-3 py-2.5 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none bg-white transition">
                              <option>Jasa Instalasi Gas Komersil</option>
                              <option>Instalasi & Fabrikasi Ducting Exhaust</option>
                              <option>Instalasi & Fabrikasi Fresh Air</option>
                              <option>Peralatan Custom Dapur Restoran</option>
                              <option>Paket Full Kitchen Setup (Desain & Pasang)</option>
                              <option>Maintenance & Emergency Repair</option>
                          </select>
                      </div>
                      <div>
                          <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Pesan / Lokasi Proyek</label>
                          <textarea rows="3" placeholder="Deskripsikan luas dapur atau lokasi usaha Anda..." class="w-full px-3 py-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"></textarea>
                      </div>
                      <button type="submit" class="w-full bg-primary hover:bg-primaryDark text-white py-3 rounded font-bold text-sm tracking-wider uppercase shadow-md hover:shadow-lg transition">
                          Kirim Permintaan Konsultasi
                      </button>
                  </form>
              </div>
          </div>

      </div>
  </section>

  <!-- Stats Counter Bar -->
  <section class="bg-navy text-white py-8 border-b border-slate-800">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
          <div class="border-r border-slate-700/50 last:border-0 reveal" data-animate="animate__fadeInUp">
              <span class="block text-3xl sm:text-4xl font-extrabold text-primary">500+</span>
              <span class="text-xs uppercase tracking-wider text-gray-300 font-medium">Proyek Sukses</span>
          </div>
          <div class="border-r border-slate-700/50 last:border-0 reveal" data-animate="animate__fadeInUp">
              <span class="block text-3xl sm:text-4xl font-extrabold text-primary">100%</span>
              <span class="text-xs uppercase tracking-wider text-gray-300 font-medium">Food Grade SUS 304</span>
          </div>
          <div class="border-r border-slate-700/50 last:border-0 reveal" data-animate="animate__fadeInUp">
              <span class="block text-3xl sm:text-4xl font-extrabold text-primary">SNI</span>
              <span class="text-xs uppercase tracking-wider text-gray-300 font-medium">Standar Safety Gas</span>
          </div>
          <div class="reveal" data-animate="animate__fadeInUp">
              <span class="block text-3xl sm:text-4xl font-extrabold text-primary">24/7</span>
              <span class="text-xs uppercase tracking-wider text-gray-300 font-medium">Emergency Response</span>
          </div>
      </div>
  </section>

  <!-- About Section -->
  <section id="tentang" class="py-20 bg-white overflow-hidden">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
              <div class="relative reveal" data-animate="animate__fadeInLeft">
                  <img src="https://images.unsplash.com/photo-1578474846511-04ba529f0b88?q=80&w=900&auto=format&fit=crop" alt="Commercial Kitchen Installation" class="rounded-lg shadow-xl w-full h-[420px] object-cover">
                  <div class="absolute -bottom-6 -right-6 bg-primary text-white p-6 rounded shadow-lg hidden sm:block">
                      <span class="block text-3xl font-black">All-in-One</span>
                      <span class="text-xs uppercase tracking-wider font-semibold">Kitchen Solution Partner</span>
                  </div>
              </div>

              <div class="space-y-5 reveal" data-animate="animate__fadeInRight">
                  <div class="inline-block text-xs font-bold text-primary tracking-widest uppercase">Tentang PT Solusi Dapur Restoran</div>
                  <h2 class="text-3xl sm:text-4xl font-black text-navy uppercase leading-tight">
                      Spesialis Rekayasa, Fabrikasi & Instalasi Dapur Standar Industri
                  </h2>
                  <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                      Kami adalah kontraktor spesialis dapur komersial terkemuka di Indonesia. Kami menangani seluruh siklus pembuatan dapur: mulai dari perencanaan tata letak (*workflow kitchen system*), fabrikasi peralatan stainless steel presisi, hingga pemasangan exhaust hood dan instalasi pipa gas bertekanan tinggi.
                  </p>
                  <p class="text-slate-600 text-sm sm:text-base leading-relaxed">
                      Setiap instalasi dikerjakan oleh teknisi bersertifikat demi menjamin kepatuhan higienitas, regulasi keselamatan kebakaran, efisiensi sirkulasi udara ruangan, dan durabilitas operasional jangka panjang.
                  </p>

                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-3">
                      <div class="flex items-start space-x-3">
                          <i class="fa-solid fa-check-double text-primary mt-1"></i>
                          <div>
                              <h4 class="font-bold text-sm text-navy">Presisi Pengerjaan</h4>
                              <p class="text-xs text-gray-500">Hasil las halus, simetris, dan kokoh tahan beban berat.</p>
                          </div>
                      </div>
                      <div class="flex items-start space-x-3">
                          <i class="fa-solid fa-check-double text-primary mt-1"></i>
                          <div>
                              <h4 class="font-bold text-sm text-navy">Sistem Udara Seimbang</h4>
                              <p class="text-xs text-gray-500">Exhaust dan Fresh Air terintegrasi agar suhu dapur tetap dingin.</p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <!-- Services Section -->
  <section id="layanan" class="py-20 bg-slate-100 border-t border-slate-200">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center max-w-3xl mx-auto mb-16 space-y-3 reveal" data-animate="animate__fadeInDown">
              <span class="text-xs font-bold text-primary uppercase tracking-widest">Layanan Terintegrasi</span>
              <h2 class="text-3xl sm:text-4xl font-black text-navy uppercase">Solusi Lengkap Dapur Komersial</h2>
              <div class="w-16 h-1 bg-primary mx-auto"></div>
              <p class="text-gray-600 text-sm">Dirancang untuk memenuhi standar restoran bintang lima, hotel, rumah sakit, dan waralaba makanan skala besar.</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

              <!-- Layanan 1: Jasa Instalasi Gas Komersil -->
              <div id="jasa-gas" class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col border border-gray-200 group reveal" data-animate="animate__fadeInUp">
                  <div class="h-44 overflow-hidden relative">
                      <img src="https://images.unsplash.com/photo-1581092160607-ee22621dd758?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                      <div class="absolute top-3 right-3 bg-navy text-white p-2 rounded-full w-9 h-9 flex items-center justify-center text-sm shadow">
                          <i class="fa-solid fa-fire-burner"></i>
                      </div>
                  </div>
                  <div class="p-5 flex-1 flex flex-col justify-between">
                      <div>
                          <span class="text-[10px] font-bold uppercase tracking-wider text-primary">Standar Migas & SNI</span>
                          <h3 class="text-base font-bold text-navy my-1 group-hover:text-primary transition">Jasa Instalasi Gas Komersil</h3>
                          <p class="text-gray-600 text-xs leading-relaxed mb-4">
                              Jalur pipa besi SCH 40 central manifold gas, automatic shut-off solenoid valve, regulator presisi, dan sistem deteksi kebocoran gas alarm.
                          </p>
                      </div>
                      <a href="#kontak" class="text-xs font-bold uppercase tracking-wider text-primary hover:text-primaryDark flex items-center gap-1">
                          Info Detail <i class="fa-solid fa-arrow-right"></i>
                      </a>
                  </div>
              </div>

              <!-- Layanan 2: Instalasi & Fabrikasi Ducting Exhaust -->
              <div id="jasa-exhaust" class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col border border-gray-200 group reveal" data-animate="animate__fadeInUp">
                  <div class="h-44 overflow-hidden relative">
                      <img src="https://images.unsplash.com/photo-1590725140246-20acceedc18b?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                      <div class="absolute top-3 right-3 bg-navy text-white p-2 rounded-full w-9 h-9 flex items-center justify-center text-sm shadow">
                          <i class="fa-solid fa-wind"></i>
                      </div>
                  </div>
                  <div class="p-5 flex-1 flex flex-col justify-between">
                      <div>
                          <span class="text-[10px] font-bold uppercase tracking-wider text-primary">Air Flow Engineering</span>
                          <h3 class="text-base font-bold text-navy my-1 group-hover:text-primary transition">Instalasi & Fabrikasi Ducting Exhaust</h3>
                          <p class="text-gray-600 text-xs leading-relaxed mb-4">
                              Hood stainless SUS 304 with grease filter, jalur ducting seng BJLS/PU, exhaust blower sentrifugal daya hisap tinggi tanpa asap pekat.
                          </p>
                      </div>
                      <a href="#kontak" class="text-xs font-bold uppercase tracking-wider text-primary hover:text-primaryDark flex items-center gap-1">
                          Info Detail <i class="fa-solid fa-arrow-right"></i>
                      </a>
                  </div>
              </div>

              <!-- Layanan 3: Instalasi & Fabrikasi Fresh Air -->
              <div id="jasa-freshair" class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col border border-gray-200 group reveal" data-animate="animate__fadeInUp">
                  <div class="h-44 overflow-hidden relative">
                      <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                      <div class="absolute top-3 right-3 bg-navy text-white p-2 rounded-full w-9 h-9 flex items-center justify-center text-sm shadow">
                          <i class="fa-solid fa-fan"></i>
                      </div>
                  </div>
                  <div class="p-5 flex-1 flex flex-col justify-between">
                      <div>
                          <span class="text-[10px] font-bold uppercase tracking-wider text-primary">Sirkulasi Bersih</span>
                          <h3 class="text-base font-bold text-navy my-1 group-hover:text-primary transition">Instalasi & Fabrikasi Fresh Air</h3>
                          <p class="text-gray-600 text-xs leading-relaxed mb-4">
                              Pemasok udara segar (Make-up Air) terfiltrasi untuk menjaga tekanan udara dapur tetap seimbang, sejuk, dan tidak panas pengap.
                          </p>
                      </div>
                      <a href="#kontak" class="text-xs font-bold uppercase tracking-wider text-primary hover:text-primaryDark flex items-center gap-1">
                          Info Detail <i class="fa-solid fa-arrow-right"></i>
                      </a>
                  </div>
              </div>

              <!-- Layanan 4: Peralatan Custom Dapur Restoran -->
              <div id="jasa-custom" class="bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 flex flex-col border border-gray-200 group reveal" data-animate="animate__fadeInUp">
                  <div class="h-44 overflow-hidden relative">
                      <img src="https://images.unsplash.com/photo-1541544741938-0af808871cc0?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                      <div class="absolute top-3 right-3 bg-navy text-white p-2 rounded-full w-9 h-9 flex items-center justify-center text-sm shadow">
                          <i class="fa-solid fa-cubes"></i>
                      </div>
                  </div>
                  <div class="p-5 flex-1 flex flex-col justify-between">
                      <div>
                          <span class="text-[10px] font-bold uppercase tracking-wider text-primary">Custom Fabrication</span>
                          <h3 class="text-base font-bold text-navy my-1 group-hover:text-primary transition">Peralatan Custom Dapur Restoran</h3>
                          <p class="text-gray-600 text-xs leading-relaxed mb-4">
                              Pembuatan custom Single/Double Kwali Range, Stock Pot, Meja Sink, Cabinet Table, Trolley, Bain Marie, hingga Grease Trap SUS 304.
                          </p>
                      </div>
                      <a href="#kontak" class="text-xs font-bold uppercase tracking-wider text-primary hover:text-primaryDark flex items-center gap-1">
                          Info Detail <i class="fa-solid fa-arrow-right"></i>
                      </a>
                  </div>
              </div>

          </div>
      </div>
  </section>

  <!-- Custom Products Showcase -->
  <section id="produk" class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 reveal" data-animate="animate__fadeIn">
              <div>
                  <span class="text-xs font-bold text-primary uppercase tracking-widest">Katalog Fabrikasi</span>
                  <h2 class="text-3xl font-black text-navy uppercase mt-1">Produk Stainless Steel Unggulan</h2>
              </div>
              <a href="#kontak" class="mt-4 md:mt-0 text-sm font-bold text-primary hover:text-primaryDark flex items-center gap-2">
                  Minta Katalog Lengkap <i class="fa-solid fa-arrow-right"></i>
              </a>
          </div>

          <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
              <!-- Item 1 -->
              <div class="p-5 bg-gray-50 rounded-lg border border-gray-200 hover:border-primary transition group reveal" data-animate="animate__zoomIn">
                  <div class="w-16 h-16 bg-red-100 text-primary mx-auto rounded-full flex items-center justify-center text-2xl mb-4 group-hover:bg-primary group-hover:text-white transition">
                      <i class="fa-solid fa-fire"></i>
                  </div>
                  <h4 class="font-bold text-navy text-sm sm:text-base">Double Kwali Range</h4>
                  <p class="text-xs text-gray-500 mt-1">Cast iron burner heavy duty with soup ring & faucet.</p>
              </div>

              <!-- Item 2 -->
              <div class="p-5 bg-gray-50 rounded-lg border border-gray-200 hover:border-primary transition group reveal" data-animate="animate__zoomIn">
                  <div class="w-16 h-16 bg-red-100 text-primary mx-auto rounded-full flex items-center justify-center text-2xl mb-4 group-hover:bg-primary group-hover:text-white transition">
                      <i class="fa-solid fa-sink"></i>
                  </div>
                  <h4 class="font-bold text-navy text-sm sm:text-base">Commercial Sink Table</h4>
                  <p class="text-xs text-gray-500 mt-1">Single / Double / Triple bowl SUS 304 food grade.</p>
              </div>

              <!-- Item 3 -->
              <div class="p-5 bg-gray-50 rounded-lg border border-gray-200 hover:border-primary transition group reveal" data-animate="animate__zoomIn">
                  <div class="w-16 h-16 bg-red-100 text-primary mx-auto rounded-full flex items-center justify-center text-2xl mb-4 group-hover:bg-primary group-hover:text-white transition">
                      <i class="fa-solid fa-drumstick-bite"></i>
                  </div>
                  <h4 class="font-bold text-navy text-sm sm:text-base">Lava Rock Charcoal Grill</h4>
                  <p class="text-xs text-gray-500 mt-1">Panggangan steak & BBQ aroma arang dengan cabinet.</p>
              </div>

              <!-- Item 4 -->
              <div class="p-5 bg-gray-50 rounded-lg border border-gray-200 hover:border-primary transition group reveal" data-animate="animate__zoomIn">
                  <div class="w-16 h-16 bg-red-100 text-primary mx-auto rounded-full flex items-center justify-center text-2xl mb-4 group-hover:bg-primary group-hover:text-white transition">
                      <i class="fa-solid fa-filter"></i>
                  </div>
                  <h4 class="font-bold text-navy text-sm sm:text-base">Stainless Grease Trap</h4>
                  <p class="text-xs text-gray-500 mt-1">Penyaring lemak & limbah dapur under-counter.</p>
              </div>
          </div>
      </div>
  </section>

  <!-- Why Choose Us -->
  <section class="py-20 bg-darkGray text-white relative overflow-hidden">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center max-w-3xl mx-auto mb-16 space-y-3 reveal" data-animate="animate__fadeInDown">
              <span class="text-xs font-bold text-primary uppercase tracking-widest">Keunggulan Kami</span>
              <h2 class="text-3xl sm:text-4xl font-black uppercase">Standar Mutu Presisi & Aman</h2>
              <div class="w-16 h-1 bg-primary mx-auto"></div>
              <p class="text-gray-300 text-sm">Mengapa ratusan pengusaha kuliner mempercayakan dapur komersial mereka kepada kami.</p>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
              <div class="bg-navy/80 p-8 rounded-lg border border-slate-700 reveal" data-animate="animate__fadeInLeft">
                  <i class="fa-solid fa-medal text-4xl text-primary mb-4"></i>
                  <h3 class="text-lg font-bold mb-2">Material Berkualitas Tinggi</h3>
                  <p class="text-sm text-gray-400 leading-relaxed">
                      Kami hanya menggunakan stainless steel SUS 304 anti karat, pipa gas seamless sch40 standar migas, dan motor blower tahan panas tinggi.
                  </p>
              </div>

              <div class="bg-navy/80 p-8 rounded-lg border border-slate-700 reveal" data-animate="animate__fadeInUp">
                  <i class="fa-solid fa-drafting-compass text-4xl text-primary mb-4"></i>
                  <h3 class="text-lg font-bold mb-2">Alur Dapur Simetris & Ergonomis</h3>
                  <p class="text-sm text-gray-400 leading-relaxed">
                      Perhitungan presisi memastikan hood sejajar dengan kompor, jalur ducting minim sudut tajam, dan pembuangan asap tidak mengorbankan estetika gedung.
                  </p>
              </div>

              <div class="bg-navy/80 p-8 rounded-lg border border-slate-700 reveal" data-animate="animate__fadeInRight">
                  <i class="fa-solid fa-headset text-4xl text-primary mb-4"></i>
                  <h3 class="text-lg font-bold mb-2">After-Sales & Garansi Resmi</h3>
                  <p class="text-sm text-gray-400 leading-relaxed">
                      Dukungan teknis pasca-instalasi, garansi kebocoran pipa gas, serta tim siap siaga untuk perawatan berkala sistem exhaust dapur Anda.
                  </p>
              </div>
          </div>
      </div>
  </section>

  <!-- Project Gallery / Portofolio -->
  <section id="portofolio" class="py-20 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
          <div class="text-center max-w-3xl mx-auto mb-16 space-y-3 reveal" data-animate="animate__fadeInDown">
              <span class="text-xs font-bold text-primary uppercase tracking-widest">Portofolio Kami</span>
              <h2 class="text-3xl sm:text-4xl font-black text-navy uppercase">Instalasi & Proyek Terbaru</h2>
              <div class="w-16 h-1 bg-primary mx-auto"></div>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
              <div class="group relative overflow-hidden rounded-lg shadow-md aspect-video reveal" data-animate="animate__fadeInUp">
                  <img src="https://images.unsplash.com/photo-1556910103-1c02745aae4d?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                  <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/40 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6 text-white">
                      <span class="text-xs text-primary font-bold uppercase">Restoran Fine Dining Jakarta</span>
                      <h4 class="font-bold text-base">Full Exhaust Hood & Island Cooking Setup</h4>
                  </div>
              </div>

              <div class="group relative overflow-hidden rounded-lg shadow-md aspect-video reveal" data-animate="animate__fadeInUp">
                  <img src="https://images.unsplash.com/photo-1578474846511-04ba529f0b88?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                  <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/40 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6 text-white">
                      <span class="text-xs text-primary font-bold uppercase">Hotel Bintang 4 Bali</span>
                      <h4 class="font-bold text-base">Instalasi Central Gas & Manifold System</h4>
                  </div>
              </div>

              <div class="group relative overflow-hidden rounded-lg shadow-md aspect-video reveal" data-animate="animate__fadeInUp">
                  <img src="https://images.unsplash.com/photo-1590725140246-20acceedc18b?q=80&w=600&auto=format&fit=crop" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                  <div class="absolute inset-0 bg-gradient-to-t from-navy via-navy/40 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-6 text-white">
                      <span class="text-xs text-primary font-bold uppercase">Central Kitchen Depok</span>
                      <h4 class="font-bold text-base">Ducting Rooftop Blower & Fresh Air Air-Makeup</h4>
                  </div>
              </div>
          </div>
      </div>
  </section>

  <!-- Bottom CTA Bar -->
  <section class="bg-primary text-white py-12 reveal" data-animate="animate__fadeIn">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col md:flex-row items-center justify-between gap-6 text-center md:text-left">
          <div>
              <h3 class="text-2xl sm:text-3xl font-black uppercase">Siap Membangun Dapur Profesional Anda?</h3>
              <p class="text-red-100 text-sm mt-1">Dapatkan survei lokasi dan konsultasi teknis langsung dari ahli kami.</p>
          </div>
          <a href="<?= $domain->wa_link ?>" target="_blank" class="bg-navy hover:bg-slate-900 text-white px-8 py-4 rounded font-bold text-sm tracking-wider uppercase shadow-xl transition whitespace-nowrap animate__animated animate__pulse animate__infinite">
              Hubungi Kami Sekarang
          </a>
      </div>
  </section>