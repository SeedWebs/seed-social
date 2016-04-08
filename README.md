# Seed Social 0.8
Minimal Social Sharing WordPress Plugin (Just Facebook / Twitter / Google Plus and Line)

# How to use (for now)

Put this code to page.php or single.php

```php
<?php if(function_exists('seed_social')) {seed_social();} ?>
```


## [Thai Language]
ปลั๊กอินสำหรับเพิ่มปุ่มแชร์ไปที่ Facebook / Twitter / Google Plus และ Line

#### ข้อจำกัดของการแชร์ผ่าน Line
ขณะนี้ Line API ตัวใหม่ยังไม่รองรับการแสดงผลแบบ Responsive ทำให้เวลาแชร์ผ่านมือถือจะใช้งานยากกว่า API รุ่นเก่าที่ให้เลือกใน App ว่าจะแชร์ให้ใคร 

ดังนั้นปลั๊กอินนี้จึงใช้วิธีแสดงลิงก์สำหรับ Line รุ่นใหม่ในหน้าจอ Desktop และแสดงลิงก์สำหรับ Line รุ่นเก่าในหน้าจอ Mobile ไปก่อน จนกว่า Line จะมีการอัพเดท

#### หมายเหตุ
สำหรับคนที่ไม่ได้แก้ไฟล์ธีมเอง ต้องการลงปลั๊กอินแล้วให้แสดงผลเลย ขอให้รอเวอร์ชัน 0.9 ก่อนนะครับ อีกไม่กี่วันนี้ครับ
