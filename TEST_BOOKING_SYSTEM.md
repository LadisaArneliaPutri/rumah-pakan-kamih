# 🏠 Test Sistem Booking Villa Pakan Kamih

## 📋 Panduan Test Lengkap

### 🎯 Tujuan Test
Memastikan sistem booking user dan konfirmasi admin berjalan dengan sempurna, termasuk sinkronisasi status booking.

---

## 🔐 **STEP 1: Login sebagai User**

### 1.1 Buka Browser
- Buka browser dan akses: `http://localhost:8000` atau `http://0.0.0.0:8000`

### 1.2 Login User
- Klik "Login" di halaman welcome
- Masukkan kredensial user:
  ```
  Email: user@example.com
  Password: password
  ```
- Klik "Login"

### 1.3 Verifikasi Login User
- Pastikan Anda masuk ke dashboard dengan role "user"
- Tab "Kamar" akan aktif secara default
- Tab "Riwayat Booking" akan tersedia (bukan "Booking")

---

## 📝 **STEP 2: Buat Booking Kamar**

### 2.1 Pilih Kamar
- Di tab "Kamar", pilih kamar yang ingin dibooking
- Klik tombol "Booking" pada kamar yang dipilih

### 2.2 Isi Form Booking
- Form akan muncul dengan informasi kamar yang dipilih
- Isi data lengkap:
  ```
  Nama Lengkap: [Nama Anda]
  Email: [Email Anda]
  Nomor Telepon: [Nomor HP]
  Alamat: [Alamat lengkap]
  Tanggal Check-In: [Pilih tanggal]
  Tanggal Check-Out: [Pilih tanggal setelah check-in]
  ```
- Klik "Buat Booking"

### 2.3 Verifikasi Booking Berhasil
- Akan muncul pesan: "Booking berhasil dibuat! Silakan cek riwayat booking Anda."
- Kembali ke dashboard

---

## 📊 **STEP 3: Cek Riwayat Booking User**

### 3.1 Buka Tab Riwayat Booking
- Klik tab "Riwayat Booking Anda"
- Pastikan booking yang baru dibuat muncul di tabel

### 3.2 Verifikasi Status Awal
- Status booking harus: **"Menunggu Konfirmasi"** 
- Badge harus berwarna **KUNING** ⚠️
- Data yang ditampilkan:
  - Pengunjung: [Nama Anda]
  - Kamar: [Nama Kamar]
  - Check-In: [Tanggal yang dipilih]
  - Check-Out: [Tanggal yang dipilih]
  - Status: Menunggu Konfirmasi (badge kuning)

---

## 🔑 **STEP 4: Login sebagai Admin**

### 4.1 Logout dari User
- Klik "Logout" di navbar
- Pastikan kembali ke halaman login

### 4.2 Login Admin
- Masukkan kredensial admin:
  ```
  Email: admin@example.com
  Password: password
  ```
- Klik "Login"

### 4.3 Verifikasi Login Admin
- Pastikan Anda masuk dengan role "admin"
- Tab "Kamar", "Jenis Kamar", "Pengunjung", dan "Booking" tersedia
- Tab "Booking" akan menampilkan semua booking

---

## ✅ **STEP 5: Konfirmasi Booking di Admin**

### 5.1 Buka Tab Booking
- Klik tab "Booking"
- Pastikan booking user muncul di tabel dengan status "Menunggu Konfirmasi"

### 5.2 Verifikasi Data Booking
- Cari booking yang dibuat user sebelumnya
- Pastikan data sesuai:
  - Pengunjung: [Nama User]
  - Kamar: [Nama Kamar]
  - Status: Menunggu Konfirmasi (badge kuning)

### 5.3 Konfirmasi Booking
- Pada baris booking user, klik tombol **"Konfirmasi"** (hijau)
- Akan muncul konfirmasi: "Konfirmasi booking ini?"
- Klik "OK"

### 5.4 Verifikasi Konfirmasi Berhasil
- Akan muncul pesan: "Booking berhasil dikonfirmasi."
- Status booking berubah menjadi: **"Dikonfirmasi"** (badge hijau) ✅
- Tombol "Konfirmasi" dan "Batalkan" hilang (karena sudah dikonfirmasi)

---

## 🔄 **STEP 6: Login Kembali sebagai User**

### 6.1 Logout dari Admin
- Klik "Logout" di navbar
- Kembali ke halaman login

### 6.2 Login User Kembali
- Masukkan kredensial user yang sama:
  ```
  Email: user@example.com
  Password: password
  ```

### 6.3 Cek Riwayat Booking User
- Klik tab "Riwayat Booking Anda"
- Cari booking yang sebelumnya dibuat

---

## 🎉 **STEP 7: Verifikasi Status Berubah**

### 7.1 Status Booking User
- Status booking harus berubah menjadi: **"Dikonfirmasi"**
- Badge harus berwarna **HIJAU** ✅
- Data booking tetap sama, hanya status yang berubah

### 7.2 Verifikasi Sinkronisasi
- ✅ Status berubah dari "Menunggu Konfirmasi" (kuning) → "Dikonfirmasi" (hijau)
- ✅ Perubahan terjadi secara real-time
- ✅ Data booking tetap konsisten antara admin dan user

---

## 🧪 **Test Tambahan (Opsional)**

### Test Batalkan Booking
1. Login sebagai admin
2. Cari booking dengan status "Menunggu Konfirmasi"
3. Klik tombol "Batalkan" (merah)
4. Status berubah menjadi "Dibatalkan" (badge merah) ❌
5. Login sebagai user, cek riwayat booking
6. Status harus "Dibatalkan" (badge merah)

### Test Multiple Booking
1. Buat beberapa booking sebagai user
2. Login admin, konfirmasi satu per satu
3. Verifikasi setiap booking berubah statusnya

---

## ✅ **Kriteria Sukses Test**

### ✅ Sistem Berjalan dengan Baik Jika:
- [ ] User bisa login dan membuat booking
- [ ] Booking muncul di riwayat user dengan status "Menunggu Konfirmasi"
- [ ] Admin bisa login dan melihat semua booking
- [ ] Admin bisa konfirmasi booking
- [ ] Status booking berubah menjadi "Dikonfirmasi" di admin
- [ ] User login kembali dan status booking sudah "Dikonfirmasi"
- [ ] Badge warna sesuai (kuning = pending, hijau = confirmed, merah = cancelled)

### ❌ Jika Ada Masalah:
- [ ] Booking tidak muncul di riwayat user
- [ ] Status tidak berubah setelah konfirmasi admin
- [ ] Error saat login atau membuat booking
- [ ] Data tidak sinkron antara admin dan user

---

## 🆘 **Troubleshooting**

### Jika Booking Tidak Muncul di Riwayat User:
1. Pastikan email user di form booking sama dengan email login
2. Cek apakah ada error saat membuat booking
3. Refresh halaman dan cek lagi

### Jika Status Tidak Berubah:
1. Pastikan admin mengklik tombol "Konfirmasi" dengan benar
2. Cek apakah ada pesan error
3. Refresh halaman admin dan user

### Jika Login Gagal:
1. Pastikan kredensial benar
2. Cek apakah server Laravel berjalan
3. Restart server jika perlu

---

## 📞 **Kontak Support**
Jika ada masalah dalam testing, silakan berikan detail error yang muncul untuk bantuan lebih lanjut.

**Server URL:** `http://localhost:8000` atau `http://0.0.0.0:8000`
**Status Server:** ✅ Running 