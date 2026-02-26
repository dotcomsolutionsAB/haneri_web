<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Custom Invoice PDF</title>
  <!-- Include jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Include jsPDF library -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    #pdfContainer {
      margin-top: 20px;
      border: 1px solid #ccc;
      min-height: 500px;
    }
  </style>
</head>
<body>
  <h1>Invoice Preview</h1>
  <div id="pdfContainer">Generating PDF, please wait...</div>

  <script>
    $(document).ready(function() {
      // Helper to safely get URL params or use sample data
      const params = new URLSearchParams(window.location.search);
      function getParam(key, defaultVal) {
        return params.get(key) || defaultVal;
      }

      // Sample or dynamic data
      let quotation         = getParam('quotation', "QTN-12345");
      let total_amount      = getParam('total_amount', "5000");
      let status            = getParam('status', "pending");
      let payment_status    = getParam('payment_status', "pending");
      let shipping_address  = getParam('shipping_address', "Shaqlin Mondal, 8597148785, Memari, Burdwan, N/A, India");
      let razorpay_order_id = getParam('razorpay_order_id', "RP-987654321");
      let products = [
        { sku: "DEMOP123", name: "Demo Product", quantity: "2", price: "$100", total: "$100" },
        { sku: "DEMOP456", name: "Another Product", quantity: "1", price: "$100", total: "$100" }
      ];
      let vendor = {
        name: "SampleVendor",
        address: "Vendor Street, City, ZIP",
        email: "vendor@example.com",
        phone: "987-654-3210"
      };

      const { jsPDF } = window.jspdf;
      
      // Helper function: convert image element to DataURL using canvas
      function getDataURL(img, callback) {
        const canvas = document.createElement('canvas');
        canvas.width = img.width;
        canvas.height = img.height;
        const ctx = canvas.getContext('2d');
        ctx.drawImage(img, 0, 0);
        callback(canvas.toDataURL("image/png"));
      }
      
      // Function to generate PDF; logoDataUrl is a data URL string or null.
      function generatePDF(logoDataUrl) {
        const doc = new jsPDF({ unit: "pt", format: "a4" });
        const pageWidth  = doc.internal.pageSize.getWidth();  // ~595pt
        const pageHeight = doc.internal.pageSize.getHeight(); // ~842pt
        const leftMargin = 40;
        const rightMargin = 40;
        let cursorY = 0;

        // ---------------- HEADER (BLUE Bar with 50-50 layout) ----------------
        const headerHeight = 80;
        doc.setFillColor("#1b4b79");
        doc.rect(0, 0, pageWidth, headerHeight, "F");

        // Left side: Company information text (left half)
        const halfWidth = pageWidth / 2;
        doc.setFontSize(14);
        doc.setTextColor("#ffffff");
        doc.text("Haneri", leftMargin, 30);
        doc.setFontSize(10);
        doc.text("Elza International, BHEL Township, Haridwar, Uttarakhand 249403", leftMargin, 45);
        doc.text("Email: info@haneri.in  |  Phone: 123-456-7890", leftMargin, 60);

        // Right side: Add logo if available
        if (logoDataUrl) {
          // Define logo dimensions (adjust as needed)
          const logoWidth = 80;
          // We'll use an Image object to get original dimensions from the data URL
          let tempImg = new Image();
          tempImg.onload = function() {
            const logoHeight = (tempImg.height / tempImg.width) * logoWidth;
            const rightHalfX = halfWidth;
            const xPos = rightHalfX + ((halfWidth - logoWidth) / 2);
            const yPos = (headerHeight - logoHeight) / 2;
            doc.addImage(logoDataUrl, 'PNG', xPos, yPos, logoWidth, logoHeight);
            continuePDF();
          };
          tempImg.src = logoDataUrl;
        } else {
          continuePDF();
        }
        
        // Function to continue PDF generation after handling the logo
        function continuePDF() {
          // Move cursor below header
          cursorY = headerHeight + 20; // ~100pt from top

          // ---------------- SHIPPING & QUOTATION INFO (SIDE BY SIDE) ----------------
          doc.setFontSize(10);
          doc.setTextColor("#000000");

          // Box dimensions
          const boxWidth = 250;
          const boxHeight = 100;
          const boxGap = 20;

          // SHIPPING ADDRESS BOX (Left)
          doc.text("SHIPPING ADDRESS", leftMargin, cursorY);
          doc.setLineWidth(0.5);
          doc.setDrawColor(200, 200, 200);
          doc.line(leftMargin, cursorY + 2, leftMargin + 100, cursorY + 2);
          doc.rect(leftMargin, cursorY + 10, boxWidth, boxHeight);

          let shipTextX = leftMargin + 10;
          let shipTextY = cursorY + 25;
          let shipLines = shipping_address.split(", ");
          shipLines.forEach((line) => {
            doc.text(line.trim(), shipTextX, shipTextY);
            shipTextY += 12;
          });

          // QUOTATION INFORMATION BOX (Right)
          let rightBoxX = leftMargin + boxWidth + boxGap;
          doc.text("QUOTATION INFORMATION", rightBoxX, cursorY);
          doc.line(rightBoxX, cursorY + 2, rightBoxX + 140, cursorY + 2);
          doc.rect(rightBoxX, cursorY + 10, boxWidth, boxHeight);

          let qTextX = rightBoxX + 10;
          let qTextY = cursorY + 25;
          doc.text(`Burdwan, West Bengal, 713146, India`, qTextX, qTextY);   qTextY += 12;
          doc.text(`Status: ${status}`, qTextX, qTextY);                   qTextY += 12;
          doc.text(`Payment Status: ${payment_status}`, qTextX, qTextY);    qTextY += 12;
          // Uncomment if needed:
          // doc.text(`Razorpay ID: ${razorpay_order_id}`, qTextX, qTextY);   qTextY += 12;
          // doc.text(`Quotation: ${quotation}`, qTextX, qTextY);             qTextY += 12;

          // Move cursor below boxes
          cursorY += boxHeight + 40;

          // ---------------- PRODUCT DETAILS ----------------
          doc.text("PRODUCT DETAILS", leftMargin, cursorY);
          doc.line(leftMargin, cursorY + 2, leftMargin + 80, cursorY + 2);
          const tableStartY = cursorY + 15;
          let colX = [leftMargin, leftMargin + 70, leftMargin + 180, leftMargin + 260, leftMargin + 320];
          doc.text("SKU", colX[0], tableStartY);
          doc.text("Name", colX[1], tableStartY);
          doc.text("Quantity", colX[2], tableStartY);
          doc.text("Price", colX[3], tableStartY);
          doc.text("Total", colX[4], tableStartY);
          doc.line(leftMargin, tableStartY + 3, pageWidth - rightMargin, tableStartY + 3);

          let rowY = tableStartY + 15;
          products.forEach((p) => {
            doc.text(p.sku, colX[0], rowY);
            doc.text(p.name, colX[1], rowY);
            doc.text(String(p.quantity), colX[2], rowY);
            doc.text(p.price, colX[3], rowY);
            doc.text(p.total, colX[4], rowY);
            rowY += 14;
          });
          cursorY = rowY + 10;

          // ---------------- TOTAL ----------------
          doc.setFont("helvetica", "bold");
          doc.text(`Total: ${total_amount}`, colX[4], cursorY);
          doc.setFont("helvetica", "normal");
          cursorY += 40;

          // ---------------- BARCODE & VENDOR INFORMATION ----------------
          doc.text("BARCODE", leftMargin, cursorY);
          doc.line(leftMargin, cursorY + 2, leftMargin + 50, cursorY + 2);
          const barcodeBoxHeight = 60;
          doc.rect(leftMargin, cursorY + 10, boxWidth, barcodeBoxHeight);
          doc.text("[Barcode Placeholder]", leftMargin + 10, cursorY + 35);

          let vendorBoxX = leftMargin + boxWidth + boxGap;
          doc.text("VENDOR INFORMATION", vendorBoxX, cursorY);
          doc.line(vendorBoxX, cursorY + 2, vendorBoxX + 120, cursorY + 2);
          doc.rect(vendorBoxX, cursorY + 10, boxWidth, barcodeBoxHeight);
          let vInfoX = vendorBoxX + 10;
          let vInfoY = cursorY + 25;
          doc.text(`Name: ${vendor.name}`, vInfoX, vInfoY);       vInfoY += 12;
          doc.text(`Address: ${vendor.address}`, vInfoX, vInfoY); vInfoY += 12;
          doc.text(`Email: ${vendor.email}`, vInfoX, vInfoY);     vInfoY += 12;
          doc.text(`Phone: ${vendor.phone}`, vInfoX, vInfoY);     vInfoY += 12;

          // ---------------- FOOTER (Optional) ----------------
          doc.setFontSize(9);
          doc.setTextColor(100, 100, 100);
          let footerY = pageHeight - 40;
          doc.text("Thank you for your business!", leftMargin, footerY);
          doc.text("Website: www.yourcompany.com", leftMargin, footerY + 12);

          // Output PDF in iframe
          let pdfDataUri = doc.output("datauristring");
          $("#pdfContainer").html('<iframe width="100%" height="800" src="' + pdfDataUri + '"></iframe>');
        }
      }

      // Load logo image and convert to data URL
      const logo = new Image();
      logo.crossOrigin = "Anonymous";
      logo.src = "images/logo_white.png";
      logo.onload = function() {
        getDataURL(logo, function(logoDataUrl) {
          generatePDF(logoDataUrl);
        });
      };
      logo.onerror = function() {
        console.error("Logo image failed to load.");
        generatePDF(null);
      };

      // Fallback timeout in case image load hangs
      setTimeout(function() {
        if (!$("#pdfContainer iframe").length) {
          console.warn("Image load timeout, generating PDF without logo.");
          generatePDF(null);
        }
      }, 3000);
    });
  </script>
</body>
</html>
