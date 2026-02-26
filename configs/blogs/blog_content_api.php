<?php

/* ===============================
   UPDATE BLOG
================================ */
if (isset($_POST['update_content'])) {

    $id       = (int)$_POST['edit_id'];
    $name     = trim($_POST['name']);
    $category = trim($_POST['category']);

    // Clean + format HTML
    $content = cleanContent($_POST['content']);
    $content = formatHtmlPretty($content);

    $filePath = 'json/blog_content.json';
    $data = file_exists($filePath)
        ? json_decode(file_get_contents($filePath), true)
        : [];

    foreach ($data as &$blog) {
        if ((int)$blog['id'] === $id) {

            $blog['name']       = $name;
            $blog['category']   = $category;
            $blog['content']    = $content;
            $blog['updated_at'] = date('Y-m-d H:i:s');

            // Append new images if uploaded
            if (!empty($_FILES['images']['name'][0])) {

                $uploadDir = 'json/uploads/';
                $newImgs   = [];

                foreach ($_FILES['images']['name'] as $k => $img) {
                    if (!empty($img)) {
                        $file = time().'_'.$img;
                        move_uploaded_file(
                            $_FILES['images']['tmp_name'][$k],
                            $uploadDir.$file
                        );
                        $newImgs[] = $file;
                    }
                }

                $old = $blog['images'] ?? '';
                $blog['images'] = trim($old.',' . implode(',', $newImgs), ',');
            }

            break;
        }
    }

    file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    header("Location: all_blogs.php?status=success");
    exit;
}


/* ===============================
   CREATE BLOG
================================ */
if (isset($_POST['save_content'])) {

    $name     = trim($_POST['name']);
    $category = trim($_POST['category']);

    // Clean + format HTML
    $content = cleanContent($_POST['content']);
    $content = formatHtmlPretty($content);

    // Handle images
    $uploadedImages = [];
    if (!empty($_FILES['images']['name'][0])) {
        $uploadDir = 'json/uploads/';
        foreach ($_FILES['images']['name'] as $k => $img) {
            if (!empty($img)) {
                $file = time().'_'.$img;
                move_uploaded_file(
                    $_FILES['images']['tmp_name'][$k],
                    $uploadDir.$file
                );
                $uploadedImages[] = $file;
            }
        }
    }

    $filePath = 'json/blog_content.json';
    $data = file_exists($filePath)
        ? json_decode(file_get_contents($filePath), true)
        : [];

    $nextId = !empty($data)
        ? max(array_column($data, 'id')) + 1
        : 1;

    $data[] = [
        'id'        => $nextId,
        'category'  => $category,
        'name'      => $name,
        'content'   => $content,
        'timestamp' => date('Y-m-d H:i:s'),
        'images'    => implode(',', $uploadedImages)
    ];

    file_put_contents($filePath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    header("Location: all_blogs.php?status=success");
    exit;
}


/* ======================================================
   CLEAN CONTENT (adds classes, removes junk, NO <body>)
====================================================== */
function cleanContent(string $content): string
{
    $doc = new DOMDocument('1.0', 'UTF-8');
    libxml_use_internal_errors(true);

    $doc->loadHTML(
        '<?xml encoding="utf-8" ?>'.$content,
        LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
    );

    libxml_clear_errors();

    // Headings
    foreach ($doc->getElementsByTagName('h1') as $h1) {
        $h1->setAttribute('class', 'journal-title heading1');
    }
    foreach ($doc->getElementsByTagName('h2') as $h2) {
        $h2->setAttribute('class', 'journal-subtitle');
    }
    foreach ($doc->getElementsByTagName('h3') as $h3) {
        $h3->setAttribute('class', 'journal-subtitle');
    }

    // Paragraphs
    foreach ($doc->getElementsByTagName('p') as $p) {
        $p->setAttribute('class', 'journal-description');
    }

    // Lists
    foreach ($doc->getElementsByTagName('ul') as $ul) {
        $ul->setAttribute('class', 'bldc106');
    }

    // Remove inline styles
    foreach ($doc->getElementsByTagName('*') as $node) {
        $node->removeAttribute('style');
    }

    // Return inner HTML only (NO body/html)
    $html = '';
    foreach ($doc->childNodes as $node) {
        $html .= $doc->saveHTML($node);
    }

    return trim($html);
}


/* ======================================================
   FORMAT HTML BEAUTIFULLY (indent, line breaks)
====================================================== */
function formatHtmlPretty(string $html): string
{
    $dom = new DOMDocument('1.0', 'UTF-8');
    libxml_use_internal_errors(true);

    $dom->loadHTML(
        '<div id="wrap">'.$html.'</div>',
        LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
    );

    libxml_clear_errors();
    $dom->formatOutput = true;

    $wrapper = $dom->getElementById('wrap');
    $pretty  = '';

    foreach ($wrapper->childNodes as $node) {

        // 🔥 Convert <p><br></p> → <br>
        if (
            $node->nodeName === 'p' &&
            $node->childNodes->length === 1 &&
            $node->firstChild->nodeName === 'br'
        ) {
            $pretty .= "<br>\n\n";
            continue;
        }

        // 🔥 Convert <li><br></li> → <br>
        if (
            $node->nodeName === 'li' &&
            $node->childNodes->length === 1 &&
            $node->firstChild->nodeName === 'br'
        ) {
            $pretty .= "<br>\n\n";
            continue;
        }

        $pretty .= $dom->saveHTML($node) . "\n\n";
    }

    // Remove extra blank lines
    $pretty = preg_replace("/\n\s*\n/", "\n\n", $pretty);

    return trim($pretty);
}

