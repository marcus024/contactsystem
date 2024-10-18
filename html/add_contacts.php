<?php include ('header-footer/headermain.php'); ?>

<div class="content-wrapper d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-12">
              <div class="card-body">
                <h2 class="card-title text-primary text-center">Add New Contact</h2>

                <!-- Add Contact Form Begins Here -->
                <form action="add_contact_back.php" method="POST">
                  <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input required type="text" class="form-control" id="name" name="contactName" placeholder="Enter full name" required>
                  </div>
                  <div class="mb-3">
                    <label for="company" class="form-label">Company</label>
                    <input required type="text" class="form-control" id="company" name="contactCompany" placeholder="Enter company name" required>
                  </div>
                  <div class="mb-3">
                    <label for="phone" class="form-label">Phone</label>
                    <input required type="tel" class="form-control" id="phone" name="contactPhone" placeholder="Enter phone number" required>
                  </div>
                  <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input required type="email" class="form-control" id="email" name="contactEmail" placeholder="Enter email address" required>
                  </div>
                  <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Add Contact</button>
                  </div>
                </form>
                <!-- Add Contact Form Ends Here -->

                <div class="mt-3">
                  <a href="main.php" class="btn btn-secondary">Back to Contacts</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include ('header-footer/footermain.php'); ?>
