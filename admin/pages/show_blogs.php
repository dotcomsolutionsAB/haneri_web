<base href="../">
<?php include("../../configs/auth_check.php"); ?>
<?php include("../../configs/config.php"); ?>
<?php
$current_page = "Show Blogs";
?>
<?php include("header1.php"); ?>

<style>
  .blog-pill {
    display: inline-flex;
    align-items: center;
    border-radius: 999px;
    padding: 2px 8px;
    font-size: 11px;
    background: #f3f4f6;
    color: #374151;
    margin: 2px 4px 2px 0;
  }
  .blog-list-content {
    max-width: 460px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
  }
  .blog-status {
    font-size: 11px;
    font-weight: 600;
    border-radius: 999px;
    padding: 3px 10px;
    display: inline-block;
  }
  .blog-status-published {
    background: #dcfce7;
    color: #166534;
  }
  .blog-status-draft {
    background: #fef3c7;
    color: #92400e;
  }
  .faq-row {
    display: grid;
    grid-template-columns: 1fr 1fr 90px auto;
    gap: 8px;
    margin-bottom: 8px;
    align-items: center;
  }
  .faq-row .input {
    width: 100%;
  }
  .faq-remove {
    border: 1px solid #fecaca;
    color: #b91c1c;
    background: #fff;
    border-radius: 8px;
    padding: 7px 10px;
    font-size: 12px;
  }
  @media (max-width: 900px) {
    .faq-row {
      grid-template-columns: 1fr;
    }
  }
</style>

<main class="grow content pt-5" id="content" role="content">
  <div class="container-fixed" id="content_container"></div>

  <div class="container-fixed">
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
      <div class="flex flex-col justify-center gap-2">
        <h1 class="text-xl font-medium leading-none text-gray-900">Blogs</h1>
      </div>
      <div class="flex items-center gap-2.5">
        <a class="btn btn-sm btn-primary" href="pages/add_blog.php">Add Blog</a>
      </div>
    </div>
  </div>

  <div class="container-fixed">
    <div class="grid gap-5 lg:gap-7.5">
      <div class="card card-grid min-w-full">
        <div class="card-header py-5 flex-wrap gap-3 justify-between items-center">
          <h3 class="card-title">
            Overview of <span id="count-blogs">0</span> Blogs
          </h3>
          <div class="flex flex-wrap items-center gap-3">
            <div class="relative">
              <i class="ki-filled ki-magnifier leading-none text-md text-gray-500 absolute top-1/2 start-0 -translate-y-1/2 ms-3"></i>
              <input id="blog-search" class="input input-sm pl-8" placeholder="Search title / slug" type="text" />
            </div>
            <label class="switch switch-sm">
              <input class="order-2" id="published-only" type="checkbox" value="1" />
              <span class="switch-label order-1">Published only</span>
            </label>
          </div>
        </div>

        <div class="card-body">
          <div class="scrollable-x-auto">
            <table class="table table-border" id="blogs-table">
              <thead>
                <tr>
                  <th class="min-w-[220px] text-gray-700 font-normal">Title</th>
                  <th class="min-w-[160px] text-gray-700 font-normal">Slug</th>
                  <th class="min-w-[260px] text-gray-700 font-normal">Tags</th>
                  <th class="min-w-[120px] text-gray-700 font-normal">Status</th>
                  <th class="min-w-[160px] text-gray-700 font-normal">Published At</th>
                  <th class="w-[60px]"></th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>

          <div class="card-footer justify-center md:justify-between flex-col md:flex-row gap-5 text-gray-600 text-2sm font-medium">
            <div class="flex items-center gap-2 order-2 md:order-1">
              Show
              <select class="select select-sm w-16" id="blogs-per-page">
                <option value="10" selected>10</option>
                <option value="20">20</option>
                <option value="50">50</option>
              </select>
              per page
            </div>
            <div class="flex items-center gap-4 order-1 md:order-2">
              <span id="blogs-page-info"></span>
              <div class="pagination flex items-center gap-2">
                <button id="blogs-prev" class="btn btn-sm btn-light" type="button">Previous</button>
                <span id="blogs-page-current">Page 1</span>
                <button id="blogs-next" class="btn btn-sm btn-light" type="button">Next</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
(function ($) {
  $(function () {
    const BASE_URL = "<?php echo BASE_URL; ?>";
    const token = localStorage.getItem("auth_token") || "";

    const $tbody = $("#blogs-table tbody");
    const $count = $("#count-blogs");
    const $search = $("#blog-search");
    const $publishedOnly = $("#published-only");
    const $perPage = $("#blogs-per-page");
    const $pageInfo = $("#blogs-page-info");
    const $pageCurrent = $("#blogs-page-current");
    const $btnPrev = $("#blogs-prev");
    const $btnNext = $("#blogs-next");

    let currentPage = 1;
    let perPage = Number($perPage.val() || 10);
    let totalItems = 0;
    let rowsCache = [];

    function authHeaders() {
      return {
        "Authorization": `Bearer ${token}`,
        "Content-Type": "application/json"
      };
    }

    function getBlogsFromResponse(json) {
      if (Array.isArray(json)) return json;
      if (!json || typeof json !== "object") return [];
      if (json.data && Array.isArray(json.data.blogs)) return json.data.blogs;
      if (Array.isArray(json.blogs)) return json.blogs;
      if (json.data && Array.isArray(json.data)) return json.data;
      return [];
    }

    function getTotalFromResponse(json, fallbackLength) {
      if (!json || typeof json !== "object") return fallbackLength;
      if (json.data && typeof json.data.total !== "undefined") return Number(json.data.total) || fallbackLength;
      if (typeof json.total_records !== "undefined") return Number(json.total_records) || fallbackLength;
      if (typeof json.total !== "undefined") return Number(json.total) || fallbackLength;
      return fallbackLength;
    }

    function normalizeBlog(row) {
      const tags = Array.isArray(row.tags)
        ? row.tags.map(function (t) { return typeof t === "string" ? t : (t && (t.name || t.tag || t.title)) || ""; }).filter(Boolean)
        : [];
      const faqs = Array.isArray(row.faqs) ? row.faqs : [];
      return {
        id: row.id,
        title: row.title || "",
        slug: row.slug || "",
        sub_title: row.sub_title || "",
        cover_image: row.cover_image || "",
        content: row.content || "",
        meta_title: row.meta_title || "",
        meta_description: row.meta_description || "",
        meta_keywords: row.meta_keywords || "",
        canonical_url: row.canonical_url || "",
        og_title: row.og_title || "",
        og_description: row.og_description || "",
        og_image: row.og_image || "",
        is_published: Boolean(row.is_published),
        published_at: row.published_at || "",
        tags: tags,
        faqs: faqs
      };
    }

    function toDateTimeLocal(val) {
      if (!val) return "";
      const d = new Date(val);
      if (Number.isNaN(d.getTime())) return "";
      const pad = function (n) { return String(n).padStart(2, "0"); };
      return d.getFullYear() + "-" + pad(d.getMonth() + 1) + "-" + pad(d.getDate()) + "T" + pad(d.getHours()) + ":" + pad(d.getMinutes());
    }

    function fromDateTimeLocal(val) {
      if (!val) return null;
      const d = new Date(val);
      if (Number.isNaN(d.getTime())) return null;
      return d.toISOString().slice(0, 19).replace("T", " ");
    }

    function stripHtml(html) {
      const div = document.createElement("div");
      div.innerHTML = html || "";
      return (div.textContent || div.innerText || "").trim();
    }

    function parseErrors(resJson) {
      const out = {};
      if (!resJson || !resJson.errors || typeof resJson.errors !== "object") return out;
      Object.keys(resJson.errors).forEach(function (key) {
        const msg = Array.isArray(resJson.errors[key]) ? resJson.errors[key][0] : String(resJson.errors[key]);
        out[key] = msg;
      });
      return out;
    }

    function showApiError(title, status, resJson) {
      const errors = parseErrors(resJson);
      const keys = Object.keys(errors);
      if (status === 422 && keys.length) {
        Swal.fire({
          icon: "error",
          title: title,
          html: "<div style='text-align:left'>" + keys.map(function (k) {
            return "<div><b>" + k + "</b>: " + errors[k] + "</div>";
          }).join("") + "</div>"
        });
        return;
      }
      Swal.fire("Error", (resJson && (resJson.message || resJson.error)) || "Request failed.", "error");
    }

    function renderRows(rows) {
      $tbody.empty();
      if (!rows.length) {
        $tbody.append("<tr><td colspan='6' class='text-center text-gray-500'>No blogs found.</td></tr>");
        return;
      }

      rows.forEach(function (item) {
        const b = normalizeBlog(item);
        const tagHtml = b.tags.length
          ? b.tags.slice(0, 5).map(function (t) { return "<span class='blog-pill'>" + $("<div>").text(t).html() + "</span>"; }).join("")
          : "<span class='text-gray-500 text-2sm'>-</span>";
        const statusClass = b.is_published ? "blog-status-published" : "blog-status-draft";
        const statusText = b.is_published ? "Published" : "Draft";
        const titleSafe = $("<div>").text(b.title).html();
        const slugSafe = $("<div>").text(b.slug).html();

        $tbody.append(
          "<tr>" +
            "<td><div class='font-medium text-gray-900'>" + titleSafe + "</div><div class='text-gray-600 text-2sm blog-list-content'>" + $("<div>").text(stripHtml(b.content)).html() + "</div></td>" +
            "<td class='text-gray-700 text-2sm'>" + slugSafe + "</td>" +
            "<td>" + tagHtml + "</td>" +
            "<td><span class='blog-status " + statusClass + "'>" + statusText + "</span></td>" +
            "<td class='text-gray-700 text-2sm'>" + (b.published_at ? $("<div>").text(b.published_at).html() : "-") + "</td>" +
            "<td>" +
              "<div class='flex items-center gap-2'>" +
                "<button class='btn btn-xs btn-light js-edit-blog' data-id='" + b.id + "'>Edit</button>" +
                "<button class='btn btn-xs btn-danger js-delete-blog' data-id='" + b.id + "'>Delete</button>" +
              "</div>" +
            "</td>" +
          "</tr>"
        );
      });
    }

    function updatePager() {
      const totalPages = Math.max(1, Math.ceil(totalItems / perPage));
      const start = totalItems ? ((currentPage - 1) * perPage) + 1 : 0;
      const end = Math.min(currentPage * perPage, totalItems);
      $pageInfo.text("Showing " + start + "-" + end + " of " + totalItems);
      $pageCurrent.text("Page " + currentPage + " / " + totalPages);
      $btnPrev.prop("disabled", currentPage <= 1);
      $btnNext.prop("disabled", currentPage >= totalPages);
    }

    async function fetchBlogs() {
      const offset = (currentPage - 1) * perPage;
      const payload = {
        search: ($search.val() || "").trim(),
        limit: perPage,
        offset: offset
      };
      if ($publishedOnly.is(":checked")) payload.is_published = true;

      try {
        const res = await fetch(`${BASE_URL}/blogs/fetch`, {
          method: "POST",
          headers: authHeaders(),
          body: JSON.stringify(payload)
        });
        const json = await res.json().catch(function () { return {}; });
        if (!res.ok) {
          showApiError("Unable to fetch blogs", res.status, json);
          return;
        }

        rowsCache = getBlogsFromResponse(json);
        totalItems = getTotalFromResponse(json, rowsCache.length || 0);
        $count.text(totalItems);
        renderRows(rowsCache);
        updatePager();
      } catch (e) {
        Swal.fire("Error", "Failed to load blogs.", "error");
      }
    }

    function parseTagsFromInput(value) {
      return String(value || "")
        .split(",")
        .map(function (s) { return s.trim(); })
        .filter(Boolean);
    }

    function buildFaqRowsHtml(faqs) {
      const rows = (Array.isArray(faqs) && faqs.length) ? faqs : [{ question: "", answer: "", sort_order: 0 }];
      return rows.map(function (f, i) {
        return "<div class='faq-row' data-faq-row>" +
          "<input class='input faq-question' placeholder='Question' value='" + $("<div>").text(f.question || "").html() + "' />" +
          "<input class='input faq-answer' placeholder='Answer' value='" + $("<div>").text(f.answer || "").html() + "' />" +
          "<input class='input faq-sort' type='number' min='0' placeholder='Sort' value='" + Number(f.sort_order || 0) + "' />" +
          "<button type='button' class='faq-remove' " + (rows.length === 1 && i === 0 ? "style='display:none'" : "") + ">Remove</button>" +
        "</div>";
      }).join("");
    }

    function openBlogForm(mode, blog) {
      const b = blog ? normalizeBlog(blog) : normalizeBlog({});
      const title = mode === "edit" ? "Edit Blog" : "Create Blog";

      Swal.fire({
        title: title,
        customClass: { popup: "swal-quotation-wide" },
        width: "min(980px, calc(100vw - 32px))",
        showCancelButton: true,
        confirmButtonText: mode === "edit" ? "Update Blog" : "Create Blog",
        cancelButtonText: "Cancel",
        html:
          "<div style='text-align:left;display:grid;grid-template-columns:repeat(2,1fr);gap:10px'>" +
            "<input id='blog_title' class='input' placeholder='Title*' value='" + $("<div>").text(b.title).html() + "' />" +
            "<input id='blog_slug' class='input' placeholder='Slug (optional)' value='" + $("<div>").text(b.slug).html() + "' />" +
            "<input id='blog_sub_title' class='input' placeholder='Subtitle' value='" + $("<div>").text(b.sub_title).html() + "' />" +
            "<input id='blog_cover_image' class='input' placeholder='Cover Image URL' value='" + $("<div>").text(b.cover_image).html() + "' />" +
            "<input id='blog_meta_title' class='input' placeholder='Meta Title' value='" + $("<div>").text(b.meta_title).html() + "' />" +
            "<input id='blog_og_title' class='input' placeholder='OG Title' value='" + $("<div>").text(b.og_title).html() + "' />" +
            "<input id='blog_canonical_url' class='input' placeholder='Canonical URL' value='" + $("<div>").text(b.canonical_url).html() + "' />" +
            "<input id='blog_og_image' class='input' placeholder='OG Image URL' value='" + $("<div>").text(b.og_image).html() + "' />" +
            "<input id='blog_meta_keywords' class='input' placeholder='Meta keywords (comma separated)' style='grid-column:1/3' value='" + $("<div>").text(b.meta_keywords).html() + "' />" +
            "<textarea id='blog_meta_description' class='textarea' placeholder='Meta description' style='grid-column:1/3;min-height:70px'>" + $("<div>").text(b.meta_description).html() + "</textarea>" +
            "<textarea id='blog_og_description' class='textarea' placeholder='OG description' style='grid-column:1/3;min-height:70px'>" + $("<div>").text(b.og_description).html() + "</textarea>" +
            "<textarea id='blog_content' class='textarea' placeholder='Content (HTML allowed)*' style='grid-column:1/3;min-height:160px'>" + $("<div>").text(b.content).html() + "</textarea>" +
            "<input id='blog_tags' class='input' placeholder='Tags (comma separated)' style='grid-column:1/3' value='" + $("<div>").text((b.tags || []).join(", ")).html() + "' />" +
            "<label style='display:flex;align-items:center;gap:8px'><input id='blog_is_published' type='checkbox' " + (b.is_published ? "checked" : "") + " /> Published</label>" +
            "<input id='blog_published_at' class='input' type='datetime-local' value='" + toDateTimeLocal(b.published_at) + "' />" +
            "<div style='grid-column:1/3;margin-top:8px'>" +
              "<div style='display:flex;justify-content:space-between;align-items:center;margin-bottom:8px'>" +
                "<strong>FAQs</strong>" +
                "<button type='button' id='add-faq-row' class='btn btn-xs btn-light'>+ Add FAQ</button>" +
              "</div>" +
              "<div id='faq-rows-wrap'>" + buildFaqRowsHtml(b.faqs) + "</div>" +
            "</div>" +
          "</div>",
        didOpen: function () {
          const wrap = document.getElementById("faq-rows-wrap");
          const addBtn = document.getElementById("add-faq-row");
          if (addBtn && wrap) {
            addBtn.addEventListener("click", function () {
              const div = document.createElement("div");
              div.className = "faq-row";
              div.setAttribute("data-faq-row", "1");
              div.innerHTML =
                "<input class='input faq-question' placeholder='Question' />" +
                "<input class='input faq-answer' placeholder='Answer' />" +
                "<input class='input faq-sort' type='number' min='0' placeholder='Sort' value='0' />" +
                "<button type='button' class='faq-remove'>Remove</button>";
              wrap.appendChild(div);
              Array.from(wrap.querySelectorAll(".faq-remove")).forEach(function (btn) { btn.style.display = ""; });
            });
          }
          if (wrap) {
            wrap.addEventListener("click", function (e) {
              const btn = e.target.closest(".faq-remove");
              if (!btn) return;
              const rows = wrap.querySelectorAll("[data-faq-row]");
              if (rows.length <= 1) return;
              btn.closest("[data-faq-row]").remove();
            });
          }
        },
        preConfirm: function () {
          const payload = {
            title: ($("#blog_title").val() || "").trim(),
            slug: ($("#blog_slug").val() || "").trim() || null,
            sub_title: ($("#blog_sub_title").val() || "").trim() || null,
            cover_image: ($("#blog_cover_image").val() || "").trim() || null,
            content: ($("#blog_content").val() || "").trim(),
            meta_title: ($("#blog_meta_title").val() || "").trim() || null,
            meta_description: ($("#blog_meta_description").val() || "").trim() || null,
            meta_keywords: ($("#blog_meta_keywords").val() || "").trim() || null,
            canonical_url: ($("#blog_canonical_url").val() || "").trim() || null,
            og_title: ($("#blog_og_title").val() || "").trim() || null,
            og_description: ($("#blog_og_description").val() || "").trim() || null,
            og_image: ($("#blog_og_image").val() || "").trim() || null,
            is_published: $("#blog_is_published").is(":checked"),
            published_at: fromDateTimeLocal($("#blog_published_at").val()),
            tags: parseTagsFromInput($("#blog_tags").val())
          };
          if (!payload.title) {
            Swal.showValidationMessage("Title is required.");
            return false;
          }
          if (!payload.content) {
            Swal.showValidationMessage("Content is required.");
            return false;
          }

          const faqRows = [];
          $("#faq-rows-wrap [data-faq-row]").each(function () {
            const q = ($(this).find(".faq-question").val() || "").trim();
            const a = ($(this).find(".faq-answer").val() || "").trim();
            const s = Number($(this).find(".faq-sort").val() || 0);
            if (!q && !a) return;
            faqRows.push({ question: q, answer: a, sort_order: Number.isNaN(s) ? 0 : s });
          });
          payload.faqs = faqRows;

          if (mode === "edit") {
            Object.keys(payload).forEach(function (k) {
              if (payload[k] === null || payload[k] === "") delete payload[k];
            });
          }
          return payload;
        }
      }).then(async function (result) {
        if (!result.isConfirmed || !result.value) return;
        const payload = result.value;

        const endpoint = mode === "edit"
          ? `${BASE_URL}/blogs/update/${b.id}`
          : `${BASE_URL}/blogs/create`;

        try {
          const res = await fetch(endpoint, {
            method: "POST",
            headers: authHeaders(),
            body: JSON.stringify(payload)
          });
          const json = await res.json().catch(function () { return {}; });
          if (!res.ok) {
            showApiError(mode === "edit" ? "Blog update failed" : "Blog create failed", res.status, json);
            return;
          }
          Swal.fire("Success", mode === "edit" ? "Blog updated successfully." : "Blog created successfully.", "success");
          fetchBlogs();
        } catch (e) {
          Swal.fire("Error", "Request failed. Please try again.", "error");
        }
      });
    }

    async function deleteBlog(id) {
      const ok = await Swal.fire({
        icon: "warning",
        title: "Delete blog?",
        text: "This action cannot be undone.",
        showCancelButton: true,
        confirmButtonText: "Delete"
      });
      if (!ok.isConfirmed) return;

      try {
        const res = await fetch(`${BASE_URL}/blogs/delete/${id}`, {
          method: "DELETE",
          headers: authHeaders()
        });
        const json = await res.json().catch(function () { return {}; });
        if (!res.ok) {
          showApiError("Delete failed", res.status, json);
          return;
        }
        Swal.fire("Deleted", "Blog removed successfully.", "success");
        fetchBlogs();
      } catch (e) {
        Swal.fire("Error", "Unable to delete blog.", "error");
      }
    }

    $tbody.on("click", ".js-edit-blog", function () {
      const id = Number($(this).data("id"));
      const found = rowsCache.find(function (r) { return Number(r.id) === id; });
      if (!found) {
        Swal.fire("Error", "Blog row not found in current page. Try refresh.", "error");
        return;
      }
      openBlogForm("edit", found);
    });

    $tbody.on("click", ".js-delete-blog", function () {
      const id = Number($(this).data("id"));
      if (!id) return;
      deleteBlog(id);
    });

    $search.on("input", function () {
      currentPage = 1;
      fetchBlogs();
    });
    $publishedOnly.on("change", function () {
      currentPage = 1;
      fetchBlogs();
    });
    $perPage.on("change", function () {
      perPage = Number($(this).val() || 10);
      currentPage = 1;
      fetchBlogs();
    });

    $btnPrev.on("click", function () {
      if (currentPage <= 1) return;
      currentPage -= 1;
      fetchBlogs();
    });
    $btnNext.on("click", function () {
      const totalPages = Math.max(1, Math.ceil(totalItems / perPage));
      if (currentPage >= totalPages) return;
      currentPage += 1;
      fetchBlogs();
    });

    fetchBlogs();
  });
})(jQuery);
</script>
