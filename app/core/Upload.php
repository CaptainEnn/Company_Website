<?php
// Upload ảnh lên server: kiểm tra MIME thật, kích thước, đổi tên ngẫu nhiên
class Upload
{
    public static function image($file, $subDir)
    {
        if ($file['error'] !== UPLOAD_ERR_OK) return [false, 'Upload lỗi'];
        if ($file['size'] > config('upload.max_size')) return [false, 'File quá lớn'];
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime  = $finfo->file($file['tmp_name']);
        $ext   = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
        if (!isset($ext[$mime])) return [false, 'Định dạng không hỗ trợ'];
        $name = bin2hex(random_bytes(12)) . '.' . $ext[$mime];
        $dest = BASE_PATH . "/public/uploads/$subDir/$name";
        if (!move_uploaded_file($file['tmp_name'], $dest)) return [false, 'Không lưu được file'];
        return [true, "uploads/$subDir/$name"];
    }
}
