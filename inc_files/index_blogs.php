<section class="blogs_section" aria-label="Latest articles">
  <div class="blogs-container">
    <?php 
      // Sample data for blogs
      $blogs = [
          [
              'image'   => 'images/Blog1.png',
              'title'   => 'Why BLDC Fans Are the Future of Energy-Efficient Cooling',
              'content' => "Why BLDC Fans Are Becoming the Industry Standard
In today’s world, where energy efficiency and sustainable living are becoming top priorities, every appliance in our homes is undergoing a transformation - and the humble ceiling fan is no exception.
",
              'link'    => 'blog.php?blog=1'
          ],
          [
              'image'   => 'images/Blog2.png',
              'title'   => 'BLDC vs Traditional Ceiling Fans: Which One Should You Choose?',
              'content' => "As energy efficiency and smart technology take center stage, the humble ceiling fan is undergoing a remarkable transformation. Today, homeowners are increasingly choosing BLDC fans over traditional electric fans for their performance.
",
              'link'    => 'blog.php?blog=2'
          ],
          [
              'image'   => 'images/Blog3.png',
              'title'   => 'How Smart Fans Are Revolutionizing Home Comfort',
              'content' => "In today's fast-evolving world of home automation, the humble ceiling fan is undergoing a dramatic transformation. No longer just a basic cooling device, the modern smart fan is becoming a vital part of intelligent living spaces. 

",
              'link'    => 'blog.php?blog=3'
          ]
      ];

      // Multibyte-safe, neat boundary truncation to ~500 characters
      function truncate_content($content, $char_limit = 500) {
          $text = trim(preg_replace('/\s+/u', ' ', strip_tags($content)));
          if (mb_strlen($text, 'UTF-8') <= $char_limit) return $text;

          $slice = mb_substr($text, 0, $char_limit, 'UTF-8');
          $lastSpace = mb_strrpos($slice, ' ', 0, 'UTF-8');
          if ($lastSpace !== false && $lastSpace > ($char_limit * 0.7)) {
              $slice = mb_substr($slice, 0, $lastSpace, 'UTF-8');
          }
          return rtrim($slice, " \t\n\r\0\x0B.,;:!?”’\"") . '..';
      }

      if (!empty($blogs)) {
        foreach ($blogs as $blog) {
          $title = htmlspecialchars($blog['title'], ENT_QUOTES, 'UTF-8');
          $image = htmlspecialchars($blog['image'], ENT_QUOTES, 'UTF-8');
          $link  = htmlspecialchars($blog['link'],  ENT_QUOTES, 'UTF-8');
          $snippet = htmlspecialchars(truncate_content($blog['content']), ENT_QUOTES, 'UTF-8');

          echo '
            <article class="blog-item">
              <div class="contents">
                <div class="blog-image">
                  <img src="'.$image.'" alt="'.$title.'" loading="lazy" decoding="async">
                </div>
                <div class="blog-content">
                  <h3 class="blog-title">'.$title.'</h3>
                  <p class="blog-snippet">'.$snippet.'</p>
                </div>
                <a href="'.$link.'" class="btn btn_darkGreen read-more-button" aria-label="Read more: '.$title.'">Read More</a>
              </div>
            </article>
          ';
        }
      } else {
        echo '<p class="no-blogs">No blog posts available.</p>';
      }
    ?>
  </div>
</section>

<style>
/* =========================================
   BLOGS: Bulletproof responsive layout
   Mobile → auto-fit columns on wider screens
   ========================================= */
.blogs_section * { box-sizing: border-box; }

.blogs_section {
  padding: clamp(16px, 3vw, 36px) 0;
  background: #fff;
  color: #1b1e24;
}

/* Container: real grid, never collapses to skinny columns */
.blogs_section .blogs-container{
  width: 100%;
  margin-inline: auto;
  display: grid !important;
  grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)) !important;
  gap: 24px !important;
  align-items: stretch !important;
  justify-items: stretch !important;
}

/* Card */
.blogs_section .blog-item {
  display: flex;
  border: 1px solid #ececec;
  border-radius: 14px;
  overflow: hidden;
  background: #fff;
  box-shadow: 0 2px 12px rgba(0,0,0,0.04);
  transition: transform .18s ease, box-shadow .18s ease;
  min-width: 0;            /* prevent overflow in tight grids */
  width: auto !important;  /* neutralize external constraints */
  max-width: none !important;
  flex: 1 1 auto !important;
  min-height: auto;
}
.blogs_section .blog-item:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 28px rgba(0,0,0,0.08);
}

/* Inner layout: image (auto) + body (1fr) + button (auto) */
.blogs_section .blog-item .contents {
  display: grid;
  grid-template-rows: auto 1fr auto;
  width: 100%;
  min-height: 100%;
  min-width: 0; /* fix text overflow in grids */
}

/* Image with cover fit */
.blogs_section .blog-image {
  position: relative;
  width: 100%;
  aspect-ratio: 16 / 9;
  overflow: hidden;
  background: #f7f7f7;
}
.blogs_section .blog-image img {
  position: absolute;
  inset: 0;
  width: 100% !important;
  height: 100% !important;
  object-fit: cover !important;
  display: block;
}

/* Content */
.blogs_section .blog-content {
  padding: 14px 14px 0;
  display: grid;
  gap: 8px;
}
.blog-content p {
    padding: 5px;
}
.blogs_section .blog-title {
  font-family: "Barlow Condensed", system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
  font-weight: 500;
  font-size: clamp(18px, 2.2vw, 22px);
  line-height: 1.15;
  color: #005d5a;
  margin: 0;
  text-align: left;
}
.blogs_section .blog-snippet {
  margin: 0;
  color: #4a505e;
  font: 400 14px/1.55 "Open Sans", Arial, sans-serif;
}

/* Read more button pinned to bottom */
.blogs_section .read-more-button {
  margin: 12px 14px 14px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  padding: 10px 14px;
  border-radius: 10px;
  border: 1px solid #e5eceb;
  background: #f4faf9;
  color: #005d5a;
  font: 600 13px/1 "Open Sans", Arial, sans-serif;
  text-decoration: none;
  white-space: nowrap;
  transition: background .15s ease, transform .08s ease;
}
.blogs_section .read-more-button:hover { background: #e9f4f2; }
.blogs_section .read-more-button:active { transform: translateY(1px); }

/* Small phones */
@media (max-width: 480px) {
  .blogs_section .blog-content { padding: 12px 12px 0; }
  .blogs_section .read-more-button { margin: 10px 12px 12px; }
}

/* Clamp lines (visual safety; PHP already truncates) */
.blogs_section .blog-title {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.blogs_section .blog-snippet {
  display: -webkit-box;
  -webkit-line-clamp: 5;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Safer wrapping (avoid per-character breaks) */
.blogs_section .blog-title,
.blogs_section .blog-snippet{
  white-space: normal !important;
  word-break: normal !important;
  overflow-wrap: break-word !important;  /* NOT 'anywhere' */
  hyphens: auto;
}

/* Empty state */
.blogs_section .no-blogs {
  grid-column: 1 / -1;
  text-align: center;
  color: #6b7280;
  font: 500 15px/1.6 system-ui, -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
}

</style>
