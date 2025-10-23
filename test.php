<style>
  .sales-form-container {
    max-width: 360px;
    margin: 30px auto;
    padding: 20px;
    background: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 10px;
    font-family: 'Segoe UI', sans-serif;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
  }

  .sales-form-container h3 {
    text-align: center;
    margin-bottom: 15px;
    font-size: 20px;
    color: #333;
  }

  .form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 10px;
  }

  .form-group label {
    font-size: 14px;
    color: #444;
    margin-bottom: 4px;
  }

  .form-group input {
    padding: 6px 10px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
  }

  .form-group input[readonly] {
    background-color: #f1f1f1;
    color: #555;
  }
</style>

<div class="sales-form-container">
  <h3>Sales Entry</h3>
  <form id="salesForm">
    <div class="form-group">
      <label>Bill Amount</label>
      <input type="number" class="bill" />
    </div>

    <div class="form-group">
      <label>Cheque Amount</label>
      <input type="number" class="cheque" />
    </div>

    <div class="form-group">
      <label>Total GST</label>
      <input type="number" class="totalGst" />
    </div>

    <div class="form-group">
      <label>GST 1.5%</label>
      <input type="number" class="gst1_5" readonly />
    </div>

    <div class="form-group">
      <label>Remaining GST</label>
      <input type="number" class="remGst" readonly />
    </div>

    <div class="form-group">
      <label>Vendor % (default 10%)</label>
      <input type="number" class="vendorPercent" placeholder="10" />
    </div>

    <div class="form-group">
      <label>Cashier % (default 0%)</label>
      <input type="number" class="cashierPercent" placeholder="0" />
    </div>

    <div class="form-group">
      <label>AG % (default 8%)</label>
      <input type="number" class="agPercent" placeholder="8" />
    </div>

    <div class="form-group">
      <label>Office % (default 7%)</label>
      <input type="number" class="officePercent" placeholder="7" />
    </div>

    <div class="form-group">
      <label>Balance</label>
      <input type="number" class="balance" readonly />
    </div>
  </form>
</div>
