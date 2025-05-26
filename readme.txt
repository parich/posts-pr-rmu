=== Posts Pr Rmu ===
Contributors:      The WordPress Contributors
Tags:              block
Tested up to:      6.7
Stable tag:        0.1.0
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

Example block scaffolded with Create Block tool.

== Description ==

- ปลั๊กอินนี้ช่วยให้คุณสามารถแสดงฟอร์มค้นหาโพสต์ในเว็บไซต์ WordPress ได้อย่างง่ายดาย  
รองรับทั้งการใช้งานผ่าน Block Editor (Gutenberg) และ Shortcode  
สามารถปรับแต่งสีของแท็บและปุ่มนำทาง (Pagination) ได้เองจากหน้า Settings  
เหมาะสำหรับเว็บไซต์ที่ต้องการระบบค้นหาโพสต์แบบกำหนดเองและปรับแต่งดีไซน์ได้

**คุณสมบัติหลัก**
- เพิ่มฟอร์มค้นหาโพสต์ด้วย Block หรือ Shortcode [posts_pr_rmu]
- ปรับแต่งสีแท็บและปุ่ม Pagination ได้จากเมนู Settings
- รองรับการใช้งานร่วมกับ Elementor (ผ่าน Shortcode Widget)
- มีปุ่ม Reset Default สำหรับคืนค่าการตั้งค่าเริ่มต้น

== Installation ==

1. ดาวน์โหลดไฟล์ `posts-pr-rmu.php` และโฟลเดอร์ `build` แล้ว zip ไฟล์ทั้งหมดไว้ในไฟล์เดียว
2. นำไฟล์ zip นี้ไปติดตั้งผ่านหน้า Plugins > Add New > Upload Plugin ในแผงควบคุม WordPress
3. ไปที่เมนู **Plugins** ในแผงควบคุม WordPress แล้วคลิก "Activate" ที่ปลั๊กอิน **Posts Pr Rmu**
4. หลังเปิดใช้งาน สามารถตั้งค่าปลั๊กอินได้ที่เมนู **Settings > PostsPR-RMU**

== Usage ==

1. ไปที่เมนู **Settings > PostsPR-RMU** เพื่อปรับแต่งสีและตัวเลือกต่าง ๆ ตามต้องการ
2. หากต้องการแสดงฟอร์มค้นหาโพสต์ ให้เพิ่ม Shortcode นี้ลงในหน้า/โพสต์ หรือใน Elementor (ผ่าน Shortcode Widget):

   [posts_pr_rmu]

3. หรือสามารถเพิ่ม Block "Posts Pr Rmu" ผ่าน WordPress Block Editor ได้โดยตรง
4. ปรับแต่งการแสดงผลเพิ่มเติมได้ที่หน้า Settings ของปลั๊กอิน

