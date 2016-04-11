# Seed Social 0.9
Minimal Social Sharing WordPress Plugin (Just Facebook / Twitter / Google Plus and Line)

## English Language

### How to use?
Just upload this plugin to WordPress and activate it. The plugin will add social sharing buttons under content.

### How to add buttons manually?

1) Remove buttons by putting this code to functions.php

remove_filter('the_content', 'seed_social_auto');

2) Add this code after "The Loop" in template files, such as page.php, single.php or archive.php.

```php
<?php if(function_exists('seed_social')) {seed_social();} ?>
```

### How to let seed_social add opengraph?

1) putting this code to functions.php

```php
add_action('wp_head','seed_social_fb_og');
```

## Thai Language
ปลั๊กอินสำหรับเพิ่มปุ่มแชร์ไปที่ Facebook / Twitter / Google Plus และ Line

=======
### วิธีใช้งาน
ดาวน์โหลดไฟล์ปลั๊กอิน และนำไปติดตั้งในเวิร์ดเพรส. ปลั๊กอินนี้จะเพิ่มปุ่มแชร์ของ Facebook, Twitter, Google Plus และ Line ให้อัตโนมัติ ใต้เนื้อหาแต่ละหน้า

### หากต้องการเปลี่ยนตำแหน่งของปุ่ม

1) สั่งให้ระบบนำโค้ดแสดงปุ่มแชร์ออก โดยเพิ่มโค้ดด้านล่างนี้ในไฟล์ functions.php

```php
remove_filter('the_content', 'seed_social_auto');
```

2) เพิ่มโค้ดด้านล่างนี้ในตำแหน่งที่ต้องการแชร์ ซึ่งมักจะอยู่ต่อจาก Loop ของเวิร์ดเพรส ในไฟล์เทมเพลตต่างๆ เช่น page.php, single.php หรือ archive.php โดยสามารถเพิ่มหลายตำแหน่งได้ (เช่น ก่อนและหลังการแสดง the_content())

```php
<?php if(function_exists('seed_social')) {seed_social();} ?>
```

### หากต้องการให้ seed_social เพิ่ม opengraph

1) เพิ่มโค้ดด้านล่างนี้ในไฟล์ functions.php

```php
add_action('wp_head','seed_social_fb_og');
```

### หมายเหตุ: ข้อจำกัดของการแชร์ผ่าน Line
ขณะนี้ Line API ตัวใหม่ยังไม่รองรับการแสดงผลแบบ Responsive ทำให้เวลาแชร์ผ่านมือถือจะใช้งานยากกว่า API รุ่นเก่าที่ให้เลือกใน App ว่าจะแชร์ให้ใคร 

ดังนั้นปลั๊กอินนี้จึงใช้วิธีแสดงลิงก์สำหรับ Line รุ่นใหม่ในหน้าจอ Desktop และแสดงลิงก์สำหรับ Line รุ่นเก่าในหน้าจอ Mobile ไปก่อน จนกว่า Line จะมีการอัพเดท

แต่ Line API ตัวใหม่ เท่าที่ทดสอบ พบว่ามีปัญหากับ URL ภาษาไทยอยู่ กับอาจมีปัญหากับ Hosting ในไทยบางแห่งที่เน็ตนอกช้า ดังนั้น หากต้องการปิดปุ่มแชร์สำหรับเวอร์ชั่น Desktop สามารถเพิ่มโค้ดนี้ใน CSS ได้

```css
@media (min-width:768px) {
	.seed-social .line {display:none}
}
```
