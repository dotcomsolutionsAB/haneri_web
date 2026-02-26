<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Blog - Rich Text Editor</title>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-size: 1rem;
            font-weight: bold;
            color: #333;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            font-size: 1rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 1rem;
            cursor: pointer;
            width: 100%;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        #editor {
            height: 200px;
            width: 100%;
            border: 1px solid #ccc;
            overflow: auto;
        }
        .file-upload {
            display: flex;
            flex-direction: column;
        }
        .file-upload input {
            margin-top: 10px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Upload Blog</h1>
        <form action="blog_content_api.php" method="POST" enctype="multipart/form-data">
            <!-- Name and Category Fields -->
            <div class="form-group">
                <label for="name">Blog Name</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" required>
            </div>

            <!-- Quill Editor -->
            <div class="form-group">
                <label for="editor">Blog Content</label>
                <div id="editor"></div>
            </div>

            <!-- Image Upload (Optional) -->
            <div class="form-group file-upload">
                <label for="images">Upload Images (Optional)</label>
                <input type="file" name="images[]" id="images" multiple>
            </div>

            <input type="hidden" name="content" id="editor-content">
            <div class="form-group">
                <button type="submit" name="save_content">Save Content</button>
            </div>
        </form>
    </div>

    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        var quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Write your content here...',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline'],
                    ['link', 'image'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'align': [] }],
                    ['color', 'background']
                ]
            }
        });

        // On form submit, update the hidden input with editor content (HTML)
        document.querySelector('form').onsubmit = function() {
            var content = quill.root.innerHTML;
            document.getElementById('editor-content').value = content;
        };
    </script>
</body>
</html>
