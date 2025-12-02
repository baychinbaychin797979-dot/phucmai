Movable Type Framework

Movable Type là một framework blogging và quản lý nội dung mạnh mẽ, giúp người dùng tạo, quản lý và xuất bản nội dung hiệu quả, linh hoạt và dễ mở rộng.

Tính Năng Chính

Quản lý blog: bài viết, danh mục, thẻ

Hệ thống người dùng: xác thực và phân quyền

Hỗ trợ plugin để mở rộng chức năng

Hệ thống chủ đề tùy chỉnh

Tích hợp SEO tối ưu sẵn

API RESTful để kết nối với hệ thống khác

Cấu trúc Dự án

mt-framework/
src/
  core/       # Các thành phần cốt lõi
  modules/    # Các mô-đun chức năng chính
  plugins/    # Plugin và phần mở rộng
  themes/     # Chủ đề giao diện
config/       # Cấu hình ứng dụng
public/       # Thư mục public
db/           # Cơ sở dữ liệu
tests/        # Kiểm thử đơn vị
composer.json
package.json
README.md

Yêu cầu Hệ thống

PHP 8.0 hoặc cao hơn

MySQL 5.7 hoặc cao hơn

Node.js 14+

Composer

Cài đặt

Clone dự án

git clone https://github.com/movabletype/mt-framework.git
cd mt-framework


Cài đặt phụ thuộc

composer install
npm install


Cấu hình cơ sở dữ liệu

cp .env.example .env
php artisan migrate


Khởi động server

npm run dev

Tài liệu

Xem thêm tại thư mục: docs/

Đóng góp

Đóng góp được chào đón!
Vui lòng xem CONTRIBUTING.md để biết quy chuẩn phát triển.

Giấy phép

Dự án được cấp phép theo GPL-2.0+.
Chi tiết trong file LICENSE.