<?php 
session_start();
include "auth/database/db.php";

// Check if the user email is set in the session
if (!isset($_SESSION['emailAddress'])) {
    echo "<script>alert('User not logged in.'); window.location.href='login.php';</script>";
    exit();
}

// Get the contact ID from the URL
if (isset($_GET['id'])) {
    $contactId = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Fetch the contact data from the database
    $sql = "SELECT * FROM contactInfo WHERE contact_id = '$contactId' AND emailFK = '{$_SESSION['emailAddress']}'";
    $result = mysqli_query($conn, $sql);
    
    // Check if the contact exists
    if (mysqli_num_rows($result) == 0) {
        echo "<script>alert('Contact not found.'); window.location.href='main.php';</script>";
        exit();
    }
    
    $contact = mysqli_fetch_assoc($result);
} else {
    echo "<script>alert('Invalid contact ID.'); window.location.href='main.php';</script>";
    exit();
}
?>

<?php include ('header-footer/headermain.php'); ?>

<div class="content-wrapper d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-12">
              <div class="card-body">
                <h2 class="card-title text-primary text-center">Edit Contact</h2>
                <form method="POST" action="update_contact.php">
                  <input type="hidden" name="contact_id" value="<?php echo $contact['contact_id']; ?>">
                  <div class="mb-3">
                    <label for="contactName" class="form-label">Name</label>
                    <input type="text" class="form-control" id="contactName" name="contactName" value="<?php echo $contact['contactName']; ?>" required>
                  </div>
                  <div class="mb-3">
                    <label for="contactCompany" class="form-label">Company</label>
                    <input type="text" class="form-control" id="contactCompany" name="contactCompany" value="<?php echo $contact['contactCompany']; ?>" required>
                  </div>
                  <div class="mb-3">
                    <label for="contactPhone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="contactPhone" name="contactPhone" value="<?php echo $contact['contactPhone']; ?>" required>
                  </div>
                  <div class="mb-3">
                    <label for="contactEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="contactEmail" name="contactEmail" value="<?php echo $contact['contactEmail']; ?>" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Update Contact</button>
                  <a href="main.php" class="btn btn-secondary">Cancel</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include ('header-footer/footermain.php'); ?>
