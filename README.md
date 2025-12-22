# Tata Cara Menjalankan Laravel dari Repo GitHub

1. **Clone Repo dari GitHub**
   
   Pertama, Anda perlu meng-clone repo Laravel dari GitHub. Anda bisa melakukannya dengan perintah berikut di terminal Anda:

   ```bash
   git clone https://github.com/Andrisetianabrata/volta-blog.git
   ```

2. **Install Dependencies**
   
   Setelah repo berhasil di-clone, masuk ke direktori proyek dan install dependencies menggunakan Composer:
   ```bash
   cd volta-blog
   composer install
   ```

3. **Setup Environment**
   
   Copy file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database dan lainnya sesuai kebutuhan Anda:
   ```bash
   cp .env.example .env
   ```

4. **Generate Key**
   
   Laravel memerlukan key aplikasi untuk enkripsi dan lainnya. Anda bisa generate key ini dengan perintah:
   ```bash
   php artisan key:generate
   ```

5. **Migrate Database**
   
   Jika Anda memiliki migrasi database, jalankan migrasi dengan perintah:
   ```bash
   php artisan migrate
   ```

6. **Jalankan Seeder**
   
   Penting Anda harus melakukan ini sebelum menjalankan server, jalankan seeder dengan perintah:
   ```bash
   php artisan db:seed
   ```
   Atau jalankan migrate sekaligus seed jika Database anda belum terbentuk:
   ```bash
   php artisan migrate --seed
   ```

7. **Storage Link**
   
   Penting untok linking `Public Storage` guna penyimpanan blog kedepanya:
   ```bash
   php artisan storage:link
   ```

8. **Jalankan Server**
   
   Anda bisa menjalankan server Laravel dengan perintah:
   ```bash
   php artisan serve
   ```
   Sekarang, Laravel Anda harus berjalan di `http://localhost:8000`.

