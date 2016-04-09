# Seed Social 0.9
Minimal Social Sharing WordPress Plugin (Just Facebook / Twitter / Google Plus and Line)

# How to use (for now)

Put this code to page.php or single.php

```php
<?php if(function_exists('seed_social')) {seed_social();} ?>
```

# How to remove the seed_social from single.php

Put this code to functions.php

	remove_filter('the_content', 'seed_social_auto');


## [Thai Language]
ปลั๊กอินสำหรับเพิ่มปุ่มแชร์ไปที่ Facebook / Twitter / Google Plus และ Line

#### ข้อจำกัดของการแชร์ผ่าน Line
ขณะนี้ Line API ตัวใหม่ยังไม่รองรับการแสดงผลแบบ Responsive ทำให้เวลาแชร์ผ่านมือถือจะใช้งานยากกว่า API รุ่นเก่าที่ให้เลือกใน App ว่าจะแชร์ให้ใคร 

ดังนั้นปลั๊กอินนี้จึงใช้วิธีแสดงลิงก์สำหรับ Line รุ่นใหม่ในหน้าจอ Desktop และแสดงลิงก์สำหรับ Line รุ่นเก่าในหน้าจอ Mobile ไปก่อน จนกว่า Line จะมีการอัพเดท

#### หากต้องการยุติการแสดง seed_social แบบอัตโนมัติในหน้า single

ใส่โค้ดข่างล่างนี้ใน functions.php

	remove_filter('the_content', 'seed_social_auto');