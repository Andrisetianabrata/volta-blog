# Tata Cara Menjalankan Laravel dari Repo GitHub

1. **Clone Repo dari GitHub**
   
   Pertama, Anda perlu meng-clone repo Laravel dari GitHub. Anda bisa melakukannya dengan perintah berikut di terminal Anda:

   ```sh
   git clone https://github.com/Andrisetianabrata/volta-blog.git
   ```

2. **Install Dependencies**
   
   Setelah repo berhasil di-clone, masuk ke direktori proyek dan install dependencies menggunakan Composer:
   cd repo
   composer install

3. **Setup Environment**
   
   Copy file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database dan lainnya sesuai kebutuhan Anda:
   ```sh
   cp .env.example .env
   ```

4. **Generate Key**
   
   Laravel memerlukan key aplikasi untuk enkripsi dan lainnya. Anda bisa generate key ini dengan perintah:
   ```sh
   php artisan key:generate
   ```

5. **Migrate Database**
   
   Jika Anda memiliki migrasi database, jalankan migrasi dengan perintah:
   `php artisan migrate`

6. **Storage Link**

   Untuk linking `Public Storage` penting:
   `php artisan storage:link`

7. **Jalankan Server**
   
   Akhirnya, Anda bisa menjalankan server Laravel dengan perintah:
   ```sh
   php artisan serve
   ```
   Sekarang, Laravel Anda harus berjalan di `http://localhost:8000`.

