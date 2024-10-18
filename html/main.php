<?php 
session_start();
include "auth/database/db.php";
if (!isset($_SESSION['emailAddress'])) {
    echo "<script>alert('User not logged in.'); window.location.href='login.php';</script>";
    exit();
}
$emailFK = mysqli_real_escape_string($conn, $_SESSION['emailAddress']);
// Pagination variables
$contactsPerPage = 5; // Number of contacts per page
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $contactsPerPage;

// Fetch total contacts for pagination
$totalContactsQuery = "SELECT COUNT(*) AS total FROM contactInfo WHERE emailFK = '$emailFK'";
$totalContactsResult = mysqli_query($conn, $totalContactsQuery);
$totalContacts = mysqli_fetch_assoc($totalContactsResult)['total'];
$totalPages = ceil($totalContacts / $contactsPerPage);

// Fetch contacts
$sql = "SELECT * FROM contactInfo WHERE emailFK = '$emailFK' LIMIT $offset, $contactsPerPage";
$result = mysqli_query($conn, $sql);
?>
<?php include('header-footer/headermain.php'); ?>
<style>
  .nav-tabs .nav-link.active {
    font-weight: bold;
    color: #007bff;
  }
</style>
<div class="content-wrapper d-flex justify-content-center align-items-center" style="min-height: 100vh;">
  <div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
      <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-12">
              <div class="card-body">
                <h2 class="card-title text-primary text-center">CONTACT SYSTEM</h2>
                <!-- Tab Navigation -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="contacts-tab" data-bs-toggle="tab" href="#contacts" role="tab" aria-controls="contacts" aria-selected="true">Contacts</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="addContact-tab" data-bs-toggle="tab" href="#addContact" role="tab" aria-controls="addContact" aria-selected="false">Add Contact</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="logout-tab" data-bs-toggle="tab" href="#logout" role="tab" aria-controls="logout" aria-selected="false">Logout</a>
                  </li>
                </ul>
                <!-- Tab Content -->
                <div class="tab-content mt-4" id="myTabContent">
                  <!-- Contacts Tab -->
                  <div class="tab-pane fade show active" id="contacts" role="tabpanel" aria-labelledby="contacts-tab">
                    <!-- Contacts Table -->
                    <div class="mt-3">
                      <h3>Contacts</h3>
                      <div class="input-group mb-3">
                          <input type="text" class="form-control" id="search" placeholder="Search" aria-label="Search">
                          <button class="btn btn-outline-secondary" id="searchBtn" type="button">Search</button>
                      </div>
                      <table class="table table-bordered" id="contactsTable">
                        <thead class="table-light">
                          <tr>
                              <th>Name</th>
                              <th>Company</th>
                              <th>Phone</th>
                              <th>Email</th>
                              <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          if (mysqli_num_rows($result) > 0) {
                              while ($row = mysqli_fetch_assoc($result)) {
                                  echo "<tr>
                                        <td>{$row['contactName']}</td>
                                        <td>{$row['contactCompany']}</td>
                                        <td>{$row['contactPhone']}</td>
                                        <td>{$row['contactEmail']}</td>
                                        <td>
                                            <a href='edit_contact.php?id={$row['contact_id']}'>Edit</a> | 
                                            <a href='delete_contact.php?id={$row['contact_id']}' class='text-danger'>Delete</a>
                                        </td>
                                    </tr>";
                              }
                          } else {
                              echo "<tr><td colspan='5' class='text-center'>No contacts found.</td></tr>";
                          }
                          ?>
                        </tbody>
                      </table>
                      <!-- Pagination -->
                      <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                          <?php if ($currentPage > 1): ?>
                              <li class="page-item"><a class="page-link" href="?page=<?php echo $currentPage - 1; ?>">Previous</a></li>
                          <?php endif; ?>
                          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                              <li class="page-item <?php if ($i === $currentPage) echo 'active'; ?>">
                                  <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                              </li>
                          <?php endfor; ?>
                          <?php if ($currentPage < $totalPages): ?>
                              <li class="page-item"><a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">Next</a></li>
                          <?php endif; ?>
                        </ul>
                      </nav>
                    </div>
                  </div>
                  <!-- Add Contact Tab -->
                  <div class="tab-pane fade" id="addContact" role="tabpanel" aria-labelledby="addContact-tab">
                    <!-- Add Contact Form -->
                    <div class="mt-3">
                      <h3>Add New Contact</h3>
                      <form action="add_contact_back.php" method="POST">
                        <div class="mb-3">
                          <label for="name" class="form-label">Name</label>
                          <input type="text" class="form-control" id="name" name="contactName" required placeholder="Enter full name">
                        </div>
                        <div class="mb-3">
                          <label for="company" class="form-label">Company</label>
                          <input type="text" class="form-control" id="company" name="contactCompany" required placeholder="Enter company name">
                        </div>
                        <div class="mb-3">
                          <label for="phone" class="form-label">Phone</label>
                          <input type="tel" class="form-control" id="phone" name="contactPhone" required placeholder="Enter phone number">
                        </div>
                        <div class="mb-3">
                          <label for="email" class="form-label">Email</label>
                          <input type="email" class="form-control" id="email" name="contactEmail" required placeholder="Enter email address">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Contact</button>
                      </form>
                    </div>
                  </div>
                  <!-- Logout Tab -->
                  <div class="tab-pane fade" id="logout" role="tabpanel" aria-labelledby="logout-tab">
                    <div class="mt-3 text-center">
                      <h3>Logout</h3>
                      <p>Are you sure you want to log out?</p>
                      <a href="logout_back.php" class="btn btn-danger">Logout</a>
                      <a href="#contacts" class="btn btn-secondary" data-bs-toggle="tab">Cancel</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  $(document).ready(function() {
      // Search functionality
      $("#searchBtn").click(function() {
          var query = $("#search").val();
          $.ajax({
              url: "search_contacts.php",
              method: "POST",
              data: {search: query},
              success: function(data) {
                  $("#contactsTable tbody").html(data);
              }
          });
      });

      $("#search").on("keypress", function(e) {
          if (e.which === 13) {
              $("#searchBtn").click();
          }
      });
  });
</script>

<?php include('header-footer/footermain.php'); ?>
