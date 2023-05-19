# TP3DPBO2023
Saya Mochamad Khaairi NIM 2106416 mengerjakan TP3 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek untuk keberkahanNya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin.

## Deskripsi Tugas
Buatlah program menggunakan bahasa pemrograman PHP dengan spesifikasi sebagai berikut:
* Program bebas, kecuali program Ormawa
* Menggunakan minimal 3 buah tabel
* Terdapat proses Create, Read, Update, dan Delete data
* Memiliki fungsi pencarian dan pengurutan data (kata kunci bebas)
* Menggunakan template/skin form tambah data dan ubah data yang sama
* 1 tabel pada database ditampilkan dalam bentuk bukan tabel, 2 tabel sisanya ditampilkan dalam bentuk tabel (seperti contoh saat praktikum)
* Menggunakan template/skin tabel yang sama untuk menampilkan tabel

## Desaign Program
![image](https://github.com/Khaairi/TP3DPBO2023/assets/100757455/d2822b0e-2fb2-4a5d-b457-889a004374f5)

Pada program ini terdapat 3 tabel yaitu:
1. Tabel Film yang berisi 7 entitas dengan entitas `film_id` sebagai primary keynya. Tabel ini memiliki relasi many to one dengan tabel Director dimana foreign keynya ada pada entitas `film_director` dan juga berelasi many to one dengan tabel Genre dimana foreign keynya ada pada entitas `film_genre`.
2. Tabel Director berisi 3 entitas dengan entitas `director_id` sebagai primary keynya. Tabel ini memiliki relasi one to many dengan tabel Film
3. Tabel Genre berisi 3 entitas dengan entitas `genre_id` sebagai primary keynya. Tabel ini memiliki relasi one to many dengan tabel Film.

## Penjelasan alur
1. Ketika pertama kali mengakses, pengguna akan diarahkan pada halaman home yang berisi kumpulan film yang tersedia di database. Pada navbar terdapat navigasi untuk berpindah ke halaman add film, directors, dan genres, juga terdapat field untuk mencari film dan dropdown untuk pilihan filter, misalnya untuk mengurutkan berdasarkan tahun rilis film, dll. Data film yang ditampilkan dapat diklik untuk melihat data film secara lebih detail.
2. Jika user mengklik salah satu film pada halaman home, maka akan diarahkan pada halaman detail. Pada halaman ini juga terdapat tombol untuk mengubah data film dan menghapus data film yang dipilih.
3. Jika pengguna menekan tombol ubah data pada halaman detail, maka akan diarahkan ke halaman form untuk mengubah data. Form sudah terisi dengan data film yang akan diubah
4. Pada halaman add film berisi form untuk menambahkan data film baru.
5. Pada halaman Directors berisi tabel kumpulan data director yang tersedia di database, pada halaman ini juga sudah tersedia form untuk menambahkan data director baru yang terletak di sebelah kanan tabel.
6. Jika pengguna ingin mengubah data director maka dapat menekan icon pen pada kolom action di tabel yang nantinya akan diarahkan ke halaman Directors tetapi dengan form yang sudah terisi
7. Jika pengguna ingin menghapus data director maka dapat menekan icon trashcan pada kolom action di tabel yang nantinya akan memunculkan peringatan untuk menghapus.

## Dokumentasi
Halaman Home
![image](https://github.com/Khaairi/TP3DPBO2023/assets/100757455/adb96fdb-a697-46b8-9d4d-c4a268b71819)

Halaman Detail
![image](https://github.com/Khaairi/TP3DPBO2023/assets/100757455/1f46e69a-1945-4026-99c6-fda37b7b7d3d)

Halaman Add Film
![image](https://github.com/Khaairi/TP3DPBO2023/assets/100757455/576610c3-656a-4fab-942e-5c1d05324dbc)

Halaman Edit Film
![image](https://github.com/Khaairi/TP3DPBO2023/assets/100757455/3f304e70-9aef-43a2-9976-30952c22da30)

Halaman Directors
![image](https://github.com/Khaairi/TP3DPBO2023/assets/100757455/e5b06463-6bdc-424f-ad74-47c4c9784086)

Halaman Genres
![image](https://github.com/Khaairi/TP3DPBO2023/assets/100757455/f1cbbbc4-dd01-48b7-a5ea-67fe67bec16d)

Dokumentasi Video

https://github.com/Khaairi/TP3DPBO2023/assets/100757455/ec31fe08-75e3-48b8-ae05-6d5c57bc6dec


