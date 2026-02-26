<?php
$filePath = 'json/blog_content.json';

if (!isset($_GET['id'])) die('Invalid request');
$id = (int)$_GET['id'];

$data = file_exists($filePath) ? json_decode(file_get_contents($filePath), true) : [];
$blog = null;

foreach ($data as $item) {
    if ((int)$item['id'] === $id) { $blog = $item; break; }
}
if (!$blog) die('Blog not found');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Edit Blog</title>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<style>
body{font-family:Arial;background:#f4f4f4;margin:0}
nav{background:#333;padding:10px 20px}
nav a{color:#fff;margin-right:15px;text-decoration:none}
.container{width:80%;margin:30px auto;background:#fff;padding:30px}
label{font-weight:bold;margin-top:15px;display:block}
input{width:100%;padding:10px;margin-top:5px}
#editor{height:320px;border:1px solid #ccc}
#htmlBox{width:100%;height:320px;border:1px solid #ccc;padding:10px;display:none;font-family:monospace}
button{margin-top:20px;padding:12px 20px;background:#28a745;color:#fff;border:none;cursor:pointer}
.images img{height:80px;margin:5px;border:1px solid #ddd}
.ql-toolbar .ql-htmlToggle {
    width: auto;
    padding: 0 10px;
    font-weight: bold;
    color:red;
    width: 60px !important;
}
</style>
</head>

<body>

<nav>
    <a href="all_blogs.php">All Blogs</a>
    <a href="upload_blog.php">Upload Blog</a>
</nav>

<div class="container">
<h2>Edit Blog</h2>

<form method="POST" action="blog_content_api.php" enctype="multipart/form-data">

    <input type="hidden" name="edit_id" value="<?= (int)$blog['id'] ?>">
    <input type="hidden" name="content" id="editor-content">

    <label>Blog Name</label>
    <input type="text" name="name" value="<?= htmlspecialchars($blog['name']) ?>" required>

    <label>Category</label>
    <input type="text" name="category" value="<?= htmlspecialchars($blog['category']) ?>" required>

    <label>Content</label>

    <!-- Toolbar -->
    <div id="toolbar">
        <!-- ✅ HTML Toggle Button BEFORE Bold -->
        <button type="button" class="ql-htmlToggle">HTML</button>

        <!-- Standard tools -->
        <button class="ql-bold"></button>
        <button class="ql-italic"></button>
        <button class="ql-underline"></button>
        <button class="ql-link"></button>
        <button class="ql-list" value="ordered"></button>
        <button class="ql-list" value="bullet"></button>
    </div>

    <!-- Quill Editor -->
    <div id="editor"></div>

    <!-- Raw HTML textarea (toggle view) -->
    <textarea id="htmlBox"></textarea>

    <?php if (!empty($blog['images'])): ?>
        <label>Existing Images</label>
        <div class="images">
            <?php foreach (explode(',', $blog['images']) as $img): ?>
                <?php if (trim($img) !== ''): ?>
                    <img src="json/uploads/<?= htmlspecialchars(trim($img)) ?>">
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <label>Upload New Images (optional)</label>
    <input type="file" name="images[]" multiple>

    <button type="submit" name="update_content">Update Blog</button>
</form>
</div>

<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
var quill = new Quill('#editor', {
    theme: 'snow',
    modules: {
        toolbar: '#toolbar'
    }
});

var isHtmlMode = false;
var htmlBox = document.getElementById('htmlBox');

// ✅ Load initial HTML into editor
setTimeout(function(){
    quill.root.innerHTML = <?= json_encode($blog['content'], JSON_UNESCAPED_UNICODE) ?>;
}, 50);

// ✅ Toggle button logic
document.querySelector('.ql-htmlToggle').addEventListener('click', function(){

    if (!isHtmlMode) {
        // Switch to HTML mode
        htmlBox.value = quill.root.innerHTML;
        document.getElementById('editor').style.display = 'none';
        htmlBox.style.display = 'block';
        this.innerText = 'EDITOR';
        isHtmlMode = true;
    } else {
        // Switch back to Editor mode
        quill.root.innerHTML = htmlBox.value;
        htmlBox.style.display = 'none';
        document.getElementById('editor').style.display = 'block';
        this.innerText = 'HTML';
        isHtmlMode = false;
    }
});

// ✅ On submit: save correct content depending on mode
document.querySelector('form').addEventListener('submit', function(){
    if (isHtmlMode) {
        document.getElementById('editor-content').value = htmlBox.value;
    } else {
        document.getElementById('editor-content').value = quill.root.innerHTML;
    }
});
</script>

</body>
</html>
