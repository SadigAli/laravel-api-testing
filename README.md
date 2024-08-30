
proyekti klonladıqdan sonrakı addımlar:

1) terminalda composer install komandası işə salınır 
2) proyektin kök yolunda - .env.example faylının yanında .env adlı fayl yaradırıq və .env.example faylının içindəki hər şeyi kopyalayıb .env faylına yapışdırırıq
3) terminalda php artisan key:generate komandası işə salınır
4) .env faylında 
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
hissəsinə öz databaza məlumatlarımızı yazırıq DB_DATABASE=laravel hissəsinə yeni yaratmaq istədiyimiz bazanın adını yaza bilərik 
əgər əvvəlcədən bazamız yoxdursa(bu zaman terminalda bu barədə soruşulacaq ki, yeni baza yaradılsın ya yox)
5) terminalda php artisan migrate komandasını işə salın
6) base_url/api/register (POST) url-inə görə qeydiyyat məlumatlarını daxil edin. Request-in body-si olaraq, name, email, password və repeat_password daxil edin. 
7) base_url/api/login (POST) url-inə görə daxil olma məlumatlarını daxil edin. Request-in body-si olaraq, Email və password daxil edin.
8) base_url/api/categories url-inə görə kateqoriya məlumatlarına baxa, yeni məhsul əlavə edə, dəyişə və silə bilərsiniz. Kateqoriya əlavə edərkən request-in body-sinə bu key-ləri daxil edin : name_az, name_en, name_ru. Kateqoriya ilə bağlı url-lər aşağıdakılardır : 
    1. base_url/api/categories (GET) - Kateqoriyaların siyahısını gətirir (page və limit parameterlərini request-in body-sinə göndərə bilərsiniz).
    2. base_url/api/categories (POST) - Kateqoriya əlavə edir.
    3. base_url/api/categories/{id} (GET) - Kateqoriyanı gətirir.
    4. base_url/api/categories/{id} (PUT) - Kateqoriyanı yeniləyir.
    5. base_url/api/categories/{id} (DELETE) - Kateqoriyanı silir.
9) base_url/api/products url-inə görə məhsul məlumatlarına baxa, yeni məhsul əlavə edə, dəyişə və silə bilərsiniz. Məhsul əlavə edərkən request-in body-sində bu keyləri daxil edin : title_az, title_en, title_ru, description_az, description_en, description_ru, cost_price, sale_price, discount, image(file), category_id. Məhsullar ilə bağlı url-lər aşağıdakılardır :
    1. base_url/api/products (GET) - Məhsulların siyahısını gətirir (page və limit parameterlərini request-in body-sinə göndərə bilərsiniz).
    2. base_url/api/products (POST) - Məhsul əlavə edir.
    3. base_url/api/products/{id} (GET) - Məhsulu gətirir.
    4. base_url/api/products/{id} (PUT) - Məhsulu yeniləyir.
    5. base_url/api/products/{id} (DELETE) - Məhsulu silir.
10) base_url/api/logout (GET) - Hesabdan çıxış edir.
