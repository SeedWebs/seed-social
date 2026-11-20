# Seed Social

Seed Social ใส่ปุ่มแชร์ไปยังโซเชียลไม่กี่เครือข่ายให้เนื้อหาของ WordPress และพิมพ์แท็ก Open Graph สำหรับพรีวิวลิงก์ได้

## ภาษา

### การแชร์

**เครือข่าย (Network)**:
บริการโซเชียลที่ผู้เข้าชมแชร์ไปได้ ได้แก่ Facebook, X และ LINE
_เลี่ยง_: Twitter, Line, social

**ปุ่มแชร์ (Share button)**:
ลิงก์ที่เปิดหน้าแชร์ของเครือข่ายหนึ่งสำหรับโพสต์ที่กำลังดู
_เลี่ยง_: icon, social button

**ชุดปุ่ม (Button set)**:
กลุ่มปุ่มแชร์ของทุกเครือข่ายที่เปิดไว้ ซึ่งแสดงด้วยกันในที่เดียว
_เลี่ยง_: buttons, share bar, list

**ป้ายปุ่ม (Button label)**:
ข้อความบนปุ่มแชร์ข้างไอคอน ผู้ดูแลเว็บตั้งได้ทีละเครือข่าย
_เลี่ยง_: button text, caption

**หน้าต่างแชร์ (Share popup)**:
หน้าต่างเบราว์เซอร์ขนาดเล็กที่ปุ่มแชร์ใช้เปิดหน้าแชร์ของเครือข่ายบนเดสก์ท็อป
_เลี่ยง_: share dialog, new tab

**ยอดแชร์ (Share count)**:
จำนวนครั้งที่หน้าหนึ่งถูกแชร์บน Facebook Seed Social เคยแสดงไว้บนปุ่ม Facebook และเลิกแสดงแล้ว
_เลี่ยง_: share counter, likes

### การวางปุ่ม

**วางอัตโนมัติ (Automatic placement)**:
ชุดปุ่มที่ Seed Social ใส่ให้เอง ทั้งในชนิดเนื้อหาที่ผู้ดูแลเลือกตามการตั้งค่าตำแหน่ง และบนหน้าสินค้า WooCommerce ทุกหน้าตามการตั้งค่าตำแหน่งใน WooCommerce
_เลี่ยง_: auto buttons, default buttons

**วางเอง (Manual placement)**:
ชุดปุ่มที่เจ้าของเว็บใส่เองด้วยฟังก์ชัน `seed_social()` ใน template หรือ shortcode `[seed_social]`
_เลี่ยง_: custom buttons

**ตำแหน่ง (Position)**:
Top หรือ Bottom คือการวางอัตโนมัติไว้ก่อนหรือหลังเนื้อหาของโพสต์ หน้า หรือ topic ของ bbPress
_เลี่ยง_: location, placement

**ตำแหน่งใน WooCommerce (WooCommerce position)**:
After summary หรือ After product content คือที่วางอัตโนมัติบนหน้าสินค้าเดี่ยวของ WooCommerce เป็นการตั้งค่าที่แยกจากตำแหน่ง
_เลี่ยง_: Position (เมื่อพูดถึงสินค้า)

**ปิดปุ่มรายโพสต์ (Per-post disable)**:
การที่ผู้เขียนปิดการวางอัตโนมัติบนโพสต์ หน้า หรือสินค้าชิ้นเดียว ปุ่มที่วางเองบนชิ้นนั้นยังแสดงอยู่
_เลี่ยง_: hide buttons, opt-out

### พรีวิวลิงก์

**แท็ก Open Graph (Open Graph tags)**:
meta tag `og:` ที่บอก Facebook และเว็บอื่นว่าจะใช้ชื่อ คำอธิบาย ภาพ และ URL ใดในพรีวิวลิงก์ ผู้ดูแลเปิดได้ด้วยตัวเลือก "Share featured image?"
_เลี่ยง_: OG, featured image sharing, FB Open Graph
