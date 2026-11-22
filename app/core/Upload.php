<?php
// Upload ảnh lên server: kiểm tra MIME thật, kích thước, đổi tên ngẫu nhiên
class Upload
{
    public static function image($file, $subDir)
    {
        if (!in_array($subDir, ['avatars', 'news', 'products', 'site'], true)) {
            return [false, 'Thư mục upload không hợp lệ.'];
        }
        if (!isset($file['error'], $file['tmp_name'], $file['size'])
            || $file['error'] !== UPLOAD_ERR_OK || !is_string($file['tmp_name'])
            || !is_uploaded_file($file['tmp_name'])) {
            return [false, 'Hãy chọn tệp ảnh hợp lệ dưới 2 MB.'];
        }
        if ($file['size'] > config('upload.max_size')) return [false, 'Tệp ảnh quá lớn.'];

        $info = @getimagesize($file['tmp_name']);
        $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
        $ext = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
        if (!$info || !isset($ext[$mime]) || $info['mime'] !== $mime
            || $info[0] > 4096 || $info[1] > 4096) {
            return [false, 'Chỉ chấp nhận JPEG, PNG hoặc WebP tối đa 4096 × 4096 pixel.'];
        }
        $name = bin2hex(random_bytes(12)) . '.' . $ext[$mime];
        $dest = BASE_PATH . "/public/uploads/$subDir/$name";
        if (!move_uploaded_file($file['tmp_name'], $dest)) return [false, 'Không lưu được file'];
        return [true, "uploads/$subDir/$name"];
    }
}
