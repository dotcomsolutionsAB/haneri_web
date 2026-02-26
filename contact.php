<?php include("header.php"); ?>

<main class="main">
	<nav aria-label="breadcrumb" class="breadcrumb-nav">
		<div class="container">
			<ol class="breadcrumb">
				<li class="breadcrumb-item">
					<a href="index"><i class="icon-home"></i></a>
				</li>
				<li class="breadcrumb-item active" aria-current="page">
					Contact Us
				</li>
			</ol>
		</div>
	</nav>

	<div class="contact_section">
		<!-- Contact Section -->
		<div class="contact_101">
			<div class="contact_102">
				<img src="images/contact_image.png" alt="Family" class="contact_103" />
			</div>
			<div class="contact_104">
				<h2 class="contact_105">Get In Touch</h2>
				<form class="contact_106">
				<div class="contact_107">
					<input type="text" class="contact_108" placeholder="Full Name" required />
					<input type="email" class="contact_109" placeholder="Email" required />
				</div>
				<div class="contact_110">
					<input type="tel" class="contact_111" placeholder="Phone Number" required />
					<input type="text" class="contact_112" placeholder="Your Message" required />
				</div>
				<button type="submit" class="contact_113">Submit</button>
				</form>
			</div>
		</div>
		<div class="mb-2"></div>
		<!-- Map Section -->
		<div class="contact_114">
			<iframe 
				src="https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d3502.9191005485295!2d77.35124647549972!3d28.602203675681356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zMjjCsDM2JzA3LjkiTiA3N8KwMjEnMTMuOCJF!5e0!3m2!1sen!2sin!4v1754734913098!5m2!1sen!2sin" 
				width="100%" 
				height="100%" 
				style="border:0;" 
				allowfullscreen="" 
				loading="lazy" 
				referrerpolicy="no-referrer-when-downgrade">
			</iframe>
		</div>
	</div>
	<style>
		
	</style>
<div class="mb-2"></div>
</main>

<?php include("footer.php"); ?>