<base href="../">
<?php include("../../configs/auth_check.php"); ?>
<?php include("../../configs/config.php"); ?>
<?php
$current_page = "Edit Blog";
?>
<?php include("header1.php"); ?>

<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

<style>
  .blog-form-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
  .blog-form-full { grid-column: 1 / -1; }
  .form-help { font-size: 12px; color: #6b7280; }
  .field-error { font-size: 12px; color: #b91c1c; min-height: 18px; margin-top: 4px; }
  .input.error, .textarea.error, .select.error { border-color: #fca5a5 !important; }

  #blog-editor { background: #fff; border-radius: 8px; overflow: hidden; }
  #blog-editor .ql-toolbar.ql-snow { border-color: #e5e7eb; }
  #blog-editor .ql-container.ql-snow { border-color: #e5e7eb; height: 300px !important; min-height: 300px !important; }
  #blog-editor .ql-editor { min-height: 300px; max-height: 300px; overflow-y: auto; }

  .faq-row { display: grid; grid-template-columns: 1fr 1fr 120px auto; gap: 10px; margin-bottom: 10px; align-items: center; }
  .faq-remove { border: 1px solid #fecaca; color: #b91c1c; background: #fff; border-radius: 8px; padding: 8px 12px; font-size: 12px; }

  @media (max-width: 980px) {
    .blog-form-grid { grid-template-columns: 1fr; }
    .faq-row { grid-template-columns: 1fr; }
    #blog-editor .ql-container.ql-snow { height: 240px !important; min-height: 240px !important; }
    #blog-editor .ql-editor { min-height: 240px; max-height: 240px; }
  }
</style>

<main class="grow content pt-5" id="content" role="content">
  <div class="container-fixed" id="content_container"></div>
  <div class="container-fixed">
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
      <div class="flex flex-col justify-center gap-2">
        <h1 class="text-xl font-medium leading-none text-gray-900">Edit Blog</h1>
      </div>
      <div class="flex items-center gap-2.5">
        <a class="btn btn-sm btn-light" href="pages/show_blogs.php">Back to Blogs</a>
      </div>
    </div>
  </div>

  <div class="container-fixed">
    <div class="grid gap-5 grid-cols-1 lg:gap-7.5 xl:w-[74rem] mx-auto">
      <div class="card pb-2.5">
        <div class="card-header"><h3 class="card-title">Basic</h3></div>
        <div class="card-body blog-form-grid">
          <div><label class="form-label">Title *</label><input class="input" id="title" type="text"><div class="field-error" data-error-for="title"></div></div>
          <div><label class="form-label">Slug</label><input class="input" id="slug" type="text"><div class="field-error" data-error-for="slug"></div></div>
          <div><label class="form-label">Subtitle</label><input class="input" id="sub_title" type="text"><div class="field-error" data-error-for="sub_title"></div></div>
          <div>
            <label class="form-label">Cover Image</label>
            <input class="input" id="cover_image" accept="image/*" type="file">
            <div class="form-help" id="current-cover-info">Upload new file only if you want to replace current cover.</div>
            <div class="field-error" data-error-for="cover_image"></div>
          </div>
        </div>
      </div>

      <div class="card pb-2.5">
        <div class="card-header"><h3 class="card-title">Content</h3></div>
        <div class="card-body">
          <div class="form-help mb-2">HTML is supported. Use the toolbar for formatting.</div>
          <div id="blog-editor"></div>
          <div class="field-error" data-error-for="content"></div>
        </div>
      </div>

      <div class="card pb-2.5">
        <div class="card-header"><h3 class="card-title">SEO</h3></div>
        <div class="card-body blog-form-grid">
          <div><label class="form-label">Meta Title</label><input class="input" id="meta_title" type="text"><div class="field-error" data-error-for="meta_title"></div></div>
          <div><label class="form-label">OG Title</label><input class="input" id="og_title" type="text"><div class="field-error" data-error-for="og_title"></div></div>
          <div class="blog-form-full"><label class="form-label">Meta Description</label><textarea class="textarea" id="meta_description"></textarea><div class="field-error" data-error-for="meta_description"></div></div>
          <div class="blog-form-full"><label class="form-label">Meta Keywords</label><input class="input" id="meta_keywords" type="text"><div class="field-error" data-error-for="meta_keywords"></div></div>
          <div class="blog-form-full"><label class="form-label">Canonical URL</label><input class="input" id="canonical_url" type="text"><div class="field-error" data-error-for="canonical_url"></div></div>
          <div class="blog-form-full"><label class="form-label">OG Description</label><textarea class="textarea" id="og_description"></textarea><div class="field-error" data-error-for="og_description"></div></div>
          <div class="blog-form-full"><label class="form-label">OG Image URL</label><input class="input" id="og_image" type="text"><div class="field-error" data-error-for="og_image"></div></div>
        </div>
      </div>

      <div class="card pb-2.5">
        <div class="card-header"><h3 class="card-title">Publish</h3></div>
        <div class="card-body blog-form-grid">
          <div>
            <label class="form-label">Status</label>
            <select class="select" id="status">
              <option value="draft">draft</option>
              <option value="published">published</option>
            </select>
            <div class="field-error" data-error-for="status"></div>
          </div>
          <div><label class="form-label">Published At</label><input class="input" id="published_at" type="datetime-local"><div class="field-error" data-error-for="published_at"></div></div>
        </div>
      </div>

      <div class="card pb-2.5">
        <div class="card-header"><h3 class="card-title">Tags & FAQs</h3></div>
        <div class="card-body blog-form-grid">
          <div class="blog-form-full">
            <label class="form-label">Tags</label>
            <input class="input" id="tags" type="text">
            <div class="form-help">Comma-separated tags. Leave empty to keep no tags.</div>
            <div class="field-error" data-error-for="tags"></div>
          </div>
          <div class="blog-form-full">
            <div class="flex items-center justify-between mb-2">
              <label class="form-label">FAQs</label>
              <button class="btn btn-sm btn-light" id="add-faq-row" type="button">+ Add FAQ</button>
            </div>
            <div id="faq-rows-wrap"></div>
            <div class="field-error" data-error-for="faqs"></div>
          </div>
        </div>
      </div>

      <div class="flex justify-end gap-3">
        <a class="btn btn-light" href="pages/show_blogs.php">Cancel</a>
        <button class="btn btn-primary" id="update-blog" type="button">Update Blog</button>
      </div>
    </div>
  </div>
</main>

<?php include("footer1.php"); ?>

<script>
(function () {
  const BASE_URL = "<?php echo BASE_URL; ?>";
  const token = localStorage.getItem("auth_token") || "";
  const params = new URLSearchParams(window.location.search);
  const blogId = (params.get("id") || "").trim();
  const faqWrap = document.getElementById("faq-rows-wrap");

  const editor = new Quill("#blog-editor", {
    theme: "snow",
    modules: {
      toolbar: [
        [{ header: [1, 2, 3, false] }],
        ["bold", "italic", "underline", "strike"],
        [{ list: "ordered" }, { list: "bullet" }],
        [{ color: [] }, { background: [] }],
        ["link", "image", "blockquote", "code-block"],
        ["clean"]
      ]
    }
  });

  function createFaqRow(initial) {
    const row = document.createElement("div");
    row.className = "faq-row";
    row.setAttribute("data-faq-row", "1");
    row.innerHTML =
      '<input class="input faq-question" placeholder="Question" type="text">' +
      '<input class="input faq-answer" placeholder="Answer" type="text">' +
      '<input class="input faq-sort" min="0" placeholder="Sort order" type="number">' +
      '<button class="faq-remove" type="button">Remove</button>';
    if (initial && initial.question) row.querySelector(".faq-question").value = initial.question;
    if (initial && initial.answer) row.querySelector(".faq-answer").value = initial.answer;
    if (initial && typeof initial.sort_order !== "undefined") row.querySelector(".faq-sort").value = initial.sort_order;
    return row;
  }

  function ensureFaqRows(list) {
    faqWrap.innerHTML = "";
    const rows = Array.isArray(list) && list.length ? list : [{ question: "", answer: "", sort_order: 0 }];
    rows.forEach(function (f) { faqWrap.appendChild(createFaqRow(f)); });
  }

  function tagsToArray(v) {
    return String(v || "").split(",").map(function (x) { return x.trim(); }).filter(Boolean);
  }

  function toLocalDateTime(val) {
    if (!val) return "";
    const d = new Date(val);
    if (Number.isNaN(d.getTime())) return "";
    const p = function (n) { return String(n).padStart(2, "0"); };
    return d.getFullYear() + "-" + p(d.getMonth() + 1) + "-" + p(d.getDate()) + "T" + p(d.getHours()) + ":" + p(d.getMinutes());
  }

  function toBackendDate(v) {
    if (!v) return null;
    const d = new Date(v);
    if (Number.isNaN(d.getTime())) return null;
    return d.toISOString().slice(0, 19).replace("T", " ");
  }

  function clearErrors() {
    document.querySelectorAll("[data-error-for]").forEach(function (el) { el.textContent = ""; });
    document.querySelectorAll(".input, .textarea, .select").forEach(function (el) { el.classList.remove("error"); });
  }

  function setFieldError(key, message) {
    const err = document.querySelector('[data-error-for="' + key + '"]');
    if (err) err.textContent = message;
    const input = document.getElementById(key);
    if (input) input.classList.add("error");
  }

  function pickBlogFromResponse(json) {
    if (!json || typeof json !== "object") return null;
    if (json.data && Array.isArray(json.data.blogs) && json.data.blogs.length) return json.data.blogs[0];
    if (json.data && json.data.blog && typeof json.data.blog === "object") return json.data.blog;
    if (json.data && typeof json.data === "object" && !Array.isArray(json.data) && json.data.id) return json.data;
    if (Array.isArray(json.blogs) && json.blogs.length) return json.blogs[0];
    if (json.blog && typeof json.blog === "object") return json.blog;
    return null;
  }

  function setForm(blog) {
    document.getElementById("title").value = blog.title || "";
    document.getElementById("slug").value = blog.slug || "";
    document.getElementById("sub_title").value = blog.sub_title || "";
    const coverInfo = document.getElementById("current-cover-info");
    if (coverInfo) {
      if (blog.cover_image) {
        coverInfo.textContent = "Current: " + blog.cover_image;
      } else {
        coverInfo.textContent = "No current cover image.";
      }
    }
    document.getElementById("meta_title").value = blog.meta_title || "";
    document.getElementById("meta_description").value = blog.meta_description || "";
    document.getElementById("meta_keywords").value = blog.meta_keywords || "";
    document.getElementById("canonical_url").value = blog.canonical_url || "";
    document.getElementById("og_title").value = blog.og_title || "";
    document.getElementById("og_description").value = blog.og_description || "";
    document.getElementById("og_image").value = blog.og_image || "";
    document.getElementById("status").value = Boolean(blog.is_published) ? "published" : "draft";
    document.getElementById("published_at").value = toLocalDateTime(blog.published_at);
    const tags = Array.isArray(blog.tags) ? blog.tags.map(function (t) { return typeof t === "string" ? t : (t && (t.name || t.tag || t.title)) || ""; }).filter(Boolean) : [];
    document.getElementById("tags").value = tags.join(", ");
    editor.root.innerHTML = blog.content || "";
    ensureFaqRows(Array.isArray(blog.faqs) ? blog.faqs : []);
  }

  function collectFormData() {
    const faqs = [];
    faqWrap.querySelectorAll("[data-faq-row]").forEach(function (row) {
      const q = (row.querySelector(".faq-question").value || "").trim();
      const a = (row.querySelector(".faq-answer").value || "").trim();
      const s = Number(row.querySelector(".faq-sort").value || 0);
      if (!q && !a) return;
      faqs.push({ question: q, answer: a, sort_order: Number.isNaN(s) ? 0 : s });
    });

    const htmlContent = editor.root.innerHTML.trim();
    const plainText = editor.getText().trim();
    const payload = {
      title: (document.getElementById("title").value || "").trim(),
      slug: (document.getElementById("slug").value || "").trim(),
      sub_title: (document.getElementById("sub_title").value || "").trim(),
      content: plainText ? htmlContent : "",
      meta_title: (document.getElementById("meta_title").value || "").trim(),
      meta_description: (document.getElementById("meta_description").value || "").trim(),
      meta_keywords: (document.getElementById("meta_keywords").value || "").trim(),
      canonical_url: (document.getElementById("canonical_url").value || "").trim(),
      og_title: (document.getElementById("og_title").value || "").trim(),
      og_description: (document.getElementById("og_description").value || "").trim(),
      og_image: (document.getElementById("og_image").value || "").trim(),
      is_published: document.getElementById("status").value === "published" ? "1" : "0",
      published_at: toBackendDate(document.getElementById("published_at").value) || "",
      tags: tagsToArray(document.getElementById("tags").value),
      faqs: faqs
    };

    const fd = new FormData();
    Object.keys(payload).forEach(function (k) {
      if (k === "tags") {
        payload.tags.forEach(function (tag) { fd.append("tags[]", tag); });
        return;
      }
      if (k === "faqs") {
        if (payload.faqs.length > 0) {
          fd.append("faqs", JSON.stringify(payload.faqs));
        }
        return;
      }
      if (payload[k] !== "") fd.append(k, payload[k]);
    });
    const file = document.getElementById("cover_image").files[0];
    if (file) fd.append("cover_image", file);
    return { payload: payload, formData: fd };
  }

  async function loadBlog() {
    if (!blogId) {
      Swal.fire("Error", "Missing blog id.", "error").then(function () {
        window.location.href = "pages/show_blogs.php";
      });
      return;
    }
    try {
      const res = await fetch(`${BASE_URL}/blogs/fetch/${encodeURIComponent(blogId)}`, {
        method: "POST",
        headers: { "Authorization": `Bearer ${token}`, "Content-Type": "application/json", "Accept": "application/json" },
        body: JSON.stringify({})
      });
      const json = await res.json().catch(function () { return {}; });
      if (!res.ok) {
        Swal.fire("Error", (json && (json.message || json.error)) || "Failed to load blog.", "error");
        return;
      }
      const blog = pickBlogFromResponse(json);
      if (!blog) {
        Swal.fire("Error", "Blog data not found.", "error");
        return;
      }
      setForm(blog);
    } catch (e) {
      Swal.fire("Error", "Unable to load blog.", "error");
    }
  }

  async function updateBlog() {
    clearErrors();
    const collected = collectFormData();
    const payload = collected.payload;
    if (!payload.title) { setFieldError("title", "Title is required."); return; }
    if (!payload.content) { setFieldError("content", "Content is required."); return; }

    const btn = document.getElementById("update-blog");
    btn.disabled = true;
    btn.textContent = "Updating...";
    try {
      const res = await fetch(`${BASE_URL}/blogs/update/${encodeURIComponent(blogId)}`, {
        method: "POST",
        headers: { "Authorization": `Bearer ${token}`, "Accept": "application/json" },
        body: collected.formData
      });
      const json = await res.json().catch(function () { return {}; });
      if (!res.ok) {
        if (res.status === 422 && json && json.errors) {
          Object.keys(json.errors).forEach(function (k) {
            const msg = Array.isArray(json.errors[k]) ? json.errors[k][0] : String(json.errors[k]);
            setFieldError(k, msg);
          });
          Swal.fire("Validation Error", "Please fix the highlighted fields.", "error");
        } else {
          Swal.fire("Error", (json && (json.message || json.error)) || "Failed to update blog.", "error");
        }
        return;
      }
      Swal.fire("Success", "Blog updated successfully.", "success").then(function () {
        window.location.href = "pages/show_blogs.php";
      });
    } catch (e) {
      Swal.fire("Error", "Request failed. Please try again.", "error");
    } finally {
      btn.disabled = false;
      btn.textContent = "Update Blog";
    }
  }

  document.getElementById("update-blog").addEventListener("click", updateBlog);
  document.getElementById("add-faq-row").addEventListener("click", function () {
    faqWrap.appendChild(createFaqRow({ question: "", answer: "", sort_order: 0 }));
  });
  faqWrap.addEventListener("click", function (e) {
    const btn = e.target.closest(".faq-remove");
    if (!btn) return;
    const rows = faqWrap.querySelectorAll("[data-faq-row]");
    if (rows.length <= 1) return;
    btn.closest("[data-faq-row]").remove();
  });

  ensureFaqRows([]);
  loadBlog();
})();
</script>
