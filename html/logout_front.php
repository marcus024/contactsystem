<?php include('header-footer/headermain.php'); ?>

<div class="content-wrapper d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-lg-6 mb-4 order-0">
        <div class="card">
          <div class="card-body text-center">
            <h2 class="card-title text-primary">Confirm Logout</h2>
            <p>Are you sure you want to log out?</p>

            <!-- Logout and Cancel buttons -->
            <div class="mt-4">
              <a href="logout_back.php" class="btn btn-danger">Logout</a>
              <a href="main.php" class="btn btn-secondary">Cancel</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include('header-footer/footermain.php'); ?>
