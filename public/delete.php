<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Folder</title>
</head>
<body>

<h2>Hapus Folder Beserta Isinya</h2>
<form method="POST" action="">
    <label for="folderPath">Path Folder:</label>
    <input type="text" id="folderPath" name="folderPath" required>
    <button type="submit">Hapus Folder</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $folderPath = '/home/vol19_2/infinityfree.com/if0_37497724/htdocs' . $_POST['folderPath'];

    if (deleteFolder($folderPath)) {
        echo "Folder '$folderPath' berhasil dihapus!";
    } else {
        echo "Gagal menghapus folder '$folderPath'.";
    }
}

function deleteFolder($folderPath) {
    if (!is_dir($folderPath)) {
        return false;  // Jika path bukan folder, return false
    }
    
    $files = array_diff(scandir($folderPath), array('.', '..'));  // Ambil semua file/folder kecuali '.' dan '..'
    
    foreach ($files as $file) {
        $filePath = $folderPath . DIRECTORY_SEPARATOR . $file;
        
        if (is_dir($filePath)) {
            deleteFolder($filePath);  // Rekursif jika ditemukan subfolder
        } else {
            unlink($filePath);  // Hapus file
        }
    }
    
    return rmdir($folderPath);  // Hapus folder setelah isinya kosong
}
?>

</body>
</html>
