<?php
session_start();
if (!isset($_SESSION['loggedin'])) {
    header("Location: /");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Dashboard</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script src="https://cdn.tailwindcss.com"></script>
<style>
  .watermark {
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
    opacity: 0.10;
    z-index: 0;
    pointer-events: none;
  }
  .watermark img {
    max-width: 400px;
  }
</style>

    <style>
  .menu-bar {
    background-color: #6b3de6;
    padding: 12px 0;
    text-align: center;
    box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000;
  }

  .menu-bar a {
    color: white;
    padding: 14px 24px;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
    transition: background-color 0.3s;
  }

  .menu-bar a:hover {
    background-color: #5830be;
  }

  body {
    margin: 0;
    padding-bottom: 70px; /* enough space for bottom navbar */
    font-family: sans-serif;
  }
</style>

  
</head>
<body class="bg-gray-100 text-gray-800">
 <div class="menu-bar">
  <a href="/home">Dashboard</a>
  <a href="/sales">Sales</a>
  <a href="/purchase">Purchases</a>
  <a href="/customer">Customer</a>
  <a href="/invoices">Invoice</a>
    <a href="/Form">From</a>

</div>
<style>
  input.amount {
    width: 100px;
    display: inline-block;
  }
</style>

<style>
  .container {
    max-width: 900px;
    margin: 40px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    font-family: Arial, sans-serif;
  }

  .container h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }

  table th, table td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
  }

  table th {
    background-color: #f3f3f3;
  }

  input[type="text"],
  input[type="number"] {
    width: 100%;
    padding: 6px;
    box-sizing: border-box;
    border-radius: 4px;
    border: 1px solid #aaa;
  }

  button {
    padding: 10px 20px;
    background-color: #6b3de6;
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s;
  }

  button:hover {
    background-color: #5830be;
  }

  h3 {
    text-align: right;
    color: #222;
  }
</style>
<form id="salesForm" style="margin-top: 70px;">
  <div id="pdfContent">
    <!-- B&M Enterprises Section -->
   <div id="bmHeader" style="display: none; width: 100%; padding: 20px 30px; box-sizing: border-box; font-family: sans-serif;">
  <div style="display: flex; justify-content: space-between; align-items: flex-start;">
    <!-- Left: Company Info -->
    <div>
      <h1 style="text-align: center; font-size: 2.25rem; font-weight: 600; line-height: 1.25; margin: 0;">
        B&M <span style="color: #a64d79;">Enterprises</span>
      </h1>
      <p style="color: #4a4a4a; font-size: 20px; line-height: 1.4; margin-top: 5px;">
         General Order Supplier
      </p>
    </div>

    <!-- Right: Invoice Number -->
    <div id="bmInvoiceNumber" style="font-weight: bold; color: black; font-size: 14px; text-align: right; margin-top: 10px;">
      <!-- filled dynamically -->
    </div>
  </div>
  <!-- Ref and Date row -->
  <div style="display: flex; justify-content: space-between; margin-top: 30px; font-size: 14px; color: #4a4a4a; font-weight: 500;">
    <div>
      Ref #: <span style="display: inline-block; width: 200px; border-bottom: 1px solid #aaa;"></span>
    </div>
    <div>
      Date: <span style="display: inline-block; width: 200px; border-bottom: 1px solid #aaa;"></span>
    </div>
  </div>
</div>
    <div id="bmContainer" style="display:none;">
  <h2>Sales Table</h2>
  <table id="bmTable" class="w-full border-collapse border border-gray-300">
    <thead>
      <tr>
        <th class="border border-gray-300 px-2 py-1">SR No</th>
        <th class="border border-gray-300 px-2 py-1">Description</th>
        <th class="border border-gray-300 px-2 py-1">QTY</th>
        <th class="border border-gray-300 px-2 py-1">Unit Rate</th>
        <th class="border border-gray-300 px-2 py-1">Labour</th>
        <th class="border border-gray-300 px-2 py-1">GST (18%)</th>
        <th class="border border-gray-300 px-2 py-1">PST (16%)</th>
        <th class="border border-gray-300 px-2 py-1">Amount</th>
      </tr>
    </thead>
    <tbody id="bmTableBody">
      <tr>
        <td class="border border-gray-300 px-2 py-1">1</td>
        <td class="border border-gray-300 px-2 py-1"><input type="text" name="description[]" /></td>
        <td class="border border-gray-300 px-2 py-1"><input type="number" name="qty[]" class="qty" oninput="calculateRow(this)" /></td>
        <td class="border border-gray-300 px-2 py-1"><input type="number" name="rate[]" class="rate" oninput="calculateRow(this)" /></td>
        <td class="border border-gray-300 px-2 py-1"><input type="number" name="labour[]" class="labour" oninput="calculateRow(this)" /></td>
        <td class="border border-gray-300 px-2 py-1"><input type="text" name="gst[]" class="gst" readonly /></td>
        <td class="border border-gray-300 px-2 py-1"><input type="text" name="pst[]" class="pst" readonly /></td>
        <td class="border border-gray-300 px-2 py-1"><input type="text" name="amount[]" class="amount" readonly /></td>
      </tr>
    </tbody>
  </table>
  <h3>Total: <span id="totalAmount">0</span></h3>
</div>


    <div id="bmFooter" style="display: none; width: 100%; margin: 0 auto;">
  <div style="text-align: center; font-weight: bold; font-size: 0.875rem; color: black; margin-bottom: 8px;">
    <span style="display: inline-block; margin-right: 0px;">Email: bilalali109@gmail.com</span>
    <span style="display: inline-block;">Cell: +92 331 418 5033</span>
  </div>

  <div style="background-color: #a64d79; color: white; font-weight: bold; font-family: serif; font-size: 1rem; padding: 8px 16px; text-align: center;">
        Shop No. 18, Street No. 64, Makhan Pura, Chah Miran, Lahore.
  </div>
</div>

    <!-- Faizan Traders Section -->
    <div id="faizanHeader" style="display: none; width: 100%; padding: 20px 30px; box-sizing: border-box; font-family: sans-serif;">
  <div style="display: flex; justify-content: space-between; align-items: flex-start;">
    <!-- Left: Company Info -->
    <div>
      <h1 style="text-align: center; font-size: 2.25rem; font-weight: 600; line-height: 1.25; margin: 0;">
        Faizan <span style="color: Blue;">Traders</span>
      </h1>
      <p style="color: #4a4a4a; font-size: 14px; line-height: 1.4; margin-top: 5px;">
        All Kind of Paper Products, Stationery, Printing<br />
        Furniture, Auto Workshop Works, Computer Accessories
      </p>
    </div>

    <!-- Right: Invoice Number -->
    <div id="faizanInvoiceNumber" style="font-weight: bold; color: black; font-size: 14px; text-align: right; margin-top: 10px;">
      <!-- filled dynamically -->
    </div>
  </div>

  <!-- Ref and Date row -->
  <div style="display: flex; justify-content: space-between; margin-top: 30px; font-size: 14px; color: #4a4a4a; font-weight: 500;">
    <div>
      Ref #: <span style="display: inline-block; width: 200px; border-bottom: 1px solid #aaa;"></span>
    </div>
    <div>
      Date: <span style="display: inline-block; width: 200px; border-bottom: 1px solid #aaa;"></span>
    </div>
  </div>
</div>

    

    <div id="faizanContainer" style="display:none;">
      <h2>Sales Table</h2>
      <table id="faizanTable" class="w-full border-collapse border border-gray-300">
        <thead>
          <tr>
            <th class="border border-gray-300 px-2 py-1">SR No</th>
            <th class="border border-gray-300 px-2 py-1">Description</th>
            <th class="border border-gray-300 px-2 py-1">QTY</th>
            <th class="border border-gray-300 px-2 py-1">Unit Rate</th>
            <th class="border border-gray-300 px-2 py-1">Labour</th>
            <th class="border border-gray-300 px-2 py-1">GST (18%)</th>
            <th class="border border-gray-300 px-2 py-1">PST (16%)</th>
            <th class="border border-gray-300 px-2 py-1">Amount</th>
          </tr>
        </thead>
        <tbody id="faizanTableBody">
          <tr>
            <td class="border border-gray-300 px-2 py-1">1</td>
            <td class="border border-gray-300 px-2 py-1"><input type="text" name="description[]" /></td>
            <td class="border border-gray-300 px-2 py-1"><input type="number" name="qty[]" class="qty" oninput="calculateRow(this)" /></td>
            <td class="border border-gray-300 px-2 py-1"><input type="number" name="rate[]" class="rate" oninput="calculateRow(this)" /></td>
            <td class="border border-gray-300 px-2 py-1"><input type="number" name="labour[]" class="labour" oninput="calculateRow(this)" /></td>
            <td class="border border-gray-300 px-2 py-1"><input type="text" name="gst[]" class="gst" readonly /></td>
            <td class="border border-gray-300 px-2 py-1"><input type="text" name="pst[]" class="pst" readonly /></td>
            <td class="border border-gray-300 px-2 py-1"><input type="text" name="amount[]" class="amount" readonly /></td>
          </tr>
        </tbody>
      </table>
      <h3>Total: <span id="totalAmountFaizan">0</span></h3>
    </div>

   <div id="faizanFooter" style="display: none; width: 100%; margin: 0 auto;">
  <div style="text-align: center; font-weight: bold; font-size: 0.875rem; color: black; margin-bottom: 8px;">
    <span style="display: inline-block; margin-right: 0px;">tradersa895@gmail.com</span>
    <span style="display: inline-block;">Cell: +92 323 1464657</span>
  </div>

  <div style="background-color: Blue; color: white; font-weight: bold; font-family: serif; font-size: 1rem; padding: 8px 16px; text-align: center;">
    Office # 7, Al Qamar Centre, 26 Kabeer Street, Urdu Bazar Lahore
  </div>
</div>

    
    <div id="azHeader" style="display: none; width: 100%; padding: 20px 30px; box-sizing: border-box; font-family: sans-serif;">
  <div style="display: flex; justify-content: space-between; align-items: flex-start;">
    <!-- Left: Company Info -->
    <div>
      <h1 style="text-align: center; font-size: 2.25rem; font-weight: 600; line-height: 1.25; margin: 0;">
        AZ <span style="color: red;">Traders</span>
      </h1>
      <p style="color: #4a4a4a; font-size: 14px; line-height: 1.4; margin-top: 5px;">
        All Kind of Paper Products, Stationery, Printing<br />
        Furniture, Auto Workshop Works, Computer Accessories
      </p>
    </div>

    <!-- Right: Invoice Number -->
    <div id="azInvoiceNumber" style="font-weight: bold; color: black; font-size: 14px; text-align: right; margin-top: 10px;">
      <!-- filled dynamically -->
    </div>
  </div>

  <!-- Ref and Date row -->
  <div style="display: flex; justify-content: space-between; margin-top: 30px; font-size: 14px; color: #4a4a4a; font-weight: 500;">
    <div>
      Ref #: <span style="display: inline-block; width: 200px; border-bottom: 1px solid #aaa;"></span>
    </div>
    <div>
      Date: <span style="display: inline-block; width: 200px; border-bottom: 1px solid #aaa;"></span>
    </div>
  </div>
</div>

    <div id="azContainer" style="display:none;">
      <h2>Sales Table</h2>
      <table id="azTable" class="w-full border-collapse border border-gray-300">
        <thead>
          <tr>
            <th class="border border-gray-300 px-2 py-1">SR No</th>
        <th class="border border-gray-300 px-2 py-1">Description</th>
        <th class="border border-gray-300 px-2 py-1">QTY</th>
        <th class="border border-gray-300 px-2 py-1">Unit Rate</th>
        <th class="border border-gray-300 px-2 py-1">Labour</th>
        <th class="border border-gray-300 px-2 py-1">GST (18%)</th>
        <th class="border border-gray-300 px-2 py-1">PST (16%)</th>
        <th class="border border-gray-300 px-2 py-1">Amount</th>
          </tr>
        </thead>
        <tbody id="azTableBody">
          <tr>
            <td class="border border-gray-300 px-2 py-1">1</td>
        <td class="border border-gray-300 px-2 py-1"><input type="text" name="description[]" /></td>
        <td class="border border-gray-300 px-2 py-1"><input type="number" name="qty[]" class="qty" oninput="calculateRow(this)" /></td>
        <td class="border border-gray-300 px-2 py-1"><input type="number" name="rate[]" class="rate" oninput="calculateRow(this)" /></td>
        <td class="border border-gray-300 px-2 py-1"><input type="number" name="labour[]" class="labour" oninput="calculateRow(this)" /></td>
        <td class="border border-gray-300 px-2 py-1"><input type="text" name="gst[]" class="gst" readonly /></td>
        <td class="border border-gray-300 px-2 py-1"><input type="text" name="pst[]" class="pst" readonly /></td>
        <td class="border border-gray-300 px-2 py-1"><input type="text" name="amount[]" class="amount" readonly /></td>
          </tr>
        </tbody>
      </table>
      <h3>Total: <span id="totalAmountAZ">0</span></h3>
    </div>

   <div id="azFooter" style="display: none; width: 100%; margin: 0 auto;">
  <div style="text-align: center; font-weight: bold; font-size: 0.875rem; color: black; margin-bottom: 8px;">
    <span style="display: inline-block; margin-right: 0px;">tradersa895@gmail.com</span>
    <span style="display: inline-block;">Cell: +92 310 1427935</span>
  </div>

  <div style="background-color: red; color: white; font-style: bold; font-family: serif; font-size: 1rem; padding: 8px 16px; text-align: center;">
    Office # 23, 1st Floor Khawaja Arcade Wahdat Road Lahore
  </div>
</div>


  </div>
  

<!-- Trader Dropdown -->
<div class="mt-6 max-w-2xl mx-auto px-4" style="margin-top: 70px;">
  <label for="traderDropdown" class="font-semibold block mb-2">Select Trader:</label>
  <select id="traderDropdown" name="trader" class="w-full border border-gray-400 p-2 rounded">
    <option value="">-- Select Trader --</option>
    <option value="faizan">Faizan Traders</option>   
    <option value="az">Az Traders</option>
    <option value="bm">B&amp;M Enterprises</option>
  </select>
</div>

<!-- Buttons: Add, Clear, Save -->
<div style="max-width: 800px; margin: 30px auto 20px; display: flex; gap: 10px; justify-content: center; flex-wrap: wrap;">
  <button type="button" onclick="addRow()" style="background-color: #6b3de6; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Add Row</button>
  <button type="button" onclick="clearTable()" style="background-color: #dc3545; color: white; padding: 10px 20px; border: none; border-radius: 5px;">Clear Table</button>
<button type="button" onclick="saveAndDownloadPDF()" class="bg-red-600 text-white px-6 py-2 rounded hover:bg-red-700 transition">
    <i class="fas fa-download mr-2"></i>Download PDF
  </button></div>



</form>
<script>
function saveAndDownloadPDF() {
  const form = document.getElementById("salesForm");
  const formData = new FormData(form);

  fetch('save_table.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.text())
  .then(data => {
    const match = data.trim().match(/Invoice saved in table:\s*(\S+)/i);
    const invoiceNumber = match ? match[1] : "N/A";

    // Update invoice numbers
    ["bmInvoiceNumber", "faizanInvoiceNumber", "azInvoiceNumber"].forEach(id => {
      const el = document.getElementById(id);
      if (el) el.innerText = "Invoice #: " + invoiceNumber;
    });

    // Show confirmation message
    let resultDiv = document.getElementById("invoiceResult");
    if (!resultDiv) {
      resultDiv = document.createElement("div");
      resultDiv.id = "invoiceResult";
      document.body.appendChild(resultDiv);
    }
    resultDiv.innerHTML = `
      <div style="margin-top: 20px; background: #dff0d8; color: #3c763d; padding: 15px; border-radius: 5px;">
        ${data}<br>Page will refresh in seconds...
      </div>
    `;

    // Refresh after 2 seconds
    setTimeout(() => {
      window.location.reload();
    }, 1000);

    const selectedTrader = document.getElementById("traderDropdown").value;
    const traders = ["bm", "faizan", "az"];

    // Show only selected trader sections
    traders.forEach(trader => {
      ["Header", "Footer", "Container"].forEach(part => {
        const el = document.getElementById(`${trader}${part}`);
        if (el) el.style.display = trader === selectedTrader ? "block" : "none";
      });
    });

    // Hide UI controls
    const uiControls = document.querySelector(".ui-controls");
    if (uiControls) uiControls.style.display = "none";

    // Spacer before footer
    let spacer;
    const footerEl = document.getElementById(`${selectedTrader}Footer`);
    if (footerEl) {
      spacer = document.createElement("div");
      spacer.className = "pdf-footer-spacer";
      spacer.style.height = "630px";
      footerEl.parentNode.insertBefore(spacer, footerEl);
    }
    

    const element = document.getElementById("pdfContent");
    if (!element) {
      alert("PDF content element not found.");
      return;
    }

    const options = {
      margin: 0.2,
      filename: `invoice-${invoiceNumber}.pdf`,
      image: { type: 'jpeg', quality: 0.98 },
      html2canvas: { scale: 2 },
      jsPDF: { unit: 'in', format: 'A4', orientation: 'portrait' }
    };

    // 👉 Insert watermark
    const watermarkDiv = document.createElement("div");
    watermarkDiv.className = "watermark";
    const img = document.createElement("img");

    if (selectedTrader === "bm") {
      img.src = "bmlogo.png";
    } else if (selectedTrader === "faizan") {
      img.src = "ftlogo.png";
    } else if (selectedTrader === "az") {
      img.src = "azlogo.png";
    }

    watermarkDiv.appendChild(img);
    element.appendChild(watermarkDiv);

    // ✅ Generate PDF and cleanup
    html2pdf().from(element).set(options).save().then(() => {
      // Restore UI
      if (uiControls) uiControls.style.display = "block";
      if (spacer && spacer.parentNode) {
        spacer.parentNode.removeChild(spacer);
      }

      // Remove watermark
      if (watermarkDiv && watermarkDiv.parentNode) {
        watermarkDiv.parentNode.removeChild(watermarkDiv);
      }

      // Hide trader sections
      traders.forEach(trader => {
        ["Header", "Footer", "Container"].forEach(part => {
          const el = document.getElementById(`${trader}${part}`);
          if (el) el.style.display = "none";
        });
      });
    });

  })
  .catch(err => {
    alert("Error saving or generating PDF: " + err.message);
  });
}
</script>


<script>
  function addRow() {
  const trader = document.getElementById('traderDropdown').value;
  if (!trader) {
    alert('Please select a trader first.');
    return;
  }

  const tableBodyIdMap = {
    bm: 'bmTableBody',
    faizan: 'faizanTableBody',
    az: 'azTableBody'
  };

  const tableBody = document.getElementById(tableBodyIdMap[trader]);
  if (!tableBody) return;

  const rowCount = tableBody.rows.length + 1;
  const newRow = document.createElement('tr');

  const createCell = (className, inputType, name, inputClass = '', readonly = false, oninputFn = null) => {
    const cell = document.createElement('td');
    cell.className = className;

    const input = document.createElement('input');
    input.type = inputType;
    input.name = name;

    if (inputClass) input.classList.add(inputClass); // ✅ Correctly adds class
    if (readonly) input.readOnly = true;
    if (oninputFn) input.addEventListener('input', () => oninputFn(input));

    cell.appendChild(input);
    return cell;
  };

  // SR No
  const srNoCell = document.createElement('td');
  srNoCell.className = 'border border-gray-300 px-2 py-1';
  srNoCell.textContent = rowCount;
  newRow.appendChild(srNoCell);

  // Description
  newRow.appendChild(createCell('border border-gray-300 px-2 py-1', 'text', 'description[]'));

  // Quantity
  newRow.appendChild(createCell('border border-gray-300 px-2 py-1', 'number', 'qty[]', 'qty', false, calculateRow));

  // Rate
  newRow.appendChild(createCell('border border-gray-300 px-2 py-1', 'number', 'rate[]', 'rate', false, calculateRow));

  // Labour
  newRow.appendChild(createCell('border border-gray-300 px-2 py-1', 'number', 'labour[]', 'labour', false, calculateRow));

  // Amount
  newRow.appendChild(createCell('border border-gray-300 px-2 py-1', 'text', 'amount[]', 'amount', true));

  // GST
  newRow.appendChild(createCell('border border-gray-300 px-2 py-1', 'text', 'gst[]', 'gst', true));

  // PST (only for az)
  if (trader === 'az') {
    newRow.appendChild(createCell('border border-gray-300 px-2 py-1', 'text', 'pst[]', 'pst', true));
  }

  tableBody.appendChild(newRow);
}

  function clearTable() {
    const trader = document.getElementById('traderDropdown').value;
    if (!trader) {
      alert('Please select a trader first.');
      return;
    }

    const tableBodyIdMap = {
      bm: 'bmTableBody',
      faizan: 'faizanTableBody',
      az: 'azTableBody'
    };

    const tableBody = document.getElementById(tableBodyIdMap[trader]);
    if (!tableBody) return;

    tableBody.innerHTML = '';
    const newRow = document.createElement('tr');

    const createCell = (className, inputType, name, inputClass = '', readonly = false, oninputFn = null) => {
      const cell = document.createElement('td');
      cell.className = className;
      const input = document.createElement('input');
      input.type = inputType;
      input.name = name;
      if (inputClass) input.className = inputClass;
      if (readonly) input.readOnly = true;
      if (oninputFn) input.oninput = () => oninputFn(input);
      cell.appendChild(input);
      return cell;
    };

    const srNoCell = document.createElement('td');
    srNoCell.className = 'border border-gray-300 px-2 py-1';
    srNoCell.textContent = '1';
    newRow.appendChild(srNoCell);

    newRow.appendChild(createCell('border border-gray-300 px-2 py-1', 'text', 'description[]'));
    newRow.appendChild(createCell('border border-gray-300 px-2 py-1', 'number', 'qty[]', 'qty', false, calculateRow));
    newRow.appendChild(createCell('border border-gray-300 px-2 py-1', 'number', 'rate[]', 'rate', false, calculateRow));
    newRow.appendChild(createCell('border border-gray-300 px-2 py-1', 'number', 'labour[]', 'labour', false, calculateRow));
    newRow.appendChild(createCell('border border-gray-300 px-2 py-1', 'text', 'amount[]', 'amount', true));
    newRow.appendChild(createCell('border border-gray-300 px-2 py-1', 'text', 'gst[]', 'gst', true));

    if (trader === 'az') {
      newRow.appendChild(createCell('border border-gray-300 px-2 py-1', 'text', 'pst[]', 'pst', true));
    }

    tableBody.appendChild(newRow);
    updateTotal(trader);
  }

  function updateTotal(trader) {
    const totalIdMap = {
      bm: 'totalAmount',
      faizan: 'totalAmountFaizan',
      az: 'totalAmountAZ'
    };
    const totalEl = document.getElementById(totalIdMap[trader]);
    if (totalEl) {
      totalEl.textContent = '0';
    }
  }
</script>


<script>
  document.getElementById('traderDropdown').addEventListener('change', function() {
    const val = this.value;

    // Hide all containers
    document.getElementById('bmContainer').style.display = 'none';
    document.getElementById('faizanContainer').style.display = 'none';
    document.getElementById('azContainer').style.display = 'none';

    // Hide all headers/footers (in case they were visible from PDF render)
    document.getElementById('bmHeader').style.display = 'none';
    document.getElementById('bmFooter').style.display = 'none';
    document.getElementById('faizanHeader').style.display = 'none';
    document.getElementById('faizanFooter').style.display = 'none';
    document.getElementById('azHeader').style.display = 'none';
    document.getElementById('azFooter').style.display = 'none';

    // Show only selected container
    if (val === 'bm') {
      document.getElementById('bmContainer').style.display = 'block';
    } else if (val === 'faizan') {
      document.getElementById('faizanContainer').style.display = 'block';
    } else if (val === 'az') {
      document.getElementById('azContainer').style.display = 'block';
    }
  });
</script>

<script>
  function calculateRow(input) {
    const row = input.closest('tr');

    const qty = parseFloat(row.querySelector('input.qty')?.value) || 0;
    const rate = parseFloat(row.querySelector('input.rate')?.value) || 0;
    const labour = parseFloat(row.querySelector('input.labour')?.value) || 0;

    const gstInput = row.querySelector('input.gst');
    const pstInput = row.querySelector('input.pst');
    const amountInput = row.querySelector('input.amount');

    const baseAmount = qty * rate;
    const gst = baseAmount * 0.18; // 18% of qty × rate
    const pst = labour * 0.16;     // 16% of labour

    const totalAmount = baseAmount + labour + gst + pst;

    gstInput.value = gst.toFixed(2);
    pstInput.value = pst.toFixed(2);
    amountInput.value = totalAmount.toFixed(2);

    updateTotalForTrader(input);
  }

  function updateTotalForTrader(input) {
    const container = input.closest('div[id$="Container"]');
    if (!container) return;

    const amounts = container.querySelectorAll('input.amount');
    let total = 0;
    amounts.forEach(a => {
      const val = parseFloat(a.value);
      if (!isNaN(val)) total += val;
    });

    let totalSpanId;
    if (container.id === 'bmContainer') totalSpanId = 'totalAmount';
    else if (container.id === 'faizanContainer') totalSpanId = 'totalAmountFaizan';
    else if (container.id === 'azContainer') totalSpanId = 'totalAmountAZ';
    else return;

    document.getElementById(totalSpanId).textContent = total.toFixed(2);
  }
</script>






</body>
